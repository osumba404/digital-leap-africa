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
        'slots',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_free' => 'boolean',
        'active' => 'boolean',
        'has_certification' => 'boolean',
        'start_date' => 'date',
        'end_date' => 'date',
        'slots' => 'integer',
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

public function users()
{
    return $this->belongsToMany(User::class, 'enrollments')
                ->withPivot('status', 'enrolled_at')
                ->withTimestamps();
}

public function enrolledUsers()
{
    return $this->users()->wherePivot('status', 'active');
}

public function getRemainingSlots()
{
    if (!$this->slots) {
        return null;
    }
    return $this->slots - $this->enrolledUsers()->count();
}

public function hasAvailableSlots()
{
    if (!$this->slots) {
        return true;
    }
    return $this->getRemainingSlots() > 0;
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