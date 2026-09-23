<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\View\View;

class FaqController extends Controller
{
    public function index(): View
    {
        $faqs = Faq::where('status', true)->orderBy('sort_order')->latest()->get();
        return view('frontend.faq', compact('faqs'));
    }
}
