<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FaqCategory;
use App\Models\Faq;
use App\Models\Language;
use Illuminate\Support\Str;

class FaqCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $english = Language::where('code', 'en')->first();
        if (!$english) {
            $english = Language::create(['name' => 'English', 'code' => 'en', 'is_active' => true, 'is_default' => true]);
        }

        $categories = [
            'About humanity',
            'Become a Volunteer',
            'How Can You Help?',
            'Safety & Privacy',
            'Customer Insights',
        ];

        foreach ($categories as $index => $name) {
            $category = FaqCategory::create([
                'is_active' => true,
                'order' => $index,
            ]);

            $category->translations()->create([
                'language_id' => $english->id,
                'name' => $name,
                'slug' => Str::slug($name),
            ]);
        }

        // Randomly assign FAQs to categories
        $activeCategories = FaqCategory::all();
        if ($activeCategories->count() > 0) {
            $faqs = Faq::all();
            foreach ($faqs as $faq) {
                $faq->update(['faq_category_id' => $activeCategories->random()->id]);
            }
        }
    }
}
