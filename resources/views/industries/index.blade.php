@extends('layouts.app')

@section('content')
@if($industries->isNotEmpty())
<section class="industries-section">
    <div class="container">
        <div class="section-header">
            <h1>Industries We Serve</h1>
            <p>Comprehensive security solutions tailored for various sectors</p>
        </div>
        <div class="industries-grid">
            @foreach($industries as $industry)
            <a href="{{ route('industries.show', $industry->slug) }}" class="industry-card industry-link">
                <div class="icon">
                    <i class="{{ $industry->icon }}"></i>
                </div>
                <h3>{{ $industry->title }}</h3>
            </a>
            @endforeach
        </div>
    </div>
</section>

<style>
    .industries-section {
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

    .section-header h1 {
        font-size: 2.5rem;
        color: #1a1a1a;
        margin-bottom: 15px;
    }

    .section-header p {
        font-size: 1.1rem;
        color: #666;
    }

    .industries-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 30px;
    }

    .industry-card {
        background: #fff;
        padding: 30px;
        border-radius: 10px;
        text-align: center;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .industry-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
    }

    .industry-card .icon {
        width: 70px;
        height: 70px;
        margin: 0 auto 20px;
        background: #f8f9fa;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .industry-card .icon i {
        font-size: 30px;
        color: #dc2626;
    }

    .industry-card h3 {
        font-size: 1.25rem;
        color: #1a1a1a;
        margin-bottom: 15px;
    }

    .industry-card p {
        font-size: 0.95rem;
        color: #666;
        line-height: 1.6;
    }

    @media (max-width: 1200px) {
        .industries-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    @media (max-width: 992px) {
        .industries-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 576px) {
        .industries-grid {
            grid-template-columns: 1fr;
        }
        
        .section-header h2 {
            font-size: 2rem;
        }
    }

    .industry-link {
        text-decoration: none;
        color: inherit;
        display: block;
    }
    .industry-link:hover h3 {
        color: #dc2626;
    }
</style>
@endif
@endsection 