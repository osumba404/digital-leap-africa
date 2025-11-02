<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\EmailNotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class PasswordResetController extends Controller
{

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        
        $status = Password::sendResetLink($request->only('email'));
        
        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', 'If your email is registered with us, you will receive a password reset link shortly.')
            : back()->with('status', 'If your email is registered with us, you will receive a password reset link shortly.');
    }

    public function showResetPasswordForm(Request $request, $token = null)
    {
        return view('auth.reset-password', ['token' => $token, 'email' => $request->email]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $passwordReset = \DB::table('password_resets')
            ->where('email', $request->email)
            ->first();

        if (!$passwordReset || !Hash::check($request->token, $passwordReset->token)) {
            return back()->withErrors(['email' => 'This password reset token is invalid.']);
        }

        $user = User::where('email', $request->email)->first();
        
        if (!$user) {
            return back()->withErrors(['email' => 'We can\'t find a user with that email address.']);
        }

        $user->update(['password' => Hash::make($request->password)]);
        
        // Delete the token
        \DB::table('password_resets')->where('email', $request->email)->delete();

        return redirect()->route('login')->with('status', 'Your password has been reset successfully!');
    }


}