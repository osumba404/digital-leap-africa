<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Course extends Model
{
    use HasFactory;
    
    protected $appends = ['image_url_full'];

    protected $fillable = [
        'title',
        'slug',
        'description',
        'instructor',
        'image_url',
        'is_free',
        'price',
        'active',
        'course_type',
        'duration_weeks',
        'start_date',
        'end_date',
        'has_certification',
        'certificate_title',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_free' => 'boolean',
        'active' => 'boolean',
        'has_certification' => 'boolean',
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function topics()
{
    // Order topics by their 'order' column by default
    return $this->hasMany(Topic::class)->orderBy('order');
}

public function lessons()
{
    return $this->hasManyThrough(Lesson::class, Topic::class);
}

public function payments()
{
    return $this->hasMany(Payment::class);
}

public function certificates()
{
    return $this->hasMany(Certificate::class);
}

public function getImageUrlFullAttribute(): ?string
{
    if (!$this->image_url) {
        return null;
    }
    
    if (preg_match('/^https?:\/\//i', $this->image_url)) {
        return $this->image_url;
    }
    
    if (str_starts_with($this->image_url, '/storage/')) {
        return url($this->image_url);
    }
    
    return Storage::disk('public')->url($this->image_url);
}

}