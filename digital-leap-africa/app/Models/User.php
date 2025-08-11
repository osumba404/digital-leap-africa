<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

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
     * The courses that the user is enrolled in.
     */
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_enrollments')->withTimestamps();
    }

    /**
     * The points records for the user.
     */
    public function points()
    {
        return $this->hasMany(GamificationPoint::class);
    }

    /**
     * The badges awarded to the user.
     */
    public function badges()
    {
        return $this->hasMany(Badge::class);
    }

    /**
     * NEW: Calculate the user's total points.
     */
    public function getTotalPoints(): int
    {
        // This sums up the 'points' column from all related records
        return $this->points()->sum('points');
    }
}