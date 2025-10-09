<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'location',
        'date',
        'description',
        'registration_url',
        'image_path',
    ];

    protected $casts = [
        'date' => 'datetime',
    ];

    // Convenience accessor to always get a usable image URL (could return a default)
    public function getImageUrlAttribute(): ?string
    {
        return $this->image_path ?: null;
    }

    // Example scopes (optional)
    public function scopeUpcoming($query)
    {
        return $query->where('date', '>=', now())->orderBy('date', 'asc');
    }

    public function scopePast($query)
    {
        return $query->where('date', '<', now())->orderBy('date', 'desc');
    }
}