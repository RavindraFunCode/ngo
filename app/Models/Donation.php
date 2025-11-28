<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    protected $fillable = [
        'campaign_id',
        'user_id',
        'amount',
        'currency',
        'status',
        'payment_gateway',
        'transaction_id',
        'payment_reference',
        'payment_details',
        'donor_name',
        'donor_email',
        'donor_phone',
        'donor_address',
        'is_anonymous',
        'paid_at',
    ];

    protected $casts = [
        'payment_details' => 'array',
        'paid_at' => 'datetime',
        'is_anonymous' => 'boolean',
    ];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }
}
