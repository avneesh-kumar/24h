@extends('admin.layouts.app')

@section('content')
<div class="w-full">
    <div class="bg-white border border-red-200 shadow-2xl rounded-lg mb-8">
        <div class="p-6 border-b border-red-100">
            <h1 class="text-xl font-bold text-red-700">Add FAQ</h1>
        </div>
        <form method="POST" action="{{ route('admin.faqs.store') }}" class="p-6 space-y-6">
            @csrf
            @if ($errors->any())
                <div class="p-4 border border-red-200 bg-red-50 text-red-700 rounded-lg">
                    <ul class="list-disc ml-6">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- FAQ entries container --}}
            <div id="faq-entries" class="space-y-4">
                <div class="faq-entry border border-red-100 rounded-lg p-4 space-y-4 relative">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm font-semibold text-red-600">FAQ #1</span>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Question</label>
                        <input type="text" name="faqs[0][question]" value="{{ old('faqs.0.question') }}"
                            class="bg-white border border-red-200 text-gray-900 rounded-lg px-4 py-2 w-full focus:ring-2 focus:ring-red-500 focus:border-red-500" required>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Answer</label>
                        <textarea name="faqs[0][answer]" rows="4"
                            class="bg-white border border-red-200 text-gray-900 rounded-lg px-4 py-2 w-full focus:ring-2 focus:ring-red-500 focus:border-red-500" required>{{ old('faqs.0.answer') }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Sort Order</label>
                        <input type="number" name="faqs[0][sort_order]" value="{{ old('faqs.0.sort_order', 0) }}" min="0"
                            class="bg-white border border-red-200 text-gray-900 rounded-lg px-4 py-2 w-32 focus:ring-2 focus:ring-red-500 focus:border-red-500">
                    </div>
                </div>
            </div>

            {{-- Add more button --}}
            <div>
                <button type="button" id="add-faq-btn"
                    class="inline-flex items-center gap-2 px-4 py-2 border border-red-300 text-red-600 font-semibold rounded-lg hover:bg-red-50 transition duration-200">
                    <span class="text-lg leading-none">+</span> Add Another FAQ
                </button>
            </div>

            {{-- Map to posts --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Map to Blog Posts (optional)</label>
                <div class="border border-red-200 rounded-lg p-4 max-h-60 overflow-y-auto space-y-2">
                    @forelse($posts as $post)
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="post_ids[]" value="{{ $post->id }}"
                                {{ in_array($post->id, old('post_ids', [])) ? 'checked' : '' }}
                                class="rounded border-red-300 text-red-600 focus:ring-red-500">
                            <span class="text-sm text-gray-700">{{ $post->title }}</span>
                        </label>
                    @empty
                        <p class="text-sm text-gray-500">No posts available.</p>
                    @endforelse
                </div>
            </div>

            <div>
                <button type="submit" class="inline-flex items-center justify-center px-6 py-3 bg-red-600 text-white font-semibold rounded-lg shadow hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 transition duration-200">
                    Create FAQ
                </button>
            </div>
        </form>
    </div>
</div>

<script>
(function () {
    let index = 1;

    document.getElementById('add-faq-btn').addEventListener('click', function () {
        const container = document.getElementById('faq-entries');
        const entry = document.createElement('div');
        entry.className = 'faq-entry border border-red-100 rounded-lg p-4 space-y-4 relative';
        entry.innerHTML = `
            <div class="flex items-center justify-between mb-2">
                <span class="text-sm font-semibold text-red-600">FAQ #${index + 1}</span>
                <button type="button" onclick="this.closest('.faq-entry').remove(); renumberFaqs();"
                    class="text-gray-400 hover:text-red-500 text-sm">✕ Remove</button>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Question</label>
                <input type="text" name="faqs[${index}][question]"
                    class="bg-white border border-red-200 text-gray-900 rounded-lg px-4 py-2 w-full focus:ring-2 focus:ring-red-500 focus:border-red-500" required>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Answer</label>
                <textarea name="faqs[${index}][answer]" rows="4"
                    class="bg-white border border-red-200 text-gray-900 rounded-lg px-4 py-2 w-full focus:ring-2 focus:ring-red-500 focus:border-red-500" required></textarea>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Sort Order</label>
                <input type="number" name="faqs[${index}][sort_order]" value="0" min="0"
                    class="bg-white border border-red-200 text-gray-900 rounded-lg px-4 py-2 w-32 focus:ring-2 focus:ring-red-500 focus:border-red-500">
            </div>
        `;
        container.appendChild(entry);
        index++;
    });

    window.renumberFaqs = function () {
        document.querySelectorAll('.faq-entry').forEach(function (entry, i) {
            entry.querySelector('.text-red-600').textContent = `FAQ #${i + 1}`;
        });
    };
})();
</script>
@endsection
