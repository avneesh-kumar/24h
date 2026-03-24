<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\PageSection;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageBuilderController extends Controller
{
    public function index()
    {
        return view('admin.page-builder.index');
    }

    public function load()
    {
        $page = Page::where('slug', 'home')->first();
        
        if (!$page) {
            $page = Page::create([
                'name' => 'Home',
                'slug' => 'home',
                'status' => 'draft'
            ]);
        }

        $sections = $page->sections->map(function ($section) {
            return [
                'id' => $section->id,
                'type' => $section->type,
                'content' => $section->content,
                'settings' => $section->settings,
                'order' => $section->order
            ];
        });

        return response()->json([
            'page' => $page,
            'sections' => $sections
        ]);
    }

    public function save(Request $request)
    {
        $page = Page::where('slug', 'home')->first();
        
        if (!$page) {
            $page = Page::create([
                'name' => 'Home',
                'slug' => 'home',
                'status' => 'draft'
            ]);
        }

        // Delete existing sections
        $page->sections()->delete();

        // Create new sections
        foreach ($request->sections as $index => $sectionData) {
            PageSection::create([
                'page_id' => $page->id,
                'type' => $sectionData['type'],
                'content' => $sectionData['content'],
                'settings' => $sectionData['settings'] ?? [],
                'order' => $index,
                'is_active' => true
            ]);
        }

        return response()->json([
            'message' => 'Page saved successfully'
        ]);
    }

    public function preview()
    {
        $page = Page::where('slug', 'home')->first();
        
        if (!$page) {
            return redirect()->route('admin.page-builder.index');
        }

        $sections = $page->sections()->orderBy('order')->get();

        return view('admin.page-builder.preview', compact('page', 'sections'));
    }
}
