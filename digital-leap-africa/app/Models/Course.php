<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

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
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_free' => 'boolean',
        'active' => 'boolean',
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


}