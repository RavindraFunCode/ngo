<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Language;

class Category extends Model
{
    use HasFactory;

    protected $table = 'post_categories';

    protected $fillable = ['slug', 'is_active'];

    public function translations()
    {
        return $this->hasMany(CategoryTranslation::class);
    }

    public function getTranslation($locale)
    {
        $languageId = Language::where('code', $locale)->value('id');

        if (! $languageId) {
            return null;
        }

        return $this->translations->where('language_id', $languageId)->first();
    }

    public function posts()
    {
        return $this->hasMany(BlogPost::class);
    }

    public function getNameAttribute()
    {
        $translation = $this->getTranslation(app()->getLocale());
        return $translation ? $translation->name : null;
    }
}
