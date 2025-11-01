<?php

namespace App\Services;

use App\Models\User;
use App\Models\Badge;
use App\Models\GamificationPoint;
use App\Models\Notification;

class GamificationService
{
    const POINTS = [
        'lesson_complete' => 50,
        'course_complete' => 200,
        'forum_post' => 10,
        'forum_reply' => 5,
        'testimonial' => 25,
        'profile_complete' => 100,
        'daily_login' => 5,
        'course_enroll' => 20,
    ];

    const LEVELS = [
        'Beginner' => 0,
        'Learner' => 500,
        'Contributor' => 1000,
        'Expert' => 2500,
        'Master' => 5000,
    ];

    public function awardPoints(User $user, string $action, string $reason = null)
    {
        if (!isset(self::POINTS[$action])) {
            return false;
        }

        $points = self::POINTS[$action];
        
        if ($action === 'daily_login') {
            $today = now()->format('Y-m-d');
            $existingLogin = GamificationPoint::where('user_id', $user->id)
                ->where('reason', 'Daily Login')
                ->whereDate('created_at', $today)
                ->exists();
            
            if ($existingLogin) {
                return false;
            }
        }

        GamificationPoint::create([
            'user_id' => $user->id,
            'points' => $points,
            'reason' => $reason ?: ucwords(str_replace('_', ' ', $action)),
        ]);

        $this->checkBadgeEligibility($user);
        return true;
    }

    public function getUserLevel(User $user): string
    {
        $totalPoints = $user->gamificationPoints()->sum('points');
        
        $level = 'Beginner';
        foreach (self::LEVELS as $levelName => $requiredPoints) {
            if ($totalPoints >= $requiredPoints) {
                $level = $levelName;
            }
        }
        
        return $level;
    }

    public function getUserPoints(User $user): int
    {
        return $user->gamificationPoints()->sum('points');
    }

    public function canAfford(User $user, int $cost): bool
    {
        return $this->getUserPoints($user) >= $cost;
    }

    public function spendPoints(User $user, int $cost, string $reason): bool
    {
        if (!$this->canAfford($user, $cost)) {
            return false;
        }

        GamificationPoint::create([
            'user_id' => $user->id,
            'points' => -$cost,
            'reason' => $reason,
        ]);

        return true;
    }

    private function checkBadgeEligibility(User $user)
    {
        $totalPoints = $this->getUserPoints($user);
        $completedLessons = $user->lessons()->count();
        $completedCourses = $user->courses()->wherePivot('status', 'completed')->count();

        $badgesToCheck = [
            'First Steps' => $totalPoints >= 100,
            'Lesson Master' => $completedLessons >= 10,
            'Course Completer' => $completedCourses >= 1,
            'Dedicated Learner' => $completedCourses >= 5,
            'Point Collector' => $totalPoints >= 500,
            'Expert Learner' => $totalPoints >= 1000,
        ];

        foreach ($badgesToCheck as $badgeName => $condition) {
            if ($condition && !$user->badges()->where('badge_name', $badgeName)->exists()) {
                $this->awardBadge($user, $badgeName);
            }
        }
    }

    private function awardBadge(User $user, string $badgeName)
    {
        $badge = Badge::firstOrCreate(['badge_name' => $badgeName]);
        
        if (!$user->badges()->where('badge_id', $badge->id)->exists()) {
            $user->badges()->attach($badge->id, ['awarded_at' => now()]);
            
            try {
                Notification::create([
                    'user_id' => $user->id,
                    'type' => 'badge_earned',
                    'title' => 'New Badge Earned!',
                    'message' => "Congratulations! You've earned the {$badgeName} badge.",
                    'url' => route('profile.edit'),
                    'is_read' => false,
                ]);
            } catch (\Exception $e) {
                // Graceful fallback
            }
        }
    }
}