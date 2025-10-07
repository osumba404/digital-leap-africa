<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'excerpt',
        'featured_image',
        'published_at',
        'status',
        'author_id',
    ];

    protected $dates = [
        'published_at',
        'created_at',
        'updated_at',
    ];

    /**
     * Scope a query to only include published articles.
     */
    public function scopePublished(Builder $query): void
    {
        $query->where('status', 'published')
              ->where('published_at', '<=', now());
    }

    /**
     * Get the author that owns the article.
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * Get the comments for the article.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}