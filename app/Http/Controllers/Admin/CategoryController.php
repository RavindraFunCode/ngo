<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Language;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with('translations')->paginate(10);
        return view('admin.blog.categories.index', compact('categories'));
    }

    public function create()
    {
        $languages = Language::where('is_active', true)->get();
        return view('admin.blog.categories.create', compact('languages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'slug' => 'required|unique:post_categories,slug',
            'is_active' => 'boolean',
            'translations' => 'required|array',
            'translations.*.name' => 'required|string|max:255',
            'translations.*.slug' => 'required|string|max:255',
        ]);

        $category = Category::create([
            'slug' => Str::slug($request->slug),
            'is_active' => $request->has('is_active'),
        ]);

        $languages = Language::whereIn('code', array_keys($request->translations))->get()->keyBy('code');

        foreach ($request->translations as $locale => $data) {
            if (! $languages->has($locale)) {
                continue;
            }

            $category->translations()->create([
                'language_id' => $languages[$locale]->id,
                'name' => $data['name'],
                'slug' => Str::slug($data['slug']),
                'description' => $data['description'] ?? null,
            ]);
        }

        return redirect()->route('admin.blog.categories.index')->with('success', 'Category created successfully.');
    }

    public function edit(Category $category)
    {
        $languages = Language::where('is_active', true)->get();
        return view('admin.blog.categories.edit', compact('category', 'languages'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'slug' => 'required|unique:post_categories,slug,' . $category->id,
            'is_active' => 'boolean',
            'translations' => 'required|array',
            'translations.*.name' => 'required|string|max:255',
            'translations.*.slug' => 'required|string|max:255',
        ]);

        $category->update([
            'slug' => Str::slug($request->slug),
            'is_active' => $request->has('is_active'),
        ]);

        $languages = Language::whereIn('code', array_keys($request->translations))->get()->keyBy('code');

        foreach ($request->translations as $locale => $data) {
            if (! $languages->has($locale)) {
                continue;
            }

            $category->translations()->updateOrCreate([
                'language_id' => $languages[$locale]->id,
            ], [
                'name' => $data['name'],
                'slug' => Str::slug($data['slug']),
                'description' => $data['description'] ?? null,
            ]);
        }

        return redirect()->route('admin.blog.categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        $category->translations()->delete();
        $category->delete();
        return redirect()->route('admin.blog.categories.index')->with('success', 'Category deleted successfully.');
    }
}
