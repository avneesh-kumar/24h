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
        <p>Ready 24h Security is a team, with every person in the company a player who is expected and needed to perform to their fullest capacity. Ready 24h Security's objective is to make a fair profit and achieve sales and budgeting goals while, at the same time, remaining committed to quality security service and strengthening the connection between its employees and clients.</p>
    </section>
    <section class="about-section">
        <h2>Who We Are</h2>
        <p>Ready 24h Security Services is a local security contract company in Los Angeles, CA. Our corporate headquarters is within the LA area, allowing our owner and top-level managers to be immediately available to address concerns and resolve problems as they occur. We are innovative and aggressive in our attempts to obtain the goals we have defined and are always seeking further knowledge and challenges, making us one of the best <b>security guard companies in Los Angeles</b>.</p>
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