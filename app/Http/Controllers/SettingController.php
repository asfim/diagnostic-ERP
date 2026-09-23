<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $settings = [
            'site_name'    => Setting::get('site_name', 'MediDiag'),
            'site_tagline' => Setting::get('site_tagline', 'Diagnostic & Clinic'),
            'site_phone'   => Setting::get('site_phone', ''),
            'site_email'   => Setting::get('site_email', ''),
            'site_address' => Setting::get('site_address', ''),
            'site_logo'    => Setting::get('site_logo', ''),
            'site_favicon' => Setting::get('site_favicon', ''),
            'site_whatsapp'=> Setting::get('site_whatsapp', ''),
        ];

        return view('settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'site_name'    => 'required|string|max:100',
            'site_tagline' => 'nullable|string|max:150',
            'site_phone'   => 'nullable|string|max:50',
            'site_email'   => 'nullable|email|max:100',
            'site_address' => 'nullable|string|max:300',
            'site_logo'    => 'nullable|image|mimes:png,jpg,jpeg,svg,webp|max:2048',
            'site_favicon' => 'nullable|image|mimes:png,jpg,ico,svg|max:512',
            'site_whatsapp'=> 'nullable|string|max:50',
        ]);

        // Text settings
        foreach (['site_name', 'site_tagline', 'site_phone', 'site_whatsapp', 'site_email', 'site_address'] as $key) {
            Setting::set($key, $request->input($key, ''));
        }

        // Logo upload
        if ($request->hasFile('site_logo')) {
            $oldLogo = Setting::get('site_logo');
            if ($oldLogo && Storage::disk('public')->exists($oldLogo)) {
                Storage::disk('public')->delete($oldLogo);
            }
            $path = $request->file('site_logo')->store('settings', 'public');
            Setting::set('site_logo', $path);
        }

        // Favicon upload
        if ($request->hasFile('site_favicon')) {
            $oldFav = Setting::get('site_favicon');
            if ($oldFav && Storage::disk('public')->exists($oldFav)) {
                Storage::disk('public')->delete($oldFav);
            }
            $path = $request->file('site_favicon')->store('settings', 'public');
            Setting::set('site_favicon', $path);
        }

        return redirect()->route('settings.index')->with('success', 'Settings updated successfully!');
    }
}
