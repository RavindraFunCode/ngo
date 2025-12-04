<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Campaign;
use App\Models\Language;
use Illuminate\Support\Str;

class CampaignController extends Controller
{
    public function index()
    {
        $campaigns = Campaign::with('translations')->latest()->paginate(10);
        return view('admin.campaigns.index', compact('campaigns'));
    }

    public function create()
    {
        $languages = Language::where('is_active', true)->get();
        return view('admin.campaigns.create', compact('languages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'slug' => 'required|unique:campaigns,slug',
            'target_amount' => 'nullable|numeric',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'featured_image' => 'nullable|image|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('featured_image')) {
            $imagePath = $request->file('featured_image')->store('campaigns', 'public');
        }

        $campaign = Campaign::create([
            'slug' => Str::slug($request->slug),
            'status' => $request->status ?? 'draft',
            'target_amount' => $request->target_amount,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'featured_image' => $imagePath,
            'is_featured' => $request->has('is_featured'),
            'created_by' => auth()->id(),
        ]);

        $languages = Language::all()->keyBy('code');

        foreach ($request->translations as $locale => $data) {
            if (empty($data['title'])) continue;
            if (isset($languages[$locale])) {
                $campaign->translations()->create([
                    'language_id' => $languages[$locale]->id,
                    'title' => $data['title'],
                    'slug' => Str::slug($data['title']),
                    'short_description' => $data['short_description'] ?? null,
                    'full_description' => $data['full_description'] ?? null,
                    'meta_title' => $data['meta_title'] ?? null,
                    'meta_description' => $data['meta_description'] ?? null,
                    'meta_keywords' => $data['meta_keywords'] ?? null,
                ]);
            }
        }

        return redirect()->route('admin.campaigns.index')->with('success', 'Campaign created successfully.');
    }

    public function edit(Campaign $campaign)
    {
        $languages = Language::where('is_active', true)->get();
        return view('admin.campaigns.edit', compact('campaign', 'languages'));
    }

    public function update(Request $request, Campaign $campaign)
    {
        $request->validate([
            'slug' => 'required|unique:campaigns,slug,' . $campaign->id,
            'target_amount' => 'nullable|numeric',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'featured_image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('featured_image')) {
            $campaign->featured_image = $request->file('featured_image')->store('campaigns', 'public');
        }

        $campaign->update([
            'slug' => Str::slug($request->slug),
            'status' => $request->status,
            'target_amount' => $request->target_amount,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'is_featured' => $request->has('is_featured'),
            'updated_by' => auth()->id(),
        ]);

        $languages = Language::all()->keyBy('code');

        foreach ($request->translations as $locale => $data) {
            if (empty($data['title'])) continue;
            if (isset($languages[$locale])) {
                $campaign->translations()->updateOrCreate(
                    ['language_id' => $languages[$locale]->id],
                    [
                        'title' => $data['title'],
                        'slug' => Str::slug($data['title']),
                        'short_description' => $data['short_description'] ?? null,
                        'full_description' => $data['full_description'] ?? null,
                        'meta_title' => $data['meta_title'] ?? null,
                        'meta_description' => $data['meta_description'] ?? null,
                        'meta_keywords' => $data['meta_keywords'] ?? null,
                    ]
                );
            }
        }

        return redirect()->route('admin.campaigns.index')->with('success', 'Campaign updated successfully.');
    }

    public function destroy(Campaign $campaign)
    {
        $campaign->translations()->delete();
        $campaign->delete();
        return redirect()->route('admin.campaigns.index')->with('success', 'Campaign deleted successfully.');
    }
}
