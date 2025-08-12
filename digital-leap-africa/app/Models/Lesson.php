<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;
    protected $fillable = ['topic_id', 'title', 'type', 'content', 'video_url', 'resource_url', 'order'];

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    public function users()
{
    return $this->belongsToMany(User::class, 'lesson_user')->withTimestamps();
}

}