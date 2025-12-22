<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Volunteer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'nationality',
        'gender',
        'age_group',
        'interest_areas',
        'experience',
        'availability',
        'notes',
        'status',
    ];

    protected $casts = [
        'interest_areas' => 'array',
    ];
}
