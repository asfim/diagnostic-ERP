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
use App\Models\Testimonial;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

// =====================================================================
// HOME
// =====================================================================
class HomeController extends Controller
{
    public function about()
    {
        $aboutDefaults = [
            'image' => null,
            'years_number' => '15+',
            'years_text' => "Years of\nExcellence",
            'label' => 'About MediDiag',
            'title' => 'Leading the Way in Medical Diagnostics',
            'description' => 'We provide comprehensive diagnostic services with a commitment to accuracy, reliability, and patient comfort.',
            'quote' => 'Precision in every result, compassion in every interaction.',
            'features' => ['Advanced Equipment', 'Expert Pathologists', 'Accurate Reports', 'Fast Turnaround'],
            'button_text' => 'Learn More',
            'button_link' => url('/about'),
            'mission_title' => 'Our Mission',
            'mission_text' => 'To deliver precise, timely, and affordable diagnostic services to all segments of society while maintaining the highest ethical standards.',
            'vision_title' => 'Our Vision',
            'vision_text' => 'To become the leading and most trusted healthcare diagnostic brand in South Asia.',
            'values' => [
                ['title' => 'Integrity', 'description' => 'We uphold the highest moral standards in our practices.', 'icon' => 'bi-shield-check', 'color' => 'primary'],
                ['title' => 'Compassion', 'description' => 'We treat every patient with empathy and respect.', 'icon' => 'bi-heart', 'color' => 'danger'],
                ['title' => 'Excellence', 'description' => 'We continuously strive for clinical and service excellence.', 'icon' => 'bi-award', 'color' => 'secondary'],
                ['title' => 'Innovation', 'description' => 'Embracing new technologies for better diagnostics.', 'icon' => 'bi-lightbulb', 'color' => 'warning'],
            ],
            'infrastructure_title' => 'World-Class Infrastructure',
            'infrastructure_text' => 'Our laboratories are equipped with fully automated analyzers, ensuring zero manual error and fastest report delivery.',
            'infrastructure_points' => ['ISO 9001:2015 Certified Laboratories', 'Fully Automated Pathology Workflow', '3 Tesla MRI & 128 Slice CT Scan', 'Internal & External Quality Control'],
            'infrastructure_image' => null,
        ];
        $about = array_replace_recursive($aboutDefaults, HomeSetting::getSection('about_page_section', HomeSetting::getSection('about_section', [])));
        $stats = HomeSetting::getSection('stats_section', [
            'doctors' => '50+',
            'tests' => '500+',
            'patients' => '100k+',
        ]);

        return view('frontend.about', compact('about', 'stats'));
    }

    public function index()
    {
        $departments  = Department::withCount('doctors', 'tests')->limit(8)->get();
        $doctors      = Doctor::where('status', 1)->limit(4)->get();
        $tests        = Test::where('status', 1)->limit(8)->get();
        $packages     = TestPackage::where('status', 'active')->orderBy('sort_order')->limit(3)->get();
        $testimonials = Testimonial::where('status', true)->latest()->get();
        $blogs        = Blog::where('status', true)->latest('published_at')->latest()->limit(3)->get();

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

        $howItWorks = HomeSetting::getSection('how_it_works_section', [
            'label' => 'Process',
            'title' => 'How It Works',
            'steps' => [
                ['n'=>'1','icon'=>'bi-search','title'=>'Choose Service','desc'=>'Browse our tests, packages, or select a doctor for consultation.'],
                ['n'=>'2','icon'=>'bi-calendar-check','title'=>'Book Appointment','desc'=>'Pick a convenient date and time slot online or via phone.'],
                ['n'=>'3','icon'=>'bi-hospital','title'=>'Visit or Home','desc'=>'Visit our center, or we collect the sample from your home.'],
                ['n'=>'4','icon'=>'bi-file-earmark-check','title'=>'Get Report Online','desc'=>'Download your verified report securely from our portal.'],
            ]
        ]);

        return view('frontend.home', compact('tests', 'packages', 'departments', 'doctors', 'hero', 'stats', 'quickActions', 'about', 'whyChoose', 'howItWorks', 'testimonials', 'blogs'));
    }
}
