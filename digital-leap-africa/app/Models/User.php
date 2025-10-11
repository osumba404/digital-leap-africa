<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $appends = ['profile_photo_url'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'profile_photo',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the enrollments for the user.
     */
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    /**
     * The gamification points records for the user.
     */
    public function gamificationPoints()
    {
        return $this->hasMany(GamificationPoint::class);
    }

    /**
     * Get the courses that the user is enrolled in.
     */
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'enrollments')
            ->withPivot(['status', 'enrolled_at', 'completed_at'])
            ->withTimestamps();
    }

    /**
     * Lessons the user has completed (lesson_user pivot).
     */
    public function lessons()
    {
        return $this->belongsToMany(Lesson::class, 'lesson_user')->withTimestamps();
    }

    /**
     * Badges/achievements earned by the user.
     */
    public function badges()
    {
        return $this->hasMany(\App\Models\Badge::class);
    }

    // Add any other methods you had before here
    // such as points(), badges(), getTotalPoints(), lessons(), getCourseProgress(), etc.

    /**
     * Total gamification points accumulated by the user.
     */
    public function getTotalPoints(): int
    {
        return (int) $this->gamificationPoints()->sum('points');
    }

    /**
     * Accessor: public URL for the user's profile photo (storage disk).
     */
    public function getProfilePhotoUrlAttribute(): ?string
    {
        if (!$this->profile_photo) {
            return null;
        }
        // If already an absolute URL, return as is
        if (preg_match('/^https?:\/\//i', $this->profile_photo)) {
            return $this->profile_photo;
        }
        // Normalize any mistakenly stored 'storage/' prefix
        $path = preg_replace('#^storage/#', '', $this->profile_photo);
        return Storage::disk('public')->url($path);
    }
}