<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasSlug;

    protected $fillable = [
        'type', 'category_id', 'admin_user_id', 'title', 'slug',
        'excerpt', 'body', 'featured_image', 'status',
        'meta_title', 'meta_description', 'og_image', 'order', 'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'order' => 'integer',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    // Relationships
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(AdminUser::class, 'admin_user_id');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function approvedComments(): HasMany
    {
        return $this->hasMany(Comment::class)
            ->where('status', 'approved')
            ->whereNull('parent_id')
            ->latest();
    }

    // Scopes
    public function scopePublished($query)
    {
        return $query->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now());
    }

    public function scopeBlog($query)
    {
        return $query->where('type', 'blog');
    }

    public function scopePressRelease($query)
    {
        return $query->where('type', 'press_release');
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order')->latest('published_at');
    }

    // Helpers
    public function getReadingTimeAttribute(): int
    {
        $words = str_word_count(strip_tags($this->body));
        return max(1, (int) ceil($words / 200));
    }

    public function getFeaturedImageUrlAttribute(): ?string
    {
        return $this->featured_image ? asset('storage/' . $this->featured_image) : null;
    }

    public function getExcerptOrTrimmedAttribute(): string
    {
        return $this->excerpt ?: Str::limit(strip_tags($this->body), 160);
    }

    // Next / Previous (within same type, published)
    public function nextPost()
    {
        return static::published()->where('type', $this->type)
            ->where('published_at', '>', $this->published_at)
            ->orderBy('published_at', 'asc')->first();
    }

    public function previousPost()
    {
        return static::published()->where('type', $this->type)
            ->where('published_at', '<', $this->published_at)
            ->orderBy('published_at', 'desc')->first();
    }
}