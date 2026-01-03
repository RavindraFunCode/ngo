<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AboutPageSeeder extends Seeder
{
    public function run()
    {
        // 1. Settings
        $settings = [
            // Group: about_page
            ['key' => 'about_page_bg_image', 'value' => 'website/images/background/4.jpg', 'group' => 'about_page', 'type' => 'string'],
            ['key' => 'about_page_right_title', 'value' => 'Years of Experience', 'group' => 'about_page', 'type' => 'string'],
            ['key' => 'about_page_right_text_1', 'value' => "When you give to Our humanity, you know your donation is making a difference. Whether you are supporting one of our Signature Programs or our carefully curated list of Gifts That Give More, our professional staff works hard every day\nto ensure every dolar has impact for the cause of your choice explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system.", 'group' => 'about_page', 'type' => 'string'],
            ['key' => 'about_page_right_text_2', 'value' => 'We partner with over 320 amazing projects worldwide, and have given over $150 million in cash and product grants to other groups since 2011. We also operate our own dynamic suite of Signature Programs.', 'group' => 'about_page', 'type' => 'string'],
            ['key' => 'about_page_checklist', 'value' => "This mistaken idea of denouncing pleasure\nMaster-builder of human happiness\nOccasionally circumstances occur in toil\nUndertakes laborious physical exercise", 'group' => 'about_page', 'type' => 'string'],
            ['key' => 'about_page_counter_bg', 'value' => 'website/images/background/5.jpg', 'group' => 'about_page', 'type' => 'string'],
        ];

        foreach ($settings as $setting) {
             \App\Models\Setting::updateOrCreate(['key' => $setting['key']], $setting);
        }

        // 2. Features
        // Clear existing about page features to avoid duplicates if re-run
        \App\Models\Feature::whereIn('type', ['about_intro', 'why_choose_us', 'about_counter'])->delete();

        $features = [
            // About Intro (Left Column)
            [
                'type' => 'about_intro',
                'title' => 'Intro 1', // Hidden in view but required
                'description' => 'Idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actually teachings of the great explorer of the truth when you give to Our humanity.',
                'image' => 'website/images/resource/about6.jpg',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'type' => 'about_intro',
                'title' => 'Intro 2',
                'description' => 'When you give to Our humanity, you know your donation is making a difference. Whether you supporting one of our Signature Programs or our carefully curated list of Gifts That Give More, our professional staff.',
                'image' => 'website/images/resource/about7.jpg',
                'order' => 2,
                'is_active' => true,
            ],

            // Why Choose Us
            [
                'type' => 'why_choose_us',
                'title' => '25 Years of Experince',
                'icon' => 'icon-heart3',
                'description' => 'Actual teachings of the great explorer the truth, the master-builder of human sed happiness one dislikes, or avoids pleasure itself.',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'type' => 'why_choose_us',
                'title' => 'Good Will Volunteers',
                'icon' => 'icon-people-1',
                'description' => 'Installations are becoming more important, but if current trends continue under we seds ut should be looking to seds others solutions.',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'type' => 'why_choose_us',
                'title' => 'Most Trusted humanity',
                'icon' => 'icon-favorite',
                'description' => 'Everyone loves spend time outside with friends and family but as the temperature begins to dip out in the freezing cold.',
                'order' => 3,
                'is_active' => true,
            ],

            // About Page Counters
            [
                'type' => 'about_counter',
                'title' => 'Year Of Experience',
                'subtitle' => '30',
                'icon' => 'icon-nature-1',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'type' => 'about_counter',
                'title' => 'Successfull Projects',
                'subtitle' => '2345',
                'icon' => 'icon-ribbon',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'type' => 'about_counter',
                'title' => 'Team Members',
                'subtitle' => '347',
                'icon' => 'icon-people-1',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'type' => 'about_counter',
                'title' => 'Winning Awards',
                'subtitle' => '85',
                'icon' => 'icon-shapes',
                'order' => 4,
                'is_active' => true,
            ],
        ];

        foreach ($features as $feature) {
            \App\Models\Feature::create($feature);
        }
    }
}
