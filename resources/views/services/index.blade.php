@extends('layouts.app')

@section('content')
<div class="services-page">
    <div class="section-header" style="margin: 80px">
        <h1 style="color: black">Our Security Services</h1>
        <p style="color: black">Comprehensive security solutions tailored to your needs</p>
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

    <div class="pagination">
        {{ $services->links() }}
    </div>
</div>
@endsection 