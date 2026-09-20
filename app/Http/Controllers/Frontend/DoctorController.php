<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Department;
use App\Models\DoctorSchedule;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index(Request $request)
    {
        $query = Doctor::with('department')->where('status', 'active');

        if ($request->filled('department')) {
            $query->where('department_id', $request->department);
        }
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $doctors     = $query->paginate(12);
        $departments = Department::get();

        return view('frontend.doctors.index', compact('doctors', 'departments'));
    }

    public function show($id)
    {
        $doctor    = Doctor::with('department')->findOrFail($id);
        $schedules = DoctorSchedule::where('doctor_id', $id)->get();

        return view('frontend.doctors.show', compact('doctor', 'schedules'));
    }
}
