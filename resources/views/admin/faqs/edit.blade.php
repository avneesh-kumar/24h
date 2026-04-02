@extends('admin.layouts.app')

@section('content')
<div class="w-full">
    <div class="bg-white border border-red-200 shadow-2xl rounded-lg mb-8">
        <div class="p-6 border-b border-red-100">
            <h1 class="text-xl font-bold text-red-700">Edit FAQ</h1>
        </div>
        @if (session('status'))
            <div class="mx-6 mt-6 p-4 border border-green-200 bg-green-50 text-green-700 rounded-lg">{{ session('status') }}</div>
        @endif
        <form method="POST" action="{{ route('admin.faqs.update', $faq) }}" class="p-6 space-y-6">
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

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2" for="group_name">Group Name <span class="text-gray-400 font-normal">(optional)</span></label>
                <input type="text" name="group_name" id="group_name" value="{{ old('group_name', $faq->group_name) }}" placeholder="e.g. General, Pricing, Technical..."
                    class="bg-white border border-red-200 text-gray-900 rounded-lg px-4 py-2 w-full focus:ring-2 focus:ring-red-500 focus:border-red-500">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2" for="question">Question</label>
                <input type="text" name="question" id="question" value="{{ old('question', $faq->question) }}"
                    class="bg-white border border-red-200 text-gray-900 rounded-lg px-4 py-2 w-full focus:ring-2 focus:ring-red-500 focus:border-red-500" required>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2" for="answer">Answer</label>
                <textarea name="answer" id="answer" rows="5"
                    class="bg-white border border-red-200 text-gray-900 rounded-lg px-4 py-2 w-full focus:ring-2 focus:ring-red-500 focus:border-red-500" required>{{ old('answer', $faq->answer) }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2" for="sort_order">Sort Order</label>
                <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', $faq->sort_order) }}" min="0"
                    class="bg-white border border-red-200 text-gray-900 rounded-lg px-4 py-2 w-32 focus:ring-2 focus:ring-red-500 focus:border-red-500">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Map to Blog Posts (optional)</label>
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
                <button type="submit" class="inline-flex items-center justify-center px-6 py-3 bg-red-600 text-white font-semibold rounded-lg shadow hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 transition duration-200">
                    Update FAQ
                </button>
            </div>
        </form>

        <div class="px-6 pb-6">
            <form action="{{ route('admin.faqs.destroy', $faq) }}" method="POST">
                @csrf @method('DELETE')
                <button type="submit" onclick="return confirm('Delete this FAQ?')"
                    class="px-6 py-3 text-gray-600 font-semibold rounded-lg border border-gray-300 hover:bg-gray-50 transition duration-200">
                    Delete
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
