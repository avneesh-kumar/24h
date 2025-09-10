@extends('admin.layouts.app')

@section('content')
<div class="w-full">
	<div class="bg-white border border-red-200 shadow-2xl rounded-lg mb-8">
		<div class="p-6 border-b border-red-100 flex items-center justify-between">
			<h1 class="text-xl font-bold text-red-700">Edit Post</h1>
			@if (session('status'))
				<div class="p-2 border border-green-200 bg-green-50 text-green-700 rounded-lg">{{ session('status') }}</div>
			@endif
		</div>
		<form method="POST" action="{{ route('admin.posts.update', $post) }}" enctype="multipart/form-data" class="p-6 space-y-6">
			@csrf
			@method('PUT')
			@if ($errors->any())
				<div class="p-4 border border-red-200 bg-red-50 text-red-700 rounded-lg">
					<ul class="list-disc ml-6">
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			@endif
			<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
				<div>
					<label class="block text-sm font-semibold text-gray-700 mb-2" for="title">Title</label>
					<input type="text" name="title" id="title" value="{{ old('title', $post->title) }}" class="bg-white border border-red-200 text-gray-900 rounded-lg px-4 py-2 w-full focus:ring-2 focus:ring-red-500 focus:border-red-500" required>
				</div>
				<div>
					<label class="block text-sm font-semibold text-gray-700 mb-2" for="slug">Slug (optional)</label>
					<input type="text" name="slug" id="slug" value="{{ old('slug', $post->slug) }}" class="bg-white border border-red-200 text-gray-900 rounded-lg px-4 py-2 w-full focus:ring-2 focus:ring-red-500 focus:border-red-500">
				</div>
			</div>
			<div>
				<label class="block text-sm font-semibold text-gray-700 mb-2" for="excerpt">Excerpt</label>
				<textarea name="excerpt" id="excerpt" rows="3" class="bg-white border border-red-200 text-gray-900 rounded-lg px-4 py-2 w-full focus:ring-2 focus:ring-red-500 focus:border-red-500">{{ old('excerpt', $post->excerpt) }}</textarea>
			</div>
			<div>
				<label class="block text-sm font-semibold text-gray-700 mb-2" for="content">Content</label>
				<textarea name="content" id="content" rows="10" class="bg-white border border-red-200 text-gray-900 rounded-lg px-4 py-2 w-full focus:ring-2 focus:ring-red-500 focus:border-red-500 rich-editor">{{ old('content', $post->content) }}</textarea>
			</div>
			<div>
				<label class="block text-sm font-semibold text-gray-700 mb-2" for="featured_image">Featured Image</label>
				@if($post->featured_image)
					<div class="mb-2">
						<img src="{{ asset('storage/'.$post->featured_image) }}" alt="{{ $post->title }}" class="max-h-32 rounded">
					</div>
				@endif
				<input type="file" name="featured_image" id="featured_image" class="block w-full text-gray-900 border border-red-200 rounded-lg px-4 py-2 bg-white focus:ring-2 focus:ring-red-500 focus:border-red-500 file:bg-red-600 file:text-white file:rounded-lg file:border-0 file:px-4 file:py-2 file:mr-4">
				@if($post->featured_image)
					<label class="inline-flex items-center mt-2">
						<input type="checkbox" name="remove_featured_image" value="1" class="mr-2"> Remove current image
					</label>
				@endif
			</div>
			<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
				<div>
					<label class="block text-sm font-semibold text-gray-700 mb-2" for="status">Status</label>
					<select name="status" id="status" class="bg-white border border-red-200 text-gray-900 rounded-lg px-4 py-2 w-full focus:ring-2 focus:ring-red-500 focus:border-red-500">
						@foreach(['draft','published','scheduled','archived'] as $st)
							<option value="{{ $st }}" @selected(old('status', $post->status)===$st)>{{ ucfirst($st) }}</option>
						@endforeach
					</select>
				</div>
				<div>
					<label class="block text-sm font-semibold text-gray-700 mb-2" for="published_at">Publish At</label>
					<input type="datetime-local" name="published_at" id="published_at" value="{{ old('published_at', optional($post->published_at)->format('Y-m-d\TH:i')) }}" class="bg-white border border-red-200 text-gray-900 rounded-lg px-4 py-2 w-full focus:ring-2 focus:ring-red-500 focus:border-red-500">
				</div>
			</div>

			<div class="border-t border-red-200 pt-6 mt-6">
				<h2 class="text-lg font-semibold text-gray-900 mb-4">SEO Settings</h2>
				<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
					<div>
						<label class="block text-sm font-semibold text-gray-700 mb-2" for="meta_title">Meta Title</label>
						<input type="text" name="meta_title" id="meta_title" value="{{ old('meta_title', $post->meta_title) }}" class="bg-white border border-red-200 text-gray-900 rounded-lg px-4 py-2 w-full focus:ring-2 focus:ring-red-500 focus:border-red-500" placeholder="Leave empty to use title">
					</div>
					<div>
						<label class="block text-sm font-semibold text-gray-700 mb-2" for="meta_keywords">Meta Keywords</label>
						<input type="text" name="meta_keywords" id="meta_keywords" value="{{ old('meta_keywords', $post->meta_keywords) }}" class="bg-white border border-red-200 text-gray-900 rounded-lg px-4 py-2 w-full focus:ring-2 focus:ring-red-500 focus:border-red-500" placeholder="Comma separated keywords">
					</div>
				</div>
				<div class="mt-6">
					<label class="block text-sm font-semibold text-gray-700 mb-2" for="meta_description">Meta Description</label>
					<textarea name="meta_description" id="meta_description" rows="3" class="bg-white border border-red-200 text-gray-900 rounded-lg px-4 py-2 w-full focus:ring-2 focus:ring-red-500 focus:border-red-500" placeholder="Leave empty to use excerpt">{{ old('meta_description', $post->meta_description) }}</textarea>
				</div>
				<div class="mt-6">
					<label class="block text-sm font-semibold text-gray-700 mb-2" for="canonical_url">Canonical URL</label>
					<input type="url" name="canonical_url" id="canonical_url" value="{{ old('canonical_url', $post->canonical_url) }}" class="bg-white border border-red-200 text-gray-900 rounded-lg px-4 py-2 w-full focus:ring-2 focus:ring-red-500 focus:border-red-500" placeholder="Leave empty to use default">
				</div>
			</div>

			<div class="text-left mt-6">
				<button type="submit" class="inline-flex items-center justify-center px-6 py-3 bg-red-600 text-white font-semibold rounded-lg shadow hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 transition duration-200 hover:shadow-lg">
					Save Changes
				</button>
			</div>
		</form>
	</div>
</div>
<script src="https://cdn.tiny.cloud/1/ay3qm76k852bki848b9z44n7dv1paeu25u8prgmduxjj20id/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize TinyMCE with proper configuration
        tinymce.init({
            selector: 'textarea.rich-editor',
            menubar: false,
            plugins: 'link lists code',
            toolbar: 'undo redo | bold italic underline | bullist numlist | link | code',
            height: 300,
            skin: 'oxide',
            content_css: 'default',
            branding: false,
            setup: function(editor) {
                // Ensure the editor is properly initialized before form submission
                editor.on('init', function() {
                    // Remove required attribute from textarea when editor is ready
                    const textarea = editor.getElement();
                    if (textarea) {
                        textarea.removeAttribute('required');
                    }
                });
            }
        });

        // Add form validation
        const form = document.querySelector('form');
        form.addEventListener('submit', function(e) {
            const contentEditor = tinymce.get('content');
            if (contentEditor && contentEditor.getContent().trim() === '') {
                e.preventDefault();
                alert('Please enter content for the post.');
                contentEditor.focus();
                return false;
            }
        });
    });
</script>
@endsection


