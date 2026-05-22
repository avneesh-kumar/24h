@extends('admin.layouts.app')

@section('content')
<div class="w-full">
    <div class="bg-white border border-red-200 shadow-2xl rounded-lg mb-8">
        <div class="p-6 border-b border-red-100 flex items-center justify-between">
            <h1 class="text-xl font-bold text-red-700">Quote Request Details</h1>
            <a href="{{ route('admin.quote-requests.index') }}" class="px-4 py-2 bg-red-600 text-white rounded-lg">Back to list</a>
        </div>

        <div class="p-6 space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                    <h2 class="text-sm font-semibold text-gray-600">Name</h2>
                    <p class="mt-2 text-gray-900">{{ $quoteRequest->name }}</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                    <h2 class="text-sm font-semibold text-gray-600">Email</h2>
                    <p class="mt-2 text-gray-900">{{ $quoteRequest->email }}</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                    <h2 class="text-sm font-semibold text-gray-600">Phone</h2>
                    <p class="mt-2 text-gray-900">{{ $quoteRequest->phone ?? '-' }}</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                    <h2 class="text-sm font-semibold text-gray-600">Requested</h2>
                    <p class="mt-2 text-gray-900">{{ $quoteRequest->created_at->format('Y-m-d H:i') }}</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                    <h2 class="text-sm font-semibold text-gray-600">Facility Type</h2>
                    <p class="mt-2 text-gray-900">{{ $quoteRequest->facility_type }}</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                    <h2 class="text-sm font-semibold text-gray-600">Service Type</h2>
                    <p class="mt-2 text-gray-900">{{ $quoteRequest->service_type }}</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                    <h2 class="text-sm font-semibold text-gray-600">Needed By</h2>
                    <p class="mt-2 text-gray-900">{{ $quoteRequest->service_needed_by }}</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                    <h2 class="text-sm font-semibold text-gray-600">Area</h2>
                    <p class="mt-2 text-gray-900">{{ $quoteRequest->area }}</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                    <h2 class="text-sm font-semibold text-gray-600">Number of Guards</h2>
                    <p class="mt-2 text-gray-900">{{ $quoteRequest->num_guards }}</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                    <h2 class="text-sm font-semibold text-gray-600">Referral</h2>
                    <p class="mt-2 text-gray-900">{{ $quoteRequest->referral }}</p>
                </div>
            </div>

            <div class="flex gap-2">
                <a href="{{ route('admin.quote-requests.index') }}" class="px-4 py-2 bg-gray-100 rounded-lg text-gray-700">Back</a>
                <form method="POST" action="{{ route('admin.quote-requests.destroy', $quoteRequest) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg" onclick="return confirm('Delete this quote request?')">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
