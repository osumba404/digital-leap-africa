<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class PasswordResetController extends Controller
{
    public function showResetForm()
    {
        return view('auth.simple-reset');
    }

    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = User::where('email', $request->email)->first();
        
        if ($user) {
            $user->update([
                'password' => Hash::make($request->password)
            ]);

            return redirect()->route('login')->with('status', 'Password has been reset successfully! You can now log in with your new password.');
        }

        return back()->withErrors(['email' => 'User not found.']);
    }
}