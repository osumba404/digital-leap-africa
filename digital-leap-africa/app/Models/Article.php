<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;

class Article extends Model
{
    use HasFactory;

    // Mass assignable attributes
    protected $fillable = [
        'title',
        'slug',
        'content',
        'excerpt',
        'featured_image',
        'published_at',
        'status',
        'author_id',
        'tags',
        'likes_count',
        'bookmarks_count',
        'shares_count',
    ];

    // Cast timestamps
    protected $dates = [
        'published_at',
        'created_at',
        'updated_at',
    ];

    // Casts
    protected $casts = [
        'tags' => 'array',
        'likes_count' => 'integer',
        'bookmarks_count' => 'integer',
        'shares_count' => 'integer',
    ];

    // Scopes
    public function scopePublished(Builder $query): void
    {
        $query->where('status', 'published')
              ->where('published_at', '<=', now());
    }

    public function scopeWithTag(Builder $query, ?string $tag): Builder
    {
        if (!$tag) { return $query; }
        return $query->whereJsonContains('tags', $tag);
    }

    // Relationships
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // Accessors
    public function getFeaturedImageUrlAttribute()
    {
        return $this->featured_image ? Storage::url($this->featured_image) : null;
    }
}