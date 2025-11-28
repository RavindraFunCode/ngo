<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::with('translations')->paginate(10);
        return view('admin.pages.index', compact('pages'));
    }

    public function create()
    {
        $languages = Language::where('is_active', true)->get();
        return view('admin.pages.create', compact('languages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'slug' => 'required|unique:pages,slug',
            'is_active' => 'boolean',
        ]);

        $page = Page::create([
            'slug' => Str::slug($request->slug),
            'is_active' => $request->has('is_active'),
            'template' => $request->template ?? 'default',
        ]);

        foreach ($request->translations as $locale => $data) {
            $language = Language::where('code', $locale)->first();
            if ($language) {
                $page->translations()->create([
                    'language_id' => $language->id,
                    'title' => $data['title'],
                    'slug' => Str::slug($data['title'] ?? $request->slug),
                    'content' => $data['content'],
                    'meta_title' => $data['meta_title'],
                    'meta_description' => $data['meta_description'],
                    'meta_keywords' => $data['meta_keywords'],
                ]);
            }
        }

        return redirect()->route('admin.pages.index')->with('success', 'Page created successfully.');
    }

    public function edit(Page $page)
    {
        $languages = Language::where('is_active', true)->get();
        return view('admin.pages.edit', compact('page', 'languages'));
    }

    public function update(Request $request, Page $page)
    {
        $request->validate([
            'slug' => 'required|unique:pages,slug,' . $page->id,
            'is_active' => 'boolean',
        ]);

        $page->update([
            'slug' => Str::slug($request->slug),
            'is_active' => $request->has('is_active'),
            'template' => $request->template ?? 'default',
        ]);

        foreach ($request->translations as $locale => $data) {
            $language = Language::where('code', $locale)->first();
            if ($language) {
                $page->translations()->updateOrCreate(
                    ['language_id' => $language->id],
                    [
                        'title' => $data['title'],
                        'slug' => Str::slug($data['title'] ?? $request->slug),
                        'content' => $data['content'],
                        'meta_title' => $data['meta_title'],
                        'meta_description' => $data['meta_description'],
                        'meta_keywords' => $data['meta_keywords'],
                    ]
                );
            }
        }

        return redirect()->route('admin.pages.index')->with('success', 'Page updated successfully.');
    }

    public function destroy(Page $page)
    {
        $page->translations()->delete();
        $page->delete();
        return redirect()->route('admin.pages.index')->with('success', 'Page deleted successfully.');
    }
}
