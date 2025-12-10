<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaqCategoryTranslation extends Model
{
    use HasFactory;

    protected $fillable = ['faq_category_id', 'language_id', 'name', 'slug'];

    public function faqCategory()
    {
        return $this->belongsTo(FaqCategory::class);
    }
}
