<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $fillable = ['slug', 'is_active', 'type'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function translations()
    {
        return $this->hasMany(PageTranslation::class);
    }

    public function getTranslation($localeOrId)
    {
        if (is_numeric($localeOrId)) {
            return $this->translations->where('language_id', $localeOrId)->first();
        }

        return $this->translations->filter(function($translation) use ($localeOrId) {
            return $translation->language && $translation->language->code === $localeOrId;
        })->first();
    }

    public function translation()
    {
        $locale = app()->getLocale();
        return $this->getTranslation($locale);
    }
}
