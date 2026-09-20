<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Test;
use App\Models\Department;
use App\Models\TestCategory;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index(Request $request)
    {
        $query = Test::with('department')->where('status', 'active');

        if ($request->filled('department')) {
            $query->where('department_id', $request->department);
        }
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('test_code', 'like', '%' . $request->search . '%');
            });
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        $tests       = $query->paginate(16);
        $departments = Department::get();
        $categories  = TestCategory::get();

        return view('frontend.tests.index', compact('tests', 'departments', 'categories'));
    }

    public function show($id)
    {
        $test    = Test::with('department')->findOrFail($id);
        $related = Test::where('department_id', $test->department_id)
                       ->where('id', '!=', $id)
                       ->limit(4)->get();

        return view('frontend.tests.show', compact('test', 'related'));
    }
}
