<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;

    protected $fillable = ['is_active', 'order', 'faq_category_id'];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
        'faq_category_id' => 'integer',
    ];

    public function category()
    {
        return $this->belongsTo(FaqCategory::class, 'faq_category_id');
    }

    public function translations()
    {
        return $this->hasMany(FaqTranslation::class);
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
