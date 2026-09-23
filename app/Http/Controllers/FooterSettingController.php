<?php

namespace App\Http\Controllers;

use App\Http\Requests\FooterSettingRequest;
use App\Models\HomeSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class FooterSettingController extends Controller
{
    public function index(): View
    {
        $footer = HomeSetting::getSection('footer_section', $this->defaults());
        return view('admin.footer-settings.index', compact('footer'));
    }

    public function update(FooterSettingRequest $request): RedirectResponse
    {
        HomeSetting::updateOrCreate(['key' => 'footer_section'], ['value' => $request->validated()]);
        return redirect()->route('footer-settings.index')->with('success', 'Footer settings updated successfully!');
    }

    private function defaults(): array
    {
        return [
            'description' => 'We are committed to providing accurate and timely diagnostic reports to help you make informed healthcare decisions.',
            'cta_title' => 'Your Health. Our Priority.',
            'cta_description' => 'Experience world-class diagnostic services with state-of-the-art technology and expert medical professionals.',
            'cta_button_text' => 'Book an Appointment Now',
            'cta_button_link' => '/appointment',
            'socials' => [['name' => 'Facebook', 'icon' => 'bi-facebook', 'url' => ''], ['name' => 'Twitter', 'icon' => 'bi-twitter', 'url' => ''], ['name' => 'LinkedIn', 'icon' => 'bi-linkedin', 'url' => ''], ['name' => 'YouTube', 'icon' => 'bi-youtube', 'url' => '']],
            'quick_links' => [['label' => 'Home', 'url' => '/'], ['label' => 'About Us', 'url' => '/about'], ['label' => 'Our Doctors', 'url' => '/doctors'], ['label' => 'Download Report', 'url' => '/reports'], ['label' => 'Contact Us', 'url' => '/contact']],
            'service_links' => [['label' => 'Pathology', 'url' => '/departments'], ['label' => 'Radiology & Imaging', 'url' => '/departments'], ['label' => 'Cardiology', 'url' => '/departments'], ['label' => 'Health Packages', 'url' => '/packages'], ['label' => 'Home Sample Collection', 'url' => '/home-collection']],
        ];
    }
}
