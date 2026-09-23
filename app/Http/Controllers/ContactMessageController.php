<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ContactMessageController extends Controller
{
    public function index(): View
    {
        $messages = ContactMessage::latest()->paginate(15);
        return view('contact-messages.index', compact('messages'));
    }

    public function show(ContactMessage $contact_message): View
    {
        if ($contact_message->status === 'unread') {
            $contact_message->update(['status' => 'read']);
        }
        return view('contact-messages.show', ['messageItem' => $contact_message]);
    }

    public function destroy(ContactMessage $contact_message): RedirectResponse
    {
        $contact_message->delete();
        return redirect()->route('contact-messages.index')->with('success', 'Message deleted successfully.');
    }
}
