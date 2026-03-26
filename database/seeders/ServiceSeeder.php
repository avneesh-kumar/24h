<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;
use Illuminate\Support\Str;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'title' => 'Property Management Security',
                'banner_title' => 'Professional Property Security Solutions',
                'description' => 'Comprehensive security services for residential and commercial properties. Our expert security personnel ensure the safety of your property, assets, and occupants through vigilant monitoring, access control, and rapid response protocols.',
                'order' => 1,
                'active' => true,
            ],
            [
                'title' => 'Industrial Facilities Security',
                'banner_title' => 'Industrial Security & Protection Services',
                'description' => 'Specialized security solutions for industrial facilities, including manufacturing plants, warehouses, and distribution centers. We provide 24/7 monitoring, access control, and emergency response services tailored to industrial environments.',
                'order' => 2,
                'active' => true,
            ],
            [
                'title' => 'Event Security Services',
                'banner_title' => 'Professional Event Security & Crowd Management',
                'description' => 'Comprehensive security services for events of all sizes. Our trained security personnel handle crowd management, access control, and emergency response to ensure safe and successful events.',
                'order' => 3,
                'active' => true,
            ],
            [
                'title' => 'Corporate Security Solutions',
                'banner_title' => 'Enterprise-Level Security Services',
                'description' => 'Tailored security solutions for corporate environments. We provide executive protection, access control, surveillance, and emergency response services to protect your business assets and personnel.',
                'order' => 4,
                'active' => true,
            ],
            [
                'title' => 'Retail Security Services',
                'banner_title' => 'Retail Loss Prevention & Security',
                'description' => 'Specialized security services for retail establishments. Our security personnel help prevent theft, manage customer flow, and ensure a safe shopping environment for customers and staff.',
                'order' => 5,
                'active' => true,
            ],
            [
                'title' => 'Healthcare Facility Security',
                'banner_title' => 'Healthcare Security & Patient Safety',
                'description' => 'Dedicated security services for healthcare facilities. We provide specialized security solutions that protect patients, staff, and assets while maintaining a welcoming environment for visitors.',
                'order' => 6,
                'active' => true,
            ],
            [
                'title' => 'Educational Institution Security',
                'banner_title' => 'Campus Security & Student Safety',
                'description' => 'Comprehensive security services for schools, colleges, and universities. Our security personnel ensure a safe learning environment through access control, monitoring, and emergency response services.',
                'order' => 7,
                'active' => true,
            ],
            [
                'title' => 'Construction Site Security',
                'banner_title' => 'Construction Site Protection Services',
                'description' => 'Specialized security services for construction sites. We protect your equipment, materials, and personnel through 24/7 monitoring, access control, and rapid response protocols.',
                'order' => 8,
                'active' => true,
            ],
            [
                'title' => 'Residential Community Security',
                'banner_title' => 'Residential Security & Community Safety',
                'description' => 'Comprehensive security services for residential communities. Our security personnel provide access control, patrol services, and emergency response to ensure the safety of residents and property.',
                'order' => 9,
                'active' => true,
            ],
            [
                'title' => 'Specialized Security Services',
                'banner_title' => 'Custom Security Solutions',
                'description' => 'Tailored security services for unique requirements. We provide specialized security solutions for specific needs, including VIP protection, high-value asset security, and custom security protocols.',
                'order' => 10,
                'active' => true,
            ],
        ];

        foreach ($services as $service) {
            Service::create([
                'title' => $service['title'],
                'slug' => Str::slug($service['title']) . '-' . uniqid(),
                'banner_title' => $service['banner_title'],
                'description' => $service['description'],
                'order' => $service['order'],
                'active' => $service['active'],
            ]);
        }
    }
} 