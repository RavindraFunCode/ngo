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
        return $this->translations->where('locale', $locale)->first();
    }

    public function donations()
    {
        return $this->hasMany(Donation::class);
    }
}
