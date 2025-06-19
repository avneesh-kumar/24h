@props(['type' => 'header'])

@php
use App\Models\Menu;
$menuItems = Menu::active()->ofType($type)->root()->orderBy('order')->get();
@endphp

@if($type === 'header')
<nav class="main-menu">
    <ul class="menu-list">
        @foreach($menuItems as $item)
            <li class="menu-item {{ $item->children->count() > 0 ? 'has-dropdown' : '' }}">
                <a href="{{ $item->url }}" class="menu-link" {{ $item->target === '_blank' ? 'target="_blank"' : '' }}>
                    @if($item->icon)
                        <i class="{{ $item->icon }}"></i>
                    @endif
                    {{ $item->title }}
                    @if($item->children->count() > 0)
                        <i class="fas fa-chevron-down ml-1"></i>
                    @endif
                </a>
                @if($item->children->count() > 0)
                    <ul class="dropdown-menu">
                        @foreach($item->children as $child)
                            <li class="dropdown-item">
                                <a href="{{ $child->url }}" class="dropdown-link" {{ $child->target === '_blank' ? 'target="_blank"' : '' }}>
                                    @if($child->icon)
                                        <i class="{{ $child->icon }}"></i>
                                    @endif
                                    {{ $child->title }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </li>
        @endforeach
    </ul>
</nav>

<style>
.main-menu {
    display: flex;
    align-items: center;
}

.menu-list {
    display: flex;
    list-style: none;
    margin: 0;
    padding: 0;
}

.menu-item {
    position: relative;
    margin: 0 1rem;
}

.menu-link {
    display: flex;
    align-items: center;
    color: #1a1a1a;
    text-decoration: none;
    font-weight: 500;
    padding: 0.5rem 0;
    transition: color 0.3s ease;
}

.menu-link:hover {
    color: #dc2626;
}

.has-dropdown .menu-link {
    padding-right: 1rem;
}

.dropdown-menu {
    position: absolute;
    top: 100%;
    left: 0;
    min-width: 200px;
    background: white;
    border-radius: 0.5rem;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    opacity: 0;
    visibility: hidden;
    transform: translateY(10px);
    transition: all 0.3s ease;
    z-index: 1000;
    list-style: none;
    padding: 0.5rem 0;
    margin: 0;
}

.has-dropdown:hover .dropdown-menu {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

.dropdown-item {
    margin: 0;
}

.dropdown-link {
    display: flex;
    align-items: center;
    padding: 0.5rem 1rem;
    color: #1a1a1a;
    text-decoration: none;
    transition: all 0.3s ease;
}

.dropdown-link:hover {
    background: #f8f9fa;
    color: #dc2626;
}

.dropdown-link i {
    margin-right: 0.5rem;
    width: 1rem;
    text-align: center;
}

@media (max-width: 768px) {
    .main-menu {
        display: none;
    }
}
</style>
@else
<nav class="footer-menu">
    <ul class="footer-menu-list">
        @foreach($menuItems as $item)
            <li class="footer-menu-item">
                <a href="{{ $item->url }}" class="footer-menu-link" {{ $item->target === '_blank' ? 'target="_blank"' : '' }}>
                    @if($item->icon)
                        <i class="{{ $item->icon }}"></i>
                    @endif
                    {{ $item->title }}
                </a>
            </li>
        @endforeach
    </ul>
</nav>

<style>
.footer-menu {
    margin-bottom: 1rem;
}

.footer-menu-list {
    list-style: none;
    margin: 0;
    padding: 0;
    display: flex;
    flex-wrap: wrap;
    gap: 1rem;
}

.footer-menu-item {
    margin: 0;
}

.footer-menu-link {
    color: #666;
    text-decoration: none;
    font-size: 0.9rem;
    transition: color 0.3s ease;
}

.footer-menu-link:hover {
    color: #dc2626;
}

@media (max-width: 768px) {
    .footer-menu-list {
        flex-direction: column;
        gap: 0.5rem;
    }
}
</style>
@endif 