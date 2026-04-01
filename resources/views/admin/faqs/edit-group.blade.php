@extends('admin.layouts.app')

@section('content')
<div class="w-full">
    <div class="bg-white border border-red-200 shadow-2xl rounded-lg mb-8">
        <div class="p-6 border-b border-red-100 flex items-center justify-between">
            <div>
                <h1 class="text-xl font-bold text-red-700">Edit Group: {{ $groupName ?: 'Ungrouped' }}</h1>
                <p class="text-sm text-gray-500 mt-1">{{ $faqs->count() }} {{ Str::plural('question', $faqs->count()) }}</p>
            </div>
            <a href="{{ route('admin.faqs.index') }}" class="text-sm text-gray-500 hover:text-red-600">← Back to Groups</a>
        </div>

        @if (session('status'))
            <div class="mx-6 mt-6 p-4 border border-green-200 bg-green-50 text-green-700 rounded-lg">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('admin.faqs.group.update', $group) }}" class="p-6 space-y-6">
            @csrf @method('PUT')

            @if ($errors->any())
                <div class="p-4 border border-red-200 bg-red-50 text-red-700 rounded-lg">
                    <ul class="list-disc ml-6">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Group Name --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Group Name</label>
                <input type="text" name="group_name" value="{{ old('group_name', $groupName) }}" placeholder="e.g. General, Pricing, Technical..."
                    class="bg-white border border-red-200 text-gray-900 rounded-lg px-4 py-2 w-full focus:ring-2 focus:ring-red-500 focus:border-red-500">
                <p class="text-xs text-gray-400 mt-1">Changing this renames the group for all questions below.</p>
            </div>

            {{-- FAQ entries --}}
            <div id="faq-entries" class="space-y-4">
                @foreach($faqs as $i => $faq)
                <div class="faq-entry border border-red-100 rounded-lg p-4 space-y-4 relative">
                    <input type="hidden" name="faqs[{{ $i }}][id]" value="{{ $faq->id }}">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm font-semibold text-red-600">FAQ #{{ $i + 1 }}</span>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Question</label>
                        <input type="text" name="faqs[{{ $i }}][question]" value="{{ old("faqs.$i.question", $faq->question) }}"
                            class="bg-white border border-red-200 text-gray-900 rounded-lg px-4 py-2 w-full focus:ring-2 focus:ring-red-500 focus:border-red-500" required>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Answer</label>
                        <textarea name="faqs[{{ $i }}][answer]" rows="4"
                            class="bg-white border border-red-200 text-gray-900 rounded-lg px-4 py-2 w-full focus:ring-2 focus:ring-red-500 focus:border-red-500" required>{{ old("faqs.$i.answer", $faq->answer) }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Sort Order</label>
                        <input type="number" name="faqs[{{ $i }}][sort_order]" value="{{ old("faqs.$i.sort_order", $faq->sort_order) }}" min="0"
                            class="bg-white border border-red-200 text-gray-900 rounded-lg px-4 py-2 w-32 focus:ring-2 focus:ring-red-500 focus:border-red-500">
                    </div>
                </div>
                @endforeach
            </div>

            {{-- Map to posts --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Map to Blog Posts (optional)</label>
                <p class="text-xs text-gray-400 mb-2">Applied to all questions in this group.</p>
                <div class="border border-red-200 rounded-lg p-4 max-h-60 overflow-y-auto space-y-2">
                    @forelse($posts as $post)
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="post_ids[]" value="{{ $post->id }}"
                                {{ in_array($post->id, old('post_ids', $selectedPostIds)) ? 'checked' : '' }}
                                class="rounded border-red-300 text-red-600 focus:ring-red-500">
                            <span class="text-sm text-gray-700">{{ $post->title }}</span>
                        </label>
                    @empty
                        <p class="text-sm text-gray-500">No posts available.</p>
                    @endforelse
                </div>
            </div>

            <div class="flex items-center gap-4">
                <button type="submit" class="px-6 py-3 bg-red-600 text-white font-semibold rounded-lg shadow hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 transition duration-200">
                    Save Group
                </button>
                <a href="{{ route('admin.faqs.index') }}" class="px-6 py-3 text-gray-600 font-semibold rounded-lg border border-gray-300 hover:bg-gray-50 transition duration-200">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
