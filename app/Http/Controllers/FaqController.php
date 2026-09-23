<?php

namespace App\Http\Controllers;

use App\Http\Requests\FaqRequest;
use App\Models\Faq;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class FaqController extends Controller
{
    public function index(): View
    {
        $faqs = Faq::orderBy('sort_order')->latest()->paginate(15);
        return view('faqs.index', compact('faqs'));
    }

    public function create(): View
    {
        return view('faqs.create');
    }

    public function store(FaqRequest $request): RedirectResponse
    {
        Faq::create([...$request->validated(), 'status' => $request->boolean('status')]);
        return redirect()->route('faqs.index')->with('success', 'FAQ added successfully!');
    }

    public function edit(Faq $faq): View
    {
        return view('faqs.edit', compact('faq'));
    }

    public function update(FaqRequest $request, Faq $faq): RedirectResponse
    {
        $faq->update([...$request->validated(), 'status' => $request->boolean('status')]);
        return redirect()->route('faqs.index')->with('success', 'FAQ updated successfully!');
    }

    public function destroy(Faq $faq): RedirectResponse
    {
        $faq->delete();
        return redirect()->route('faqs.index')->with('success', 'FAQ deleted successfully!');
    }
}
