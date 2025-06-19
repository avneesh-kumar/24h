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
                <img src="{{ asset('storage/' . $service->thumbnail) }}" alt="{{ $service->title }}">
            @endif
            <i class="fas fa-shield-alt"></i>
            <h3>{{ $service->title }}</h3>
            <p>{{ Str::limit($service->description, 120) }}</p>
            <a href="{{ route('services.show', $service->slug) }}" class="btn btn-outline">Learn More</a>
        </div>
        @endforeach
    </div>
</section>