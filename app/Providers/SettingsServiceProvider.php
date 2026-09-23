<?php

namespace App\Providers;

use App\Models\Setting;
use App\Models\HomeSetting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class SettingsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Share settings with all views
        if (Schema::hasTable('settings')) {
            $settings = [
                'site_name'    => Setting::get('site_name', 'MediDiag'),
                'site_tagline' => Setting::get('site_tagline', 'Diagnostic & Clinic'),
                'site_phone'   => Setting::get('site_phone', '+880 1711 000 000'),
                'site_email'   => Setting::get('site_email', 'info@medidiag.com'),
                'site_address' => Setting::get('site_address', '123 Health Avenue, Dhaka'),
                'site_logo'    => Setting::get('site_logo', ''),
                'site_favicon' => Setting::get('site_favicon', ''),
            ];

            View::share('siteSettings', $settings);

            View::share('footerSettings', HomeSetting::getSection('footer_section', [
                'description' => 'We are committed to providing accurate and timely diagnostic reports to help you make informed healthcare decisions.',
                'cta_title' => 'Your Health. Our Priority.',
                'cta_description' => 'Experience world-class diagnostic services with state-of-the-art technology and expert medical professionals.',
                'cta_button_text' => 'Book an Appointment Now',
                'cta_button_link' => '/appointment',
                'socials' => [
                    ['name' => 'Facebook', 'icon' => 'bi-facebook', 'url' => ''],
                    ['name' => 'Twitter', 'icon' => 'bi-twitter', 'url' => ''],
                    ['name' => 'LinkedIn', 'icon' => 'bi-linkedin', 'url' => ''],
                    ['name' => 'YouTube', 'icon' => 'bi-youtube', 'url' => ''],
                ],
                'quick_links' => [
                    ['label' => 'Home', 'url' => '/'], ['label' => 'About Us', 'url' => '/about'], ['label' => 'Our Doctors', 'url' => '/doctors'], ['label' => 'Download Report', 'url' => '/reports'], ['label' => 'Contact Us', 'url' => '/contact'],
                ],
                'service_links' => [
                    ['label' => 'Pathology', 'url' => '/departments'], ['label' => 'Radiology & Imaging', 'url' => '/departments'], ['label' => 'Cardiology', 'url' => '/departments'], ['label' => 'Health Packages', 'url' => '/packages'], ['label' => 'Home Sample Collection', 'url' => '/home-collection'],
                ],
            ]));
        }
    }
}
