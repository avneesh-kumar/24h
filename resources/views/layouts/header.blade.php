<header class="header">
    <nav class="navbar">
        <div class="logo">
            <a href="/">
                <img src="{{ $site_logo ? asset('storage/' . $site_logo) : asset('logo.png') }}" alt="READY 24h Security Logo">
            </a>
        </div>
        <div class="nav-links" id="main-nav-links">
            <a href="/" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
            <a href="{{ route('services.index') }}" class="{{ request()->routeIs('services.*') ? 'active' : '' }}">Services</a>
            <a href="{{ route('areas.index') }}" class="{{ request()->routeIs('areas.*') ? 'active' : '' }}">Areas</a>
            <a href="{{ route('industries.index') }}" class="{{ request()->routeIs('industries.*') ? 'active' : '' }}">Industries</a>
            <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">About</a>
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
        <button class="mobile-nav-close" onclick="toggleMobileNav()"><i class="fas fa-times"></i></button>
        <nav class="mobile-nav-links">
            <a href="/">Home</a>
            <a href="{{ route('services.index') }}">Services</a>
            <a href="{{ route('areas.index') }}">Areas</a>
            <a href="{{ route('industries.index') }}">Industries</a>
            <a href="{{ route('about') }}">About</a>
            <a href="{{ route('contact') }}">Contact</a>
            <button type="button" class="btn btn-primary w-full mt-4" onclick="openQuoteModal();toggleMobileNav()">Get a Quote</button>
        </nav>
    </div>
</header>
@include('components.quote-form')
<style>
@media (max-width: 900px) {
    .nav-links, .cta-buttons { display: none !important; }
    .mobile-menu { display: block !important; }
}
@media (min-width: 901px) {
    .mobile-menu, #mobile-nav-panel { display: none !important; }
}
.mobile-menu {
    display: none;
    cursor: pointer;
    font-size: 2rem;
    color: var(--secondary-color);
    margin-left: 1rem;
}
.mobile-nav-panel {
    position: fixed;
    top: 0; right: 0;
    width: 80vw; max-width: 340px;
    height: 100vh;
    background: #fff;
    box-shadow: -2px 0 24px rgba(0,0,0,0.18);
    z-index: 2000;
    transform: translateX(100%);
    transition: transform 0.3s cubic-bezier(.4,2,.6,1);
    display: flex;
    flex-direction: column;
    padding: 2rem 1.5rem 1.5rem 1.5rem;
}
.mobile-nav-panel.active {
    transform: translateX(0);
}
.mobile-nav-close {
    background: none;
    border: none;
    font-size: 2rem;
    color: var(--secondary-color);
    align-self: flex-end;
    margin-bottom: 1.5rem;
    cursor: pointer;
}
.mobile-nav-links {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}
.mobile-nav-links a {
    color: var(--primary-color);
    font-size: 1.2rem;
    text-decoration: none;
    font-weight: 600;
    transition: color 0.2s;
}
.mobile-nav-links a:hover {
    color: var(--secondary-color);
}
</style>
<script>
function toggleMobileNav() {
    const panel = document.getElementById('mobile-nav-panel');
    panel.classList.toggle('active');
}
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('mobile-menu-toggle').onclick = toggleMobileNav;
});
</script>