@extends('admin.layouts.app')

@section('content')
<div class="w-full max-w-4xl mx-auto">
    <div class="bg-admin-card glass-effect border border-red-900/30 shadow-2xl rounded-lg p-8">
        <div class="text-center mb-8">
            <img src="{{ asset('./logo.png') }}" alt="Ready 24h security" class="bg-white p-4 mx-auto w-20 h-20 rounded-full shadow-lg mb-4" />
            <h1 class="text-2xl font-bold text-red-400 mb-2">Login History</h1>
            <p class="text-red-400 font-medium">Recent admin logins</p>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-transparent">
                <thead>
                    <tr>
                        <th class="px-4 py-2 text-left text-gray-400">Date</th>
                        <th class="px-4 py-2 text-left text-gray-400">User</th>
                        <th class="px-4 py-2 text-left text-gray-400">IP Address</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($logins as $login)
                        <tr class="border-b border-gray-700 last:border-0">
                            <td class="px-4 py-2 text-gray-200">{{ $login->date }}</td>
                            <td class="px-4 py-2 text-gray-200">{{ $login->user }}</td>
                            <td class="px-4 py-2 text-gray-200">{{ $login->ip }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
