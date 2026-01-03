<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;
use App\Models\Language;
use Illuminate\Support\Str;
use Carbon\Carbon;

class EventsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Ensure we have English language
        $en = Language::where('code', 'en')->first();
        if (!$en) {
            $en = Language::create(['name' => 'English', 'code' => 'en', 'is_active' => true, 'is_default' => true]);
        }

        $events = [
            [
                'slug' => 'run-for-cancer-people',
                'start_date' => Carbon::now()->addDays(10),
                'end_date' => Carbon::now()->addDays(10),
                'start_time' => '09:30 AM',
                'location' => 'New Grand Street, California',
                'image' => 'events/event-1.jpg', // Placeholder, user will need to upload or we assume it exists in public
                'organizer' => 'Humanity NGO',
                'title' => 'Run for Cancer People',
                'description' => 'Join us for a charity run to support cancer patients. Every step you take helps us get closer to a cure.',
            ],
            [
                'slug' => 'providing-water-for-farmers',
                'start_date' => Carbon::now()->addDays(25),
                'end_date' => Carbon::now()->addDays(25),
                'start_time' => '10:00 AM',
                'location' => 'Tottenham Court Road, London',
                'image' => 'events/event-2.jpg',
                'organizer' => 'Global Water Aid',
                'title' => 'Providing Water for Farmers',
                'description' => 'A fundraising event to provide clean water access to farmers in drought-affected regions.',
            ],
            [
                'slug' => 'humanity-trailwalker',
                'start_date' => Carbon::now()->addMonth(),
                'end_date' => Carbon::now()->addMonth(),
                'start_time' => '08:00 AM',
                'location' => 'Grand Canyon, Arizona',
                'image' => 'events/event-3.jpg',
                'organizer' => 'Trailwalkers Inc.',
                'title' => 'Humanity Trailwalker',
                'description' => 'Challenge yourself in this 100km trail walk to raise funds for poverty alleviation.',
            ],
            [
                'slug' => 'education-for-all-gala',
                'start_date' => Carbon::now()->addMonths(2),
                'end_date' => Carbon::now()->addMonths(2),
                'start_time' => '07:00 PM',
                'location' => 'Metropolitan Hall, New York',
                'image' => 'events/event-4.jpg',
                'organizer' => 'Education Foundation',
                'title' => 'Education for All Gala',
                'description' => 'An evening of art, music, and philanthropy to support education for underprivileged children.',
            ]
        ];

        foreach ($events as $data) {
            // Check if exists
            if (Event::where('slug', $data['slug'])->exists()) {
                continue;
            }

            $event = Event::create([
                'slug' => $data['slug'],
                'start_date' => $data['start_date'],
                'end_date' => $data['end_date'],
                'start_time' => $data['start_time'],
                'location' => $data['location'],
                //'image' => $data['image'], // Commenting out image path as we don't have the files yet, or let's leave it null or use a default
                'organizer' => $data['organizer'],
                'status' => 'published',
                'is_active' => true,
                'created_by' => 1, // Assuming admin ID 1 exists
            ]);

            // Add Translation
            $event->translations()->create([
                'language_id' => $en->id,
                'title' => $data['title'],
                'description' => $data['description'],
                'meta_title' => $data['title'],
                'meta_description' => Str::limit($data['description'], 160),
            ]);
        }
    }
}
