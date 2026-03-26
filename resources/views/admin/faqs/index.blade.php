@extends('admin.layouts.app')

@section('content')
<div class="w-full">
    <div class="bg-white border border-red-200 shadow-2xl rounded-lg mb-8">
        <div class="p-6 border-b border-red-100 flex items-center justify-between">
            <h1 class="text-xl font-bold text-red-700">FAQs</h1>
            <a href="{{ route('admin.faqs.create') }}" class="px-4 py-2 bg-red-600 text-white rounded-lg">Add FAQ</a>
        </div>
        @if (session('status'))
            <div class="m-6 p-4 border border-green-200 bg-green-50 text-green-700 rounded-lg">{{ session('status') }}</div>
        @endif
        <div class="p-6">
            <div class="overflow-x-auto">
                <table class="min-w-full text-left">
                    <thead>
                        <tr class="border-b">
                            <th class="p-2">Question</th>
                            <th class="p-2">Mapped Posts</th>
                            <th class="p-2">Order</th>
                            <th class="p-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($faqs as $faq)
                        <tr class="border-b">
                            <td class="p-2">{{ $faq->question }}</td>
                            <td class="p-2 text-sm text-gray-500">
                                {{ $faq->posts->pluck('title')->join(', ') ?: '—' }}
                            </td>
                            <td class="p-2">{{ $faq->sort_order }}</td>
                            <td class="p-2 space-x-2">
                                <a href="{{ route('admin.faqs.edit', $faq) }}" class="text-red-600">Edit</a>
                                <form action="{{ route('admin.faqs.destroy', $faq) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button class="text-gray-600" onclick="return confirm('Delete this FAQ?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td class="p-2" colspan="4">No FAQs found.</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-4">{{ $faqs->links() }}</div>
        </div>
    </div>
</div>
@endsection
