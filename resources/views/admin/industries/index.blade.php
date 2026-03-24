@extends('admin.layouts.app')

@section('content')
<div class="w-full mx-auto">
    <div class="bg-white border border-red-200 shadow-2xl rounded-lg mb-8">
        <div class="flex items-center justify-between p-6 border-b border-red-100">
            <h1 class="text-2xl font-bold text-red-700">Industries</h1>
            <a href="{{ route('admin.industries.create') }}" class="px-4 py-2 bg-red-600 text-white rounded-lg font-semibold shadow hover:bg-red-700 transition">Add New Industry</a>
        </div>
        @if(session('status'))
            <div class="m-6 p-4 bg-green-50 border border-green-500 rounded-lg">
                <p class="text-green-700">{{ session('status') }}</p>
            </div>
        @endif
        <div class="overflow-x-auto p-6">
            <table class="min-w-full divide-y divide-red-200">
                <thead>
                    <tr class="bg-red-50">
                        <th class="px-6 py-3 text-left text-xs font-semibold text-red-700 uppercase tracking-wider">Order</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-red-700 uppercase tracking-wider">Title</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-red-700 uppercase tracking-wider">Slug</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-red-700 uppercase tracking-wider">Icon</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-red-700 uppercase tracking-wider">Active</th>
                        <th class="px-6 py-3 text-center text-xs font-semibold text-red-700 uppercase tracking-wider">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-red-100">
                    @forelse($industries as $industry)
                        <tr>
                            <td class="px-6 py-4">{{ $industry->order }}</td>
                            <td class="px-6 py-4 font-medium text-gray-900">{{ $industry->title }}</td>
                            <td class="px-6 py-4">{{ $industry->slug }}</td>
                            <td class="px-6 py-4">
                                <i class="{{ $industry->icon }} text-xl text-red-600"></i>
                            </td>
                            <td class="px-6 py-4">
                                @if($industry->active)
                                    <span class="px-2 py-1 bg-green-100 text-green-700 rounded text-xs font-semibold">Active</span>
                                @else
                                    <span class="px-2 py-1 bg-red-100 text-red-700 rounded text-xs font-semibold">Inactive</span>
                                @endif
                            </td>
                            <td class="px-6 py-6 flex gap-2">
                                <a href="{{ route('admin.industries.edit', $industry) }}" class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded hover:bg-yellow-200">Edit</a>
                                <form action="{{ route('admin.industries.destroy', $industry) }}" method="POST" onsubmit="return confirm('Delete this industry?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-1 bg-red-100 text-red-700 rounded hover:bg-red-200">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-gray-400">No industries found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-6">
                {{ $industries->links() }}
            </div>
        </div>
    </div>
</div>
@endsection 