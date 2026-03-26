@extends('admin.layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-white via-gray-100 to-white">
    <div class="bg-white/80 glass-effect border border-red-200 shadow-2xl rounded-lg p-8 w-full max-w-md">
        <h1 class="text-2xl font-bold mb-4 text-red-500">Reset Password</h1>
        <form method="POST" action="{{ route('admin.password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <div class="mb-4">
                <label for="email" class="block text-gray-800">Email Address</label>
                <input id="email" type="email" name="email" required autofocus class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-red-400 border-gray-200 bg-white text-gray-900">
                @error('email')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="password" class="block text-gray-800">New Password</label>
                <input id="password" type="password" name="password" required class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-red-400 border-gray-200 bg-white text-gray-900">
                @error('password')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="password_confirmation" class="block text-gray-800">Confirm Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-red-400 border-gray-200 bg-white text-gray-900">
            </div>
            <button type="submit" class="w-full bg-gradient-to-r from-red-400 to-red-500 hover:from-red-500 hover:to-red-600 text-white font-semibold py-2 rounded-md transition-all duration-200">Reset Password</button>
        </form>
        <div class="mt-4 text-center">
            <a href="{{ route('admin.login') }}" class="text-red-500 hover:underline">Back to login</a>
        </div>
    </div>
</div>
@endsection
