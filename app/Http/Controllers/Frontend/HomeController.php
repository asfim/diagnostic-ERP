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
        $doctors      = Doctor::where('status', 1)->limit(4)->get();
        $tests        = Test::where('status', 1)->limit(8)->get();
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

        $about = HomeSetting::getSection('about_section', [
            'image' => null,
            'years_number' => '15+',
            'years_text' => "Years of\nExcellence",
            'label' => 'About MediDiag',
            'title' => 'Leading the Way in Medical Diagnostics',
            'description' => 'We provide comprehensive diagnostic services with a commitment to accuracy, reliability, and patient comfort. Our state-of-the-art facility is equipped with the latest medical technology.',
            'features' => [
                'Advanced Equipment',
                'Expert Pathologists',
                'Accurate Reports',
                'Fast Turnaround'
            ],
            'button_text' => 'Learn More',
            'button_link' => url('/about')
        ]);

        $whyChoose = HomeSetting::getSection('why_choose_section', [
            'image' => null,
            'label' => 'Why Choose Us',
            'title' => 'The MediDiag Difference',
            'description' => 'We merge medical expertise with advanced technology to deliver unparalleled diagnostic accuracy and patient care.',
            'features' => [
                ['icon'=>'bi-shield-check','color'=>'primary','title'=>'Accurate &amp; Reliable Reports','desc'=>'Rigorous quality control ensuring ISO-certified accuracy in every result.'],
                ['icon'=>'bi-clock-history','color'=>'success','title'=>'Fast Report Delivery','desc'=>'Minimum waiting time with online report access within hours.'],
                ['icon'=>'bi-cash-coin','color'=>'warning','title'=>'Affordable Pricing','desc'=>'Premium diagnostics at transparent, competitive rates. No hidden charges.'],
                ['icon'=>'bi-house-door','color'=>'danger','title'=>'Home Sample Collection','desc'=>'We come to you — convenient, safe, and timely doorstep service.'],
            ]
        ]);

        return view('frontend.home', compact('tests', 'packages', 'departments', 'doctors', 'hero', 'stats', 'quickActions', 'about', 'whyChoose'));
    }
}
