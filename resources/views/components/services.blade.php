@php
use App\Models\Service;
$services = Service::where('active', true)->orderBy('order')->take(8)->get();
@endphp

<section id="services" class="services">
    <div class="section-header">
        <h2 style="color:white">Our Security Services</h2>
        <p style="color:white">Comprehensive security solutions tailored to your needs</p>
    </div>
    <div class="services-grid">
        @foreach($services as $service)
        <div class="service-card">
            @if($service->thumbnail)
                <a href="{{ route('services.show', $service->slug) }}" >
                    <img src="{{ asset('storage/' . $service->thumbnail) }}" alt="{{ $service->title }}">
                </a>
            @endif
            <i class="fas fa-shield-alt"></i>
            <a href="{{ route('services.show', $service->slug) }}">
                <h3 style="height: 50px;">{{ $service->title }}</h3>
            </a>
            <p>{{ $service->banner_title }}</p>
            
        </div>
        @endforeach
    </div>
</section>