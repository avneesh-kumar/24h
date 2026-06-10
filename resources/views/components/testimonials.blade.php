<section class="testimonials-section">
    <div class="container">
        <div class="section-header">
            <h2>What Our Clients Say</h2>
            <p>Trusted by businesses across various industries</p>
        </div>
        <div class="testimonials-slider">
            <div class="testimonials-track">
                @foreach($testimonials as $testimonial)
                <div class="testimonial-card">
                    <div class="rating">
                        @for($i = 1; $i <= 5; $i++)
                            <i class="fas fa-star {{ $i <= $testimonial->rating ? 'text-yellow-400' : 'text-gray-300' }}"></i>
                        @endfor
                    </div>
                    <div class="content">
                        <p>{{ $testimonial->content }}</p>
                    </div>
                    <div class="author">
                        @if($testimonial->image)
                            <img src="{{ asset('storage/' . $testimonial->image) }}" alt="{{ $testimonial->name }}" class="author-image">
                        @else
                            <div class="author-initial">{{ substr($testimonial->name, 0, 1) }}</div>
                        @endif
                        <div class="author-info">
                            <h4>{{ $testimonial->name }}</h4>
                            <p>{{ $testimonial->position }}</p>
                            <p class="company">{{ $testimonial->company }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="slider-controls">
                <button type="button" class="prev-btn" aria-label="Previous testimonial">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button type="button" class="next-btn" aria-label="Next testimonial">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>
    </div>
</section>
