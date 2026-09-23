<?php

namespace App\Http\Controllers;

use App\Http\Requests\PricingPageRequest;
use App\Models\HomeSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PricingPageController extends Controller
{
    public function index(): View
    {
        $content = HomeSetting::getSection('pricing_page_section', $this->defaults());

        return view('admin.pricing-page.index', compact('content'));
    }

    public function update(PricingPageRequest $request): RedirectResponse
    {
        HomeSetting::updateOrCreate(['key' => 'pricing_page_section'], ['value' => $request->validated()]);

        return redirect()->route('pricing-page.index')->with('success', 'Pricing page updated successfully!');
    }

    private function defaults(): array
    {
        return [
            'label' => 'Transparent Pricing',
            'title' => 'Affordable Diagnostics for All',
            'description' => 'We believe in transparent pricing with no hidden costs. Search for specific tests or choose one of our comprehensive health packages.',
            'promo_title' => 'Save up to 40%',
            'promo_description' => 'Choose our comprehensive health packages and save significantly on your total diagnostic costs.',
            'promo_button_text' => 'Explore Packages',
            'promo_button_link' => '/packages',
            'promo_icon' => 'bi-box2-heart',
        ];
    }
}
