@extends('layouts.app')

@section('title', $area->title . ' Security Services | Ready 24h Security')
@section('meta_description', $area->meta_description ?? Str::limit(strip_tags($area->description), 160))

@section('content')
<link rel="stylesheet" href="/css/area-detail.css">

<div class="area-detail-section">
    <div class="area-detail-banner" style="position:relative; width:100vw; left:50%; right:50%; margin-left:-50vw; margin-right:-50vw; max-width:100vw; overflow:hidden; height:450px; display:flex; align-items:center; justify-content:center; padding:2rem 0;">
        <img src="{{ asset('storage/' . $area->banner) }}" alt="{{ $area->title }} Security Banner" class="service-area-banner-img" style="width:100vw; height:450px; object-fit:fill; object-position:center; display:block; filter:brightness(0.7);">
        <div class="area-detail-title" style="position:absolute; top:50%; left:50%; transform:translate(-50%,-50%); color:#fff; font-size:2.2rem; font-weight:700; text-shadow:0 4px 24px rgba(0,0,0,0.35), 0 1px 2px rgba(0,0,0,0.25); text-align:center; padding:0 2rem; letter-spacing:1px;">
            {{ $area->banner_title ?? $area->title }}
        </div>
    </div>

    <div class="area-detail-container">
        <div class="area-detail-box">
            <h2>Why Choose Ready 24h Security in {{ $area->title }}?</h2>
            <div class="area-detail-prose">
                {!! $area->description !!}
            </div>
        </div>

        <div class="area-detail-features">
            <div class="area-detail-feature">
                <div class="icon"><i class="fas fa-user-shield"></i></div>
                <div class="title">Licensed & Insured</div>
                <div class="desc">All guards are fully licensed, trained, and background-checked.</div>
            </div>
            <div class="area-detail-feature">
                <div class="icon"><i class="fas fa-clock"></i></div>
                <div class="title">Rapid Response</div>
                <div class="desc">24/7 dispatch and fast on-site response for emergencies.</div>
            </div>
            <div class="area-detail-feature">
                <div class="icon"><i class="fas fa-star"></i></div>
                <div class="title">Trusted Reputation</div>
                <div class="desc">Hundreds of satisfied clients across California.</div>
            </div>
        </div>
        <div class="area-detail-cta">
            <a href="/contact" class="area-detail-btn" style="font-size:1.2rem; padding: 18px 40px;">Get Started Today</a>
        </div>
    </div>

    <div class="area-detail-container">
        <div class="area-detail-box area-detail-faq-container">
            <h2>Frequently Asked Questions</h2>
            <div class="area-detail-faq-list">
                <div class="faq-item">
                    <button class="faq-question" onclick="toggleFaq(this)">What types of security services do you offer in {{ $area->title }}?</button>
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
@endsection
