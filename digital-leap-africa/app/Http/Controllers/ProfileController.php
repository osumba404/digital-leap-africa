<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Services\GamificationService;
use App\Traits\HasWebPImages;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    use HasWebPImages;
    /**
     * Display a user's profile.
     */
    public function show(\App\Models\User $user): View
    {
        return view('profile.public', [
            'user' => $user,
        ]);
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = $request->user()->load([
            'courses' => function ($q) {
                $q->withPivot(['status', 'enrolled_at', 'completed_at']);
            },
            'badges',
            'gamificationPoints',
        ]);

        $gamification = new GamificationService();
        
        // Award daily login points
        $gamification->awardPoints($user, 'daily_login');

        return view('profile.edit', [
            'user' => $user,
            'totalPoints' => $gamification->getUserPoints($user),
            'userLevel' => $gamification->getUserLevel($user),
            'isOwner' => true,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $validated = $request->validated();

        if ($request->hasFile('profile_photo')) {
            // Delete old profile photo if exists
            if ($user->profile_photo) {
                Storage::disk('public')->delete($user->profile_photo);
            }
            
            // Convert and store as WebP
            $imagePath = $this->storeWebPImage($request->file('profile_photo'), 'profile-photos');
            $validated['profile_photo'] = $imagePath;
        }

        $user->fill($validated);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
