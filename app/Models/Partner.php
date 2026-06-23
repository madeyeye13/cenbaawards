<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    protected $fillable = ['name', 'logo', 'website', 'description', 'order', 'is_active'];
    protected $casts = ['is_active' => 'boolean', 'order' => 'integer'];

    public function getLogoUrlAttribute(): ?string
    {
        return $this->logo ? asset('storage/' . $this->logo) : null;
    }
}