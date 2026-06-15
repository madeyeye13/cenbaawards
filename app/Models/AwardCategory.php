<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class AwardCategory extends Model
{
    use HasSlug;

    protected $fillable = [
        'name', 'slug', 'description',
        'icon', 'featured_image',
        'order', 'is_active',
    ];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function winners()
    {
        return $this->hasMany(Winner::class);
    }
}