<?php

namespace App\Http\Controllers;

use App\Http\Requests\TestimonialRequest;
use App\Models\Testimonial;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class TestimonialController extends Controller
{
    public function index(): View
    {
        $testimonials = Testimonial::latest()->paginate(10);

        return view('testimonials.index', compact('testimonials'));
    }

    public function create(): View
    {
        return view('testimonials.create');
    }

    public function store(TestimonialRequest $request): RedirectResponse
    {
        $data = $request->validated();
        unset($data['photo'], $data['remove_photo']);
        $data['status'] = $request->boolean('status');

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('testimonials', 'public');
        }

        Testimonial::create($data);

        return redirect()->route('testimonials.index')->with('success', 'Testimonial added successfully!');
    }

    public function edit(Testimonial $testimonial): View
    {
        return view('testimonials.edit', compact('testimonial'));
    }

    public function update(TestimonialRequest $request, Testimonial $testimonial): RedirectResponse
    {
        $data = $request->validated();
        unset($data['photo'], $data['remove_photo']);
        $data['status'] = $request->boolean('status');

        if ($request->hasFile('photo')) {
            $this->deletePhoto($testimonial);
            $data['photo'] = $request->file('photo')->store('testimonials', 'public');
        } elseif ($request->boolean('remove_photo')) {
            $this->deletePhoto($testimonial);
            $data['photo'] = null;
        }

        $testimonial->update($data);

        return redirect()->route('testimonials.index')->with('success', 'Testimonial updated successfully!');
    }

    public function destroy(Testimonial $testimonial): RedirectResponse
    {
        $this->deletePhoto($testimonial);
        $testimonial->delete();

        return redirect()->route('testimonials.index')->with('success', 'Testimonial deleted successfully!');
    }

    private function deletePhoto(Testimonial $testimonial): void
    {
        if ($testimonial->photo) {
            Storage::disk('public')->delete($testimonial->photo);
        }
    }
}
