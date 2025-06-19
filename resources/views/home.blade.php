@extends('layouts.app')

@section('title', $seo_meta_title)

@section('content')
    @include('components.hero')
    @include('components.why-us')
    @if($areas->isNotEmpty())
        @include('components.area', $areas)
    @endif
    @if($services->isNotEmpty())
        @include('components.services', $services)
    @endif
    @include('components.industries')
    @include('components.cta')
    @include('components.testimonials')

    <section class="cta-section" style="background: linear-gradient(rgba(0, 0, 0, 0.9), rgba(0, 0, 0, 0.9)), url('https://images.pexels.com/photos/247763/pexels-photo-247763.jpeg');">
        <div class="section-header">
            <h2>Need Immediate Security?</h2>
            <p>Our rapid response team is available 24/7</p>
        </div>
        <div class="cta-buttons">
            <a href="tel:800-613-5903" class="btn btn-secondary">Call Now</a>
            <a href="#contact" class="btn btn-secondary">Request Service</a>
        </div>
    </section>

    @include('components.contact-form')
@endsection 