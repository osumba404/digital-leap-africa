<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class EmailNotificationService
{
    public static function sendNotification($type, $user, $data = [])
    {
        try {
            $subject = self::getSubject($type, $data);
            $content = self::getContent($type, $user, $data);
            
            Mail::raw($content, function ($message) use ($user, $subject) {
                $message->to($user->email, $user->name)
                        ->subject($subject)
                        ->from(config('mail.from.address'), config('mail.from.name'));
            });
            
            Log::info('Email sent', ['type' => $type, 'email' => $user->email]);
        } catch (\Exception $e) {
            Log::error("Failed to send email ({$type}) to {$user->email}: " . $e->getMessage());
        }
    }

    private static function getSubject($type, $data)
    {
        return match($type) {
            'course_enrollment' => 'Course Enrollment - Digital Leap Africa',
            'course_enrollment_approved' => 'Course Approved - Digital Leap Africa',
            'course_enrollment_rejected' => 'Course Update - Digital Leap Africa',
            'account_verified' => 'Account Verified - Digital Leap Africa',
            'lesson_completed' => 'Lesson Completed - Digital Leap Africa',
            'course_completed' => 'Course Completed - Digital Leap Africa',
            'payment_success' => 'Payment Successful - Digital Leap Africa',
            'password_reset' => 'Password Reset - Digital Leap Africa',
            default => $data['title'] ?? 'Notification - Digital Leap Africa'
        };
    }

    private static function getContent($type, $user, $data)
    {
        $greeting = "Hello {$user->name},\n\n";
        $footer = "\n\nBest regards,\nDigital Leap Africa Team";
        
        $body = match($type) {
            'course_enrollment' => "You have enrolled in: {$data['course']->title}\n\nStart learning now!",
            'course_enrollment_approved' => "Your enrollment for '{$data['course']->title}' has been approved!\n\nYou can now access the course.",
            'course_enrollment_rejected' => "Your enrollment for '{$data['course']->title}' was not approved.\n\nPlease contact support.",
            'account_verified' => "Your account has been verified!\n\nYou now have access to premium features.",
            'lesson_completed' => "Congratulations! You completed: {$data['lesson']->title}\n\nKeep up the great work!",
            'course_completed' => "Congratulations! You completed: {$data['course']->title}\n\nYour certificate is ready.",
            'payment_success' => "Payment successful!\n\nTransaction: {$data['payment']->transaction_id}",
            'password_reset' => "Reset your password: {$data['url']}\n\nIgnore if you didn't request this.",
            default => $data['message'] ?? 'You have a new notification.'
        };
        
        return $greeting . $body . $footer;
    }
}