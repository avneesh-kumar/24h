@extends('admin.layouts.app')

@section('content')
<div class="w-full mx-auto">
    <div class="p-4 bg-white border border-red-200 shadow-2xl rounded-lg mb-8">
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-red-700 mb-2">Account</h1>
            <p class="text-red-600 font-medium">Manage your admin account details</p>
        </div>
        <form method="POST" action="{{ route('admin.account') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-8 mx-auto">
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2" for="name">Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name', auth()->user()->name) }}" class="bg-white border border-red-200 text-gray-900 rounded-lg px-4 py-2 w-full focus:ring-2 focus:ring-red-500 focus:border-red-500" required>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2" for="email">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email', auth()->user()->email) }}" class="bg-white border border-red-200 text-gray-900 rounded-lg px-4 py-2 w-full focus:ring-2 focus:ring-red-500 focus:border-red-500" required>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2" for="password">New Password <span class="text-gray-400 font-normal">(leave blank to keep current)</span></label>
                        <input type="password" name="password" id="password" class="bg-white border border-red-200 text-gray-900 rounded-lg px-4 py-2 w-full focus:ring-2 focus:ring-red-500 focus:border-red-500">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2" for="password_confirmation">Confirm Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="bg-white border border-red-200 text-gray-900 rounded-lg px-4 py-2 w-full focus:ring-2 focus:ring-red-500 focus:border-red-500">
                    </div>
                </div>
            </div>
            <div class="text-center">
                <button type="submit" class="inline-flex items-center justify-center px-6 py-3 bg-red-600 text-white font-semibold rounded-lg shadow hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 transition duration-200 hover:shadow-lg">
                    Update Account
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
