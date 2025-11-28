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
        ]);

        $category = Category::create([
            'slug' => Str::slug($request->slug),
            'is_active' => $request->has('is_active'),
        ]);

        foreach ($request->translations as $locale => $data) {
            $category->translations()->create([
                'locale' => $locale,
                'name' => $data['name'],
                'description' => $data['description'] ?? null,
            ]);
        }

        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully.');
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
        ]);

        $category->update([
            'slug' => Str::slug($request->slug),
            'is_active' => $request->has('is_active'),
        ]);

        foreach ($request->translations as $locale => $data) {
            $category->translations()->updateOrCreate(
                ['locale' => $locale],
                [
                    'name' => $data['name'],
                    'description' => $data['description'] ?? null,
                ]
            );
        }

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        $category->translations()->delete();
        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully.');
    }
}
