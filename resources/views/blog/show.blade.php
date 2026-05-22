@extends('layouts.app')

@section('title', $post->meta_title ?: $post->title)
@section('meta_description', $post->meta_description ?: Str::limit(strip_tags($post->excerpt ?: $post->content), 160))

@if($post->schema_markup)
@push('schema')
<script type="application/ld+json">{!! $post->schema_markup !!}</script>
@endpush
@endif

@section('content')
<div class="blog-detail">
	<!-- Hero Section -->
	<div class="blog-hero" style="background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%); color: white; padding: 40px 0; margin-bottom: 40px; position: relative; overflow: hidden;">
		<div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: linear-gradient(45deg, rgba(220, 38, 38, 0.1) 0%, rgba(0, 0, 0, 0) 100%);"></div>
		<div style="max-width: 1400px; margin: 0 auto; padding: 0 20px; text-align: center; position: relative; z-index: 2;">
			<div style="max-width: 1000px; margin: 0 auto;">
				<div style="color: rgba(255,255,255,0.9); font-size: 0.85rem; font-weight: 600; margin-bottom: 12px; text-transform: uppercase; letter-spacing: 1px;">{{ optional($post->published_at)->format('F d, Y') }}</div>
				<h1 class="blog-hero-title" style="font-size: clamp(1.8rem, 6vw, 3rem); font-weight: 700; margin: 0 0 15px 0; line-height: 1.2; text-shadow: 2px 2px 4px rgba(0,0,0,0.5);">{{ $post->title }}</h1>
				@if($post->excerpt)
					<p style="font-size: clamp(1rem, 2vw, 1.2rem); margin: 0; opacity: 0.9; line-height: 1.6;">{{ $post->excerpt }}</p>
				@endif
			</div>
		</div>
	</div>

	<!-- Main Content Container -->
	<div style="max-width: 1100px; margin: 0 auto; padding: 0 20px;">
		<!-- Featured Image -->
		@if($post->featured_image)
			<div class="featured-image-container" style="margin-bottom: 40px; border-radius: 15px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.12); border: 2px solid #e5e7eb;">
				<img src="{{ asset('storage/'.$post->featured_image) }}" alt="{{ $post->title }}" style="width: 100%; height: auto; min-height: 300px; max-height: 500px; object-fit: cover; display: block;">
			</div>
		@endif

		<!-- Article Meta -->
		<div class="article-meta" style="display: flex; align-items: center; justify-content: space-between; gap: 15px; margin-bottom: 30px; padding: 20px; background: linear-gradient(135deg, #f8f9fa 0%, #f1f3f4 100%); border-radius: 15px; border: 2px solid #e5e7eb; border-left: 5px solid #dc2626; flex-wrap: wrap;">
			<div style="display: flex; align-items: center; gap: 15px; flex-wrap: wrap;">
				<div style="display: flex; align-items: center; color: #4b5563; background: white; padding: 8px 12px; border-radius: 10px; border: 1px solid #d1d5db; font-size: 0.9rem;">
					<i class="fas fa-calendar-alt" style="margin-right: 6px; color: #dc2626;"></i>
					<span>{{ optional($post->published_at)->format('M d, Y') }}</span>
				</div>
				@if($post->author)
					<div style="display: flex; align-items: center; color: #4b5563; background: white; padding: 8px 12px; border-radius: 10px; border: 1px solid #d1d5db; font-size: 0.9rem;">
						<i class="fas fa-user" style="margin-right: 6px; color: #dc2626;"></i>
						<span>{{ $post->author->name }}</span>
					</div>
				@endif
			</div>
			<div style="display: flex; align-items: center; color: #4b5563; background: white; padding: 8px 12px; border-radius: 10px; border: 1px solid #d1d5db; font-size: 0.9rem;">
				<i class="fas fa-eye" style="margin-right: 6px; color: #dc2626;"></i>
				<span>{{ $post->views ?? 0 }} views</span>
			</div>
		</div>

		<!-- Article Content -->
		<article class="article-content" style="background: white; padding: clamp(25px, 5vw, 50px); border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.08); margin-bottom: 30px; border: 2px solid #e5e7eb; border-left: 5px solid #dc2626; position: relative;">
			<div style="position: absolute; top: 0; left: 0; right: 0; height: 5px; background: linear-gradient(90deg, #dc2626, #991b1b); border-radius: 15px 15px 0 0;"></div>
			<div class="content" style="color: #374151; line-height: 1.8; font-size: clamp(1rem, 1.2vw, 1.1rem);">
				{!! $post->content !!}
			</div>
		</article>

		<!-- FAQ Section -->
		@if(isset($faqs) && $faqs->isNotEmpty())
		<div style="background: white; padding: clamp(25px, 5vw, 50px); border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.08); margin-bottom: 30px; border: 2px solid #e5e7eb; border-left: 5px solid #dc2626; position: relative;">
			<div style="position: absolute; top: 0; left: 0; right: 0; height: 5px; background: linear-gradient(90deg, #dc2626, #991b1b); border-radius: 15px 15px 0 0;"></div>
			<h2 style="color: #111; font-size: clamp(1.4rem, 4vw, 1.8rem); font-weight: 700; margin: 0 0 25px 0;">Frequently Asked Questions</h2>
			<div id="faq-accordion" style="display: flex; flex-direction: column; gap: 10px;">
				@foreach($faqs as $i => $faq)
				<div class="faq-item" style="border: 1px solid #e5e7eb; border-radius: 10px; overflow: hidden;">
					<button type="button" onclick="toggleFaq({{ $i }})"
						style="width:100%; padding: 15px 16px; font-weight: 600; color: #111; cursor: pointer; display: flex; justify-content: space-between; align-items: center; background: #f9fafb; border: none; text-align: left; font-size: 0.95rem;">
						<span>{{ $faq->question }}</span>
						<svg class="faq-chevron" id="chevron-{{ $i }}" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#dc2626" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink:0; margin-left:12px; transition: transform 0.25s ease;">
							<polyline points="6 9 12 15 18 9"></polyline>
						</svg>
					</button>
					<div id="faq-body-{{ $i }}" style="display:none; padding: 15px 16px; color: #374151; line-height: 1.7; border-top: 1px solid #e5e7eb; font-size: 0.95rem;">
						{{ $faq->answer }}
					</div>
				</div>
				@endforeach
			</div>
		</div>
		@endif

		<!-- Call to Action -->
		<div class="blog-cta-section" style="text-align: center; padding: clamp(25px, 5vw, 50px); background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); border-radius: 15px; margin-bottom: 30px; border: 2px solid #e5e7eb; border-left: 5px solid #dc2626; position: relative; display: block;">
			<div style="position: absolute; top: 0; left: 0; right: 0; height: 4px; background: linear-gradient(90deg, #dc2626, #991b1b); border-radius: 15px 15px 0 0;"></div>
			<h3 style="color: #111; margin-bottom: 12px; font-size: clamp(1.4rem, 4vw, 1.8rem);">Need Security Services?</h3>
			<p style="color: #4b5563; margin-bottom: 20px; font-size: clamp(0.95rem, 2vw, 1.1rem);">Get in touch with our expert team for a customized security solution</p>
			<a href="{{ route('contact') }}" style="display: inline-flex; align-items: center; background: linear-gradient(135deg, #dc2626, #991b1b); color: white; padding: 14px 28px; border-radius: 25px; text-decoration: none; font-weight: 600; transition: all 0.3s ease; box-shadow: 0 5px 15px rgba(220, 38, 38, 0.3); border: 2px solid transparent; font-size: 0.95rem;">
				Contact Us Today	
				<i class="fas fa-arrow-right" style="margin-left: 8px; transition: transform 0.3s ease;"></i>
			</a>
		</div>

		{{-- Related Posts Section --}}
<section style="padding: 2rem 0; margin-bottom: 30px;">

  {{-- Section heading --}}
  <div style="display: flex; align-items: center; gap: 16px; margin-bottom: 1.75rem;">
    <div style="flex: 1; height: 1px; background: #e5e7eb;"></div>
    <span style="font-size: 12px; font-weight: 600; letter-spacing: 0.08em; text-transform: uppercase; color: #6b7280; white-space: nowrap;">
      <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
           stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
           style="vertical-align: -2px; margin-right: 5px;">
        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
        <path d="M12 3a9 9 0 1 0 9 9"/>
        <path d="M18 9v-6"/>
        <path d="M12 9l6 -6"/>
      </svg>
      More Security Insights
    </span>
    <div style="flex: 1; height: 1px; background: #e5e7eb;"></div>
  </div>

  {{-- Cards grid --}}
  <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 16px;">

    @php
      $relatedPosts = \App\Models\Post::published()
        ->where('id', '!=', $post->id)
        ->latest('published_at')
        ->limit(3)
        ->get();
    @endphp

    @foreach($relatedPosts as $relatedPost)
      <a href="{{ route('blog.show', $relatedPost->slug) }}"
         style="text-decoration: none; display: flex; flex-direction: column;
                background: #fff; border-radius: 12px; border: 1px solid #e5e7eb;
                overflow: hidden; transition: border-color 0.18s, box-shadow 0.18s;"
         onmouseover="this.style.borderColor='#d1d5db'; this.style.boxShadow='0 4px 16px rgba(0,0,0,0.06)'"
         onmouseout="this.style.borderColor='#e5e7eb'; this.style.boxShadow='none'">

        {{-- Image --}}
        @if($relatedPost->featured_image)
          <div style="position: relative; height: 140px; overflow: hidden; background: #f3f4f6; flex-shrink: 0;">
            <img src="{{ asset('storage/'.$relatedPost->featured_image) }}"
                 alt="{{ $relatedPost->title }}"
                 style="width: 100%; height: 100%; object-fit: cover; display: block;">
            <div style="position: absolute; bottom: 0; left: 0; right: 0; height: 3px; background: #991b1b;"></div>
          </div>
        @else
          <div style="height: 3px; background: #991b1b;"></div>
        @endif

        {{-- Body --}}
        <div style="padding: 14px 16px 16px; display: flex; flex-direction: column; gap: 8px; flex: 1;">

          {{-- Category tag (optional) --}}
          @if($relatedPost->category)
            <span style="display: inline-flex; align-items: center; gap: 4px;
                         font-size: 11px; font-weight: 600; letter-spacing: 0.06em;
                         text-transform: uppercase; color: #7f1d1d;
                         background: #fee2e2; padding: 3px 8px; border-radius: 4px; width: fit-content;">
              {{ $relatedPost->category->name }}
            </span>
          @endif

          {{-- Title --}}
          <p style="font-size: 14px; font-weight: 500; color: #111827;
                    line-height: 1.45; margin: 0;">
            {{ $relatedPost->title }}
          </p>

          {{-- Meta --}}
          <div style="display: flex; align-items: center; gap: 6px;
                      margin-top: auto; padding-top: 10px;
                      border-top: 1px solid #f3f4f6;">
            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24"
                 fill="none" stroke="#9ca3af" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/>
              <line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/>
            </svg>
            <span style="font-size: 12px; color: #9ca3af;">
              {{ optional($relatedPost->published_at)->format('M d, Y') }}
            </span>
            <span style="font-size: 12px; color: #991b1b; margin-left: auto; display: flex; align-items: center; gap: 3px;">
              Read
              <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24"
                   fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/>
              </svg>
            </span>
          </div>

        </div>
      </a>
    @endforeach

  </div>
</section>
		<!-- Back to Blog -->
		<div style="text-align: center; margin-bottom: 40px;">
			<a href="{{ route('blog.index') }}" style="display: inline-flex; align-items: center; color: #dc2626; text-decoration: none; font-weight: 600; transition: all 0.3s ease; padding: 12px 24px; border-radius: 25px; border: 2px solid #dc2626; background: transparent; font-size: 0.95rem;">
				<i class="fas fa-arrow-left" style="margin-right: 8px; transition: transform 0.3s ease;"></i>
				Back to Blog
			</a>
		</div>
	</div>
</div>

<style>
.related-post-card:hover {
	transform: translateY(-5px);
	box-shadow: 0 15px 30px rgba(0,0,0,0.12);
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

.article-content h1, .article-content h2, .article-content h3 {
	color: #111;
	margin-top: 30px;
	margin-bottom: 20px;
	font-size: clamp(1.2rem, 3vw, 1.8rem);
}

.article-content p {
	margin-bottom: 20px;
}

.article-content ul, .article-content ol {
	margin-bottom: 20px;
	padding-left: 25px;
}

.article-content li {
	margin-bottom: 8px;
}

.article-content blockquote {
	border-left: 5px solid #dc2626;
	padding: 20px 20px 20px 25px;
	margin: 20px 0;
	font-style: italic;
	color: #4b5563;
	background: linear-gradient(135deg, #f8f9fa 0%, #f1f3f4 100%);
	border-radius: 12px;
	border: 1px solid #e5e7eb;
}

.article-content img {
	max-width: 100%;
	height: auto;
	border-radius: 12px;
	margin: 20px 0;
	border: 2px solid #e5e7eb;
}

details[open] .faq-chevron { transform: rotate(180deg); }
details > summary::-webkit-details-marker { display: none; }
details > summary { list-style: none; }

/* Tablet & Mobile Responsive */
@media (max-width: 768px) {
	.article-content h1 {
		font-size: clamp(1.5rem, 5vw, 2rem);
	}
	
	.article-content {
		padding: 20px !important;
	}
	
	.article-meta {
		padding: 15px !important;
		gap: 10px !important;
	}
	
	.article-meta > div {
		justify-content: center;
	}
	
	.related-posts {
		margin-bottom: 20px;
	}
}

@media (max-width: 480px) {
	.blog-hero {
		padding: 25px 0 !important;
		margin-bottom: 25px !important;
	}
	
	.article-meta {
		padding: 12px !important;
		font-size: 0.8rem;
	}
	
	.article-meta > div > div {
		padding: 6px 10px !important;
		font-size: 0.8rem;
	}
	
	.article-content {
		padding: 15px !important;
		margin-bottom: 20px !important;
		border-radius: 12px;
	}
	
	.article-content h1, .article-content h2, .article-content h3 {
		margin-top: 20px;
		margin-bottom: 15px;
	}
	
	.blog-cta-section {
		padding: 20px !important;
		margin-bottom: 20px !important;
	}
	
	.blog-cta-section h3 {
		margin-bottom: 10px !important;
	}
	
	.blog-cta-section p {
		margin-bottom: 15px !important;
		font-size: 0.9rem;
	}
	
	.related-posts {
		margin-bottom: 15px;
	}
	
	.related-post-card {
		border-radius: 10px;
	}
	
	.related-post-card img {
		height: 120px;
	}
	
	.related-post-card > div {
		padding: 14px !important;
	}
	
	.related-post-card h4 {
		font-size: 1rem;
	}
}
</style>
<script>
function toggleFaq(index) {
    const total = document.querySelectorAll('.faq-item').length;
    for (let i = 0; i < total; i++) {
        const body = document.getElementById('faq-body-' + i);
        const chevron = document.getElementById('chevron-' + i);
        if (i === index) {
            const isOpen = body.style.display === 'block';
            body.style.display = isOpen ? 'none' : 'block';
            chevron.style.transform = isOpen ? 'rotate(0deg)' : 'rotate(180deg)';
        } else {
            body.style.display = 'none';
            chevron.style.transform = 'rotate(0deg)';
        }
    }
}
</script>
@endsection
