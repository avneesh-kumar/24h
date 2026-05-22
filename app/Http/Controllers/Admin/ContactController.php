<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactMessage;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactReceived;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $filters = $request->validate([
            'q' => ['nullable', 'string', 'max:255'],
            'from' => ['nullable', 'date'],
            'to' => ['nullable', 'date', 'after_or_equal:from'],
            'per_page' => ['nullable', 'integer', 'in:10,25,50,100'],
        ]);

        $query = ContactMessage::query();

        if ($search = trim($filters['q'] ?? '')) {
            $query->where(function ($builder) use ($search) {
                $builder->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('message', 'like', "%{$search}%");
            });
        }

        if (!empty($filters['from'])) {
            $query->whereDate('created_at', '>=', $filters['from']);
        }

        if (!empty($filters['to'])) {
            $query->whereDate('created_at', '<=', $filters['to']);
        }

        $perPage = (int) ($filters['per_page'] ?? 25);

        $messages = $query->orderByDesc('created_at')->paginate($perPage)->withQueryString();

        return view('admin.contacts.index', compact('messages'));
    }

    public function show(ContactMessage $contact)
    {
        return view('admin.contacts.show', ['message' => $contact]);
    }

    public function destroy(ContactMessage $contact)
    {
        $contact->delete();
        return redirect()->route('admin.contacts.index')->with('status', 'Message deleted');
    }

    public function resend(ContactMessage $contact)
    {
        $to = config('mail.from.address') ?: env('MAIL_FROM_ADDRESS');
        if ($to) {
            Mail::to($to)->queue(new ContactReceived($contact));
        }
        return back()->with('status', 'Email re-queued');
    }
}
