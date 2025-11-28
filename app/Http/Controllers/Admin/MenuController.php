<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\Language;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::all();
        return view('admin.menus.index', compact('menus'));
    }

    public function create()
    {
        return view('admin.menus.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'identifier' => 'required|string|max:255|unique:menus',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        Menu::create($validated);

        return redirect()->route('admin.menus.index')->with('success', 'Menu created successfully.');
    }

    public function edit(Menu $menu)
    {
        return view('admin.menus.edit', compact('menu'));
    }

    public function update(Request $request, Menu $menu)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'identifier' => 'required|string|max:255|unique:menus,identifier,' . $menu->id,
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $menu->update($validated);

        return redirect()->route('admin.menus.index')->with('success', 'Menu updated successfully.');
    }

    public function destroy(Menu $menu)
    {
        $menu->items()->delete();
        $menu->delete();
        return redirect()->route('admin.menus.index')->with('success', 'Menu deleted successfully.');
    }

    public function builder(Menu $menu)
    {
        $menu->load('items.translations');
        $languages = Language::where('is_active', true)->get();
        return view('admin.menus.builder', compact('menu', 'languages'));
    }

    public function storeItem(Request $request, Menu $menu)
    {
        $request->validate([
            'type' => 'required',
            'title' => 'required',
            'url' => 'required_if:type,custom',
        ]);

        $item = $menu->items()->create([
            'type' => $request->type,
            'url' => $request->url,
            'target' => $request->target ?? '_self',
            'sort_order' => $menu->items()->count() + 1,
        ]);

        // Save translation for current locale and fallback
        $locales = Language::where('is_active', true)->pluck('code');
        foreach ($locales as $locale) {
            $item->translations()->create([
                'locale' => $locale,
                'title' => $request->title, // Use same title for all initially
            ]);
        }

        return redirect()->back()->with('success', 'Item added successfully.');
    }

    public function destroyItem(Menu $menu, MenuItem $item)
    {
        $item->translations()->delete();
        $item->delete();
        return redirect()->back()->with('success', 'Item deleted successfully.');
    }
}
