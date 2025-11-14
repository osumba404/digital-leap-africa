<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class AboutSection extends Model
{
    protected $fillable = [
        'section_type',
        'mini_title',
        'title',
        'content',
        'image_path',
        'read_more_url',
        'bullet_points',
        'order',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
        'bullet_points' => 'array'
    ];

    public function getImageUrlAttribute()
    {
        if (!$this->image_path) {
            return null;
        }
        // If already starts with /storage/, return as URL
        if (str_starts_with($this->image_path, '/storage/')) {
            return url($this->image_path);
        }
        // If it contains 'about/' already, use Storage::url for old format
        if (str_contains($this->image_path, 'about/')) {
            return Storage::disk('public')->url($this->image_path);
        }
        // Default: assume it's just a filename in about directory
        return url('/storage/about/' . $this->image_path);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeType($query, $type)
    {
        return $query->where('section_type', $type);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order')->orderBy('created_at');
    }
}
