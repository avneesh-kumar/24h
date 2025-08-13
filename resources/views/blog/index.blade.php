@extends('layouts.app')

@section('title', 'Blog')
@section('meta_description', 'Latest insights and updates from READY 24h Security.')

@section('content')
<div class="blog-page">
	<div class="section-header" style="margin: 80px">
		<h1 style="color: black">Blog</h1>
		<p style="color: black">News, insights, and updates</p>
	</div>

	<div class="blog-grid" style="display:grid;grid-template-columns:repeat(3,1fr);gap:24px;margin:40px 80px;">
		@forelse($posts as $post)
			<div class="blog-card" style="border:1px solid #eee;border-radius:8px;overflow:hidden;background:#fff;">
				@if($post->featured_image)
					<a href="{{ route('blog.show', $post->slug) }}">
						<img src="{{ asset('storage/'.$post->featured_image) }}" alt="{{ $post->title }}" style="width:100%;height:200px;object-fit:cover;display:block;">
					</a>
				@endif
				<div style="padding:16px">
					<h3 style="margin:0 0 8px 0;color:#111;font-size:20px;line-height:1.3;"><a href="{{ route('blog.show', $post->slug) }}" style="text-decoration:none;color:#111;">{{ $post->title }}</a></h3>
					<p style="margin:0 0 12px 0;color:#666;font-size:14px;">{{ optional($post->published_at)->format('M d, Y') }}</p>
					<p style="margin:0;color:#333;">{{ $post->excerpt ?? Str::limit(strip_tags($post->content), 120) }}</p>
				</div>
			</div>
		@empty
			<p style="margin:0 80px 80px;color:#333;">No posts yet.</p>
		@endforelse
	</div>

	<div class="pagination" style="margin: 0 80px 80px;">
		{{ $posts->links() }}
	</div>
</div>
@endsection


