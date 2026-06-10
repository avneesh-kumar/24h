<header class="header">
    <nav class="navbar">
        <div class="logo">
            <a href="/">
                <img src="{{ $site_logo ? asset('storage/' . $site_logo) : asset('logo.png') }}" alt="READY 24h Security Logo" width="82" height="80">
            </a>
        </div>
        <div class="nav-links" id="main-nav-links">
            <a href="/" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
            <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">About</a>
            <a href="{{ route('services.index') }}" class="{{ request()->routeIs('services.*') ? 'active' : '' }}">Services</a>
            <a href="{{ route('areas.index') }}" class="{{ request()->routeIs('areas.*') ? 'active' : '' }}">Areas</a>
            <a href="{{ route('industries.index') }}" class="{{ request()->routeIs('industries.*') ? 'active' : '' }}">Industries</a>
            <a href="{{ route('blog.index') }}" class="{{ request()->routeIs('blog.*') ? 'active' : '' }}">Blog</a>
            <a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a>
        </div>
        <div class="cta-buttons">
            <button type="button" class="btn btn-primary" style="cursor: pointer;" onclick="openQuoteModal()">Get a Quote</button>
        </div>
        <div class="mobile-menu" id="mobile-menu-toggle">
            <i class="fas fa-bars"></i>
        </div>
    </nav>
    <div id="mobile-nav-panel" class="mobile-nav-panel">
        <button type="button" class="mobile-nav-close" aria-label="Close menu" onclick="toggleMobileNav()"><i class="fas fa-times"></i></button>
        <nav class="mobile-nav-links">
            <a href="/">Home</a>
            <a href="{{ route('about') }}">About</a>
            <a href="{{ route('services.index') }}">Services</a>
            <a href="{{ route('areas.index') }}">Areas</a>
            <a href="{{ route('industries.index') }}">Industries</a>
            <a href="{{ route('blog.index') }}">Blog</a>
            <a href="{{ route('contact') }}">Contact</a>
            <button type="button" class="btn btn-primary w-full mt-4" onclick="openQuoteModal();toggleMobileNav()">Get a Quote</button>
        </nav>
    </div>
</header>
@include('components.quote-form')
