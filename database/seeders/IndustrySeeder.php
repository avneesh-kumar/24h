<?php

namespace Database\Seeders;

use App\Models\Industry;
use Illuminate\Database\Seeder;

class IndustrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $industries = [
            [
                'title' => 'Commercial',
                'icon' => 'fas fa-building',
                'description' => 'Office buildings, retail centers, and business parks',
                'order' => 1,
            ],
            [
                'title' => 'Industrial',
                'icon' => 'fas fa-industry',
                'description' => 'Manufacturing facilities and warehouses',
                'order' => 2,
            ],
            [
                'title' => 'Hospitality',
                'icon' => 'fas fa-hotel',
                'description' => 'Hotels, resorts, and entertainment venues',
                'order' => 3,
            ],
            [
                'title' => 'Education',
                'icon' => 'fas fa-school',
                'description' => 'Schools, colleges, and educational institutions',
                'order' => 4,
            ],
            [
                'title' => 'Healthcare',
                'icon' => 'fas fa-hospital',
                'description' => 'Hospitals, clinics, and medical facilities',
                'order' => 5,
            ],
            [
                'title' => 'Construction',
                'icon' => 'fas fa-hard-hat',
                'description' => 'Construction sites and development projects',
                'order' => 6,
            ],
            [
                'title' => 'Residential',
                'icon' => 'fas fa-home',
                'description' => 'Apartment complexes and residential communities',
                'order' => 7,
            ],
            [
                'title' => 'Events',
                'icon' => 'fas fa-calendar-check',
                'description' => 'Conferences, concerts, and special events',
                'order' => 8,
            ],
        ];

        foreach ($industries as $industry) {
            Industry::create($industry);
        }
    }
} 