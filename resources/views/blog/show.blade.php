@extends('layouts.app')

@section('title', $post->meta_title ?: $post->title)
@section('meta_description', $post->meta_description ?: Str::limit(strip_tags($post->excerpt ?: $post->content), 160))

@section('content')
<div class="blog-detail">
	<!-- Hero Section -->
	<div class="blog-hero" style="background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%); color: white; padding: 60px 0; margin-bottom: 60px; position: relative; overflow: hidden;">
		<div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: linear-gradient(45deg, rgba(220, 38, 38, 0.1) 0%, rgba(0, 0, 0, 0) 100%);"></div>
		<div style="max-width: 1400px; margin: 0 auto; padding: 0 20px; text-align: center; position: relative; z-index: 2;">
			<div style="max-width: 1000px; margin: 0 auto;">
				<div style="color: rgba(255,255,255,0.9); font-size: 0.9rem; font-weight: 600; margin-bottom: 15px; text-transform: uppercase; letter-spacing: 1px;">{{ optional($post->published_at)->format('F d, Y') }}</div>
				<h1 style="font-size: 3rem; font-weight: 700; margin: 0 0 20px 0; line-height: 1.2; text-shadow: 2px 2px 4px rgba(0,0,0,0.5);">{{ $post->title }}</h1>
				@if($post->excerpt)
					<p style="font-size: 1.2rem; margin: 0; opacity: 0.9; line-height: 1.6;">{{ $post->excerpt }}</p>
				@endif
			</div>
		</div>
	</div>

	<!-- Main Content Container -->
	<div style="max-width: 1100px; margin: 0 auto; padding: 0 20px;">
		<!-- Featured Image -->
		@if($post->featured_image)
			<div class="featured-image-container" style="margin-bottom: 40px; border-radius: 20px; overflow: hidden; box-shadow: 0 20px 40px rgba(0,0,0,0.15); border: 3px solid #e5e7eb;">
				<img src="{{ asset('storage/'.$post->featured_image) }}" alt="{{ $post->title }}" style="width: 100%; height: 450px; object-fit: cover; display: block;">
			</div>
		@endif

		<!-- Article Meta -->
		<div class="article-meta" style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 40px; padding: 25px; background: linear-gradient(135deg, #f8f9fa 0%, #f1f3f4 100%); border-radius: 20px; border: 2px solid #e5e7eb; border-left: 5px solid #dc2626;">
			<div style="display: flex; align-items: center; gap: 25px;">
				<div style="display: flex; align-items: center; color: #4b5563; background: white; padding: 10px 15px; border-radius: 12px; border: 1px solid #d1d5db;">
					<i class="fas fa-calendar-alt" style="margin-right: 8px; color: #dc2626;"></i>
					<span>{{ optional($post->published_at)->format('F d, Y') }}</span>
				</div>
				@if($post->author)
					<div style="display: flex; align-items: center; color: #4b5563; background: white; padding: 10px 15px; border-radius: 12px; border: 1px solid #d1d5db;">
						<i class="fas fa-user" style="margin-right: 8px; color: #dc2626;"></i>
						<span>{{ $post->author->name }}</span>
					</div>
				@endif
			</div>
			<div style="display: flex; align-items: center; color: #4b5563; background: white; padding: 10px 15px; border-radius: 12px; border: 1px solid #d1d5db;">
				<i class="fas fa-eye" style="margin-right: 8px; color: #dc2626;"></i>
				<span>{{ $post->views ?? 0 }} views</span>
			</div>
		</div>

		<!-- Article Content -->
		<article class="article-content" style="background: white; padding: 50px; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.08); margin-bottom: 40px; border: 2px solid #e5e7eb; position: relative;">
			<div style="position: absolute; top: 0; left: 0; right: 0; height: 5px; background: linear-gradient(90deg, #dc2626, #991b1b); border-radius: 20px 20px 0 0;"></div>
			<div class="content" style="color: #374151; line-height: 1.8; font-size: 1.1rem;">
				{!! $post->content !!}
			</div>
		</article>

		<!-- Call to Action -->
		<div class="blog-cta-section" style="text-align: center; padding: 50px; background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); border-radius: 20px; margin-bottom: 40px; border: 2px solid #e5e7eb; position: relative; display: block;">
			<div style="position: absolute; top: 0; left: 0; right: 0; height: 4px; background: linear-gradient(90deg, #dc2626, #991b1b); border-radius: 20px 20px 0 0;"></div>
			<h3 style="color: #111; margin-bottom: 15px; font-size: 1.8rem;">Need Security Services?</h3>
			<p style="color: #4b5563; margin-bottom: 30px; font-size: 1.1rem;">Get in touch with our expert team for a customized security solution</p>
			<a href="{{ route('contact') }}" style="display: inline-flex; align-items: center; background: linear-gradient(135deg, #dc2626, #991b1b); color: white; padding: 18px 35px; border-radius: 30px; text-decoration: none; font-weight: 600; transition: all 0.3s ease; box-shadow: 0 5px 15px rgba(220, 38, 38, 0.3); border: 2px solid transparent;">
				Contact Us Today	
				<i class="fas fa-arrow-right" style="margin-left: 10px; transition: transform 0.3s ease;"></i>
			</a>
		</div>

		<!-- Related Posts Section -->
		<div class="related-posts" style="margin-bottom: 40px;">
			<h3 style="color: #111; margin-bottom: 30px; font-size: 2rem; text-align: center; position: relative;">
				<span style="background: white; padding: 0 20px; position: relative; z-index: 2;">More Security Insights</span>
				<div style="position: absolute; top: 50%; left: 0; right: 0; height: 2px; background: linear-gradient(90deg, transparent, #e5e7eb, transparent); z-index: 1;"></div>
			</h3>
			<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 25px;">
				@php
					$relatedPosts = \App\Models\Post::published()
						->where('id', '!=', $post->id)
						->latest('published_at')
						->limit(3)
						->get();
				@endphp
				@foreach($relatedPosts as $relatedPost)
					<div class="related-post-card" style="background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 5px 20px rgba(0,0,0,0.08); transition: all 0.3s ease; border: 2px solid #e5e7eb; position: relative;">
						<div style="position: absolute; top: 0; left: 0; right: 0; height: 3px; background: linear-gradient(90deg, #dc2626, #991b1b);"></div>
						@if($relatedPost->featured_image)
							<a href="{{ route('blog.show', $relatedPost->slug) }}">
								<img src="{{ asset('storage/'.$relatedPost->featured_image) }}" alt="{{ $relatedPost->title }}" style="width: 100%; height: 180px; object-fit: cover;">
							</a>
						@endif
						<div style="padding: 25px;">
							<h4 style="margin: 0 0 12px 0; font-size: 1.2rem; line-height: 1.3;">
								<a href="{{ route('blog.show', $relatedPost->slug) }}" style="text-decoration: none; color: #111;">{{ $relatedPost->title }}</a>
							</h4>
							<p style="color: #6b7280; font-size: 0.9rem; margin: 0;">{{ optional($relatedPost->published_at)->format('M d, Y') }}</p>
						</div>
					</div>
				@endforeach
			</div>
		</div>

		<!-- Back to Blog -->
		<div style="text-align: center; margin-bottom: 60px;">
			<a href="{{ route('blog.index') }}" style="display: inline-flex; align-items: center; color: #dc2626; text-decoration: none; font-weight: 600; transition: all 0.3s ease; padding: 12px 24px; border-radius: 25px; border: 2px solid #dc2626; background: transparent;">
				<i class="fas fa-arrow-left" style="margin-right: 10px; transition: transform 0.3s ease;"></i>
				Back to Blog
			</a>
		</div>
	</div>
</div>

<style>
.related-post-card:hover {
	transform: translateY(-5px);
	box-shadow: 0 20px 40px rgba(0,0,0,0.15);
	border-color: #dc2626;
}

.related-post-card h4 a:hover {
	color: #dc2626 !important;
}

.blog-cta-section a:hover .fas.fa-arrow-right {
	transform: translateX(5px);
}

.blog-cta-section a:hover {
	transform: translateY(-3px);
	box-shadow: 0 10px 25px rgba(220, 38, 38, 0.4);
}

.article-content {
	border-left: 5px solid #dc2626;
}

.article-content h1, .article-content h2, .article-content h3 {
	color: #111;
	margin-top: 35px;
	margin-bottom: 20px;
}

.article-content p {
	margin-bottom: 25px;
}

.article-content ul, .article-content ol {
	margin-bottom: 25px;
	padding-left: 25px;
}

.article-content li {
	margin-bottom: 10px;
}

.article-content blockquote {
	border-left: 5px solid #dc2626;
	padding-left: 25px;
	margin: 25px 0;
	font-style: italic;
	color: #4b5563;
	background: linear-gradient(135deg, #f8f9fa 0%, #f1f3f4 100%);
	padding: 25px;
	border-radius: 15px;
	border: 1px solid #e5e7eb;
}

.article-content img {
	max-width: 100%;
	height: auto;
	border-radius: 15px;
	margin: 25px 0;
	border: 2px solid #e5e7eb;
}

@media (max-width: 768px) {
	.blog-hero h1 {
		font-size: 2rem;
	}
	
	.article-content {
		padding: 30px;
	}
	
	.article-meta {
		flex-direction: column;
		gap: 15px;
		text-align: center;
	}
}
</style>
@endsection


