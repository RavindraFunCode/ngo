<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeamMemberSeeder extends Seeder
{
    public function run()
    {
        // Clear existing members
        \App\Models\TeamMember::truncate();

        $members = [
            [
                'name' => 'Felicity BNovak',
                'role' => 'CEO & Founder',
                'email' => 'Felicity@Experts.com',
                'phone' => '+123-456-7890',
                'image' => 'website/images/team/t1.jpg',
                'order' => 1,
                'is_active' => true,
                'social_links' => [
                    'facebook' => 'https://facebook.com',
                    'twitter' => 'https://twitter.com',
                    'google-plus' => 'https://plus.google.com',
                ]
            ],
            [
                'name' => 'Mark Richarson',
                'role' => 'Board of Trustee',
                'email' => 'Mark@Experts.com',
                'phone' => '+123-456-7890',
                'image' => 'website/images/team/t2.jpg',
                'order' => 2,
                'is_active' => true,
                'social_links' => [
                    'facebook' => 'https://facebook.com',
                    'twitter' => 'https://twitter.com',
                    'linkedin' => 'https://linkedin.com',
                ]
            ],
            [
                'name' => 'Jom Caraleno',
                'role' => 'Board of Trustee',
                'email' => 'Jom@Experts.com',
                'phone' => '+123-456-7890',
                'image' => 'website/images/team/t3.jpg',
                'order' => 3,
                'is_active' => true,
                'social_links' => [
                    'facebook' => 'https://facebook.com',
                    'twitter' => 'https://twitter.com',
                     'google-plus' => 'https://plus.google.com',
                ]
            ],
            [
                'name' => 'Asahtan Marsh',
                'role' => 'Board of Advisor',
                'email' => 'Asahtan@Experts.com',
                'phone' => '+123-456-7890',
                'image' => 'website/images/team/t4.jpg',
                'order' => 4,
                'is_active' => true,
                'social_links' => [
                    'facebook' => 'https://facebook.com',
                    'linkedin' => 'https://linkedin.com',
                ]
            ],
        ];

        foreach ($members as $member) {
            \App\Models\TeamMember::create($member);
        }
    }
}
