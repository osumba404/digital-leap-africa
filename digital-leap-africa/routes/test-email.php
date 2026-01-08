<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Services\EmailNotificationService;
use App\Models\Course;

Route::get('/test-email-simple', function() {
    if (!auth()->check()) {
        return 'Please login first';
    }
    
    try {
        // Test 1: Simple raw email
        Mail::raw('This is a test email from Digital Leap Africa platform.', function($message) {
            $message->to(auth()->user()->email)
                    ->subject('Test Email - Digital Leap Africa')
                    ->from(config('mail.from.address'), config('mail.from.name'));
        });
        
        // Test 2: Enrollment notification
        $course = Course::first();
        if ($course) {
            EmailNotificationService::sendNotification('course_enrollment_suspended', auth()->user(), ['course' => $course]);
        }
        
        return 'Test emails sent to ' . auth()->user()->email . '. Check your inbox.';
    } catch (\Exception $e) {
        return 'Error: ' . $e->getMessage();
    }
})->middleware('auth');