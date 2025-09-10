@extends('admin.layouts.app')

@section('content')
<div class="w-full">
    <div class="bg-white border border-red-200 shadow-2xl rounded-lg mb-8">
        <div class="p-6 border-b border-red-100">
            <h1 class="text-xl font-bold text-red-700">Add Area</h1>
        </div>
        <form method="POST" action="{{ route('admin.areas.store') }}" class="p-6 space-y-6">
            @csrf
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2" for="title">Title</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" class="bg-white border border-red-200 text-gray-900 rounded-lg px-4 py-2 w-full focus:ring-2 focus:ring-red-500 focus:border-red-500" required>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2" for="slug">Slug</label>
                <input type="text" name="slug" id="slug" value="{{ old('slug') }}" class="bg-white border border-red-200 text-gray-900 rounded-lg px-4 py-2 w-full focus:ring-2 focus:ring-red-500 focus:border-red-500" required>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2" for="icon">Icon (Font Awesome class)</label>
                <input type="text" name="icon" id="icon" value="{{ old('icon') }}" placeholder="e.g., fas fa-map-marker-alt" class="bg-white border border-red-200 text-gray-900 rounded-lg px-4 py-2 w-full focus:ring-2 focus:ring-red-500 focus:border-red-500">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2" for="description">Description</label>
                <textarea name="description" id="description" rows="4" class="bg-white border border-red-200 text-gray-900 rounded-lg px-4 py-2 w-full focus:ring-2 focus:ring-red-500 focus:border-red-500">{{ old('description') }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2" for="order">Order</label>
                <input type="number" name="order" id="order" value="{{ old('order', 0) }}" min="0" class="bg-white border border-red-200 text-gray-900 rounded-lg px-4 py-2 w-full focus:ring-2 focus:ring-red-500 focus:border-red-500">
            </div>

            <div class="flex items-center gap-2">
                <label for="active" class="text-gray-700 font-semibold">Active</label>
                <input type="checkbox" name="active" id="active" value="1" class="sr-only" checked>
                <button type="button" id="active-switch" class="relative w-14 h-8 focus:outline-none align-middle">
                    <span id="switch-bg" class="block w-full h-full rounded-full transition bg-red-200"></span>
                    <span class="dot absolute left-1 top-1 bg-white w-6 h-6 rounded-full transition"></span>
                </button>
            </div>

            <!-- SEO Section -->
            <div class="border-t border-red-200 pt-6 mt-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">SEO Settings</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2" for="meta_title">Meta Title</label>
                        <input type="text" name="meta_title" id="meta_title" value="{{ old('meta_title') }}" class="bg-white border border-red-200 text-gray-900 rounded-lg px-4 py-2 w-full focus:ring-2 focus:ring-red-500 focus:border-red-500" placeholder="Leave empty to use title">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2" for="meta_keywords">Meta Keywords</label>
                        <input type="text" name="meta_keywords" id="meta_keywords" value="{{ old('meta_keywords') }}" class="bg-white border border-red-200 text-gray-900 rounded-lg px-4 py-2 w-full focus:ring-2 focus:ring-red-500 focus:border-red-500" placeholder="Comma separated keywords">
                    </div>
                </div>
                <div class="mt-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-2" for="meta_description">Meta Description</label>
                    <textarea name="meta_description" id="meta_description" rows="3" class="bg-white border border-red-200 text-gray-900 rounded-lg px-4 py-2 w-full focus:ring-2 focus:ring-red-500 focus:border-red-500" placeholder="Leave empty to use description">{{ old('meta_description') }}</textarea>
                </div>
                <div class="mt-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-2" for="canonical_url">Canonical URL</label>
                    <input type="url" name="canonical_url" id="canonical_url" value="{{ old('canonical_url') }}" class="bg-white border border-red-200 text-gray-900 rounded-lg px-4 py-2 w-full focus:ring-2 focus:ring-red-500 focus:border-red-500" placeholder="Leave empty to use default">
                </div>
            </div>

            <div class="text-left mt-6">
                <button type="submit" class="inline-flex items-center justify-center px-6 py-3 bg-red-600 text-white font-semibold rounded-lg shadow hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 transition duration-200 hover:shadow-lg">
                    Create Area
                </button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.tiny.cloud/1/ay3qm76k852bki848b9z44n7dv1paeu25u8prgmduxjj20id/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        tinymce.init({
            selector: '#description',
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
