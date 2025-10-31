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
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_free' => 'boolean',
        'active' => 'boolean',
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