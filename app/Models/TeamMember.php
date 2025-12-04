<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    protected $fillable = ['name', 'role', 'image', 'bio', 'social_links', 'order', 'is_active'];

    protected $casts = [
        'social_links' => 'array',
    ];
}
