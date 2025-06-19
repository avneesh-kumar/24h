<?php

if (!function_exists('admin_menu')) {
    function admin_menu()
    {
        return [
            [
                'title' => 'Dashboard',
                'icon' => 'fas fa-tachometer-alt',
                'url' => route('admin.dashboard'),
                'active' => request()->routeIs('admin.dashboard')
            ],
            [
                'title' => 'Page Builder',
                'icon' => 'fas fa-paint-brush',
                'url' => route('admin.page-builder.index'),
                'active' => request()->routeIs('admin.page-builder.*')
            ],
            // ... existing menu items ...
        ];
    }
} 