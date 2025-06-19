@extends('admin.layouts.app')

@section('content')
<div class="w-full">
    <div class="bg-white border border-red-200 shadow-2xl rounded-lg mb-8">
        <div class="p-6 border-b border-red-100 flex justify-between items-center">
            <h1 class="text-xl font-bold text-red-700">Testimonials</h1>
            <a href="{{ route('admin.testimonials.create') }}" class="inline-flex items-center justify-center px-4 py-2 bg-red-600 text-white font-semibold rounded-lg shadow hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 transition duration-200">
                Add New Testimonial
            </a>
        </div>
        @if(session('success'))
            <div class="p-4 bg-green-100 border-l-4 border-green-500 text-green-700">
                {{ session('success') }}
            </div>
        @endif
        <div class="p-6">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-red-200">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 bg-red-50 text-left text-xs font-medium text-red-500 uppercase tracking-wider">Order</th>
                            <th class="px-6 py-3 bg-red-50 text-left text-xs font-medium text-red-500 uppercase tracking-wider">Name</th>
                            <th class="px-6 py-3 bg-red-50 text-left text-xs font-medium text-red-500 uppercase tracking-wider">Position</th>
                            <th class="px-6 py-3 bg-red-50 text-left text-xs font-medium text-red-500 uppercase tracking-wider">Company</th>
                            <th class="px-6 py-3 bg-red-50 text-left text-xs font-medium text-red-500 uppercase tracking-wider">Rating</th>
                            <th class="px-6 py-3 bg-red-50 text-left text-xs font-medium text-red-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 bg-red-50 text-left text-xs font-medium text-red-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-red-200">
                        @forelse($testimonials as $testimonial)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $testimonial->order }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $testimonial->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $testimonial->position }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $testimonial->company }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    <div class="flex items-center">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star {{ $i <= $testimonial->rating ? 'text-yellow-400' : 'text-gray-300' }}"></i>
                                        @endfor
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $testimonial->active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $testimonial->active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="{{ route('admin.testimonials.edit', $testimonial) }}" class="text-red-600 hover:text-red-900 mr-3">Edit</a>
                                    <form action="{{ route('admin.testimonials.destroy', $testimonial) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure you want to delete this testimonial?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">No testimonials found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $testimonials->links() }}
            </div>
        </div>
    </div>
</div>
@endsection 