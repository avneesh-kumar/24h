@extends('admin.layouts.app')

@section('content')
<div class="w-full mx-auto">
    <div class="bg-white border border-red-200 shadow-2xl rounded-lg mb-8">
        <div class="flex items-center justify-between p-6 border-b border-red-100">
            <h1 class="text-2xl font-bold text-red-700">Login History</h1>
        </div>
        <div class="overflow-x-auto p-6">
            <table class="min-w-full divide-y divide-red-200">
                <thead>
                    <tr class="bg-red-50">
                        <th class="px-6 py-3 text-left text-xs font-semibold text-red-700 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-red-700 uppercase tracking-wider">User</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-red-700 uppercase tracking-wider">IP Address</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-red-100">
                    @foreach($logins as $login)
                        <tr>
                            <td class="px-6 py-4 text-gray-900 whitespace-nowrap">{{ $login->date }}</td>
                            <td class="px-6 py-4 text-gray-900 whitespace-nowrap">{{ $login->user }}</td>
                            <td class="px-6 py-4 text-gray-900 whitespace-nowrap">{{ $login->ip }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<style>
.admin-table th {
    font-size: 0.95rem;
    letter-spacing: 0.04em;
}
.admin-table td {
    font-size: 0.97rem;
}
@media (max-width: 700px) {
    .admin-table th, .admin-table td {
        padding-left: 0.5rem;
        padding-right: 0.5rem;
        font-size: 0.92rem;
    }
}
</style>
@endsection
