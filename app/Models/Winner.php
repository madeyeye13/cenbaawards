<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Winner extends Model
{
    protected $fillable = [
        'award_category_id', 'name', 'company',
        'photo', 'description', 'year',
        'order', 'is_active',
    ];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    public function awardCategory()
    {
        return $this->belongsTo(AwardCategory::class);
    }

     public function getPhotoUrlAttribute(): ?string
    {
        return $this->photo ? asset('storage/' . $this->photo) : null;
    }
}