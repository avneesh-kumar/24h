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
    
    {{-- Structured Data --}}
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "LocalBusiness",
        "name": "READY 24h Security",
        "image": "{{ !empty($branding_favicon) ? asset('storage/' . $branding_favicon) : asset('logo.png') }}",
        "description": @yield('meta_description', $seo_meta_description),
        @if($general->getAddress() && $general->getCity() && $general->getState() && $general->getZipCode())
        "address": {
            "@type": "PostalAddress",
            "streetAddress": "{{ $general->getAddress() }}",
            "addressLocality": "{{ $general->getCity() }}",
            "addressRegion": "{{ $general->getState() }}",
            "postalCode": "{{ $general->getZipCode() }}",
            "addressCountry": "US"
        },
        @endif
        @if($general->getLatitude() && $general->getLongitude())
        "geo": {
            "@type": "GeoCoordinates",
            "latitude": "{{ $general->getLatitude() }}",
            "longitude": "{{ $general->getLongitude() }}"
        },
        @endif
        "url": "{{ url('/') }}",
        "telephone": "888-581-8424",
        "priceRange": "$$",
        "openingHoursSpecification": {
            "@type": "OpeningHoursSpecification",
            "dayOfWeek": [
                "Monday",
                "Tuesday",
                "Wednesday",
                "Thursday",
                "Friday",
                "Saturday",
                "Sunday"
            ],
            "opens": "00:00",
            "closes": "23:59"
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
"target": "https://r24hs.com/services, https://r24hs.com/services/property-management-security-687f9ff9ed441, https://r24hs.com/services/industrial-facilities-security-687f9ff9edeaf, https://r24hs.com/services/event-security-services, https://r24hs.com/services/corporate-security-solutions-687f9ff9ee7b3, https://r24hs.com/services/retail-security-services-687f9ff9eebc2, https://r24hs.com/services/healthcare-facility-security-687f9ff9eefad, https://r24hs.com/services/educational-institution-security-687f9ff9ef393, https://r24hs.com/services/construction-site-security-687f9ff9ef749, https://r24hs.com/services/residential-community-security-687f9ff9efcd1, https://r24hs.com/services/specialized-security-services-687f9ff9f00db, https://r24hs.com/about, https://r24hs.com/contact, https://r24hs.com/industries, https://r24hs.com/areas{search_term_string}",
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

<link rel="alternate" hreflang="en-US" href="https://r24hs.com/"/>

<script async src="https://www.googletagmanager.com/gtag/js?id=G-K3JCGC63K6"></script>
<script>
window.dataLayer = window.dataLayer || [];
function gtag(){dataLayer.push(arguments);}
gtag('js', new Date());

gtag('config', 'G-K3JCGC63K6');
</script>


<meta name="google-site-verification" content="YWs5NXhjfXaWQft-1SJ8-rQckJ8HPB2Ryrf4YTQWqEk" />

<script type="text/javascript">
(function(c,l,a,r,i,t,y){
c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
})(window, document, "clarity", "script", "sq230eue6x");
</script>


<meta name="DC.title" content="READY 24h Security Inc." />
<meta name="geo.region" content="US-CA" />
<meta name="geo.placename" content="Los Angeles" />
<meta name="geo.position" content="34.168436;-118.605838" />
<meta name="ICBM" content="34.168436, -118.605838" />


    
    {!! $seo_meta_tags !!}
    
    {{-- Favicon from settings --}}
    @if(!empty($branding_favicon))
        <link rel="icon" type="image/png" href="{{ asset('storage/' . $branding_favicon) }}" />
    @else
        <link rel="icon" type="image/png" href="{{ asset('favicon.ico') }}" />
    @endif
    
    {{-- Primary/Secondary color as CSS vars --}}
    <style>
        :root {
            --primary-color: {{ $branding_primary_color ?? '#ff0000' }};
            --secondary-color: {{ $branding_secondary_color ?? '#000000' }};
        }
    </style>
    
    {{-- Preload Critical Resources --}}
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" as="style">
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" as="style">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    {{-- Analytics/Pixel/Custom Scripts --}}
    @if($integration_google_analytics_id)
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ $integration_google_analytics_id }}"></script>
        <script>window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag('js', new Date()); gtag('config', '{{ $integration_google_analytics_id }}');</script>
    @endif
    
    @if($integration_facebook_pixel_id)
        <script>
        /*! Facebook Pixel Code */
        !function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,document,'script','https://connect.facebook.net/en_US/fbevents.js');fbq('init', '{{ $integration_facebook_pixel_id }}');fbq('track', 'PageView');
        </script>
        <noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id={{ $integration_facebook_pixel_id }}&ev=PageView&noscript=1"/></noscript>
    @endif
    
    {!! $advanced_custom_head_html ?? '' !!}

</head>
<body>
    <div class="header-container">
        @include('layouts.header')
    </div>
    
    @yield('content')

    @include('layouts.footer')

    <!-- check cookie exists -->
    @if(!isset($_COOKIE['cookie_consent']))
        <div id="cookie-consent" style="position:fixed;bottom:0;left:0;width:100%;background:#222;color:#fff;padding:1rem;z-index:9999;text-align:center;">
            This website uses cookies to ensure you get the best experience. <a href="{{ $legal_privacy_policy_url }}" style="color:#ff0000;">Learn more</a>.
            <button id="cookie-consent-button" style="margin-left:1rem;padding:0.5rem 1rem;background:#ff0000;color:#fff;border:none;border-radius:4px; cursor:pointer;">Accept</button>
        </div>

        <script>
            document.getElementById('cookie-consent-button').addEventListener('click', function() {
                document.getElementById('cookie-consent').style.display = 'none';
                document.cookie = "cookie_consent=true; path=/; max-age=" + (60 * 60 * 24 * 365);
                document.getElementById('cookie-consent').style.display = 'none';

            });
        </script>
    @endif
    
    {!! $advanced_custom_body_end_html ?? '' !!}
</body>
</html>