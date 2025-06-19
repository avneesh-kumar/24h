<header class="header">
    <nav class="navbar">
        <div class="logo">
            <a href="/">
                <img src="{{ $site_logo ? asset('storage/' . $site_logo) : asset('logo.png') }}" alt="READY 24h Security Logo">
            </a>
        </div>
        <div class="nav-links">
            <a href="/" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
            <a href="{{ route('services.index') }}" class="{{ request()->routeIs('services.*') ? 'active' : '' }}">Services</a>
            <a href="{{ route('areas.index') }}" class="{{ request()->routeIs('areas.*') ? 'active' : '' }}">Areas</a>
            <a href="{{ route('industries.index') }}" class="{{ request()->routeIs('industries.*') ? 'active' : '' }}">Industries</a>
            <a href="#about">About</a>
            <a href="#contact">Contact</a>
        </div>
        <div class="cta-buttons">
            <a href="#contact" class="btn btn-primary">Get a Quote</a>
        </div>
        <div class="mobile-menu">
            <i class="fas fa-bars"></i>
        </div>
    </nav>
</header>