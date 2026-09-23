<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactPageRequest;
use App\Models\HomeSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ContactPageController extends Controller
{
    public function index(): View
    {
        $content = HomeSetting::getSection('contact_page_section', [
            'address' => '', 'emergency_phone' => '', 'appointment_phone' => '', 'general_email' => '', 'report_email' => '', 'map_url' => '',
            'hours' => [['label' => '', 'time' => ''], ['label' => '', 'time' => ''], ['label' => '', 'time' => ''], ['label' => '', 'time' => '']],
        ]);
        return view('admin.contact-page.index', compact('content'));
    }

    public function update(ContactPageRequest $request): RedirectResponse
    {
        HomeSetting::updateOrCreate(['key' => 'contact_page_section'], ['value' => $request->validated()]);
        return redirect()->route('contact-page.index')->with('success', 'Contact page updated successfully!');
    }
}
