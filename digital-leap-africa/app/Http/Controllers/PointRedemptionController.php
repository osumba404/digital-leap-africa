<?php

namespace App\Http\Controllers;

use App\Services\GamificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PointRedemptionController extends Controller
{
    private $gamification;

    public function __construct()
    {
        $this->gamification = new GamificationService();
    }

    public function index()
    {
        $user = Auth::user();
        $userPoints = $this->gamification->getUserPoints($user);
        $userLevel = $this->gamification->getUserLevel($user);

        $rewards = [
            'premium_courses' => ['cost' => 500, 'name' => 'Premium Course Access', 'description' => 'Unlock advanced courses'],
            'profile_customization' => ['cost' => 100, 'name' => 'Profile Customization', 'description' => 'Custom profile themes'],
            'forum_privileges' => ['cost' => 250, 'name' => 'Forum Privileges', 'description' => 'Create polls and pin posts'],
            'job_priority' => ['cost' => 300, 'name' => 'Job Board Priority', 'description' => 'Featured job applications'],
            'mentorship' => ['cost' => 500, 'name' => 'Mentorship Access', 'description' => 'Connect with mentors'],
            'certification' => ['cost' => 1000, 'name' => 'Certification Exam', 'description' => 'Take certification exams'],
        ];

        return view('points.index', compact('userPoints', 'userLevel', 'rewards'));
    }

    public function redeem(Request $request)
    {
        $request->validate([
            'reward_type' => 'required|string',
        ]);

        $user = Auth::user();
        $rewardType = $request->reward_type;

        $costs = [
            'premium_courses' => 500,
            'profile_customization' => 100,
            'forum_privileges' => 250,
            'job_priority' => 300,
            'mentorship' => 500,
            'certification' => 1000,
        ];

        if (!isset($costs[$rewardType])) {
            return back()->with('error', 'Invalid reward type.');
        }

        $cost = $costs[$rewardType];

        if (!$this->gamification->canAfford($user, $cost)) {
            return back()->with('error', 'Insufficient points for this reward.');
        }

        if ($this->gamification->spendPoints($user, $cost, "Redeemed: " . str_replace('_', ' ', $rewardType))) {
            return back()->with('success', 'Reward redeemed successfully!');
        }

        return back()->with('error', 'Failed to redeem reward.');
    }
}