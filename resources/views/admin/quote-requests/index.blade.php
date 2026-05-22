@extends('admin.layouts.app')

@section('content')
<div class="w-full">
    <div class="bg-white border border-red-200 shadow-2xl rounded-lg mb-8">
        <div class="p-6 border-b border-red-100 flex items-center justify-between">
            <h1 class="text-xl font-bold text-red-700">Quote Requests</h1>
        </div>

        @if(session('status'))
            <div class="m-6 p-4 border border-green-200 bg-green-50 text-green-700 rounded-lg">{{ session('status') }}</div>
        @endif

        <div class="p-6">
            <form method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Search requests..." class="bg-white border border-red-200 rounded-lg px-4 py-2">
                <div></div>
                <button class="px-4 py-2 bg-red-600 text-white rounded-lg">Filter</button>
            </form>

            <div class="overflow-x-auto">
                <table class="min-w-full text-left">
                    <thead>
                        <tr class="border-b">
                            <th class="p-2">Name</th>
                            <th class="p-2">Email</th>
                            <th class="p-2">Service</th>
                            <th class="p-2">Area</th>
                            <th class="p-2">Requested</th>
                            <th class="p-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($quoteRequests as $request)
                        <tr class="border-b">
                            <td class="p-2">{{ $request->name }}</td>
                            <td class="p-2">{{ $request->email }}</td>
                            <td class="p-2">{{ $request->service_type }}</td>
                            <td class="p-2">{{ $request->area }}</td>
                            <td class="p-2">{{ $request->created_at->format('Y-m-d H:i') }}</td>
                            <td class="p-2 space-x-2">
                                <a href="{{ route('admin.quote-requests.show', $request) }}" class="text-red-600">View</a>
                                <form action="{{ route('admin.quote-requests.destroy', $request) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button class="text-gray-600" onclick="return confirm('Delete this quote request?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td class="p-2" colspan="6">No quote requests found.</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">{{ $quoteRequests->links() }}</div>
        </div>
    </div>
</div>
@endsection
