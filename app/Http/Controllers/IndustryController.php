<?php

namespace App\Http\Controllers;

use App\Models\Industry;
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
            
        return view('industries.show', compact('industry'));
    }
} 