<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'location',
        'topic',
        'date',
        'ends_at',
        'description',
        'registration_url',
        'image_path',
    ];

    protected $casts = [
        'date' => 'datetime',
        'ends_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function (self $event) {
            if (empty($event->slug) && !empty($event->title)) {
                $event->slug = static::generateUniqueSlug($event->title);
            }
        });

        static::updating(function (self $event) {
            // If slug is empty (edge cases), regenerate from title
            if (empty($event->slug) && !empty($event->title)) {
                $event->slug = static::generateUniqueSlug($event->title, $event->id);
            }
        });
    }

    protected static function generateUniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $base = Str::slug($title);
        $slug = $base;
        $i = 1;
        while (static::query()
            ->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))
            ->where('slug', $slug)
            ->exists()) {
            $slug = $base . '-' . $i++;
        }
        return $slug;
    }

    // Convenience accessor to always get a usable image URL
    public function getImageUrlAttribute(): ?string
    {
        if (!$this->image_path) return null;
        
        if (preg_match('/^https?:\/\//i', $this->image_path)) {
            return $this->image_path;
        }
        
        if (str_starts_with($this->image_path, '/storage/')) {
            return url($this->image_path);
        }
        
        return Storage::disk('public')->url($this->image_path);
    }

    // Example scopes (optional)
    public function scopeUpcoming($query)
    {
        // Upcoming: starts in the future
        return $query->where('date', '>', now())->orderBy('date', 'asc');
    }

    public function scopePast($query)
    {
        // Past: already ended (use ends_at if set, else date)
        return $query->whereRaw('COALESCE(ends_at, date) < ?', [now()])->orderBy('date', 'desc');
    }
}