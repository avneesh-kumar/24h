@extends('layouts.app')

@section('title', $industry->title . ' | Ready 24h Security')
@section('meta_description', Str::limit(strip_tags($industry->description), 160))

@section('content')
<link rel="stylesheet" href="/css/area-detail.css">

<!-- Industry Title and Description -->
<div class="industry-header-section">
    <h1 class="industry-title">
        {{ $industry->title }}
    </h1>
    @if($industry->description)
        <div class="industry-description">{!! $industry->description !!}</div>
    @endif
</div>

<!-- Services List Section -->
@if($services->count())
<div class="services-section">
    <div class="services-section-header">
        <h2>Security Services</h2>
        <p>Explore our full range of security services. Click any service to learn more.</p>
    </div>
    <div class="services-list-grid">
        @foreach($services as $service)
        <a href="{{ route('services.show', $service->slug) }}" class="service-card service-link">
            @if($service->thumbnail)
                <img src="{{ asset('storage/' . $service->thumbnail) }}" alt="{{ $service->title }}" class="service-thumb">
            @endif
            <h3>{{ $service->title }}</h3>
            <p>{!! Str::limit(strip_tags($service->description), 100) !!}</p>
            <span class="service-learn-more">Learn More &rarr;</span>
        </a>
        @endforeach
    </div>
</div>
@else
<div class="services-section">
    <div class="services-section-header">
        <h2>All Security Services</h2>
        <p>No services are currently listed. Please check back soon or contact us for more information.</p>
    </div>
</div>
@endif

<style>
.industry-header-section {
    width: 70%;
    margin: 48px auto 32px auto;
    text-align: center;
}
.industry-title {
    font-size: 2.5rem;
    color: #b91c1c;
    font-weight: 800;
    margin-bottom: 18px;
    letter-spacing: 0.01em;
}
.industry-description {
    background: #f9fafb;
    /* border-left: 4px solid #b91c1c; */
    padding: 22px 28px;
    border-radius: 10px;
    font-size: 1.13rem;
    color: #23272b;
    line-height: 1.85;
    box-shadow: 0 2px 12px rgba(185,28,28,0.04);
    margin: 0 auto 18px auto;
    font-family: 'Segoe UI', 'Roboto', 'Arial', sans-serif;
    letter-spacing: 0.01em;
}
.industry-description p {
    margin-bottom: 0.7em;
}
.industry-description strong {
    color: #991b1b;
}
.industry-description ul, .industry-description ol {
    margin-left: 1.5em;
    margin-bottom: 0.7em;
}
.services-section {
    background: #f8f9fa;
    border-radius: 18px;
    box-shadow: 0 2px 16px rgba(0,0,0,0.04);
    margin: 48px auto 48px auto;
    padding: 48px 32px 32px 32px;
    width: 100%;
    max-width: 1200px;
}
.services-section-header {
    text-align: center;
    margin-bottom: 36px;
}
.services-section-header h2 {
    font-size: 2rem;
    color: #b91c1c;
    margin-bottom: 10px;
}
.services-section-header p {
    color: #444;
    font-size: 1.1rem;
}
.services-list-grid {
    display: flex;
    flex-wrap: wrap;
    gap: 36px;
    justify-content: center;
    margin-top: 0;
}
.service-card.service-link {
    background: #fff;
    border-radius: 14px;
    box-shadow: 0 2px 12px rgba(185,28,28,0.07);
    flex: 1 1 280px;
    min-width: 240px;
    max-width: 340px;
    padding: 32px 22px 22px 22px;
    text-align: center;
    margin: 0 8px;
    display: flex;
    flex-direction: column;
    align-items: center;
    text-decoration: none;
    color: inherit;
    transition: box-shadow 0.2s, transform 0.2s;
    border: 1px solid #f3f4f6;
    position: relative;
}
.service-card.service-link:hover {
    box-shadow: 0 8px 24px rgba(185,28,28,0.13);
    transform: translateY(-4px) scale(1.03);
    border-color: #fee2e2;
}
.service-card.service-link h3 {
    font-size: 1.25rem;
    color: #b91c1c;
    font-weight: 700;
    margin-bottom: 12px;
}
.service-card.service-link p {
    color: #444;
    font-size: 1rem;
    margin-bottom: 18px;
}
.service-thumb {
    width: 100%;
    max-width: 140px;
    height: 90px;
    object-fit: cover;
    border-radius: 8px;
    margin-bottom: 1.2rem;
    box-shadow: 0 2px 8px rgba(185,28,28,0.07);
}
.service-learn-more {
    color: #991b1b;
    font-weight: 600;
    font-size: 1.05rem;
    margin-top: auto;
    letter-spacing: 0.01em;
    transition: color 0.2s;
}
.service-card.service-link:hover .service-learn-more {
    color: #b91c1c;
    text-decoration: underline;
}
@media (max-width: 900px) {
    .industry-header-section, .services-section {
        width: 98%;
        padding: 24px 8px 16px 8px;
    }
    .services-list-grid {
        gap: 18px;
    }
}
</style>
@endsection 