<?php

namespace App\Http\Controllers;

use App\Models\Area;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    public function show($slug)
    {
        $area = Area::where('slug', $slug)
            ->where('active', true)
            ->firstOrFail();

        return view('areas.show', compact('area'));
    }

    public function index()
    {
        $areas = Area::orderBy('order')->get();
        return view('areas.index', compact('areas'));
    }
}
