<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', $seo_meta_title)</title>
    <meta name="description" content="@yield('meta_description', $seo_meta_description)">

    {{-- @if($seo_meta_keywords) --}}
        <meta name="keywords" content="@yield('meta_keywords', $seo_meta_keywords)">
    {{-- @endif --}}

    {{-- Open Graph Tags --}}
    <meta property="og:title" content="@yield('title', $seo_meta_title)">
    <meta property="og:description" content="@yield('meta_description', $seo_meta_description)">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    @if(!empty($branding_favicon))
        <meta property="og:image" content="{{ asset('storage/' . $branding_favicon) }}">
    @endif

    {{-- Twitter Card Tags --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', $seo_meta_title)">
    <meta name="twitter:description" content="{{ $seo_meta_description }}">
    @if(!empty($branding_favicon))
        <meta name="twitter:image" content="{{ asset('storage/' . $branding_favicon) }}">
    @endif

    @if($seo_canonical_url_mode === 'auto')
        <link rel="canonical" href="@yield('canonical_url', url()->current())">
    @endif

    {{-- Structured Data --}}
    <script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@@type": "LocalBusiness",
        "name": "READY 24h Security Inc.",
        "image": "https://r24hs.com/logo.png",
        "url": "https://r24hs.com/",
        "logo": "https://r24hs.com/logo.png",
        "telephone": "800-613-5903",
        "address": {
            "@@type": "PostalAddress",
            "streetAddress": "23241 Ventura Blvd., Suite 219 Woodland Hills",
            "addressLocality": "California, Los Angeles, Orange County, Riverside County, San Diego County, Ventura County",
            "postalCode": "91364",
            "addressCountry": "US"
        },
        "geo": {
            "@@type": "GeoCoordinates",
            "latitude": 34.16222570000001,
            "longitude": -118.6322503
        }
    }
    </script>

    <link rel="alternate" hreflang="en-US" href="https://r24hs.com/"/>

    <meta name="google-site-verification" content="YWs5NXhjfXaWQft-1SJ8-rQckJ8HPB2Ryrf4YTQWqEk" />
    <meta name="DC.title" content="READY 24h Security Inc." />

    @hasSection('geotags')
        @yield('geotags')
    @else
        <meta name="geo.region" content="US-CA" />
        <meta name="geo.placename" content="Los Angeles" />
        <meta name="geo.position" content="34.168436;-118.605838" />
        <meta name="ICBM" content="34.168436, -118.605838" />
    @endif

    {!! $seo_meta_tags !!}

    {{-- Favicon from settings --}}
    @if(!empty($branding_favicon))
        <link rel="icon" type="image/png" href="{{ asset('storage/' . $branding_favicon) }}" />
    @else
        <link rel="icon" type="image/png" href="{{ asset('logo.png') }}" />
    @endif

    <style>
        :root {
            --primary-color: {{ $branding_primary_color ?? '#ff0000' }};
            --secondary-color: {{ $branding_secondary_color ?? '#000000' }};
        }
    </style>

    @vite('resources/css/app.css')

    @if(!empty($advanced_custom_css))
        <style>{!! $advanced_custom_css !!}</style>
    @endif
    {!! $advanced_custom_head_html ?? '' !!}
    @stack('schema')

</head>

<body>
    <div class="header-container">
        @include('layouts.header')
    </div>

    <main id="main-content">
        @yield('content')
    </main>

    @include('layouts.footer')

    @if($legal_cookie_consent_enabled && !isset($_COOKIE['cookie_consent']))
        <div id="cookie-consent" class="cookie-consent">
            This website uses cookies to ensure you get the best experience.
            <a href="{{ $legal_privacy_policy_url }}" class="cookie-consent-link">Learn more</a>.
            <button id="cookie-consent-button" type="button" class="cookie-consent-button">Accept</button>
        </div>
    @endif

    <div id="flash-messages"
        data-status="{{ session('status') }}"
        data-error="{{ session('error') }}"
        hidden></div>

    <div id="toast-container" class="toast-container"></div>

    <script id="analytics-config" type="application/json">
        {!! json_encode([
            'gtmId' => $integration_google_tag_manager_id ?: null,
            'gaId' => $integration_google_tag_manager_id ? null : ($integration_google_analytics_id ?: null),
            'fbPixelId' => $integration_facebook_pixel_id ?: null,
            'clarityId' => $integration_google_tag_manager_id ? null : 'sq230eue6x',
            'consentRequired' => (bool) $legal_cookie_consent_enabled,
            'hasConsent' => isset($_COOKIE['cookie_consent']),
        ]) !!}
    </script>

    @if($integration_facebook_pixel_id)
        <noscript>
            <img height="1" width="1" style="display:none"
                src="https://www.facebook.com/tr?id={{ $integration_facebook_pixel_id }}&ev=PageView&noscript=1" alt="" />
        </noscript>
    @endif

    @vite('resources/js/app.js')

    {!! $advanced_custom_body_end_html ?? '' !!}
</body>

</html>
