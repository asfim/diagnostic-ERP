<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Doctor;
use App\Models\Test;
use App\Models\TestPackage;
use App\Models\Appointment;
use App\Models\Patient;
use App\Models\TestCategory;
use App\Models\DoctorSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

// =====================================================================
// HOME
// =====================================================================
class HomeController extends Controller
{
    public function index()
    {
        $departments  = Department::withCount('doctors', 'tests')->limit(8)->get();
        $doctors      = Doctor::where('status', 'active')->limit(4)->get();
        $tests        = Test::where('status', 'active')->limit(8)->get();
        $packages     = TestPackage::where('status', 'active')->orderBy('sort_order')->limit(3)->get();

        return view('frontend.home', compact('departments', 'doctors', 'tests', 'packages'));
    }
}
