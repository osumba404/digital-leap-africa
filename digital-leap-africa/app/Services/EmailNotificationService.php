<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;

class EmailNotificationService
{
    public static function sendNotification($type, $user, $data = [])
    {
        try {
            $subject = self::getSubject($type, $data);
            $template = self::getTemplate($type);
            $templateData = array_merge($data, ['user' => $user, 'subject' => $subject]);
            
            Log::info('Attempting to send email', [
                'type' => $type, 
                'email' => $user->email, 
                'template' => $template,
                'subject' => $subject
            ]);
            
            if (View::exists($template)) {
                Mail::send($template, $templateData, function ($message) use ($user, $subject) {
                    $message->to($user->email, $user->name)
                            ->subject($subject)
                            ->from(config('mail.from.address'), config('mail.from.name'));
                });
                Log::info('Email sent using template', ['template' => $template]);
            } else {
                // Fallback to plain text if template doesn't exist
                $content = self::getContent($type, $user, $data);
                Mail::raw($content, function ($message) use ($user, $subject) {
                    $message->to($user->email, $user->name)
                            ->subject($subject)
                            ->from(config('mail.from.address'), config('mail.from.name'));
                });
                Log::info('Email sent using fallback content');
            }
            
            Log::info('Email sent successfully', ['type' => $type, 'email' => $user->email]);
        } catch (\Exception $e) {
            Log::error("Failed to send email ({$type}) to {$user->email}: " . $e->getMessage());
            Log::error('Email error stack trace: ' . $e->getTraceAsString());
        }
    }

    private static function getSubject($type, $data)
    {
        return match($type) {
            'course_enrollment' => 'Welcome to Your New Course - Digital Leap Africa',
            'course_enrollment_approved' => 'Course Access Approved - Digital Leap Africa',
            'course_enrollment_rejected' => 'Course Enrollment Update - Digital Leap Africa',
            'course_enrollment_suspended' => 'Course Enrollment Suspended - Digital Leap Africa',
            'course_enrollment_dropped' => 'Dropped from Course - Digital Leap Africa',
            'course_enrollment_reactivated' => 'Course Access Restored - Digital Leap Africa',
            'course_unenrolled' => 'Course Unenrollment - Digital Leap Africa',
            'course_warning' => 'Course Warning - Digital Leap Africa',
            'new_course' => 'New Course Available - Digital Leap Africa',
            'account_verified' => 'Account Verified - Welcome to Premium - Digital Leap Africa',
            'lesson_completed' => 'Lesson Completed - Great Progress! - Digital Leap Africa',
            'course_completed' => 'Course Completed - Congratulations! - Digital Leap Africa',
            'payment_success' => 'Payment Successful - Access Granted - Digital Leap Africa',
            'password_reset' => 'Reset Your Password - Digital Leap Africa',
            default => $data['title'] ?? 'Notification - Digital Leap Africa'
        };
    }

    private static function getTemplate($type)
    {
        
        return match($type) {
            'course_enrollment' => 'emails.course-enrollment',
            'course_enrollment_approved' => 'emails.course-approved',
            'course_enrollment_rejected' => 'emails.course-rejected',
            'course_enrollment_suspended' => 'emails.course-suspended',
            'course_enrollment_dropped' => 'emails.course-dropped',
            'course_enrollment_reactivated' => 'emails.course-reactivated',
            'course_unenrolled' => 'emails.course-unenrolled-simple',
            'course_warning' => 'emails.course-warning-simple',
            'new_course' => 'emails.new-course',
            'account_verified' => 'emails.account-verified',
            'lesson_completed' => 'emails.lesson-completed',
            'course_completed' => 'emails.course-completed',
            'payment_success' => 'emails.payment-success',
            'password_reset' => 'emails.password-reset',
            default => 'emails.general-notification'
        };
    }

    private static function getContent($type, $user, $data)
    {
        $greeting = "Hello {$user->name},\n\n";
        $footer = "\n\nBest regards,\nThe Digital Leap Africa Team\n\nEmpowering African Youth Through Technology";
        
        $body = match($type) {
            'course_enrollment' => "You have successfully enrolled in: {$data['course']->title}\n\nStart your learning journey today!",
            'course_enrollment_approved' => "Great news! Your enrollment for '{$data['course']->title}' has been approved!\n\nYou can now access all course materials.",
            'course_enrollment_rejected' => "Your enrollment for '{$data['course']->title}' requires additional review.\n\nPlease contact our support team for assistance.",
            'course_enrollment_suspended' => "Your enrollment in '{$data['course']->title}' has been temporarily suspended.\n\nPlease contact support for more information about reactivating your access.",
            'course_enrollment_dropped' => "You have been dropped from '{$data['course']->title}'.\n\nIf you believe this is an error, please contact our support team.",
            'course_enrollment_reactivated' => "Great news! Your access to '{$data['course']->title}' has been restored.\n\nYou can now continue your learning journey.",
            'course_unenrolled' => "You have been unenrolled from '{$data['course']->title}'.\n\nAll progress data has been removed. Contact support if you have questions.",
            'course_warning' => "You have received a warning regarding your enrollment in '{$data['course']->title}'.\n\nPlease review your course participation and contact support if needed.",
            'new_course' => "We're excited to announce a new course: {$data['course']->title}\n\nEnroll now to start learning!",
            'account_verified' => "Congratulations! Your account has been verified!\n\nYou now have access to premium features and exclusive content.",
            'lesson_completed' => "Excellent work! You completed: {$data['lesson']->title}\n\nYou earned 50 points. Keep up the great progress!",
            'course_completed' => "Outstanding achievement! You completed: {$data['course']->title}\n\nYour certificate is ready for download. You earned 200 bonus points!",
            'payment_success' => "Payment successful!\n\nTransaction ID: {$data['payment']->transaction_id}\nYour course access has been activated.",
            'password_reset' => "Reset your password using this secure link: {$data['url']}\n\nThis link expires in 60 minutes. Ignore this email if you didn't request a password reset.",
            default => $data['message'] ?? 'You have a new notification from Digital Leap Africa.'
        };
        
        return $greeting . $body . $footer;
    }
}