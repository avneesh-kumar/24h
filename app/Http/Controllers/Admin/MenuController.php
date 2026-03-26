<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::orderBy('type')
            ->orderBy('order')
            ->paginate(20);

        return view('admin.menus.index', compact('menus'));
    }

    public function create()
    {
        $parentMenus = Menu::whereNull('parent_id')->get();
        return view('admin.menus.create', compact('parentMenus'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'required|string|max:255',
            'type' => 'required|in:header,footer',
            'parent_id' => 'nullable|exists:menus,id',
            'order' => 'nullable|integer|min:0',
            'active' => 'boolean',
            'icon' => 'nullable|string|max:50',
            'target' => 'nullable|in:_self,_blank',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['active'] = $request->has('active');

        Menu::create($validated);

        return redirect()
            ->route('admin.menus.index')
            ->with('success', 'Menu item created successfully.');
    }

    public function edit(Menu $menu)
    {
        $parentMenus = Menu::whereNull('parent_id')
            ->where('id', '!=', $menu->id)
            ->get();

        return view('admin.menus.edit', compact('menu', 'parentMenus'));
    }

    public function update(Request $request, Menu $menu)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'required|string|max:255',
            'type' => 'required|in:header,footer',
            'parent_id' => 'nullable|exists:menus,id',
            'order' => 'nullable|integer|min:0',
            'active' => 'boolean',
            'icon' => 'nullable|string|max:50',
            'target' => 'nullable|in:_self,_blank',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['active'] = $request->has('active');

        $menu->update($validated);

        return redirect()
            ->route('admin.menus.index')
            ->with('success', 'Menu item updated successfully.');
    }

    public function destroy(Menu $menu)
    {
        // Delete all child menus first
        $menu->children()->delete();
        
        // Delete the menu item
        $menu->delete();

        return redirect()
            ->route('admin.menus.index')
            ->with('success', 'Menu item deleted successfully.');
    }
} 