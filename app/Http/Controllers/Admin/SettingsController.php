<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Services\SettingsService;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    protected $settingsService;

    public function __construct(SettingsService $settingsService)
    {
        $this->settingsService = $settingsService;
    }

    public function index()
    {
        $settings = Setting::all()->groupBy('group');
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->except('_token');

        foreach ($data as $key => $value) {
            // Determine group based on key prefix or hidden field if needed
            // For simplicity, we'll assume keys are unique or handled by service
            // But here we might need to know the group.
            // Let's assume the form sends 'group' => 'general' etc.
            // Actually, simpler: just update by key.
            
            $setting = Setting::where('key', $key)->first();
            if ($setting) {
                $this->settingsService->set($key, $value, $setting->group, $setting->type ?? 'string');
            }
        }

        return redirect()->back()->with('success', 'Settings updated successfully.');
    }
}
