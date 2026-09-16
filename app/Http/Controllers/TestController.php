<?php

namespace App\Http\Controllers;

use App\Models\Test;
use App\Models\Department;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {
        $tests = Test::with('department')->latest()->paginate(10);
        return view('tests.index', compact('tests'));
    }

    public function create()
    {
        $departments = Department::all();
        return view('tests.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'department_id' => 'required|exists:departments,id',
            'specimen_type' => 'nullable|string',
            'container' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'cost' => 'required|numeric|min:0',
            'turnaround_time' => 'nullable|integer',
        ]);
        
        $lastTest = Test::latest('id')->first();
        $nextId = $lastTest ? $lastTest->id + 1 : 1;
        $data['test_code'] = 'TST-' . str_pad($nextId, 4, '0', STR_PAD_LEFT);
        
        Test::create($data);

        return redirect()->route('tests.index')->with('success', 'Test added successfully!');
    }

    public function show(Test $test)
    {
        return view('tests.show', compact('test'));
    }

    public function edit(Test $test)
    {
        $departments = Department::all();
        return view('tests.edit', compact('test', 'departments'));
    }

    public function update(Request $request, Test $test)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'department_id' => 'required|exists:departments,id',
            'specimen_type' => 'nullable|string',
            'container' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'cost' => 'required|numeric|min:0',
            'turnaround_time' => 'nullable|integer',
            'status' => 'boolean'
        ]);
        
        $test->update($data);
        return redirect()->route('tests.index')->with('success', 'Test updated successfully!');
    }

    public function destroy(Test $test)
    {
        $test->delete();
        return redirect()->route('tests.index')->with('success', 'Test removed.');
    }
}
