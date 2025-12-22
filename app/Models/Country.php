<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Country extends Model
{
    use HasFactory;

    protected $fillable = [
        'iso',
        'name',
        'iso3',
        'numcode',
        'phonecode',
        'currency_code',
        'currency_symbol',
        'min_phone_length',
        'max_phone_length',
        'is_active',
    ];

    public $timestamps = false;
    //
}
