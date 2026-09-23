<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Doctor;
use App\Models\Test;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::withCount('doctors', 'tests')->get();
        return view('frontend.departments.index', compact('departments'));
    }

    public function show($slug)
    {
        $department = Department::where('slug', $slug)->firstOrFail();
        $doctors    = Doctor::where('department_id', $department->id)->where('status', 1)->get();
        $tests      = Test::where('department_id', $department->id)->where('status', 1)->get();

        return view('frontend.departments.show', compact('department', 'doctors', 'tests'));
    }
}
