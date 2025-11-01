<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(20);
        return view('admin.users.index', compact('users'));
    }

    public function verify(User $user)
    {
        $user->update(['email_verified_at' => now()]);

        Notification::createNotification(
            $user->id,
            'account_verified',
            'Account Verified',
            'Your account has been verified by an administrator. You now have full access to all features.',
            route('dashboard')
        );

        return redirect()->back()->with('success', 'User verified successfully.');
    }

    public function unverify(User $user)
    {
        $user->update(['email_verified_at' => null]);

        Notification::createNotification(
            $user->id,
            'account_unverified',
            'Account Verification Removed',
            'Your account verification has been removed. Some features may be limited.',
            route('dashboard')
        );

        return redirect()->back()->with('success', 'User verification removed.');
    }
}