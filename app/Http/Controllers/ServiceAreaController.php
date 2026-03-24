<?php

namespace App\Http\Controllers;

use App\Models\ServiceArea;

class ServiceAreaController extends Controller
{
    public function show($slug)
    {
        $serviceArea = ServiceArea::where('slug', $slug)->get()->first();
        return view('service-areas.show', compact('serviceArea'));
    }
}
