<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    protected $fillable = ['name', 'role', 'email', 'phone', 'image', 'bio', 'social_links', 'order', 'is_active'];

    protected $casts = [
        'social_links' => 'array',
        'is_active' => 'boolean',
    ];
}
