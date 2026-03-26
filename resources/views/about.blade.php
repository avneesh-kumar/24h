@extends('layouts.app')

@section('title', 'About Us | ' . config('app.name'))
@section('meta_description', 'Learn more about Ready 24h Security, our mission, values, and team.')

@section('content')
<div class="about-banner">
    <div class="about-banner-title">About Us</div>
</div>
<div class="about-main">
    <section class="about-section">
        <h2>Our Mission</h2>
        <p>At Ready 24h Security, our mission is to provide top-tier security solutions that ensure the safety and peace of mind of our clients. With over 50 years of experience, we are committed to excellence, integrity, and rapid response.</p>
    </section>
    <section class="about-section">
        <h2>Who We Are</h2>
        <p>We are a team of licensed and insured security professionals serving businesses and individuals across California. Our expert team is available 24/7 to protect what matters most to you.</p>
    </section>
</div>
<style>
.about-banner { background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('https://images.pexels.com/photos/577769/pexels-photo-577769.jpeg'); background-size: cover; padding: 60px 0; text-align: center; }
.about-banner-title { color: #fff; font-size: 3rem; font-weight: bold; }
.about-main { max-width: 900px; margin: 40px auto; padding: 0 20px; }
.about-section { margin-bottom: 40px; }
.about-section h2 { color: #dc2626; font-size: 2rem; margin-bottom: 10px; }
.about-section p { color: #333; font-size: 1.1rem; }
.about-team-list { list-style: none; padding: 0; }
.about-team-list li { margin-bottom: 10px; font-size: 1.1rem; }
</style>
@endsection 