<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AboutPageController extends Controller
{
    protected $settingsService;

    public function __construct(\App\Services\SettingsService $settingsService)
    {
        $this->settingsService = $settingsService;
    }

    public function index()
    {
        $settings = \App\Models\Setting::where('group', 'about_page')->pluck('value', 'key');
        
        $introFeatures = \App\Models\Feature::where('type', 'about_intro')->orderBy('order')->get();
        $whyChooseFeatures = \App\Models\Feature::where('type', 'why_choose_us')->orderBy('order')->get();
        $counters = \App\Models\Feature::where('type', 'about_counter')->orderBy('order')->get();

        return view('admin.pages.about', compact('settings', 'introFeatures', 'whyChooseFeatures', 'counters'));
    }

    public function updateSettings(Request $request)
    {
        $data = $request->except('_token');

        foreach ($data as $key => $value) {
            $setting = \App\Models\Setting::firstOrCreate(
                ['key' => $key],
                ['group' => 'about_page', 'type' => 'string']
            );

            if ($request->hasFile($key)) {
                $value = $request->file($key)->store('settings', 'public');
                $setting->type = 'image';
            }
            
            $setting->group = 'about_page';
            $setting->save();

            $this->settingsService->set($key, $value, 'about_page', $setting->type ?? 'string');
        }

        return redirect()->back()->with('success', 'Page settings updated successfully.');
    }

    public function storeFeature(Request $request)
    {
        $request->validate([
            'type' => 'required|in:about_intro,why_choose_us,about_counter',
            'title' => 'required|string',
        ]);

        $data = [
            'type' => $request->type,
            'title' => $request->title,
            'subtitle' => $request->subtitle, // Used for count in counters
            'description' => $request->description,
            'icon' => $request->icon,
            'order' => $request->order ?? 0,
            'is_active' => true
        ];

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('features', 'public');
        }

        \App\Models\Feature::create($data);

        return redirect()->back()->with('success', 'Item added successfully.');
    }

    public function updateFeature(Request $request, $id)
    {
        $feature = \App\Models\Feature::findOrFail($id);
        
        $data = $request->only(['title', 'subtitle', 'description', 'icon', 'order']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('features', 'public');
        }

        $feature->update($data);

        return redirect()->back()->with('success', 'Item updated successfully.');
    }

    public function destroyFeature($id)
    {
        \App\Models\Feature::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Item deleted successfully.');
    }
}
