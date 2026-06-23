<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GalleryImage extends Model
{
    protected $fillable = ['gallery_album_id', 'image_path', 'caption', 'order'];
    protected $casts = ['order' => 'integer'];

    public function album(): BelongsTo
    {
        return $this->belongsTo(GalleryAlbum::class, 'gallery_album_id');
    }

    public function getUrlAttribute(): string
    {
        return asset('storage/' . $this->image_path);
    }
}