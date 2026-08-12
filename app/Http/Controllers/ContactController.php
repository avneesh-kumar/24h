<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactReceived;
use App\Mail\QuoteRequestReceived;
use App\Models\ContactMessage;
use App\Models\QuoteRequest;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function sendMessage(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'message' => 'required|string',
            'service'=>'nullable|string'
        ]);

        $message = ContactMessage::create($validated);

        // Queue the notification email to site owner
        $to = config('mail.from.address') ?: env('MAIL_FROM_ADDRESS');
        if ($to) {
            Mail::to($to)->queue(new ContactReceived($message));
        }

        return back()->with('status', 'Thank you — your message has been sent.');
    }

    public function submitQuote(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'facility_type' => 'required|string|max:255',
            'service_type' => 'required|string|max:255',
            'service_needed_by' => 'required|string|max:255',
            'area' => 'required|string|max:255',
            'num_guards' => 'required|string|max:255',
            'referral' => 'required|string|max:255',
        ]);

        $quoteRequest = QuoteRequest::create($validated);

        // Queue the notification email to site owner
        $to = config('mail.from.address') ?: env('MAIL_FROM_ADDRESS');
        if ($to) {
            Mail::to($to)->queue(new QuoteRequestReceived($quoteRequest));
        }

        return back()->with('status', 'Your quote request has been submitted successfully.');
    }
} 