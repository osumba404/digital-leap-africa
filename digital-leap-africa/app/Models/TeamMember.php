<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class TeamMember extends Model
{
    protected $fillable = [
        'name',
        'role',
        'bio',
        'image_path',
        'email',
        'facebook_url',
        'twitter_url',
        'instagram_url',
        'linkedin_url',
        'order',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer'
    ];

    protected $appends = ['image_url'];

    public function getImageUrlAttribute()
    {
        if (!$this->image_path) {
            return asset('images/default-avatar.svg');
        }
        
        // If already an absolute URL, return as is
        if (preg_match('/^https?:\/\//i', $this->image_path)) {
            return $this->image_path;
        }
        
        // If it's already a full path starting with /storage/, return as URL
        if (str_starts_with($this->image_path, '/storage/')) {
            return url($this->image_path);
        }
        
        // If it contains 'team/' already, use Storage::url for old format
        if (str_contains($this->image_path, 'team/')) {
            return Storage::disk('public')->url($this->image_path);
        }
        
        // Default: assume it's just a filename in team directory
        return url('/storage/team/' . $this->image_path);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order')->orderBy('created_at');
    }
}
