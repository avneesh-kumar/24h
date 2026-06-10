<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Service;
use App\Models\Testimonial;

class HomeController extends Controller
{
    public function index()
    {
        $areas = Area::where('active', true)
            ->orderBy('order', 'asc')
            ->take(15)
            ->get();
        $services = Service::where('active', true)
            ->orderBy('order', 'asc')
            ->take(8)
            ->get();
        $testimonials = Testimonial::where('active', true)
            ->orderBy('order')
            ->get();

        return view('home', compact('areas', 'services', 'testimonials'));
    }
}
