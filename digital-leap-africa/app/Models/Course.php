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


}