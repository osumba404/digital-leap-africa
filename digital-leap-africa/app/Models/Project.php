<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Project extends Model
{
    use HasFactory;
    
    protected $appends = ['image_url_full'];

    protected $fillable = [
        'title',
        'slug',
        'description',
        'github_url',
        'image_url',
    ];
    
    public function getImageUrlFullAttribute(): ?string
    {
        if (!$this->image_url) return null;
        
        if (preg_match('/^https?:\/\//i', $this->image_url)) {
            return $this->image_url;
        }
        
        if (str_starts_with($this->image_url, '/storage/')) {
            return url($this->image_url);
        }
        
        return Storage::disk('public')->url($this->image_url);
    }
}