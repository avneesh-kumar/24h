@extends('admin.layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100">
    <!-- Toolbar -->
    <div class="bg-white shadow-sm mb-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex items-center justify-between">
                <div class="flex space-x-4">
                    <button class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" data-section="hero">
                        <i class="fas fa-plus mr-2"></i> Add Hero Section
                    </button>
                    <button class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" data-section="features">
                        <i class="fas fa-plus mr-2"></i> Add Features
                    </button>
                    <button class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" data-section="testimonials">
                        <i class="fas fa-plus mr-2"></i> Add Testimonials
                    </button>
                </div>
                <div class="flex space-x-4">
                    <button id="savePage" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        <i class="fas fa-save mr-2"></i> Save Page
                    </button>
                    <button id="previewPage" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <i class="fas fa-eye mr-2"></i> Preview
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex gap-6">
            <!-- Canvas -->
            <div class="flex-1">
                <div class="bg-white shadow-sm rounded-lg p-6">
                    <div id="pageSections" class="space-y-6">
                        <!-- Sections will be added here -->
                    </div>
                </div>
            </div>

            <!-- Properties Panel -->
            <div class="w-96">
                <div class="bg-white shadow-sm rounded-lg p-6 sticky top-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Properties</h3>
                    <div id="sectionProperties" class="space-y-4">
                        <!-- Properties will be loaded here -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="{{ asset('js/page-builder/page-builder.js') }}"></script>
<script src="{{ asset('js/page-builder/sections.js') }}"></script>
<script src="{{ asset('js/page-builder/utils.js') }}"></script>
@endpush

@push('styles')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<style>
    .section {
        @apply relative border border-gray-200 rounded-lg p-4 mb-4 bg-white;
    }

    .section-handle {
        @apply absolute top-2 left-2 cursor-move text-gray-400 hover:text-gray-600;
    }

    .section-actions {
        @apply absolute top-2 right-2 flex space-x-2;
    }

    .section-actions button {
        @apply text-gray-400 hover:text-gray-600 focus:outline-none;
    }

    .property-group {
        @apply space-y-2;
    }

    .property-group label {
        @apply block text-sm font-medium text-gray-700;
    }

    .property-group input,
    .property-group textarea {
        @apply mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm;
    }

    .ui-sortable-helper {
        @apply shadow-lg;
    }

    .ui-sortable-placeholder {
        @apply border-2 border-dashed border-gray-300 rounded-lg;
    }
</style>
@endpush 