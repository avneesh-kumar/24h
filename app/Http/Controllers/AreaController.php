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
            ->with(['faqs' => function($query) {
                $query->orderBy('sort_order')->orderBy('id');
            }])
            ->firstOrFail();

        // If area has a custom URL, redirect with 301 (permanent redirect)
        if ($area->custom_url) {
            return redirect($area->custom_url, 301);
        }

        return view('areas.show', compact('area'));
    }

    public function index()
    {
        $areas = Area::orderBy('order')->where('active', 1)->get();
        return view('areas.index', compact('areas'));
    }
}
