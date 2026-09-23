<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\HomeCollectionRequestForm;
use App\Models\HomeCollectionRequest;
use App\Models\HomeSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class HomeCollectionController extends Controller
{
    public function index(): View
    {
        $content = HomeSetting::getSection('home_collection_section', $this->defaults());

        return view('frontend.home-collection', compact('content'));
    }

    public function store(HomeCollectionRequestForm $request): RedirectResponse
    {
        HomeCollectionRequest::create($request->validated());

        return redirect()->route('frontend.home-collection')->with('success', 'Your booking request was submitted successfully. Our care team will contact you shortly.');
    }

    private function defaults(): array
    {
        return [
            'label' => 'Convenience First',
            'title' => 'Diagnostics at Your Doorstep',
            'description' => 'Why travel to a clinic when you can get your blood and samples collected safely from the comfort of your home?',
            'image' => null,
            'features' => [
                ['icon' => 'bi-shield-check', 'title' => 'Safe & Hygienic', 'description' => 'Single-use sterile equipment and strict hygiene protocols followed.'],
                ['icon' => 'bi-clock', 'title' => 'On-Time Collection', 'description' => 'Choose your preferred time slot and our team will arrive on time.'],
            ],
        ];
    }
}
