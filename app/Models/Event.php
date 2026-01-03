<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;

    protected $fillable = [
        'slug',
        'start_date',
        'end_date',
        'start_time',
        'location',
        'image',
        'organizer',
        'status',
        'is_active',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_active' => 'boolean',
    ];

    public function translations()
    {
        return $this->hasMany(EventTranslation::class);
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

    public function getTitleAttribute()
    {
        return $this->getTranslation(app()->getLocale())?->title;
    }

    public function getDescriptionAttribute()
    {
        return $this->getTranslation(app()->getLocale())?->description;
    }
}
