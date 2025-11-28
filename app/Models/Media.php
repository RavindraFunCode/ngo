<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Media extends Model
{
    use HasFactory;

    protected $fillable = [
        'file_name',
        'original_name',
        'disk',
        'path',
        'mime_type',
        'size',
        'alt_text',
        'uploaded_by',
    ];

    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
}
