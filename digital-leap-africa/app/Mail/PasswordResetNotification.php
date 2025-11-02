<?php

namespace App\Mail;

use App\Models\User;

class PasswordResetNotification extends BaseNotification
{
    public $token;

    public function __construct(User $user, $token)
    {
        $this->token = $token;
        
        $resetUrl = url(route('password.reset', [
            'token' => $token,
            'email' => $user->email,
        ], false));
        
        parent::__construct(
            $user,
            'Reset Your Password',
            "You are receiving this email because we received a password reset request for your account. Click the button below to reset your password. This link will expire in 60 minutes.",
            $resetUrl,
            'Reset Password'
        );
    }
}