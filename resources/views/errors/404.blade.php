@extends('layouts.app')

@section('title', '404 Not Found')
@section('meta_description', 'Sorry, the page you are looking for cannot be found.')

@section('content')
    <section style="padding:60px 0;background:#f7f7f7;">
        <div style="max-width:1100px;margin:0 auto;padding:0 16px;">
            <div style="background:#fff;border-radius:12px;box-shadow:0 10px 25px rgba(0,0,0,0.08);overflow:hidden;">
                <div style="padding:40px 24px;text-align:center;">
                    <div style="width:88px;height:88px;margin:0 auto 16px;border-radius:50%;background:var(--primary-color, #ff0000);display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700;font-size:28px;">404</div>
                    <h1 style="margin:0 0 8px;font-size:32px;line-height:1.2;color:#111;">Page Not Found</h1>
                    <p style="margin:0 0 24px;color:#555;font-size:16px;">The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.</p>

                    <div style="display:flex;gap:12px;justify-content:center;flex-wrap:wrap;">
                        <a href="{{ url('/') }}" style="display:inline-block;padding:12px 18px;border-radius:8px;background:var(--primary-color, #ff0000);color:#fff;text-decoration:none;font-weight:600;">Go to Homepage</a>
                        <a href="{{ url('/contact') }}" style="display:inline-block;padding:12px 18px;border-radius:8px;border:2px solid var(--primary-color, #ff0000);color:var(--primary-color, #ff0000);text-decoration:none;font-weight:600;">Contact Support</a>
                    </div>
                </div>

                <div style="border-top:1px solid #eee;background:#fafafa;padding:20px 24px;text-align:center;color:#777;font-size:14px;">
                    <span>Looking for something specific? Try the menu above or reach out to us.</span>
                </div>
            </div>
        </div>
    </section>
@endsection



@section('title', __('Not Found'))
@section('code', '404')
@section('message', __('Not Found'))
