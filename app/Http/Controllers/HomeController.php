<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Service;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $areas = Area::where('active', true)
            ->orderBy('order', 'asc')
            ->paginate(15);
        $services = Service::where('active', true)
        ->orderBy('order', 'asc')
        ->paginate(15);
        return view('home', compact('areas', 'services'));
    }
}
