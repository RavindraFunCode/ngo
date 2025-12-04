<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HomepageContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Sliders
        \App\Models\Slider::create([
            'title' => 'Helping the Poor People is the Best Humanity',
            'subtitle' => 'We\'re Humanity',
            'image' => 'sliders/1.jpg', // Assuming 1.jpg exists in sliders
            'button_text' => 'Discover More',
            'button_link' => '#',
            'order' => 1,
            'is_active' => true,
        ]);
        \App\Models\Slider::create([
            'title' => 'Hand to Make Better Life for Children',
            'subtitle' => 'We\'re Humanity',
            'image' => 'sliders/1.jpg', // Reusing for demo
            'button_text' => 'Read More',
            'button_link' => '#',
            'order' => 2,
            'is_active' => true,
        ]);

        // Team
        \App\Models\TeamMember::create([
            'name' => 'John Abraham',
            'role' => 'Manager',
            'image' => 'team/1.jpg',
            'bio' => 'Experienced manager.',
            'social_links' => ['facebook' => '#', 'twitter' => '#', 'google-plus' => '#'],
            'order' => 1,
            'is_active' => true,
        ]);
        \App\Models\TeamMember::create([
            'name' => 'Jane Doe',
            'role' => 'Volunteer',
            'image' => 'team/2.jpg',
            'bio' => 'Dedicated volunteer.',
            'social_links' => ['facebook' => '#', 'twitter' => '#'],
            'order' => 2,
            'is_active' => true,
        ]);

        // Testimonials
        \App\Models\Testimonial::create([
            'name' => 'Michale John',
            'role' => 'Manager',
            'image' => 'testimonials/1.jpg',
            'content' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.',
            'is_active' => true,
        ]);
        \App\Models\Testimonial::create([
            'name' => 'Sarah Smith',
            'role' => 'Donor',
            'image' => 'testimonials/2.jpg',
            'content' => 'The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters.',
            'is_active' => true,
        ]);

        // Partners
        \App\Models\Partner::create([
            'name' => 'Partner 1',
            'logo' => 'partners/1.jpg',
            'url' => '#',
            'order' => 1,
        ]);
        \App\Models\Partner::create([
            'name' => 'Partner 2',
            'logo' => 'partners/2.jpg',
            'url' => '#',
            'order' => 2,
        ]);

        // Gallery
        \App\Models\GalleryItem::create([
            'title' => 'Child Support',
            'image' => 'gallery/1.jpg',
            'category' => 'child',
            'is_active' => true,
        ]);
        \App\Models\GalleryItem::create([
            'title' => 'Charity Event',
            'image' => 'gallery/2.jpg',
            'category' => 'charity',
            'is_active' => true,
        ]);
        \App\Models\GalleryItem::create([
            'title' => 'Volunteering',
            'image' => 'gallery/3.jpg',
            'category' => 'volunteering',
            'is_active' => true,
        ]);
    }
}
