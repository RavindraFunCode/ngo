<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'status',
        'target_amount',
        'raised_amount',
        'currency',
        'start_date',
        'end_date',
        'featured_image',
        'is_featured',
        'created_by',
        'updated_by'
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'is_featured' => 'boolean',
    ];

    public function translations()
    {
        return $this->hasMany(CampaignTranslation::class);
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

    public function donations()
    {
        return $this->hasMany(Donation::class);
    }

    public function getRaisedPercentAttribute()
    {
        if ($this->target_amount > 0) {
            return round(($this->raised_amount / $this->target_amount) * 100);
        }
        return 0;
    }

    public function getImageAttribute()
    {
        return $this->featured_image;
    }

    public function getGoalAmountAttribute()
    {
        return $this->target_amount;
    }

    public function getTitleAttribute()
    {
        return $this->getTranslation(app()->getLocale())?->title;
    }

    public function getDescriptionAttribute()
    {
        return $this->getTranslation(app()->getLocale())?->short_description ?? $this->getTranslation(app()->getLocale())?->full_description;
    }
}
