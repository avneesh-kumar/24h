@extends('admin.layouts.app')

@section('content')
<div class="w-full">
    <div class="bg-white border border-red-200 shadow-2xl rounded-lg mb-8">
        <div class="p-6 border-b border-red-100">
            <h1 class="text-xl font-bold text-red-700">Add Industry</h1>
        </div>
        <form method="POST" action="{{ route('admin.industries.store') }}" class="p-6 space-y-6">
            @csrf
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2" for="title">Title</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" class="bg-white border border-red-200 text-gray-900 rounded-lg px-4 py-2 w-full focus:ring-2 focus:ring-red-500 focus:border-red-500" required>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2" for="icon">Icon (Font Awesome class)</label>
                <input type="text" name="icon" id="icon" value="{{ old('icon') }}" class="bg-white border border-red-200 text-gray-900 rounded-lg px-4 py-2 w-full focus:ring-2 focus:ring-red-500 focus:border-red-500" required>
                <p class="mt-1 text-sm text-gray-500">Example: fas fa-building</p>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2" for="description">Description</label>
                <textarea name="description" id="description" rows="3" class="bg-white border border-red-200 text-gray-900 rounded-lg px-4 py-2 w-full focus:ring-2 focus:ring-red-500 focus:border-red-500" required>{{ old('description') }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2" for="order">Order</label>
                <input type="number" name="order" id="order" value="{{ old('order', 0) }}" class="bg-white border border-red-200 text-gray-900 rounded-lg px-4 py-2 w-full focus:ring-2 focus:ring-red-500 focus:border-red-500">
            </div>
            <div class="flex items-center gap-2">
                <label for="active" class="text-gray-700 font-semibold">Active</label>
                <input type="checkbox" name="active" id="active" value="1" class="sr-only" checked>
                <button type="button" id="active-switch" class="relative w-14 h-8 focus:outline-none align-middle">
                    <span id="switch-bg" class="block w-full h-full rounded-full transition bg-red-200"></span>
                    <span class="dot absolute left-1 top-1 bg-white w-6 h-6 rounded-full transition"></span>
                </button>
            </div>
            <div class="text-left mt-6">
                <button type="submit" class="inline-flex items-center justify-center px-6 py-3 bg-red-600 text-white font-semibold rounded-lg shadow hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 transition duration-200 hover:shadow-lg">
                    Create Industry
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
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