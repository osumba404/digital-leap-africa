<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Schema;

class LeaderboardController extends Controller
{
    public function index(Request $request): View
    {
        $period = $request->query('period', 'all');
        
        // Get users with their total gamification points
        $query = User::query()
            ->withSum('gamificationPoints', 'points')
            ->having('gamification_points_sum_points', '>', 0)
            ->orderByDesc('gamification_points_sum_points');
            
        // Apply time period filter if needed
        if ($period === '7') {
            $query->where('updated_at', '>=', now()->subDays(7));
        } elseif ($period === '30') {
            $query->where('updated_at', '>=', now()->subDays(30));
        }
        
        $topUsers = $query->take(10)->get();
        
        // Calculate user rank and points to next level
        $userRank = 1;
        $pointsToNext = 10;
        
        if (auth()->check()) {
            $userPoints = auth()->user()->getTotalPoints();
            $userRank = User::withSum('gamificationPoints', 'points')
                ->having('gamification_points_sum_points', '>', $userPoints)
                ->count() + 1;
            
            // Calculate points to next level based on current points
            $currentLevel = $this->calculateLevel($userPoints);
            $nextLevelPoints = $this->getLevelPoints($currentLevel + 1);
            $pointsToNext = max(0, $nextLevelPoints - $userPoints);
        }
        
        return view('leaderboard', compact('topUsers', 'period', 'userRank', 'pointsToNext'));
    }
    
    private function getLevelPoints(int $level): int
    {
        $levels = [
            1 => 0,
            2 => 100,
            3 => 250,
            4 => 500,
            5 => 1000,
            6 => 2000,
            7 => 3500,
            8 => 5000,
            9 => 7500,
            10 => 10000
        ];
        
        return $levels[$level] ?? 10000; // Max level is 10
    }
    
    private function calculateLevel(int $points): int
    {
        if ($points >= 10000) return 10;
        if ($points >= 7500) return 9;
        if ($points >= 5000) return 8;
        if ($points >= 3500) return 7;
        if ($points >= 2000) return 6;
        if ($points >= 1000) return 5;
        if ($points >= 500) return 4;
        if ($points >= 250) return 3;
        if ($points >= 100) return 2;
        return 1;
    }
}