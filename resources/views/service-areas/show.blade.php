@extends('layouts.app')

@section('title', $serviceArea->title . ' Security Services | Ready 24h Security')
@section('meta_description', $serviceArea->meta_description ?? Str::limit(strip_tags($serviceArea->description), 160))

@section('content')
<link rel="stylesheet" href="/css/area-detail.css">

<!-- Banner Section -->
<div>
    <div class="service-area-banner">
    <img src="{{ asset('storage/' . $serviceArea->banner) }}" alt="{{ $serviceArea->title }} Security Banner" class="service-area-banner-img">
    <div class="service-area-banner-title">
        {{ $serviceArea->banner_title ?? $serviceArea->title }}
    </div>
</div>

<!-- Description Section (centered, max-width like home page) -->
<div class="service-area-desc-container">
    <div class="service-area-desc-header">Why Choose Ready 24h Security in {{ $serviceArea->title }}?</div>
    <div class="service-area-desc-html">
        {!! $serviceArea->description !!}
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
</div>

<div class="service-area-faq-container">
    <div class="service-area-faq-header">Frequently Asked Questions</div>
    <div class="service-area-faq-list">
        <div class="faq-item">
            <button class="faq-question" onclick="toggleFaq(this)">What types of security services do you offer in {{ $serviceArea->title }}?</button>
            <div class="faq-answer">We provide armed and unarmed guards, mobile patrol, event security, commercial and residential protection, and custom security plans tailored to your needs.</div>
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
    /* margin-top: 120px; */
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
    /* font-family: 'Georgia', 'Times New Roman', Times, serif;
    color: #23272b;
    font-size: 1rem;
    line-height: 1.85;
    letter-spacing: 0.01em;
    font-weight: 400;
    margin-bottom: 0;
    padding: 0; */
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
    font-size: 2.5rem;
    color: #b91c1c;
    margin-bottom: 10px;
}
.service-area-feature .title {
    font-weight: 600;
    font-size: 1.1rem;
    margin-bottom: 6px;
    color: #b91c1c;
}
.service-area-feature .desc {
    color: #444;
    font-size: 1rem;
}
.service-area-cta {
    text-align: center;
    margin-top: 32px;
}
.area-detail-btn {
    background: #b91c1c;
    color: #fff;
    padding: 12px 24px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 500;
    transition: background 0.3s;
}
.area-detail-btn:hover {
    background: #a11d1d;
}
.service-area-faq-container {
    width: 70%;
    margin: 40px auto 60px auto;
    background: #f8f9fa;
    border-radius: 16px;
    box-shadow: 0 2px 16px rgba(0,0,0,0.07);
    padding: 40px 32px;
}
.service-area-faq-header {
    font-size: 1.5rem;
    color: #23272b;
    font-weight: 700;
    margin-bottom: 24px;
    text-align: center;
    letter-spacing: 0.01em;
}
.service-area-faq-list {
    display: flex;
    flex-direction: column;
    gap: 18px;
}
.faq-item {
    border-bottom: 1px solid #e0e0e0;
    padding-bottom: 10px;
    background: #fff;
    border-radius: 8px;
    margin-bottom: 6px;
    box-shadow: 0 1px 4px rgba(0,0,0,0.03);
}
.faq-question {
    background: none;
    border: none;
    color: #23272b;
    font-size: 1.13rem;
    font-weight: 600;
    width: 100%;
    text-align: left;
    padding: 0.7rem 0;
    cursor: pointer;
    outline: none;
    transition: color 0.2s, border-left 0.2s;
    position: relative;
    border-left: 4px solid transparent;
}
.faq-question.open {
    border-left: 4px solid #b91c1c;
    background: #f9f6f6;
}
.faq-question::after {
    content: '\25BC';
    float: right;
    transition: transform 0.3s, color 0.2s;
    color: #888;
}
.faq-question.open::after {
    transform: rotate(180deg);
    color: #b91c1c;
}
.faq-answer {
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.3s ease;
    color: #23272b;
    font-size: 1.05rem;
    line-height: 1.7;
    background: #f6f6f6;
    border-radius: 0 0 8px 8px;
    margin-top: 0;
    padding: 0 0.5rem;
}
.faq-question.open + .faq-answer {
    margin-top: 8px;
    padding: 0.7rem 0.5rem 1rem 0.5rem;
    border-left: 4px solid #b91c1c;
}
@media (max-width: 900px) {
    .service-area-desc-container {
        padding: 20px 10px;
    }
    .service-area-features {
        flex-direction: column;
        gap: 16px;
    }
    .service-area-feature {
        max-width: 100%;
        margin: 0 0 12px 0;
    }
    .service-area-faq-container {
        padding: 20px 10px;
    }
}
@media (max-width: 700px) {
    .service-area-banner, .service-area-banner_img {
        height: 180px;
    }
    .service-area-banner-title {
        font-size: 1.2rem;
        padding: 0 0.5rem;
    }
}
</style>
@endsection
