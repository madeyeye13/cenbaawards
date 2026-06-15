<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AwardCriteria extends Model
{
    protected $fillable = ['title', 'description', 'order', 'is_active'];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }
}