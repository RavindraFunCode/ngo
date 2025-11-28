<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        return $this->translations->where('locale', $locale)->first();
    }

    public function posts()
    {
        return $this->hasMany(BlogPost::class);
    }
}
