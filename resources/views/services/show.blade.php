@extends('layouts.app')

@section('title', $service->title . ' | Ready 24h Security')
@section('meta_description', $service->meta_description ?? Str::limit(strip_tags($service->description), 160))

@section('content')
<link rel="stylesheet" href="/css/area-detail.css">

<!-- Banner Section -->
<div>
    <div class="service-area-banner">
        <img src="{{ asset('storage/' . $service->banner) }}" alt="{{ $service->title }} Banner" class="service-area-banner-img">
        <div class="service-area-banner-title">
            {{ $service->banner_title ?? $service->title }}
        </div>
    </div>
</div>

<!-- Description Section -->
<div class="service-area-desc-container">
    <div class="service-area-desc-header">Why Choose Ready 24h Security in {{ $service->title }}?</div>
    <div class="service-area-desc-html">
        {!! $service->description !!}
    </div>
</div>

<div class="service-area-desc-container">
    <div class="service-area-features">
        <div class="service-area-feature">
            <div class="icon"><i class="fas fa-user-shield"></i></div>
            <div class="title">Licensed & Insured</div>
            <div class="desc">All guards are fully licensed, trained, and background-checked.</div>
        </div>
        <div class="service-area-feature">
            <div class="icon"><i class="fas fa-clock"></i></div>
            <div class="title">Rapid Response</div>
            <div class="desc">24/7 dispatch and fast on-site response for emergencies.</div>
        </div>
        <div class="service-area-feature">
            <div class="icon"><i class="fas fa-star"></i></div>
            <div class="title">Trusted Reputation</div>
            <div class="desc">Hundreds of satisfied clients across California.</div>
        </div>
    </div>
    <div class="service-area-cta">
        <a href="/contact" class="area-detail-btn" style="font-size:1.2rem; padding: 18px 40px;">Get Started Today</a>
    </div>
</div>

<div class="service-area-faq-container">
    <div class="service-area-faq-header">Frequently Asked Questions</div>
    <div class="service-area-faq-list">
        <div class="faq-item">
            <button class="faq-question" onclick="toggleFaq(this)">What types of {{ $service->title }} services do you offer?</button>
            <div class="faq-answer">We provide comprehensive {{ $service->title }} solutions tailored to your specific needs, including both short-term and long-term security arrangements.</div>
        </div>
        <div class="faq-item">
            <button class="faq-question" onclick="toggleFaq(this)">Are your security guards licensed and insured?</button>
            <div class="faq-answer">Yes, all our guards are fully licensed, insured, and undergo thorough background checks and training.</div>
        </div>
        <div class="faq-item">
            <button class="faq-question" onclick="toggleFaq(this)">How quickly can you deploy security personnel?</button>
            <div class="faq-answer">We offer rapid response and can often deploy guards within hours, depending on your location and requirements.</div>
        </div>
        <div class="faq-item">
            <button class="faq-question" onclick="toggleFaq(this)">Can I get a custom security plan for my business or event?</button>
            <div class="faq-answer">Absolutely! We work with you to assess your needs and create a tailored security solution for your property or event.</div>
        </div>
    </div>
</div>

<script>
function toggleFaq(btn) {
    var answer = btn.nextElementSibling;
    var open = btn.classList.contains('open');
    document.querySelectorAll('.faq-question').forEach(q => q.classList.remove('open'));
    document.querySelectorAll('.faq-answer').forEach(a => a.style.maxHeight = null);
    if (!open) {
        btn.classList.add('open');
        answer.style.maxHeight = answer.scrollHeight + 'px';
    }
}
</script>

<style>
.service-area-banner {
    position: relative;
    width: 100vw;
    left: 50%;
    right: 50%;
    margin-left: -50vw;
    margin-right: -50vw;
    max-width: 100vw;
    overflow: hidden;
    height: 450px;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 2rem 0rem;
}
.service-area-banner-img {
    width: 100vw;
    height: 450px;
    object-fit: fill;
    object-position: center;
    display: block;
    filter: brightness(0.7);
}
.service-area-banner-title {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    color: #fff;
    font-size: 2.2rem;
    font-weight: 700;
    text-shadow: 0 4px 24px rgba(0,0,0,0.35), 0 1px 2px rgba(0,0,0,0.25);
    text-align: center;
    padding: 0 2rem;
    letter-spacing: 1px;
}
.service-area-desc-container {
    width: 70%;
    margin: 40px auto;
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 2px 16px rgba(0,0,0,0.07);
    padding: 40px 32px;
}
.service-area-desc-header {
    font-size: 1.5rem;
    color: #b91c1c;
    font-weight: 700;
    margin-bottom: 18px;
    text-align: center;
}
.service-area-desc-html {
    line-height: 1.85;
    color: #23272b;
}
.service-area-features {
    display: flex;
    flex-wrap: wrap;
    gap: 24px;
    margin-top: 20px;
    margin-bottom: 40px;
    justify-content: center;
}
.service-area-feature {
    background: #fff5f5;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(185,28,28,0.07);
    flex: 1 1 220px;
    min-width: 200px;
    max-width: 260px;
    padding: 28px 18px;
    text-align: center;
    margin: 0 8px;
}
.service-area-feature .icon {
    font-size: 2rem;
    color: #b91c1c;
    margin-bottom: 1rem;
}
.service-area-feature .title {
    font-size: 1.1rem;
    font-weight: 600;
    color: #1a1a1a;
    margin-bottom: 0.5rem;
}
.service-area-feature .desc {
    font-size: 0.9rem;
    color: #4a5568;
    line-height: 1.5;
}
.service-area-cta {
    text-align: center;
    margin-top: 2rem;
}
.area-detail-btn {
    display: inline-block;
    background: #b91c1c;
    color: #fff;
    padding: 1rem 2rem;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
}
.area-detail-btn:hover {
    background: #991b1b;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(185,28,28,0.2);
}
.service-area-faq-container {
    width: 70%;
    margin: 40px auto;
    padding: 40px 32px;
}
.service-area-faq-header {
    font-size: 1.5rem;
    color: #b91c1c;
    font-weight: 700;
    margin-bottom: 18px;
    text-align: center;
}
.service-area-faq-list {
    margin-top: 18px;
}
.faq-item {
    margin-bottom: 18px;
}
.faq-question {
    background: #f3f4f6;
    border: none;
    outline: none;
    width: 100%;
    text-align: left;
    font-size: 1.1rem;
    font-weight: 600;
    color: #b91c1c;
    padding: 14px 18px;
    border-radius: 8px;
    cursor: pointer;
    transition: background 0.2s;
}
.faq-question.open, .faq-question:hover {
    background: #fee2e2;
}
.faq-answer {
    max-height: 0;
    overflow: hidden;
    background: #fff5f5;
    border-radius: 0 0 8px 8px;
    padding: 0 18px;
    color: #23272b;
    font-size: 1rem;
    line-height: 1.7;
    transition: max-height 0.3s ease;
}
.faq-question.open + .faq-answer {
    padding: 18px;
    max-height: 300px;
}
</style>
@endsection
