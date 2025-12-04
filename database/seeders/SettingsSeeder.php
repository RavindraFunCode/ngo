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

            // Homepage - About
            ['key' => 'home_about_title', 'value' => 'About Our Humanity', 'group' => 'home'],
            ['key' => 'home_about_text', 'value' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'group' => 'home'],
            ['key' => 'home_about_image_1', 'value' => 'website/img/about/1.jpg', 'group' => 'home'],
            ['key' => 'home_about_image_2', 'value' => 'website/img/about/2.jpg', 'group' => 'home'],

            // Homepage - Facts
            ['key' => 'count_team', 'value' => '50', 'group' => 'home'],
            ['key' => 'count_awards', 'value' => '12', 'group' => 'home'],
            ['key' => 'count_experienced', 'value' => '10', 'group' => 'home'],
            ['key' => 'count_projects', 'value' => '150', 'group' => 'home'],

            // Homepage - CTA
            ['key' => 'home_cta_text', 'value' => 'Lets Change The World With Humanity', 'group' => 'home'],
            ['key' => 'home_cta_btn_text', 'value' => 'Become A Volunteer', 'group' => 'home'],
            ['key' => 'home_cta_btn_link', 'value' => '/volunteer', 'group' => 'home'],
            ['group' => 'social', 'key' => 'social_facebook', 'value' => 'https://facebook.com/ngo', 'type' => 'string'],
            ['group' => 'social', 'key' => 'social_twitter', 'value' => 'https://twitter.com/ngo', 'type' => 'string'],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(['key' => $setting['key']], $setting);
        }
    }
}
