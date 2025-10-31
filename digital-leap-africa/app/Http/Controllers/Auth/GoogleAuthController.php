<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            
            $user = User::where('email', $googleUser->getEmail())->first();
            $isNewUser = false;
            
            if ($user) {
                // Existing user, just log them in
                Auth::login($user);
            } else {
                // New user - create with default password
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'password' => Hash::make('@africa1'), // Default password
                    'email_verified_at' => now(),
                    'google_id' => $googleUser->getId(),
                ]);
                
                Auth::login($user);
                $isNewUser = true;
            }
            
            // Redirect new users to profile with password change message
            if ($isNewUser) {
                return redirect()->route('profile.edit')
                    ->with('google_signup', 'Welcome! Your account has been created with a temporary password: <strong>@africa1</strong> (no period). Please change your password immediately for security.');
            }
            
            return redirect(RouteServiceProvider::HOME);
            
        } catch (\Exception $e) {
            return redirect()->route('register')
                ->with('error', 'Unable to login with Google. Please try again.');
        }
    }
}