<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Thread extends Model
{
    protected $table = 'forum_threads';

    protected $fillable = [
        'user_id', 'title', 'content',
    ];

    // Treat `content` column as `body` in the rest of the app
    public function getBodyAttribute(): ?string
    {
        return $this->attributes['content'] ?? null;
    }

    public function setBodyAttribute($value): void
    {
        $this->attributes['content'] = $value;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function replies(): HasMany
    {
        return $this->hasMany(Reply::class, 'thread_id');
    }

    public function latestReply(): HasOne
    {
        return $this->hasOne(Reply::class, 'thread_id')->latestOfMany();
    }
}
