<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\QuoteRequest;
use Illuminate\Http\Request;

class QuoteRequestController extends Controller
{
    public function index(Request $request)
    {
        $query = QuoteRequest::query();

        if ($search = $request->string('q')) {
            $query->where(function ($builder) use ($search) {
                $builder->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('facility_type', 'like', "%{$search}%")
                    ->orWhere('service_type', 'like', "%{$search}%")
                    ->orWhere('area', 'like', "%{$search}%");
            });
        }

        $quoteRequests = $query->orderByDesc('created_at')->paginate(20)->withQueryString();

        return view('admin.quote-requests.index', compact('quoteRequests'));
    }

    public function show(QuoteRequest $quoteRequest)
    {
        return view('admin.quote-requests.show', compact('quoteRequest'));
    }

    public function destroy(QuoteRequest $quoteRequest)
    {
        $quoteRequest->delete();

        return back()->with('status', 'Quote request deleted successfully.');
    }
}
