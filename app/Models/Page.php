<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $fillable = ['slug', 'is_active', 'template'];

    public function translations()
    {
        return $this->hasMany(PageTranslation::class);
    }

    public function getTranslation($locale)
    {
        return $this->translations->where('locale', $locale)->first();
    }
}
