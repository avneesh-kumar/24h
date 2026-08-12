@extends('admin.layouts.app')

@section('content')
<div class="w-full">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-red-700">Contact Message</h1>
        <a href="{{ route('admin.contacts.index') }}" class="px-4 py-2 bg-red-600 text-white rounded-lg">Back to list</a>
    </div>

    @if(session('status'))
        <div class="mb-6 p-4 border border-green-200 bg-green-50 text-green-700 rounded-lg">{{ session('status') }}</div>
    @endif

    <div class="bg-white border border-red-200 shadow-2xl rounded-lg">
        <div class="p-6 space-y-3">
            <p><strong>Name:</strong> {{ $message->name }}</p>
            <p><strong>Email:</strong> {{ $message->email }}</p>
            @if($message->phone)
                <p><strong>Phone:</strong> {{ $message->phone }}</p>
            @endif
            @if($message->service)
                <p><strong>Service:</strong> {{ $message->service }}</p>
            @endif
            <p><strong>Received:</strong> {{ $message->created_at->format('Y-m-d H:i') }}</p>
            <hr>
            <div class="whitespace-pre-wrap">{{ $message->message }}</div>
        </div>
    </div>

    <div class="mt-4 flex items-center gap-3">
        <form method="POST" action="{{ route('admin.contacts.resend', $message) }}">
            @csrf
            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg">Re-send Email</button>
        </form>
        <a href="{{ route('admin.contacts.index') }}" class="px-4 py-2 bg-gray-100 rounded-lg text-gray-700">Back</a>
    </div>
</div>
@endsection
