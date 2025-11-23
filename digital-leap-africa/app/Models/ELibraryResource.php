<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ELibraryResource extends Model
{
    use HasFactory;

    protected $table = 'elibrary_resources';

    protected $fillable = [
        'title',
        'slug',
        'description',
        'type',
        'file_url',
        'image_url',
    ];

    /**
     * Get the full URL for the image
     */
    public function getImageUrlAttribute($value)
    {
        if (!$value) {
            return null;
        }
        
        // If it's already a full URL, return as is
        if (preg_match('/^https?:\/\//i', $value)) {
            return $value;
        }
        
        // Convert storage path to full URL
        return Storage::disk('public')->url($value);
    }
}