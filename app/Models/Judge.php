<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Judge extends Model
{
    protected $fillable = [
        'name', 'title', 'organization',
        'location', 'bio', 'photo',
        'linkedin', 'order', 'is_active',
    ];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }
}