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

        return view('admin.cms.index', compact('hero', 'stats'));
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
        $hero->status = $request->has('status') ? 1 : 0;

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
}
