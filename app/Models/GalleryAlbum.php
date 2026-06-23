<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class GalleryAlbum extends Model
{
    use HasSlug;

    protected $fillable = ['title', 'year', 'slug', 'cover_image', 'description', 'order', 'is_active'];
    protected $casts = ['is_active' => 'boolean', 'year' => 'integer', 'order' => 'integer'];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()->generateSlugsFrom('title')->saveSlugsTo('slug');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function images(): HasMany
    {
        return $this->hasMany(GalleryImage::class)->orderBy('order');
    }

    public function getCoverUrlAttribute(): ?string
    {
        if ($this->cover_image) {
            return asset('storage/' . $this->cover_image);
        }
        // fall back to first image
        $first = $this->images()->first();
        return $first ? asset('storage/' . $first->image_path) : null;
    }
}