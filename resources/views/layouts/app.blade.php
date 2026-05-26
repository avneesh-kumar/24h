<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', $seo_meta_title)</title>
    <meta name="description" content="@yield('meta_description', $seo_meta_description)">

    @if($seo_meta_keywords)
        <meta name="keywords" content="@yield('meta_keywords', $seo_meta_keywords)">
    @endif

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

    {{-- Structured Data: @verbatim prevents @context from being parsed as a Blade directive --}}
    @verbatim
    <script type="application/ld+json">
    {
    "@context": "https://schema.org",
    "@type": "LocalBusiness",
    "name": "READY 24h Security Inc.",
    "image": "https://r24hs.com/logo.png",
    "@id": "",
    "url": "https://r24hs.com/",
    "telephone": "800-613-5903",
    "address": {
    "@type": "PostalAddress",
    "streetAddress": "23241 Ventura Blvd., Suite 219 Woodland Hills",
    "addressLocality": "California, Los Angeles, Orange County, Riverside County, San Diego County, Ventura County",
    "postalCode": "91364",
    "addressCountry": "US"
    },
    "geo": {
    "@type": "GeoCoordinates",
    "latitude": 34.16222570000001,
    "longitude": -118.6322503
    }
    }
    </script>

    <script type="application/ld+json">
    {
    "@context": "https://schema.org/",
    "@type": "WebSite",
    "name": "READY 24h Security Inc.",
    "url": "https://r24hs.com/",
    "potentialAction": {
    "@type": "SearchAction",
    "target": "https://r24hs.com/?s={search_term_string}",
    "query-input": "required name=search_term_string"
    }
    }
    </script>

    <script type="application/ld+json">
    {
    "@context": "https://schema.org",
    "@type": "Organization",
    "name": "READY 24h Security Inc.",
    "alternateName": "READY 24h Security Inc.",
    "url": "https://r24hs.com/",
    "logo": "https://r24hs.com/logo.png"
    }
    </script>
    @endverbatim

    <link rel="alternate" hreflang="en-US" href="https://r24hs.com/" />

    <script async src="https://www.googletagmanager.com/gtag/js?id=G-K3JCGC63K6"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date());

        gtag('config', 'G-K3JCGC63K6');
    </script>


    <meta name="google-site-verification" content="YWs5NXhjfXaWQft-1SJ8-rQckJ8HPB2Ryrf4YTQWqEk" />

    <script type="text/javascript">
        (function (c, l, a, r, i, t, y) {
            c[a] = c[a] || function () { (c[a].q = c[a].q || []).push(arguments) };
            t = l.createElement(r); t.async = 1; t.src = "https://www.clarity.ms/tag/" + i;
            y = l.getElementsByTagName(r)[0]; y.parentNode.insertBefore(t, y);
        })(window, document, "clarity", "script", "sq230eue6x");
    </script>


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
    {{-- Primary/Secondary color as CSS vars --}}
    <style>
        :root {
            --primary-color:
                {{ $branding_primary_color ?? '#ff0000' }}
            ;
            --secondary-color:
                {{ $branding_secondary_color ?? '#000000' }}
            ;
        }

        .toast-container {
            position: fixed;
            bottom: 1rem;
            right: 1rem;
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
            z-index: 99999;
            pointer-events: none;
        }

        .toast {
            min-width: 280px;
            max-width: 360px;
            padding: 1rem 1.25rem;
            border-radius: 0.75rem;
            background: rgba(15, 23, 42, 0.95);
            color: #fff;
            box-shadow: 0 14px 40px rgba(0, 0, 0, 0.18);
            opacity: 0;
            transform: translateY(12px);
            transition: opacity 0.25s ease, transform 0.25s ease;
            pointer-events: auto;
            font-size: 0.95rem;
            line-height: 1.4;
        }

        .toast.show {
            opacity: 1;
            transform: translateY(0);
        }

        .toast.success {
            border-left: 4px solid #22c55e;
        }

        .toast.error {
            border-left: 4px solid #ef4444;
        }
    </style>
    {{-- Preload Critical Resources --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- Analytics/Pixel/Custom Scripts --}}
    @if($integration_google_analytics_id)
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ $integration_google_analytics_id }}"></script>
        <script>window.dataLayer = window.dataLayer || []; function gtag() { dataLayer.push(arguments); } gtag('js', new Date()); gtag('config', '{{ $integration_google_analytics_id }}');</script>
    @endif
    @if($integration_facebook_pixel_id)
        <script>
            /*! Facebook Pixel Code */
            !function (f, b, e, v, n, t, s) { if (f.fbq) return; n = f.fbq = function () { n.callMethod ? n.callMethod.apply(n, arguments) : n.queue.push(arguments) }; if (!f._fbq) f._fbq = n; n.push = n; n.loaded = !0; n.version = '2.0'; n.queue = []; t = b.createElement(e); t.async = !0; t.src = v; s = b.getElementsByTagName(e)[0]; s.parentNode.insertBefore(t, s) }(window, document, 'script', 'https://connect.facebook.net/en_US/fbevents.js'); fbq('init', '{{ $integration_facebook_pixel_id }}'); fbq('track', 'PageView');
        </script>
        <noscript><img height="1" width="1" style="display:none"
                src="https://www.facebook.com/tr?id={{ $integration_facebook_pixel_id }}&ev=PageView&noscript=1" /></noscript>
    @endif
    @if(!empty($advanced_custom_css))
        <style>
            {!! $advanced_custom_css !!}
        </style>
    @endif
    {!! $advanced_custom_head_html ?? '' !!}
    @stack('schema')

</head>

<body>
    <div class="header-container">
        @include('layouts.header')
    </div>

    @yield('content')

    @include('layouts.footer')

    <!-- check cookie exists -->
    @if(!isset($_COOKIE['cookie_consent']))
        <div id="cookie-consent"
            style="position:fixed;bottom:0;left:0;width:100%;background:#222;color:#fff;padding:1rem;z-index:9999;text-align:center;">
            This website uses cookies to ensure you get the best experience. <a href="{{ $legal_privacy_policy_url }}"
                style="color:#ff0000;">Learn more</a>.
            <button id="cookie-consent-button"
                style="margin-left:1rem;padding:0.5rem 1rem;background:#ff0000;color:#fff;border:none;border-radius:4px; cursor:pointer;">Accept</button>
        </div>

        <script>
            document.getElementById('cookie-consent-button').addEventListener('click', function () {
                document.getElementById('cookie-consent').style.display = 'none';
                document.cookie = "cookie_consent=true; path=/; max-age=" + (60 * 60 * 24 * 365);
                document.getElementById('cookie-consent').style.display = 'none';

            });
        </script>
    @endif

    <div id="toast-container" class="toast-container"></div>
    <script>
        function showToast(message, type = 'success', duration = 5000) {
            if (!message) return;
            const container = document.getElementById('toast-container');
            if (!container) return;

            const toast = document.createElement('div');
            toast.className = `toast ${type}`;
            toast.textContent = message;
            container.appendChild(toast);

            requestAnimationFrame(() => toast.classList.add('show'));

            setTimeout(() => {
                toast.classList.remove('show');
                toast.addEventListener('transitionend', () => toast.remove(), { once: true });
            }, duration);
        }

        document.addEventListener('DOMContentLoaded', function () {
            const message = @json(session('status'));
            const error = @json(session('error'));

            if (message) {
                showToast(message, 'success');
            }
            if (error) {
                showToast(error, 'error');
            }
        });
    </script>

    {!! $advanced_custom_body_end_html ?? '' !!}
</body>

</html>