<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    use HasFactory;

    protected $table = 'posts';

    protected $fillable = ['category_id', 'slug', 'is_active', 'published_at', 'author_id', 'image'];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function translations()
    {
        return $this->hasMany(BlogPostTranslation::class, 'post_id');
    }

    public function getTranslation($locale)
    {
        return $this->translations->where('locale', $locale)->first();
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
