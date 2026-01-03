<?php

use App\Models\Campaign;
use App\Models\Language;
use Illuminate\Support\Str;

$language = Language::where('code', 'en')->firstOrFail();

// Campaign 1: Childrens to get their home
$campaign1 = Campaign::updateOrCreate(
    ['slug' => 'childrens-to-get-their-home'],
    [
        'status' => 'published',
        'target_amount' => 54000,
        'raised_amount' => 24000,
        'start_date' => now(),
        'is_featured' => true,
        'created_by' => 1
    ]
);

$campaign1->translations()->updateOrCreate(
    ['language_id' => $language->id],
    [
        'title' => 'Childrens to get their home',
        'slug' => 'childrens-to-get-their-home',
        'short_description' => 'Fusce et augue placerat, dictu velit sit amet, egestasuna. cras aliquam pretium ornar liquam metus. Aenean venenatis sodales...',
        'full_description' => 'Fusce et augue placerat, dictu velit sit amet, egestasuna. cras aliquam pretium ornar liquam metus. Aenean venenatis sodales...',
        'meta_title' => 'Childrens to get their home',
        'meta_description' => 'Help children get their home.'
    ]
);

// Campaign 2: We encourage girls education
$campaign2 = Campaign::updateOrCreate(
    ['slug' => 'we-encourage-girls-education'],
    [
        'status' => 'published',
        'target_amount' => 92000,
        'raised_amount' => 69000,
        'start_date' => now(),
        'is_featured' => true,
        'created_by' => 1
    ]
);

$campaign2->translations()->updateOrCreate(
    ['language_id' => $language->id],
    [
        'title' => 'We encourage girls education',
        'slug' => 'we-encourage-girls-education',
        'short_description' => 'Phasellus cursus nunc arcu, eget sollicitudin milacinia tempurs. Donec ligula turpis, egestas at volutpat no liquam...',
        'full_description' => 'Phasellus cursus nunc arcu, eget sollicitudin milacinia tempurs. Donec ligula turpis, egestas at volutpat no liquam...',
        'meta_title' => 'We encourage girls education',
        'meta_description' => 'Support girls education.'
    ]
);

echo "Campaigns seeded successfully.\n";
