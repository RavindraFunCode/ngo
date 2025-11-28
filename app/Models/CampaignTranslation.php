<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampaignTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'campaign_id',
        'language_id',
        'title',
        'slug',
        'short_description',
        'full_description',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }
}
