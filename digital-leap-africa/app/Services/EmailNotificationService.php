<?php

namespace App\Services;

use App\Models\User;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class EmailNotificationService
{
    public static function sendNotification($type, $user, $data = [])
    {
        try {
            switch ($type) {
                case 'course_enrollment':
                    if (isset($data['course'])) {
                        Mail::to($user->email)->send(new \App\Mail\CourseEnrollmentNotification($user, $data['course']));
                    }
                    break;

                case 'course_enrollment_approved':
                    if (isset($data['course'])) {
                        Mail::to($user->email)->send(new \App\Mail\CourseApprovalNotification($user, $data['course'], true));
                    }
                    break;

                case 'course_enrollment_rejected':
                    if (isset($data['course'])) {
                        Mail::to($user->email)->send(new \App\Mail\CourseApprovalNotification($user, $data['course'], false));
                    }
                    break;

                case 'account_verified':
                    Mail::to($user->email)->send(new \App\Mail\AccountVerificationNotification($user, true));
                    break;

                case 'account_unverified':
                    Mail::to($user->email)->send(new \App\Mail\AccountVerificationNotification($user, false));
                    break;

                case 'lesson_completed':
                    if (isset($data['lesson'])) {
                        Mail::to($user->email)->send(new \App\Mail\LessonCompletionNotification($user, $data['lesson']));
                    }
                    break;

                case 'course_completed':
                    if (isset($data['course'])) {
                        Mail::to($user->email)->send(new \App\Mail\CourseCompletionNotification($user, $data['course']));
                    }
                    break;

                case 'new_course':
                    if (isset($data['course'])) {
                        Mail::to($user->email)->send(new \App\Mail\NewCourseNotification($user, $data['course']));
                    }
                    break;

                case 'payment_success':
                    if (isset($data['payment'])) {
                        Mail::to($user->email)->send(new \App\Mail\PaymentSuccessNotification($data['payment']));
                    }
                    break;

                case 'password_reset':
                    if (isset($data['token'])) {
                        Mail::to($user->email)->send(new \App\Mail\PasswordResetNotification($user, $data['token']));
                    }
                    break;

                default:
                    // For generic notifications, use base notification
                    $title = $data['title'] ?? 'Notification';
                    $message = $data['message'] ?? 'You have a new notification.';
                    $actionUrl = $data['url'] ?? null;
                    Mail::to($user->email)->send(new \App\Mail\BaseNotification($user, $title, $message, $actionUrl));
                    break;
            }
        } catch (\Exception $e) {
            Log::error("Failed to send email notification ({$type}) to {$user->email}: " . $e->getMessage());
        }
    }
}