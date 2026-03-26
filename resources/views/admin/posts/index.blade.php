@extends('admin.layouts.app')

@section('content')
<div class="w-full">
	<div class="bg-white border border-red-200 shadow-2xl rounded-lg mb-8">
		<div class="p-6 border-b border-red-100 flex items-center justify-between">
			<h1 class="text-xl font-bold text-red-700">Posts</h1>
			<a href="{{ route('admin.posts.create') }}" class="px-4 py-2 bg-red-600 text-white rounded-lg">Add Post</a>
		</div>
		@if (session('status'))
			<div class="m-6 p-4 border border-green-200 bg-green-50 text-green-700 rounded-lg">{{ session('status') }}</div>
		@endif
		<div class="p-6">
			<form method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
				<input type="text" name="q" value="{{ request('q') }}" placeholder="Search title..." class="bg-white border border-red-200 rounded-lg px-4 py-2">
				<select name="status" class="bg-white border border-red-200 rounded-lg px-4 py-2">
					<option value="">All statuses</option>
					@foreach(['draft','published','scheduled','archived'] as $st)
						<option value="{{ $st }}" @selected(request('status')===$st)>{{ ucfirst($st) }}</option>
					@endforeach
				</select>
				<button class="px-4 py-2 bg-red-600 text-white rounded-lg">Filter</button>
			</form>
			<div class="overflow-x-auto">
				<table class="min-w-full text-left">
					<thead>
						<tr class="border-b">
							<th class="p-2">Title</th>
							<th class="p-2">Status</th>
							<th class="p-2">Published</th>
							<th class="p-2">Actions</th>
						</tr>
					</thead>
					<tbody>
					@forelse($posts as $post)
						<tr class="border-b">
							<td class="p-2">{{ $post->title }}</td>
							<td class="p-2">{{ ucfirst($post->status) }}</td>
							<td class="p-2">{{ $post->published_at ? $post->published_at->format('Y-m-d') : '-' }}</td>
							<td class="p-2 space-x-2">
								<a href="{{ route('admin.posts.edit', $post) }}" class="text-red-600">Edit</a>
								<form action="{{ route('admin.posts.destroy', $post) }}" method="POST" class="inline">
									@csrf @method('DELETE')
									<button class="text-gray-600" onclick="return confirm('Delete this post?')">Delete</button>
								</form>
							</td>
						</tr>
					@empty
						<tr><td class="p-2" colspan="4">No posts found.</td></tr>
					@endforelse
					</tbody>
				</table>
			</div>
			<div class="mt-4">{{ $posts->links() }}</div>
		</div>
	</div>
</div>
@endsection


