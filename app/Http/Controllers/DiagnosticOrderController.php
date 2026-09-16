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
            'prices' => 'required|array|min:1',
            'prices.*' => 'numeric|min:0',
        ]);
        
        // Calculate total from the submitted test prices (extra safety to avoid tampering if needed, but we'll trust the client side form structure for now and sum it)
        $total_amount = array_sum($data['prices']);
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
        foreach ($data['tests'] as $index => $testId) {
            \App\Models\DiagnosticOrderItem::create([
                'diagnostic_order_id' => $order->id,
                'test_id' => $testId,
                'price' => $data['prices'][$index],
                'status' => 'Pending'
            ]);
        }

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
