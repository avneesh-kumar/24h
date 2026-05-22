@extends('admin.layouts.app')

@section('content')
<div class="w-full">
    <div class="bg-white border border-red-200 shadow-2xl rounded-lg mb-8">
        <div class="p-6 border-b border-red-100 flex items-center justify-between">
            <h1 class="text-xl font-bold text-red-700">Contact Messages</h1>
        </div>

        @if(session('status'))
            <div class="m-6 p-4 border border-green-200 bg-green-50 text-green-700 rounded-lg">{{ session('status') }}</div>
        @endif

        @if($errors->any())
            <div class="m-6 p-4 border border-red-200 bg-red-50 text-red-700 rounded-lg">
                {{ $errors->first() }}
            </div>
        @endif

        <div class="p-6">
            <form method="GET" action="{{ route('admin.contacts.index') }}" class="grid grid-cols-1 md:grid-cols-12 gap-4 mb-6">
                <div class="md:col-span-4">
                    <label for="q" class="block text-sm font-semibold text-gray-700 mb-1">Search</label>
                    <input
                        type="text"
                        id="q"
                        name="q"
                        value="{{ request('q') }}"
                        placeholder="Name, email, phone, or message"
                        class="w-full bg-white border border-red-200 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-200"
                    >
                </div>

                <div class="md:col-span-2">
                    <label for="from" class="block text-sm font-semibold text-gray-700 mb-1">From</label>
                    <input
                        type="date"
                        id="from"
                        name="from"
                        value="{{ request('from') }}"
                        class="w-full bg-white border border-red-200 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-200"
                    >
                </div>

                <div class="md:col-span-2">
                    <label for="to" class="block text-sm font-semibold text-gray-700 mb-1">To</label>
                    <input
                        type="date"
                        id="to"
                        name="to"
                        value="{{ request('to') }}"
                        class="w-full bg-white border border-red-200 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-200"
                    >
                </div>

                <div class="md:col-span-2">
                    <label for="per_page" class="block text-sm font-semibold text-gray-700 mb-1">Per Page</label>
                    <select
                        id="per_page"
                        name="per_page"
                        class="w-full bg-white border border-red-200 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-200"
                    >
                        @foreach([10, 25, 50, 100] as $size)
                            <option value="{{ $size }}" @selected((int) request('per_page', 25) === $size)>{{ $size }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="md:col-span-2 flex items-end gap-2">
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg">Filter</button>
                    <a href="{{ route('admin.contacts.index') }}" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg">Reset</a>
                </div>
            </form>

            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-2 mb-4 text-sm text-gray-600">
                <div>
                    Showing {{ $messages->firstItem() ?? 0 }} to {{ $messages->lastItem() ?? 0 }} of {{ $messages->total() }} messages
                </div>
                @if(request()->hasAny(['q', 'from', 'to', 'per_page']))
                    <div class="text-red-700">Filters are active</div>
                @endif
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full text-left">
                    <thead>
                        <tr class="border-b">
                            <th class="p-2">Name</th>
                            <th class="p-2">Email</th>
                            <th class="p-2">Received</th>
                            <th class="p-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($messages as $msg)
                        <tr class="border-b">
                            <td class="p-2">{{ $msg->name }}</td>
                            <td class="p-2">{{ $msg->email }}</td>
                            <td class="p-2">{{ $msg->created_at->format('Y-m-d H:i') }}</td>
                            <td class="p-2 space-x-2">
                                <a href="{{ route('admin.contacts.show', $msg) }}" class="text-red-600">View</a>
                                <form method="POST" action="{{ route('admin.contacts.destroy', $msg) }}" class="inline" onsubmit="return confirm('Delete this message?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-gray-600">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="p-4 text-gray-600" colspan="4">No contact messages found.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $messages->onEachSide(1)->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
