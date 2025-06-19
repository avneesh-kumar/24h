@extends('admin.layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-white via-gray-100 to-white">
    <div class="bg-white/80 glass-effect border border-red-200 shadow-2xl rounded-lg p-8 w-full max-w-md">
        <h1 class="text-2xl font-bold mb-4 text-red-500">Forgot Password</h1>
        @if (session('status'))
            <div class="mb-4 font-medium text-green-600">
                {{ session('status') }}
            </div>
        @endif
        <form method="POST" action="{{ route('admin.password.email') }}">
            @csrf
            <div class="mb-4">
                <label for="email" class="block text-gray-800">Email Address</label>
                <input id="email" type="email" name="email" required autofocus class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-red-400 border-gray-200 bg-white text-gray-900">
                @error('email')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="w-full bg-gradient-to-r from-red-400 to-red-500 hover:from-red-500 hover:to-red-600 text-white font-semibold py-2 rounded-md transition-all duration-200">Send Password Reset Link</button>
        </form>
        <div class="mt-4 text-center">
            <a href="{{ route('admin.login') }}" class="text-red-500 hover:underline">Back to login</a>
        </div>
    </div>
</div>
@endsection
