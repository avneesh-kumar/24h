@extends('layouts.app')

@section('title', $post->meta_title ?: $post->title)
@section('meta_description', $post->meta_description ?: Str::limit(strip_tags($post->excerpt ?: $post->content), 160))

@section('content')
<div class="blog-detail" style="margin:80px">
	<article>
		<h1 style="color:#111;margin-bottom:8px;">{{ $post->title }}</h1>
		<p style="color:#666;margin-top:0;">{{ optional($post->published_at)->format('M d, Y') }}</p>
		@if($post->featured_image)
			<img src="{{ asset('storage/'.$post->featured_image) }}" alt="{{ $post->title }}" style="width:100%;max-height:420px;object-fit:cover;border-radius:8px;margin:16px 0;">
		@endif
		<div class="content" style="color:#222;line-height:1.8;">
			{!! $post->content !!}
		</div>
	</article>
</div>
@endsection


