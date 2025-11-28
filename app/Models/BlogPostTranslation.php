<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogPostTranslation extends Model
{
    use HasFactory;

    protected $table = 'post_translations';

    protected $fillable = [
        'post_id',
        'locale',
        'title',
        'content',
        'excerpt',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];

    public function post()
    {
        return $this->belongsTo(BlogPost::class, 'post_id');
    }
}
