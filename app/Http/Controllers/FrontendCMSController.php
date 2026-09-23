<?php

namespace App\Http\Controllers;

use App\Models\Hero;
use App\Models\HomeSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FrontendCMSController extends Controller
{
    public function index()
    {
        $hero = Hero::first(); // Single hero
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

        return view('admin.cms.index', compact('hero', 'stats', 'quickActions', 'about', 'whyChoose', 'howItWorks'));
    }

    public function updateHero(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:500',
            'button_text' => 'nullable|string|max:50',
            'button_link' => 'nullable|string|max:255',
            'bg_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
            'overlay_color' => 'nullable|string|max:50',
        ]);

        $hero = Hero::first() ?? new Hero();
        $hero->title = $request->title;
        $hero->subtitle = $request->subtitle;
        $hero->button_text = $request->button_text;
        $hero->button_link = $request->button_link;
        $hero->overlay_color = $request->overlay_color ?? 'rgba(11, 94, 215, 0.85)';
        $hero->status = 1;

        if ($request->hasFile('bg_image')) {
            if ($hero->bg_image && Storage::disk('public')->exists($hero->bg_image)) {
                Storage::disk('public')->delete($hero->bg_image);
            }
            $hero->bg_image = $request->file('bg_image')->store('cms', 'public');
        } elseif ($request->remove_bg_image) {
            if ($hero->bg_image && Storage::disk('public')->exists($hero->bg_image)) {
                Storage::disk('public')->delete($hero->bg_image);
            }
            $hero->bg_image = null;
        }

        $hero->save();

        return redirect()->back()->with('success', 'Hero section updated successfully!');
    }

    public function updateStats(Request $request)
    {
        $request->validate([
            'stats.doctors' => 'required|string|max:50',
            'stats.tests' => 'required|string|max:50',
            'stats.patients' => 'required|string|max:50',
            'stats.support' => 'required|string|max:50',
        ]);

        $setting = HomeSetting::firstOrNew(['key' => 'stats_section']);
        $setting->value = $request->input('stats');
        $setting->save();

        return redirect()->back()->with('success', 'Stats section updated successfully!');
    }

    public function updateQuickActions(Request $request)
    {
        $request->validate([
            'quick_actions' => 'required|array|size:3',
            'quick_actions.*.title' => 'required|string|max:100',
            'quick_actions.*.description' => 'required|string|max:255',
            'quick_actions.*.icon' => 'required|string|max:50',
            'quick_actions.*.color' => 'required|string|max:50',
            'quick_actions.*.button_text' => 'required|string|max:50',
            'quick_actions.*.link' => 'required|string|max:255',
        ]);

        $setting = HomeSetting::firstOrNew(['key' => 'quick_actions']);
        $setting->value = $request->input('quick_actions');
        $setting->save();

        return redirect()->back()->with('success', 'Quick Actions section updated successfully!');
    }

    public function updateAbout(Request $request)
    {
        $request->validate([
            'years_number' => 'required|string|max:20',
            'years_text' => 'required|string|max:50',
            'label' => 'required|string|max:50',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'features' => 'required|array',
            'features.*' => 'nullable|string|max:100',
            'button_text' => 'required|string|max:50',
            'button_link' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
        ]);

        $setting = HomeSetting::firstOrNew(['key' => 'about_section']);
        $currentValue = $setting->value ?? [];

        $newValue = [
            'years_number' => $request->years_number,
            'years_text' => $request->years_text,
            'label' => $request->label,
            'title' => $request->title,
            'description' => $request->description,
            'features' => array_filter($request->features),
            'button_text' => $request->button_text,
            'button_link' => $request->button_link,
            'image' => $currentValue['image'] ?? null,
        ];

        if ($request->hasFile('image')) {
            if (!empty($currentValue['image']) && Storage::disk('public')->exists($currentValue['image'])) {
                Storage::disk('public')->delete($currentValue['image']);
            }
            $newValue['image'] = $request->file('image')->store('cms', 'public');
        } elseif ($request->remove_image) {
            if (!empty($currentValue['image']) && Storage::disk('public')->exists($currentValue['image'])) {
                Storage::disk('public')->delete($currentValue['image']);
            }
            $newValue['image'] = null;
        }

        $setting->value = $newValue;
        $setting->save();

        return redirect()->back()->with('success', 'About section updated successfully!');
    }

    public function updateWhyChoose(Request $request)
    {
        $request->validate([
            'label' => 'required|string|max:50',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'features' => 'required|array|size:4',
            'features.*.icon' => 'required|string|max:50',
            'features.*.color' => 'required|string|max:50',
            'features.*.title' => 'required|string|max:100',
            'features.*.desc' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
        ]);

        $setting = HomeSetting::firstOrNew(['key' => 'why_choose_section']);
        $currentValue = $setting->value ?? [];

        $newValue = [
            'label' => $request->label,
            'title' => $request->title,
            'description' => $request->description,
            'features' => $request->features,
            'image' => $currentValue['image'] ?? null,
        ];

        if ($request->hasFile('image')) {
            if (!empty($currentValue['image']) && Storage::disk('public')->exists($currentValue['image'])) {
                Storage::disk('public')->delete($currentValue['image']);
            }
            $newValue['image'] = $request->file('image')->store('cms', 'public');
        } elseif ($request->remove_image) {
            if (!empty($currentValue['image']) && Storage::disk('public')->exists($currentValue['image'])) {
                Storage::disk('public')->delete($currentValue['image']);
            }
            $newValue['image'] = null;
        }

        $setting->value = $newValue;
        $setting->save();

        return redirect()->back()->with('success', 'Why Choose Us section updated successfully!');
    }

    public function updateHowItWorks(Request $request)
    {
        $request->validate([
            'label' => 'required|string|max:50',
            'title' => 'required|string|max:255',
            'steps' => 'required|array|size:4',
            'steps.*.n' => 'required|string|max:10',
            'steps.*.icon' => 'required|string|max:50',
            'steps.*.title' => 'required|string|max:100',
            'steps.*.desc' => 'required|string|max:255',
        ]);

        $setting = HomeSetting::firstOrNew(['key' => 'how_it_works_section']);
        $setting->value = [
            'label' => $request->label,
            'title' => $request->title,
            'steps' => $request->steps,
        ];
        $setting->save();

        return redirect()->back()->with('success', 'How It Works section updated successfully!');
    }
}
