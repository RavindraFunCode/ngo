<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Setting;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            ['group' => 'general', 'key' => 'site_name', 'value' => 'NGO Name', 'type' => 'string'],
            ['group' => 'general', 'key' => 'site_tagline', 'value' => 'Helping the world', 'type' => 'string'],
            ['group' => 'contact', 'key' => 'contact_email', 'value' => 'info@ngo.org', 'type' => 'string'],
            ['group' => 'contact', 'key' => 'contact_phone', 'value' => '+1234567890', 'type' => 'string'],
            ['group' => 'contact', 'key' => 'contact_address', 'value' => '123 NGO St, City, Country', 'type' => 'string'],
            ['group' => 'social', 'key' => 'social_facebook', 'value' => 'https://facebook.com/ngo', 'type' => 'string'],
            ['group' => 'social', 'key' => 'social_twitter', 'value' => 'https://twitter.com/ngo', 'type' => 'string'],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(['key' => $setting['key']], $setting);
        }
    }
}
