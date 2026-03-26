@extends('admin.layouts.app')

@section('content')
<div class="w-full">
    <div class="bg-white border border-red-200 shadow-2xl rounded-lg mb-8">
        <div class="p-6 border-b border-red-100">
            <h1 class="text-xl font-bold text-red-700">Edit Service</h1>
        </div>
        <form method="POST" action="{{ route('admin.services.update', $service) }}" enctype="multipart/form-data" class="p-6 space-y-6">
            @csrf
            @method('PUT')
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2" for="title">Title</label>
                <input type="text" name="title" id="title" value="{{ old('title', $service->title) }}" class="bg-white border border-red-200 text-gray-900 rounded-lg px-4 py-2 w-full focus:ring-2 focus:ring-red-500 focus:border-red-500" required>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2" for="slug">Slug</label>
                <input type="text" name="slug" id="slug" value="{{ old('slug', $service->slug) }}" class="bg-white border border-red-200 text-gray-900 rounded-lg px-4 py-2 w-full focus:ring-2 focus:ring-red-500 focus:border-red-500" required>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2" for="thumbnail">Thumbnail (card image)</label>
                <input type="file" name="thumbnail" id="thumbnail" class="block w-full text-gray-900 border border-red-200 rounded-lg px-4 py-2 bg-white focus:ring-2 focus:ring-red-500 focus:border-red-500 file:bg-red-600 file:text-white file:rounded-lg file:border-0 file:px-4 file:py-2 file:mr-4">
                @if($service->thumbnail)
                    <img src="{{ asset('storage/' . $service->thumbnail) }}" alt="Current Thumbnail" class="mt-2 rounded w-32 h-auto">
                @endif
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2" for="banner_title">Banner Title</label>
                <input type="text" name="banner_title" id="banner_title" value="{{ old('banner_title', $service->banner_title) }}" class="bg-white border border-red-200 text-gray-900 rounded-lg px-4 py-2 w-full focus:ring-2 focus:ring-red-500 focus:border-red-500" required>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2" for="banner">Banner (detail page image)</label>
                <input type="file" name="banner" id="banner" class="block w-full text-gray-900 border border-red-200 rounded-lg px-4 py-2 bg-white focus:ring-2 focus:ring-red-500 focus:border-red-500 file:bg-red-600 file:text-white file:rounded-lg file:border-0 file:px-4 file:py-2 file:mr-4">
                @if($service->banner)
                    <img src="{{ asset('storage/' . $service->banner) }}" alt="Current Banner" class="mt-2 rounded w-48 h-auto">
                @endif
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2" for="description">Description</label>
                <textarea name="description" id="description" rows="5" class="bg-white border border-red-200 text-gray-900 rounded-lg px-4 py-2 w-full focus:ring-2 focus:ring-red-500 focus:border-red-500 rich-editor">{{ old('description', $service->description) }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2" for="order">Order</label>
                <input type="number" name="order" id="order" value="{{ old('order', $service->order) }}" class="bg-white border border-red-200 text-gray-900 rounded-lg px-4 py-2 w-full focus:ring-2 focus:ring-red-500 focus:border-red-500">
            </div>
            <div class="flex items-center gap-2">
                <label for="active" class="text-gray-700 font-semibold">Active</label>
                <input type="checkbox" name="active" id="active" value="1" class="sr-only" {{ $service->active ? 'checked' : '' }}>
                <button type="button" id="active-switch" class="relative w-14 h-8 focus:outline-none align-middle">
                    <span id="switch-bg" class="block w-full h-full rounded-full transition bg-red-200"></span>
                    <span class="dot absolute left-1 top-1 bg-white w-6 h-6 rounded-full transition"></span>
                </button>
            </div>
            <div class="border-t border-red-200 pt-6 mt-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">SEO Settings</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2" for="meta_title">Meta Title</label>
                        <input type="text" name="meta_title" id="meta_title" value="{{ old('meta_title', $service->meta_title) }}" class="bg-white border border-red-200 text-gray-900 rounded-lg px-4 py-2 w-full focus:ring-2 focus:ring-red-500 focus:border-red-500" placeholder="Leave empty to use title">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2" for="meta_keywords">Meta Keywords</label>
                        <input type="text" name="meta_keywords" id="meta_keywords" value="{{ old('meta_keywords', $service->meta_keywords) }}" class="bg-white border border-red-200 text-gray-900 rounded-lg px-4 py-2 w-full focus:ring-2 focus:ring-red-500 focus:border-red-500" placeholder="Comma separated keywords">
                    </div>
                </div>
                <div class="mt-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-2" for="meta_description">Meta Description</label>
                    <textarea name="meta_description" id="meta_description" rows="3" class="bg-white border border-red-200 text-gray-900 rounded-lg px-4 py-2 w-full focus:ring-2 focus:ring-red-500 focus:border-red-500" placeholder="Leave empty to use description">{{ old('meta_description', $service->meta_description) }}</textarea>
                </div>
                <div class="mt-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-2" for="canonical_url">Canonical URL</label>
                    <input type="url" name="canonical_url" id="canonical_url" value="{{ old('canonical_url', $service->canonical_url) }}" class="bg-white border border-red-200 text-gray-900 rounded-lg px-4 py-2 w-full focus:ring-2 focus:ring-red-500 focus:border-red-500" placeholder="Leave empty to use default">
                </div>
            </div>
            <div class="text-left mt-6">
                <button type="submit" class="inline-flex items-center justify-center px-6 py-3 bg-red-600 text-white font-semibold rounded-lg shadow hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 transition duration-200 hover:shadow-lg">
                    Update Service
                </button>
            </div>
        </form>
    </div>
</div>
<script src="https://cdn.tiny.cloud/1/ay3qm76k852bki848b9z44n7dv1paeu25u8prgmduxjj20id/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        tinymce.init({
            selector: 'textarea.rich-editor',
            menubar: false,
            plugins: 'link lists code',
            toolbar: 'undo redo | bold italic underline | bullist numlist | link | code',
            height: 200,
            skin: 'oxide',
            content_css: 'default',
            branding: false
        });
        const activeInput = document.getElementById('active');
        const dot = document.querySelector('.dot');
        const switchBg = document.getElementById('switch-bg');
        const switchBtn = document.getElementById('active-switch');
        function updateSwitch() {
            if (activeInput.checked) {
                dot.style.transform = 'translateX(24px)';
                switchBg.classList.remove('bg-red-200');
                switchBg.classList.add('bg-red-600');
            } else {
                dot.style.transform = 'translateX(0)';
                switchBg.classList.remove('bg-red-600');
                switchBg.classList.add('bg-red-200');
            }
        }
        updateSwitch();
        switchBtn.addEventListener('click', function(e) {
            e.preventDefault();
            activeInput.checked = !activeInput.checked;
            updateSwitch();
        });
    });
</script>
@endsection
