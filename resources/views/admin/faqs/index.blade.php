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
            @if($grouped->isEmpty())
                <p class="text-gray-500 text-sm">No FAQs found.</p>
            @else
            <table class="min-w-full text-left">
                <thead>
                    <tr class="border-b">
                        <th class="p-3 text-sm font-semibold text-gray-700">Group</th>
                        <th class="p-3 text-sm font-semibold text-gray-700">Questions</th>
                        <th class="p-3 text-sm font-semibold text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($grouped as $groupName => $groupFaqs)
                    @php $slug = $groupName ?: '__ungrouped__'; @endphp
                    <tr class="border-b hover:bg-red-50 transition">
                        <td class="p-3 font-semibold text-red-700 uppercase tracking-wide text-sm">
                            {{ $groupName ?: 'Ungrouped' }}
                        </td>
                        <td class="p-3 text-sm text-gray-500">
                            {{ $groupFaqs->count() }} {{ Str::plural('question', $groupFaqs->count()) }}
                        </td>
                        <td class="p-3 space-x-3">
                            <a href="{{ route('admin.faqs.group.edit', $slug) }}" class="text-red-600 text-sm font-medium">Edit</a>
                            <form action="{{ route('admin.faqs.group.destroy', $slug) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button class="text-gray-500 text-sm" onclick="return confirm('Delete all FAQs in this group?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            @endif
        </div>
    </div>
</div>
@endsection
