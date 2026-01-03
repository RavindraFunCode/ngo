<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class ContactSettingsSeeder extends Seeder
{
    public function run()
    {
        $settings = [
            [
                'key' => 'contact_email',
                'value' => 'Mailus@Humanity.com',
                'group' => 'contact',
                'type' => 'string',
            ],
            [
                'key' => 'contact_phone',
                'value' => '+32 456 789012',
                'group' => 'contact',
                'type' => 'string',
            ],
            [
                'key' => 'contact_address',
                'value' => '123, New York, USA',
                'group' => 'contact',
                'type' => 'text', // Address is a textarea
            ],
            [
                'key' => 'site_tagline',
                'value' => 'Lorem ipsum dolor sit amet...',
                'group' => 'general',
                'type' => 'string',
            ]
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(['key' => $setting['key']], $setting);
        }
    }
}
