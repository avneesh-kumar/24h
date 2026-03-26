<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Industry;
use App\Models\Service;
use App\Models\Area;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistics
        $stats = [
            'total_industries' => Industry::count(),
            'active_industries' => Industry::where('active', true)->count(),
            'total_services' => Service::count(),
            'active_services' => Service::where('active', true)->count(),
            'total_areas' => Area::count(),
            'active_areas' => Area::where('active', true)->count(),
            'total_testimonials' => Testimonial::count(),
            'active_testimonials' => Testimonial::where('active', true)->count(),
        ];

        // Chart data for industries
        $industryData = [
            'labels' => ['Commercial', 'Industrial', 'Healthcare', 'Education', 'Hospitality', 'Construction'],
            'data' => [25, 20, 15, 12, 10, 8],
        ];

        // Chart data for services
        $serviceData = [
            'labels' => ['Security Guards', 'CCTV Systems', 'Access Control', 'Alarm Systems', 'Mobile Patrol'],
            'data' => [30, 25, 20, 15, 10],
        ];

        // Recent activities
        $recentActivities = [
            [
                'type' => 'industry',
                'action' => 'created',
                'title' => 'Healthcare Security',
                'time' => '2 hours ago'
            ],
            [
                'type' => 'service',
                'action' => 'updated',
                'title' => 'CCTV Systems',
                'time' => '4 hours ago'
            ],
            [
                'type' => 'testimonial',
                'action' => 'added',
                'title' => 'New Client Review',
                'time' => '1 day ago'
            ],
            [
                'type' => 'area',
                'action' => 'created',
                'title' => 'Downtown Area',
                'time' => '2 days ago'
            ],
        ];

        // Performance metrics
        $performanceMetrics = [
            'response_time' => '2.5s',
            'uptime' => '99.9%',
            'active_users' => '1,234',
            'page_views' => '45,678'
        ];

        return view('admin.dashboard', compact(
            'stats',
            'industryData',
            'serviceData',
            'recentActivities',
            'performanceMetrics'
        ));
    }
} 