<?php

namespace App\Http\Controllers;

use App\Models\TestResult;
use App\Models\DiagnosticOrder;
use App\Models\Test;
use Illuminate\Http\Request;

class TestResultController extends Controller
{
    public function index()
    {
        $results = TestResult::with(['test', 'patient'])->latest()->paginate(10);
        return view('test_results.index', compact('results'));
    }

    public function create()
    {
        $orders = DiagnosticOrder::with('items.test')->where('order_status', 'Pending')->get();
        $tests = Test::with('parameters')->get();
        return view('test_results.create', compact('orders', 'tests'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'diagnostic_order_id' => 'required|exists:diagnostic_orders,id',
            'test_id' => 'required|exists:tests,id',
            'remarks' => 'nullable|string',
            'result_value' => 'nullable|string',
            'parameters' => 'nullable|array',
            'parameters.*.id' => 'required|exists:test_parameters,id',
            'parameters.*.value' => 'required|string',
        ]);
        
        $order = DiagnosticOrder::findOrFail($data['diagnostic_order_id']);
        
        $result = TestResult::create([
            'diagnostic_order_id' => $data['diagnostic_order_id'],
            'test_id' => $data['test_id'],
            'patient_id' => $order->patient_id,
            'remarks' => $data['remarks'] ?? null,
            'status' => 'Completed',
            'result_value' => $data['result_value'] ?? 'Detailed Report'
        ]);

        if (!empty($data['parameters'])) {
            foreach ($data['parameters'] as $param) {
                \App\Models\TestResultValue::create([
                    'test_result_id' => $result->id,
                    'test_parameter_id' => $param['id'],
                    'value' => $param['value'],
                ]);
            }
        }
        
        // Update Order Status to Completed
        $order->update(['order_status' => 'Completed']);

        return redirect()->route('test-results.index')->with('success', 'Lab result recorded successfully!');
    }

    public function show($id)
    {
        $result = TestResult::with(['test', 'patient', 'diagnosticOrder', 'values.parameter'])->findOrFail($id);
        $settings = \App\Models\Setting::pluck('value', 'key');
        return view('test_results.show', compact('result', 'settings'));
    }

    public function edit($id)
    {
        $result = TestResult::findOrFail($id);
        return view('test_results.edit', compact('result'));
    }

    public function update(Request $request, $id)
    {
        $result = TestResult::findOrFail($id);
        $data = $request->validate([
            'result_value' => 'required|string',
            'remarks' => 'nullable|string',
            'status' => 'required|string',
        ]);
        
        $result->update($data);
        return redirect()->route('test-results.index')->with('success', 'Result updated successfully!');
    }

    public function destroy($id)
    {
        $result = TestResult::findOrFail($id);
        $result->delete();
        return redirect()->route('test-results.index')->with('success', 'Result deleted.');
    }
}
