<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function getGamificationStats()
    {
        $user = Auth::user();

        // Eager load the relationships to prevent N+1 query problems
        $user->load('badges', 'gamificationPoints');

        $totalPoints = $user->gamificationPoints->sum('points');

        return response()->json([
            'total_points' => $totalPoints,
            'badges' => $user->badges,
        ]);
    }
}