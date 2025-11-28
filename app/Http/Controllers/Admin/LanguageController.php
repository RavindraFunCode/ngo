<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Language;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function index()
    {
        $languages = Language::all();
        return view('admin.languages.index', compact('languages'));
    }

    public function create()
    {
        return view('admin.languages.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:10|unique:languages',
            'name' => 'required|string|max:50',
            'is_default' => 'boolean',
            'is_active' => 'boolean',
        ]);

        $validated['is_default'] = $request->has('is_default');
        $validated['is_active'] = $request->has('is_active');

        if ($validated['is_default']) {
            Language::where('is_default', true)->update(['is_default' => false]);
        }

        Language::create($validated);

        return redirect()->route('admin.languages.index')->with('success', 'Language created successfully.');
    }

    public function edit(Language $language)
    {
        return view('admin.languages.edit', compact('language'));
    }

    public function update(Request $request, Language $language)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:10|unique:languages,code,' . $language->id,
            'name' => 'required|string|max:50',
            'is_default' => 'boolean',
            'is_active' => 'boolean',
        ]);

        $validated['is_default'] = $request->has('is_default');
        $validated['is_active'] = $request->has('is_active');

        if ($validated['is_default']) {
            Language::where('is_default', true)->where('id', '!=', $language->id)->update(['is_default' => false]);
        }

        $language->update($validated);

        return redirect()->route('admin.languages.index')->with('success', 'Language updated successfully.');
    }

    public function destroy(Language $language)
    {
        if ($language->is_default) {
            return back()->with('error', 'Cannot delete default language.');
        }
        
        $language->delete();

        return redirect()->route('admin.languages.index')->with('success', 'Language deleted successfully.');
    }
}
