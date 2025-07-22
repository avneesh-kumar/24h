<section id="service-areas" class="areas">
    <div class="section-header">
        <h2>Areas We Serve</h2>
        <p>Providing comprehensive security solutions across California</p>
    </div>
    <div class="areas-grid">
        @if($areas->count() > 0)
            @foreach($areas as $area)
                <a href="{{ url('/areas/' . $area->slug) }}" class="area-card">
                    <div class="flip-card-inner">
                        <div class="flip-card-front">
                            <img src="{{ asset('storage/' . $area->thumbnail) }}" alt="{{ $area->title }}">
                            <div class="area-title-overlay">
                                <h3>{{ $area->title }}</h3>
                            </div>
                        </div>
                        <div class="flip-card-back">
                            <div class="flip-title">About this Area</div>
                            <div class="flip-desc">
                                Most Security Services in {{ $area->title }} are available 24/7, ensuring your safety and peace of mind at all times.
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
            @if($showAll)
                <div class="flip-card-inner">
                    <div class="flip-card-back" style="transform: rotateY(0deg);">
                        <div class="flip-desc">
                            <a href="{{ url('/areas') }}" class="view-all-button">View All Areas</a>
                        </div>
                    </div>
                </div>
            @endif
        @endif
    </div>
</section>
<style>
    .areas {
        padding: 60px 0;
        background-color: #f8f9fa;
    }
    .section-header {
        text-align: center;
        margin-bottom: 40px;
    }
    .section-header h2 {
        font-size: 2.5rem;
        color: #343a40;
    }
    .section-header p {
        color: #6c757d;
        font-size: 1.2rem;
    }
    .areas-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 20px;
        padding: 0 20px;
    }
    .area-card {
        perspective: 1000px;
        border-radius: 8px;
        min-height: 320px;
        display: block;
        text-decoration: none;
        background: none;
        border: none;
        overflow: visible;
    }
    .flip-card-inner {
        position: relative;
        width: 100%;
        height: 100%;
        min-height: 320px;
        transition: transform 0.8s cubic-bezier(.4,1.6,.6,1);
        transform-style: preserve-3d;
    }
    .area-card:hover .flip-card-inner,
    .area-card:focus .flip-card-inner {
        transform: rotateY(180deg) scale(1.03);
        box-shadow: 0 8px 32px rgba(185,28,28,0.18);
    }
    .flip-card-front, .flip-card-back {
        position: absolute;
        width: 100%;
        height: 100%;
        backface-visibility: hidden;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }
    .flip-card-front {
        background: #fff;
        z-index: 2;
    }
    .flip-card-front img {
        width: 100%;
        height: auto;
        min-height: 320px;
        display: block;
    }
    .area-title-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        background: rgba(0,0,0,0.6);
        color: #fff;
        padding: 1rem;
        text-align: center;
    }
    .area-title-overlay h3 {
        font-size: 1.2rem;
        font-weight: 600;
        margin: 0;
        color: #fff;
        padding: 0;
    }
    .flip-card-back {
        background: linear-gradient(135deg, #dc2626 0%, #ef4444 60%, #b91c1c 100%);
        color: #fff;
        transform: rotateY(180deg);
        z-index: 3;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        box-shadow: 0 8px 32px rgba(185,28,28,0.18);
        border-bottom-left-radius: 8px;
        border-bottom-right-radius: 8px;
        padding: 2rem 1rem;
        justify-content: center;
    }
    .flip-title {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
        margin-bottom: 40px;
        color: #fff;
        text-align: center;
        border-bottom: 2px solid rgba(255,255,255,1);
    }
    .flip-desc {
        font-size: 1rem;
        text-align: center;
        opacity: 0.92;
    }
    .view-all-button {
        /* background-color: #dc2626; */
        border: 1px solid #dc2626;
        color: #fff;
        padding: 20px 30px;
        border-radius: 5px;
        text-decoration: none;
    }
    @media (max-width: 768px) {
        .section-header h2 {
            font-size: 2rem;
        }
        .section-header p {
            font-size: 1rem;
        }
        .areas-grid {
            padding: 0 10px;
        }
    }
    @media (max-width: 576px) {
        .section-header h2 {
            font-size: 1.5rem;
        }
        .section-header p {
            font-size: 0.9rem;
        }
        .areas-grid {
            grid-template-columns: 1fr;
        }
    }
</style>