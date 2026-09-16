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
        $orders = DiagnosticOrder::where('order_status', 'Pending')->get();
        $tests = Test::all();
        return view('test_results.create', compact('orders', 'tests'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'diagnostic_order_id' => 'required|exists:diagnostic_orders,id',
            'test_id' => 'required|exists:tests,id',
            'result_value' => 'required|string',
            'remarks' => 'nullable|string',
        ]);
        
        $order = DiagnosticOrder::findOrFail($data['diagnostic_order_id']);
        $data['patient_id'] = $order->patient_id;
        $data['status'] = 'Completed';
        
        TestResult::create($data);

        return redirect()->route('test-results.index')->with('success', 'Lab result recorded successfully!');
    }

    public function show($id)
    {
        $result = TestResult::findOrFail($id);
        return view('test_results.show', compact('result'));
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
