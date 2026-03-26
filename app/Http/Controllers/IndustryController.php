<?php

namespace App\Http\Controllers;

use App\Models\Industry;
use App\Models\Service;
use Illuminate\Http\Request;

class IndustryController extends Controller
{
    public function index()
    {
        $industries = Industry::where('active', true)
            ->orderBy('order')
            ->get();
            
        return view('industries.index', compact('industries'));
    }

    public function show($slug)
    {
        $industry = Industry::where('slug', $slug)
            ->where('active', true)
            ->firstOrFail();
        // If there is a relationship, use $industry->services; otherwise, fetch by industry_id
        $services = Service::where('active', true)
            ->orderBy('order')
            ->paginate(12);
        return view('industries.show', compact('industry', 'services'));
    }
} 