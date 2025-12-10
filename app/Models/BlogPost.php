<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Language;

class BlogPost extends Model
{
    use HasFactory;

    protected $table = 'posts';

    protected $fillable = ['category_id', 'slug', 'status', 'published_at', 'author_id', 'featured_image'];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function translations()
    {
        return $this->hasMany(BlogPostTranslation::class, 'post_id');
    }

    public function getTranslation($locale)
    {
        $languageId = Language::where('code', $locale)->value('id');

        if (! $languageId) {
            return null;
        }

        return $this->translations->where('language_id', $languageId)->first();
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function getTitleAttribute()
    {
        $translation = $this->getTranslation(app()->getLocale());
        return $translation ? $translation->title : null;
    }

    public function getContentAttribute()
    {
        $translation = $this->getTranslation(app()->getLocale());
        return $translation ? $translation->content : null;
    }

    public function getImageUrlAttribute()
    {
        return $this->featured_image ? asset('uploads/' . $this->featured_image) : asset('website/images/blog/1.jpg');
    }
}
