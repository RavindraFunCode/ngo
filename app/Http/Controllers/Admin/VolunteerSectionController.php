<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VolunteerSectionController extends Controller
{
    protected $settingsService;

    public function __construct(\App\Services\SettingsService $settingsService)
    {
        $this->settingsService = $settingsService;
    }

    public function index()
    {
        $settings = \App\Models\Setting::where('group', 'home_volunteer')->pluck('value', 'key');
        $counters = \App\Models\Feature::where('type', 'counter')->orderBy('order')->get();
        return view('admin.volunteer.index', compact('settings', 'counters'));
    }

    public function updateSettings(Request $request)
    {
        $data = $request->except('_token');

        foreach ($data as $key => $value) {
            $setting = \App\Models\Setting::firstOrCreate(
                ['key' => $key],
                ['group' => 'home_volunteer', 'type' => 'string']
            );

            if ($request->hasFile($key)) {
                $value = $request->file($key)->store('settings', 'public');
                $setting->type = 'image';
            }
            
            $setting->group = 'home_volunteer'; // Ensure group is correct
            $setting->save();

            $this->settingsService->set($key, $value, 'home_volunteer', $setting->type ?? 'string');
        }

        return redirect()->back()->with('success', 'Section settings updated successfully.');
    }

    public function storeCounter(Request $request)
    {
        $request->validate([
            'title' => 'required|string', // Title
            'subtitle' => 'required|string', // Count
            'icon' => 'required|string',
        ]);

        \App\Models\Feature::create([
            'type' => 'counter',
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'icon' => $request->icon,
            'description' => $request->description, // Optional
            'order' => $request->order ?? 0,
            'is_active' => true
        ]);

        return redirect()->back()->with('success', 'Counter added successfully.');
    }

    public function updateCounter(Request $request, $id)
    {
        $feature = \App\Models\Feature::findOrFail($id);
        
        $request->validate([
            'title' => 'required|string',
            'subtitle' => 'required|string',
            'icon' => 'required|string',
        ]);

        $feature->update([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'icon' => $request->icon,
            'description' => $request->description,
            'order' => $request->order ?? 0,
        ]);

        return redirect()->back()->with('success', 'Counter updated successfully.');
    }

    public function destroyCounter($id)
    {
        \App\Models\Feature::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Counter deleted successfully.');
    }
}
