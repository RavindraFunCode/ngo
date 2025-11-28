<?php

namespace App\Services;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

class SettingsService
{
    public function get(string $key, $default = null)
    {
        $settings = Cache::rememberForever('settings', function () {
            return Setting::all()->pluck('value', 'key');
        });

        return $settings->get($key, $default);
    }

    public function set(string $key, $value, string $group = 'general', string $type = 'string')
    {
        Setting::updateOrCreate(
            ['key' => $key],
            [
                'value' => $value,
                'group' => $group,
                'type' => $type,
            ]
        );

        Cache::forget('settings');
    }

    public function all()
    {
        return Cache::rememberForever('settings', function () {
            return Setting::all()->pluck('value', 'key');
        });
    }
}
