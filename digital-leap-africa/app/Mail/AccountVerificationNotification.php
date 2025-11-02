<?php

namespace App\Mail;

use App\Models\User;

class AccountVerificationNotification extends BaseNotification
{
    public function __construct(User $user, $verified = true)
    {
        if ($verified) {
            parent::__construct(
                $user,
                'Account Verified',
                'Congratulations! Your account has been verified by our team. You now have full access to all Digital Leap Africa features.',
                route('dashboard'),
                'Go to Dashboard'
            );
        } else {
            parent::__construct(
                $user,
                'Account Verification Update',
                'Your account verification status has been updated. Some features may be limited until re-verification.',
                route('dashboard'),
                'Go to Dashboard'
            );
        }
    }
}