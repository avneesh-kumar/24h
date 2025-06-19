<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    public function run()
    {
        // Header Menu Items
        $home = Menu::create([
            'title' => 'Home',
            'url' => '/',
            'order' => 1,
            'type' => 'header',
            'active' => true
        ]);

        $about = Menu::create([
            'title' => 'About Us',
            'url' => '/about',
            'order' => 2,
            'type' => 'header',
            'active' => true
        ]);

        $services = Menu::create([
            'title' => 'Services',
            'url' => '/services',
            'order' => 3,
            'type' => 'header',
            'active' => true
        ]);

        // Services Submenu
        Menu::create([
            'title' => 'Security Guards',
            'url' => '/services/security-guards',
            'parent_id' => $services->id,
            'order' => 1,
            'type' => 'header',
            'active' => true
        ]);

        Menu::create([
            'title' => 'CCTV Systems',
            'url' => '/services/cctv-systems',
            'parent_id' => $services->id,
            'order' => 2,
            'type' => 'header',
            'active' => true
        ]);

        Menu::create([
            'title' => 'Access Control',
            'url' => '/services/access-control',
            'parent_id' => $services->id,
            'order' => 3,
            'type' => 'header',
            'active' => true
        ]);

        $areas = Menu::create([
            'title' => 'Areas We Serve',
            'url' => '/areas',
            'order' => 4,
            'type' => 'header',
            'active' => true
        ]);

        $contact = Menu::create([
            'title' => 'Contact',
            'url' => '/contact',
            'order' => 5,
            'type' => 'header',
            'active' => true
        ]);

        // Footer Menu Items
        Menu::create([
            'title' => 'Home',
            'url' => '/',
            'order' => 1,
            'type' => 'footer',
            'active' => true
        ]);

        Menu::create([
            'title' => 'About Us',
            'url' => '/about',
            'order' => 2,
            'type' => 'footer',
            'active' => true
        ]);

        Menu::create([
            'title' => 'Services',
            'url' => '/services',
            'order' => 3,
            'type' => 'footer',
            'active' => true
        ]);

        Menu::create([
            'title' => 'Areas We Serve',
            'url' => '/areas',
            'order' => 4,
            'type' => 'footer',
            'active' => true
        ]);

        Menu::create([
            'title' => 'Contact',
            'url' => '/contact',
            'order' => 5,
            'type' => 'footer',
            'active' => true
        ]);

        Menu::create([
            'title' => 'Privacy Policy',
            'url' => '/privacy-policy',
            'order' => 6,
            'type' => 'footer',
            'active' => true
        ]);

        Menu::create([
            'title' => 'Terms of Service',
            'url' => '/terms-of-service',
            'order' => 7,
            'type' => 'footer',
            'active' => true
        ]);
    }
} 