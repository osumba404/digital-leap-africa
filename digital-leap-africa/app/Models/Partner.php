<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Partner extends Model
{
    protected $fillable = [
        'name',
        'contact_person',
        'email',
        'phone',
        'logo_path',
        'website_url',
        'order',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer'
    ];

    protected $appends = ['logo_url'];

    public function getLogoUrlAttribute()
    {
        if (!$this->logo_path) {
            return null;
        }
        // If already starts with /storage/, return as URL
        if (str_starts_with($this->logo_path, '/storage/')) {
            return url($this->logo_path);
        }
        // Otherwise use Storage::url for old format
        return Storage::url($this->logo_path);
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
