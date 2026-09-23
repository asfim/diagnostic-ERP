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
        $patients = Patient::latest()->get();
        $tests = \App\Models\Test::where('status', true)->get();
        return view('diagnostic_orders.create', compact('patients', 'tests'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'order_date' => 'required|date',
            'discount' => 'nullable|numeric|min:0',
            'paid_amount' => 'required|numeric|min:0',
            'tests' => 'required|array|min:1',
            'tests.*' => 'exists:tests,id',
        ]);
        
        // Fetch the selected tests from DB to get their prices securely
        $selectedTests = \App\Models\Test::whereIn('id', $data['tests'])->get();
        $total_amount = $selectedTests->sum('price');
        $due_amount = $total_amount - ($data['discount'] ?? 0) - $data['paid_amount'];
        
        $orderData = [
            'patient_id' => $data['patient_id'],
            'order_date' => $data['order_date'],
            'total_amount' => $total_amount,
            'discount' => $data['discount'] ?? 0,
            'paid_amount' => $data['paid_amount'],
            'due_amount' => $due_amount,
        ];
        
        if ($orderData['due_amount'] <= 0) {
            $orderData['payment_status'] = 'Paid';
        } elseif ($orderData['paid_amount'] > 0) {
            $orderData['payment_status'] = 'Partial';
        } else {
            $orderData['payment_status'] = 'Unpaid';
        }
        
        $lastOrder = DiagnosticOrder::latest('id')->first();
        $nextId = $lastOrder ? $lastOrder->id + 1 : 1;
        $orderData['order_id'] = 'ORD-' . date('ymd') . '-' . str_pad($nextId, 4, '0', STR_PAD_LEFT);
        
        $order = DiagnosticOrder::create($orderData);

        // Insert items
        foreach ($selectedTests as $test) {
            \App\Models\DiagnosticOrderItem::create([
                'diagnostic_order_id' => $order->id,
                'test_id' => $test->id,
                'price' => $test->price,
                'status' => 'Pending'
            ]);
        }

        return redirect()->route('diagnostic-orders.index')->with('success', 'Lab order created successfully!');
    }

    public function show($id)
    {
        $order = DiagnosticOrder::findOrFail($id);
        $settings = \App\Models\Setting::pluck('value', 'key');
        return view('diagnostic_orders.show', compact('order', 'settings'));
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
            'paid_amount' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0',
        ]);
        
        $discount = $data['discount'] ?? 0;
        $due_amount = $order->total_amount - $discount - $data['paid_amount'];
        
        $data['due_amount'] = $due_amount;
        $data['discount'] = $discount;
        
        if ($due_amount <= 0) {
            $data['payment_status'] = 'Paid';
        } elseif ($data['paid_amount'] > 0) {
            $data['payment_status'] = 'Partial';
        } else {
            $data['payment_status'] = 'Unpaid';
        }
        
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
