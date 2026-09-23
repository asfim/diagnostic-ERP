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
use App\Models\Hero;
use App\Models\HomeSetting;
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

        $hero = Hero::first();
        $stats = HomeSetting::getSection('stats_section', [
            'doctors' => '50+',
            'tests' => '500+',
            'patients' => '100k+',
            'support' => '24/7'
        ]);

        $quickActions = HomeSetting::getSection('quick_actions', [
            [
                'icon' => 'bi-calendar-check-fill',
                'color' => 'primary',
                'title' => 'Book Appointment',
                'description' => 'Schedule a visit with our specialist doctors online — quick & hassle-free.',
                'button_text' => 'Book Now',
                'link' => url('/appointment')
            ],
            [
                'icon' => 'bi-file-medical-fill',
                'color' => 'success',
                'title' => 'Download Report',
                'description' => 'Access your diagnostic reports securely online at any time, from anywhere.',
                'button_text' => 'View Reports',
                'link' => url('/reports')
            ],
            [
                'icon' => 'bi-truck',
                'color' => 'danger',
                'title' => 'Home Collection',
                'description' => 'Our phlebotomists come to your doorstep for sample collection — safe & on time.',
                'button_text' => 'Request Now',
                'link' => url('/home-collection')
            ]
        ]);

        return view('frontend.home', compact('tests', 'packages', 'departments', 'doctors', 'hero', 'stats', 'quickActions'));
    }
}
