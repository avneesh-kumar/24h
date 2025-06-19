@php
use App\Models\Testimonial;
$testimonials = Testimonial::where('active', true)->orderBy('order')->get();
@endphp

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
                <button class="prev-btn" aria-label="Previous testimonial">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button class="next-btn" aria-label="Next testimonial">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>
    </div>
</section>

<style>
.testimonials-section {
    padding: 80px 0;
    background-color: #f8f9fa;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

.section-header {
    text-align: center;
    margin-bottom: 50px;
}

.section-header h2 {
    font-size: 2.5rem;
    color: #1a1a1a;
    margin-bottom: 15px;
}

.section-header p {
    font-size: 1.1rem;
    color: #666;
}

.testimonials-slider {
    position: relative;
    overflow: hidden;
    padding: 20px 0;
}

.testimonials-track {
    display: flex;
    transition: transform 0.5s ease;
    gap: 30px;
}

.testimonial-card {
    flex: 0 0 calc(33.333% - 20px);
    background: #fff;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    min-width: 350px;
}

.rating {
    margin-bottom: 20px;
}

.rating i {
    font-size: 18px;
    margin-right: 2px;
}

.content {
    margin-bottom: 25px;
}

.content p {
    font-size: 1rem;
    line-height: 1.6;
    color: #4a5568;
    font-style: italic;
}

.author {
    display: flex;
    align-items: center;
    gap: 15px;
}

.author-image {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    object-fit: cover;
}

.author-initial {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: #dc2626;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    font-weight: bold;
}

.author-info h4 {
    font-size: 1.1rem;
    color: #1a1a1a;
    margin-bottom: 5px;
}

.author-info p {
    font-size: 0.9rem;
    color: #666;
    margin: 0;
}

.author-info .company {
    color: #dc2626;
    font-weight: 500;
}

.slider-controls {
    display: flex;
    justify-content: center;
    gap: 20px;
    margin-top: 30px;
}

.prev-btn, .next-btn {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: #fff;
    border: 2px solid #dc2626;
    color: #dc2626;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
}

.prev-btn:hover, .next-btn:hover {
    background: #dc2626;
    color: #fff;
}

@media (max-width: 1200px) {
    .testimonial-card {
        flex: 0 0 calc(50% - 15px);
    }
}

@media (max-width: 768px) {
    .testimonial-card {
        flex: 0 0 100%;
    }
    
    .section-header h2 {
        font-size: 2rem;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const track = document.querySelector('.testimonials-track');
    const cards = document.querySelectorAll('.testimonial-card');
    const prevBtn = document.querySelector('.prev-btn');
    const nextBtn = document.querySelector('.next-btn');
    
    let currentIndex = 0;
    const cardWidth = cards[0].offsetWidth + 30; // Including gap
    
    function updateSlider() {
        const offset = -currentIndex * cardWidth;
        track.style.transform = `translateX(${offset}px)`;
        
        // Update button states
        prevBtn.disabled = currentIndex === 0;
        nextBtn.disabled = currentIndex >= cards.length - getVisibleCards();
        
        prevBtn.style.opacity = prevBtn.disabled ? '0.5' : '1';
        nextBtn.style.opacity = nextBtn.disabled ? '0.5' : '1';
    }
    
    function getVisibleCards() {
        return window.innerWidth > 1200 ? 3 : window.innerWidth > 768 ? 2 : 1;
    }
    
    prevBtn.addEventListener('click', () => {
        if (currentIndex > 0) {
            currentIndex--;
            updateSlider();
        }
    });
    
    nextBtn.addEventListener('click', () => {
        if (currentIndex < cards.length - getVisibleCards()) {
            currentIndex++;
            updateSlider();
        }
    });
    
    // Initialize slider
    updateSlider();
    
    // Update on window resize
    window.addEventListener('resize', () => {
        currentIndex = 0;
        updateSlider();
    });
});
</script>