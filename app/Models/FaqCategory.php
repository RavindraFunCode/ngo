<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaqCategory extends Model
{
    use HasFactory;

    protected $fillable = ['is_active', 'order'];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    public function translations()
    {
        return $this->hasMany(FaqCategoryTranslation::class);
    }

    public function faqs()
    {
        return $this->hasMany(Faq::class);
    }

    public function getTranslation($locale)
    {
        static $languages;
        if (!$languages) {
            $languages = \App\Models\Language::all()->pluck('id', 'code');
        }

        $languageId = $languages[$locale] ?? null;
        if (!$languageId) return null;

        return $this->translations->where('language_id', $languageId)->first();
    }
}
