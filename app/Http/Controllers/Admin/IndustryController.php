<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Industry;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class IndustryController extends Controller
{
    public function index()
    {
        $industries = Industry::orderBy('order')->paginate(10);
        return view('admin.industries.index', compact('industries'));
    }

    public function create()
    {
        return view('admin.industries.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'icon' => 'nullable|max:255',
            'description' => 'nullable',
            'order' => 'nullable|integer',
            'active' => 'boolean'
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['active'] = $request->has('active');

        Industry::create($validated);

        return redirect()->route('admin.industries.index')
            ->with('success', 'Industry created successfully.');
    }

    public function edit(Industry $industry)
    {
        return view('admin.industries.edit', compact('industry'));
    }

    public function update(Request $request, Industry $industry)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'icon' => 'nullable|max:255',
            'description' => 'nullable',
            'order' => 'nullable|integer',
            'active' => 'boolean'
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['active'] = $request->has('active');

        $industry->update($validated);

        return redirect()->route('admin.industries.index')
            ->with('success', 'Industry updated successfully.');
    }

    public function destroy(Industry $industry)
    {
        $industry->delete();

        return redirect()->route('admin.industries.index')
            ->with('success', 'Industry deleted successfully.');
    }
} 