<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::where('active', true)
            ->orderBy('order')
            ->paginate(12);
            
        return view('services.index', compact('services'));
    }

    public function show($slug)
    {
        $service = Service::where('slug', $slug)
            ->where('active', true)
            ->firstOrFail();
            
        return view('services.show', compact('service'));
    }
} 