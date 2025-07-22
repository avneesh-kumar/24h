@extends('layouts.app')

@section('title', 'Our Security Services')

@section('meta_description', 'Explore our comprehensive security services tailored to your needs. From event security to mobile patrols, we have you covered.')

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
                    <a href="{{ route('services.show', $service->slug) }}" >
                        <img src="{{ asset('storage/' . $service->thumbnail) }}" alt="{{ $service->title }}">
                    </a>
                @endif
                <i class="fas fa-shield-alt"></i>
                <a href="{{ route('services.show', $service->slug) }}" style="text-decoration: none;">
                    <h3 style="height: 50px;">{{ $service->title }}</h3>
                </a>
                <p>{{ $service->banner_title }}</p>
            </div>
            @endforeach
        </div>

        <div class="pagination">
            {{ $services->links() }}
        </div>
    </div>
@endsection 