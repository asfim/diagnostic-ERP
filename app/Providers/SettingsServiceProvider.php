<?php

namespace App\Providers;

use App\Models\Setting;
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
        }
    }
}
