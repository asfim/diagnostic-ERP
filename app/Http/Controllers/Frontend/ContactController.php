<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactMessageRequest;
use App\Models\ContactMessage;
use App\Models\HomeSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function index(): View
    {
        $content = HomeSetting::getSection('contact_page_section', $this->defaults());
        return view('frontend.contact', compact('content'));
    }

    public function store(ContactMessageRequest $request): RedirectResponse
    {
        ContactMessage::create($request->validated());
        return redirect()->route('frontend.contact')->with('success', 'Your message has been sent successfully. We will contact you soon.');
    }

    private function defaults(): array
    {
        return [
            'address' => '123 Healthcare Avenue, Block B, Dhaka 1212, Bangladesh',
            'emergency_phone' => '+880 1711 000 000',
            'appointment_phone' => '+880 1711 111 111',
            'general_email' => 'info@diagnosticcenter.com',
            'report_email' => 'reports@diagnosticcenter.com',
            'map_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3651.9024424301397!2d90.39108011536269!3d23.750858094676575',
            'hours' => [
                ['label' => 'Diagnostic Center', 'time' => '24/7 Open'],
                ['label' => 'Doctor Consultation', 'time' => '09:00 AM - 10:00 PM'],
                ['label' => 'Home Sample Collection', 'time' => '07:00 AM - 08:00 PM'],
                ['label' => 'Report Delivery', 'time' => '08:00 AM - 09:00 PM'],
            ],
        ];
    }
}
