@extends('layouts.app')

@section('title', 'Blog')
@section('meta_description', 'Latest insights and updates from READY 24h Security.')

@section('content')
<div class="blog-page">
	<!-- Hero Section -->
	<div class="blog-hero" style="background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%); color: white; padding: 80px 0; text-align: center; margin-bottom: 60px; position: relative; overflow: hidden;">
		<div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: linear-gradient(45deg, rgba(220, 38, 38, 0.1) 0%, rgba(0, 0, 0, 0) 100%);"></div>
		<div style="max-width: 1400px; margin: 0 auto; padding: 0 20px; position: relative; z-index: 2;">
			<h1 style="font-size: 3.5rem; font-weight: 700; margin: 0 0 20px 0; text-shadow: 2px 2px 4px rgba(0,0,0,0.5);">Security Insights</h1>
			<p style="font-size: 1.3rem; margin: 0; opacity: 0.9; max-width: 600px; margin: 0 auto;">Stay informed with the latest security trends, tips, and industry updates from our expert team</p>
			<div style="margin-top: 30px; display: inline-block; padding: 2px; background: linear-gradient(90deg, #dc2626, #991b1b); border-radius: 30px;">
				<div style="background: rgba(0,0,0,0.8); padding: 8px 20px; border-radius: 28px; font-size: 0.9rem; font-weight: 600; color: #f3f4f6;">
					<i class="fas fa-shield-alt" style="margin-right: 8px; color: #dc2626;"></i>Professional Security Solutions
				</div>
			</div>
		</div>
	</div>

	<!-- Blog Grid Container -->
	<div style="max-width: 1400px; margin: 0 auto; padding: 0 20px;">
		<!-- Featured Post Section -->
		@if($posts->count() > 0)
			@php $featuredPost = $posts->first(); @endphp
			<div class="featured-post" style="margin-bottom: 60px; background: white; border-radius: 20px; overflow: hidden; box-shadow: 0 20px 40px rgba(0,0,0,0.1); border: 2px solid #e5e7eb;">
				<div style="display: grid; grid-template-columns: 1fr 1fr; min-height: 400px;">
					@if($featuredPost->featured_image)
						<div style="position: relative; overflow: hidden;">
							<img src="{{ asset('storage/'.$featuredPost->featured_image) }}" alt="{{ $featuredPost->title }}" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s ease;">
							<div style="position: absolute; top: 20px; left: 20px; background: linear-gradient(135deg, #dc2626, #991b1b); color: white; padding: 8px 16px; border-radius: 20px; font-size: 0.9rem; font-weight: 600; box-shadow: 0 4px 12px rgba(220, 38, 38, 0.3);">Featured</div>
						</div>
					@endif
					<div style="padding: 40px; display: flex; flex-direction: column; justify-content: center; background: linear-gradient(135deg, #fafafa 0%, #f3f4f6 100%);">
						<div style="color: #dc2626; font-size: 0.9rem; font-weight: 600; margin-bottom: 15px; text-transform: uppercase; letter-spacing: 1px;">{{ optional($featuredPost->published_at)->format('M d, Y') }}</div>
						<h2 style="font-size: 2.2rem; font-weight: 700; margin: 0 0 20px 0; line-height: 1.2; color: #111;">
							<a href="{{ route('blog.show', $featuredPost->slug) }}" style="text-decoration: none; color: inherit;">{{ $featuredPost->title }}</a>
						</h2>
						<p style="color: #4b5563; line-height: 1.6; margin: 0 0 25px 0; font-size: 1.1rem;">{{ $featuredPost->excerpt ?? Str::limit(strip_tags($featuredPost->content), 200) }}</p>
						<a href="{{ route('blog.show', $featuredPost->slug) }}" style="display: inline-flex; align-items: center; background: linear-gradient(135deg, #dc2626, #991b1b); color: white; padding: 15px 30px; border-radius: 30px; text-decoration: none; font-weight: 600; transition: all 0.3s ease; box-shadow: 0 5px 15px rgba(220, 38, 38, 0.3); border: 2px solid transparent;">
							Read Full Article
							<i class="fas fa-arrow-right" style="margin-left: 10px; transition: transform 0.3s ease;"></i>
						</a>
					</div>
				</div>
			</div>
		@endif

		<!-- Regular Posts Grid -->
		<div class="blog-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(400px, 1fr)); gap: 30px; margin-bottom: 60px;">
			@foreach($posts->skip(1) as $post)
				<div class="blog-card" style="background: white; border-radius: 16px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.08); transition: all 0.3s ease; border: 2px solid #e5e7eb; position: relative;">
					<div style="position: absolute; top: 0; left: 0; right: 0; height: 4px; background: linear-gradient(90deg, #dc2626, #991b1b);"></div>
					@if($post->featured_image)
						<div style="position: relative; overflow: hidden;">
							<a href="{{ route('blog.show', $post->slug) }}">
								<img src="{{ asset('storage/'.$post->featured_image) }}" alt="{{ $post->title }}" style="width: 100%; height: 220px; object-fit: cover; transition: transform 0.3s ease;">
							</a>
							<div style="position: absolute; top: 15px; right: 15px; background: rgba(0,0,0,0.8); color: white; padding: 6px 12px; border-radius: 15px; font-size: 0.8rem; border: 1px solid #374151;">{{ optional($post->published_at)->format('M d') }}</div>
						</div>
					@endif
					<div style="padding: 25px;">
						<div style="color: #dc2626; font-size: 0.85rem; font-weight: 600; margin-bottom: 12px; text-transform: uppercase; letter-spacing: 0.5px;">{{ optional($post->published_at)->format('M d, Y') }}</div>
						<h3 style="margin: 0 0 15px 0; color: #111; font-size: 1.4rem; line-height: 1.3; font-weight: 600;">
							<a href="{{ route('blog.show', $post->slug) }}" style="text-decoration: none; color: inherit; transition: color 0.3s ease;">{{ $post->title }}</a>
						</h3>
						<p style="margin: 0; color: #4b5563; line-height: 1.5; font-size: 0.95rem;">{{ $post->excerpt ?? Str::limit(strip_tags($post->content), 120) }}</p>
						<div style="margin-top: 20px; display: flex; align-items: center; justify-content: space-between;">
							<a href="{{ route('blog.show', $post->slug) }}" style="color: #dc2626; text-decoration: none; font-weight: 600; font-size: 0.9rem; display: flex; align-items: center; transition: all 0.3s ease; padding: 8px 16px; border-radius: 20px; border: 1px solid transparent;">
								Read More
								<i class="fas fa-arrow-right" style="margin-left: 8px; font-size: 0.8rem; transition: transform 0.3s ease;"></i>
							</a>
							<div style="color: #6b7280; font-size: 0.8rem; display: flex; align-items: center;">
								<i class="fas fa-eye" style="margin-right: 5px; color: #dc2626;"></i>{{ $post->views ?? 0 }}
							</div>
						</div>
					</div>
				</div>
			@endforeach
		</div>

		<!-- Empty State -->
		@if($posts->count() == 0)
			<div style="text-align: center; padding: 80px 20px; background: white; border-radius: 20px; border: 2px solid #e5e7eb;">
				<div style="font-size: 4rem; color: #d1d5db; margin-bottom: 20px;">
					<i class="fas fa-newspaper"></i>
				</div>
				<h3 style="color: #4b5563; margin-bottom: 15px;">No posts yet</h3>
				<p style="color: #6b7280;">We're working on some great content. Check back soon!</p>
			</div>
		@endif

		<!-- Pagination -->
		@if($posts->hasPages())
			<div class="pagination" style="text-align: center; margin: 60px 0;">
				{{ $posts->links() }}
			</div>
		@endif
	</div>
</div>

<style>
.blog-card:hover {
	transform: translateY(-5px);
	box-shadow: 0 25px 50px rgba(0,0,0,0.15);
	border-color: #dc2626;
}

.blog-card:hover img {
	transform: scale(1.05);
}

.blog-card h3 a:hover {
	color: #dc2626 !important;
}

.blog-card a:hover {
	background: rgba(220, 38, 38, 0.1);
	border-color: #dc2626;
}

.blog-card a:hover .fas.fa-arrow-right {
	transform: translateX(3px);
}

.featured-post:hover img {
	transform: scale(1.05);
}

.featured-post a:hover {
	transform: translateY(-2px);
	box-shadow: 0 8px 25px rgba(220, 38, 38, 0.4);
}

@media (max-width: 768px) {
	.blog-hero h1 {
		font-size: 2.5rem;
	}
	
	.featured-post {
		grid-template-columns: 1fr !important;
	}
	
	.blog-grid {
		grid-template-columns: 1fr !important;
	}
}
</style>
@endsection


