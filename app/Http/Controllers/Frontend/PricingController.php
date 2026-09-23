<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\HomeSetting;
use App\Models\Test;
use Illuminate\View\View;

class PricingController extends Controller
{
    public function index(): View
    {
        $content = HomeSetting::getSection('pricing_page_section', [
            'label' => 'Transparent Pricing', 'title' => 'Affordable Diagnostics for All',
            'description' => 'We believe in transparent pricing with no hidden costs.',
            'promo_title' => 'Save up to 40%', 'promo_description' => 'Choose our comprehensive health packages and save significantly.',
            'promo_button_text' => 'Explore Packages', 'promo_button_link' => '/packages', 'promo_icon' => 'bi-box2-heart',
        ]);
        $tests = Test::where('status', true)->orderBy('name')->get();

        return view('frontend.pricing', compact('content', 'tests'));
    }
}
