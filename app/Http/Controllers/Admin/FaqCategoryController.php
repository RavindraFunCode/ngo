<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FaqCategory;
use App\Models\Language;
use Illuminate\Support\Str;

class FaqCategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = FaqCategory::with('translations')->withCount('faqs')->orderBy('order')->paginate(10);

        if ($request->ajax()) {
            return view('admin.faq-categories.partials.table', compact('categories'))->render();
        }

        return view('admin.faq-categories.index', compact('categories'));
    }

    public function create()
    {
        $languages = Language::where('is_active', true)->get();
        return view('admin.faq-categories.create', compact('languages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'order' => 'integer',
        ]);

        $category = FaqCategory::create([
            'is_active' => $request->has('is_active'),
            'order' => $request->order ?? 0,
        ]);

        $languages = Language::all()->keyBy('code');

        foreach ($request->translations as $locale => $data) {
            if (empty($data['name'])) continue;
            if (isset($languages[$locale])) {
                $category->translations()->create([
                    'language_id' => $languages[$locale]->id,
                    'name' => $data['name'],
                    'slug' => Str::slug($data['name']),
                ]);
            }
        }

        return response()->json(['success' => true, 'redirect' => route('admin.faq-categories.index')]);
    }

    public function edit(FaqCategory $faqCategory)
    {
        $languages = Language::where('is_active', true)->get();
        return view('admin.faq-categories.edit', compact('faqCategory', 'languages'));
    }

    public function update(Request $request, FaqCategory $faqCategory)
    {
        $request->validate([
            'order' => 'integer',
        ]);

        $faqCategory->update([
            'is_active' => $request->has('is_active'),
            'order' => $request->order,
        ]);

        $languages = Language::all()->keyBy('code');

        foreach ($request->translations as $locale => $data) {
            if (empty($data['name'])) continue;
            if (isset($languages[$locale])) {
                $faqCategory->translations()->updateOrCreate(
                    ['language_id' => $languages[$locale]->id],
                    [
                        'name' => $data['name'],
                        'slug' => Str::slug($data['name']),
                    ]
                );
            }
        }

        return response()->json(['success' => true, 'redirect' => route('admin.faq-categories.index')]);
    }

    public function destroy(FaqCategory $faqCategory)
    {
        $faqCategory->translations()->delete();
        $faqCategory->delete();
        return response()->json(['success' => true, 'message' => 'Category deleted successfully.']);
    }
}
