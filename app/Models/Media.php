<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $table = 'media';

    protected $fillable = [
        'media_folder_id',
        'name',
        'file_name',
        'path',
        'thumbnail_path',
        'mime_type',
        'extension',
        'size',
        'width',
        'height',
        'alt',
    ];

    protected function casts(): array
    {
        return [
            'size' => 'integer',
            'width' => 'integer',
            'height' => 'integer',
        ];
    }

    public function folder()
    {
        return $this->belongsTo(MediaFolder::class, 'media_folder_id');
    }

    public function getUrlAttribute(): string
    {
        return asset('storage/' . $this->path);
    }

    public function getThumbnailUrlAttribute(): string
    {
        return $this->thumbnail_path
            ? asset('storage/' . $this->thumbnail_path)
            : asset('storage/' . $this->path);
    }

    public function getFormattedSizeAttribute(): string
    {
        $bytes = $this->size;
        if ($bytes >= 1048576) return round($bytes / 1048576, 2) . ' MB';
        if ($bytes >= 1024) return round($bytes / 1024, 2) . ' KB';
        return $bytes . ' B';
    }
}