<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reply extends Model
{
    protected $table = 'forum_posts';

    protected $fillable = ['thread_id', 'user_id', 'content'];

    // Treat 'content' as 'body' in the rest of the app
    public function getBodyAttribute(): ?string
    {
        return $this->attributes['content'] ?? null;
    }

    public function setBodyAttribute($value): void
    {
        $this->attributes['content'] = $value;
    }

    public function thread(): BelongsTo
    {
        return $this->belongsTo(Thread::class, 'thread_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}