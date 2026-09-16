<?php

namespace App\Http\Controllers;

use App\Models\DiagnosticOrder;
use App\Models\Patient;
use Illuminate\Http\Request;

class DiagnosticOrderController extends Controller
{
    public function index()
    {
        $orders = DiagnosticOrder::with('patient')->latest()->paginate(10);
        return view('diagnostic_orders.index', compact('orders'));
    }

    public function create()
    {
        $patients = Patient::all();
        return view('diagnostic_orders.create', compact('patients'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'order_date' => 'required|date',
            'total_amount' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0',
            'paid_amount' => 'required|numeric|min:0',
        ]);
        
        $data['due_amount'] = $data['total_amount'] - ($data['discount'] ?? 0) - $data['paid_amount'];
        
        if ($data['due_amount'] <= 0) {
            $data['payment_status'] = 'Paid';
        } elseif ($data['paid_amount'] > 0) {
            $data['payment_status'] = 'Partial';
        } else {
            $data['payment_status'] = 'Unpaid';
        }
        
        $lastOrder = DiagnosticOrder::latest('id')->first();
        $nextId = $lastOrder ? $lastOrder->id + 1 : 1;
        $data['order_id'] = 'ORD-' . date('ymd') . '-' . str_pad($nextId, 4, '0', STR_PAD_LEFT);
        
        DiagnosticOrder::create($data);

        return redirect()->route('diagnostic-orders.index')->with('success', 'Lab order created successfully!');
    }

    public function show($id)
    {
        $order = DiagnosticOrder::findOrFail($id);
        return view('diagnostic_orders.show', compact('order'));
    }

    public function edit($id)
    {
        $order = DiagnosticOrder::findOrFail($id);
        $patients = Patient::all();
        return view('diagnostic_orders.edit', compact('order', 'patients'));
    }

    public function update(Request $request, $id)
    {
        $order = DiagnosticOrder::findOrFail($id);
        $data = $request->validate([
            'order_status' => 'required|string',
        ]);
        
        $order->update($data);
        return redirect()->route('diagnostic-orders.index')->with('success', 'Order updated successfully!');
    }

    public function destroy($id)
    {
        $order = DiagnosticOrder::findOrFail($id);
        $order->delete();
        return redirect()->route('diagnostic-orders.index')->with('success', 'Order deleted.');
    }
}
