<?php

namespace App\Http\Controllers;

use App\Http\Requests\HomeCollectionPageRequest;
use App\Models\HomeSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class HomeCollectionPageController extends Controller
{
    public function index(): View
    {
        $content = HomeSetting::getSection('home_collection_section', [
            'label' => 'Convenience First', 'title' => 'Diagnostics at Your Doorstep', 'description' => '', 'image' => null,
            'features' => [['icon' => 'bi-shield-check', 'title' => 'Safe & Hygienic', 'description' => ''], ['icon' => 'bi-clock', 'title' => 'On-Time Collection', 'description' => '']],
        ]);

        return view('admin.home-collection-page.index', compact('content'));
    }

    public function update(HomeCollectionPageRequest $request): RedirectResponse
    {
        $current = HomeSetting::getSection('home_collection_section', []);
        $data = $request->validated();
        unset($data['image'], $data['remove_image']);
        $data['image'] = $current['image'] ?? null;

        if ($request->hasFile('image')) {
            if ($data['image']) Storage::disk('public')->delete($data['image']);
            $data['image'] = $request->file('image')->store('home-collection', 'public');
        } elseif ($request->boolean('remove_image')) {
            if ($data['image']) Storage::disk('public')->delete($data['image']);
            $data['image'] = null;
        }

        HomeSetting::updateOrCreate(['key' => 'home_collection_section'], ['value' => $data]);

        return redirect()->route('home-collection-page.index')->with('success', 'Home Collection page updated successfully!');
    }
}
