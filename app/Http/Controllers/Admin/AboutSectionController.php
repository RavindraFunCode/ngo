<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AboutSectionController extends Controller
{
    protected $settingsService;

    public function __construct(\App\Services\SettingsService $settingsService)
    {
        $this->settingsService = $settingsService;
    }

    public function index()
    {
        $settings = \App\Models\Setting::where('group', 'home_about')->pluck('value', 'key');
        // Retrieve 'about_us' features
        $features = \App\Models\Feature::where('type', 'about_us')->orderBy('order')->get();
        return view('admin.about.index', compact('settings', 'features'));
    }

    public function updateSettings(Request $request)
    {
        $data = $request->except('_token');

        foreach ($data as $key => $value) {
            $setting = \App\Models\Setting::firstOrCreate(
                ['key' => $key],
                ['group' => 'home_about', 'type' => 'string']
            );

            // Handle file uploads if any (though currently about section is text-heavy)
            if ($request->hasFile($key)) {
                $value = $request->file($key)->store('settings', 'public');
                $setting->type = 'image';
            }
            
            $setting->group = 'home_about';
            $setting->save();

            $this->settingsService->set($key, $value, 'home_about', $setting->type ?? 'string');
        }

        return redirect()->back()->with('success', 'About section settings updated successfully.');
    }

    public function storeFeature(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'image' => 'nullable|image',
            'description' => 'required|string',
        ]);

        $data = [
            'type' => 'about_us',
            'title' => $request->title,
            'description' => $request->description,
            'order' => $request->order ?? 0,
            'is_active' => true
        ];

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('features', 'public');
        }

        \App\Models\Feature::create($data);

        return redirect()->back()->with('success', 'Feature added successfully.');
    }

    public function updateFeature(Request $request, $id)
    {
        $feature = \App\Models\Feature::findOrFail($id);
        
        $request->validate([
            'title' => 'required|string',
            'image' => 'nullable|image',
            'description' => 'required|string',
        ]);

        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'order' => $request->order ?? 0,
        ];

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('features', 'public');
        }

        $feature->update($data);

        return redirect()->back()->with('success', 'Feature updated successfully.');
    }

    public function destroyFeature($id)
    {
        \App\Models\Feature::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Feature deleted successfully.');
    }
}
