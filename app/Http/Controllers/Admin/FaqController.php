<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faq;
use App\Models\Language;

class FaqController extends Controller
{
    public function index(Request $request)
    {
        $faqs = Faq::with('translations')->orderBy('order')->paginate(10);

        if ($request->ajax()) {
            return view('admin.faqs.partials.table', compact('faqs'))->render();
        }

        return view('admin.faqs.index', compact('faqs'));
    }

    public function create()
    {
        $languages = Language::where('is_active', true)->get();
        $categories = \App\Models\FaqCategory::where('is_active', true)->with('translations')->orderBy('order')->get();
        return view('admin.faqs.create', compact('languages', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'order' => 'integer',
            'faq_category_id' => 'nullable|exists:faq_categories,id',
        ]);

        $faq = Faq::create([
            'is_active' => $request->has('is_active'),
            'order' => $request->order ?? 0,
            'faq_category_id' => $request->faq_category_id,
        ]);

        $languages = Language::all()->keyBy('code');

        foreach ($request->translations as $locale => $data) {
            if (empty($data['question'])) continue;
            if (isset($languages[$locale])) {
                $faq->translations()->create([
                    'language_id' => $languages[$locale]->id,
                    'question' => $data['question'],
                    'answer' => $data['answer'],
                ]);
            }
        }

        return response()->json(['success' => true, 'redirect' => route('admin.faqs.index')]);
    }

    public function edit(Faq $faq)
    {
        $languages = Language::where('is_active', true)->get();
        $categories = \App\Models\FaqCategory::where('is_active', true)->with('translations')->orderBy('order')->get();
        return view('admin.faqs.edit', compact('faq', 'languages', 'categories'));
    }

    public function update(Request $request, Faq $faq)
    {
        $request->validate([
            'order' => 'integer',
            'faq_category_id' => 'nullable|exists:faq_categories,id',
        ]);

        $faq->update([
            'is_active' => $request->has('is_active'),
            'order' => $request->order,
            'faq_category_id' => $request->faq_category_id,
        ]);

        $languages = Language::all()->keyBy('code');

        foreach ($request->translations as $locale => $data) {
            if (empty($data['question'])) continue;
            if (isset($languages[$locale])) {
                $faq->translations()->updateOrCreate(
                    ['language_id' => $languages[$locale]->id],
                    [
                        'question' => $data['question'],
                        'answer' => $data['answer'],
                    ]
                );
            }
        }

        return response()->json(['success' => true, 'redirect' => route('admin.faqs.index')]);
    }

    public function destroy(Faq $faq)
    {
        $faq->translations()->delete();
        $faq->delete();
        return response()->json(['success' => true, 'message' => 'FAQ deleted successfully.']);
    }
}
