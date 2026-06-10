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
                            <img
                                src="{{ asset('storage/' . $area->thumbnail) }}"
                                alt="{{ $area->title }}"
                            >

                            <div class="area-title-overlay">
                                <h3>{{ $area->title }}</h3>
                            </div>
                        </div>

                        <div class="flip-card-back">
                            <div class="flip-title">
                                About this Area
                            </div>

                            <div class="flip-desc">
                                {{
                                    $area->about_area
                                    ?: "Most Security Services in {$area->title} are available 24/7, ensuring your safety and peace of mind at all times."
                                }}
                            </div>
                        </div>

                    </div>
                </a>
            @endforeach

            @if($showAll)
                <div class="flip-card-inner">
                    <div class="flip-card-back" style="transform: rotateY(0deg);">
                        <div class="flip-desc">
                            <a href="{{ url('/areas') }}" class="view-all-button">
                                View All Areas
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        @endif
    </div>
</section>
