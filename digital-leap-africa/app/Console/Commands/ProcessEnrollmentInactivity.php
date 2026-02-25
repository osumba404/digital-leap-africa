<?php

namespace App\Console\Commands;

use App\Models\Enrollment;
use App\Models\Notification;
use App\Services\EmailNotificationService;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class ProcessEnrollmentInactivity extends Command
{
    protected $signature = 'enrollments:process-inactivity';

    protected $description = 'Send inactivity reminders and auto-unenroll inactive learners.';

    public function handle(): int
    {
        $now = now();

        $enrollments = Enrollment::with(['user', 'course'])
            ->whereIn('status', ['active', 'pending_pre_test'])
            ->get();

        $processed = 0;
        $unenrolled = 0;

        foreach ($enrollments as $enrollment) {
            if (!$enrollment->user || !$enrollment->course) {
                continue;
            }

            $lastActivityAt = $enrollment->getLastActivityAt();
            $daysInactive = $lastActivityAt->copy()->startOfDay()->diffInDays($now->copy()->startOfDay());

            if ($daysInactive < 7) {
                continue;
            }

            if ($daysInactive >= 21) {
                if ($this->alreadyNotifiedSinceActivity($enrollment, 'course_auto_unenrolled', $lastActivityAt)) {
                    continue;
                }

                $this->autoUnenroll($enrollment);
                $processed++;
                $unenrolled++;
                continue;
            }

            if ($daysInactive >= 14) {
                if ($this->alreadyNotifiedSinceActivity($enrollment, 'course_inactivity_warning', $lastActivityAt)) {
                    continue;
                }

                $this->sendWarning($enrollment, $daysInactive);
                $processed++;
                continue;
            }

            if ($daysInactive >= 10) {
                if ($this->alreadyNotifiedSinceActivity($enrollment, 'course_inactivity_reminder_10', $lastActivityAt)) {
                    continue;
                }

                $this->sendReminder($enrollment, $daysInactive, 10);
                $processed++;
                continue;
            }

            if ($this->alreadyNotifiedSinceActivity($enrollment, 'course_inactivity_reminder_7', $lastActivityAt)) {
                continue;
            }

            $this->sendReminder($enrollment, $daysInactive, 7);
            $processed++;
        }

        $this->info("Processed {$processed} inactivity action(s). Auto-unenrolled: {$unenrolled}.");
        return self::SUCCESS;
    }

    private function alreadyNotifiedSinceActivity(Enrollment $enrollment, string $type, Carbon $lastActivityAt): bool
    {
        return Notification::query()
            ->where('user_id', $enrollment->user_id)
            ->where('type', $type)
            ->where('data->enrollment_id', $enrollment->id)
            ->where('created_at', '>=', $lastActivityAt)
            ->exists();
    }

    private function sendReminder(Enrollment $enrollment, int $daysInactive, int $milestone): void
    {
        $notificationType = $milestone === 10 ? 'course_inactivity_reminder_10' : 'course_inactivity_reminder_7';
        $courseUrl = route('courses.show', $enrollment->course);

        Notification::createNotification(
            $enrollment->user_id,
            $notificationType,
            'Course Activity Reminder',
            "We noticed you've been inactive in {$enrollment->course->title} for {$daysInactive} days. Please continue your coursework.",
            $courseUrl,
            [
                'enrollment_id' => $enrollment->id,
                'course_id' => $enrollment->course_id,
                'days_inactive' => $daysInactive,
                'milestone' => $milestone,
            ]
        );

        EmailNotificationService::sendNotification('course_inactivity_reminder', $enrollment->user, [
            'course' => $enrollment->course,
            'days_inactive' => $daysInactive,
            'milestone' => $milestone,
            'course_url' => $courseUrl,
        ]);
    }

    private function sendWarning(Enrollment $enrollment, int $daysInactive): void
    {
        $courseUrl = route('courses.show', $enrollment->course);

        Notification::createNotification(
            $enrollment->user_id,
            'course_inactivity_warning',
            'Formal Inactivity Warning',
            "Formal warning: You've been inactive in {$enrollment->course->title} for {$daysInactive} days. Continue coursework immediately to avoid unenrollment.",
            $courseUrl,
            [
                'enrollment_id' => $enrollment->id,
                'course_id' => $enrollment->course_id,
                'days_inactive' => $daysInactive,
                'milestone' => 14,
            ]
        );

        EmailNotificationService::sendNotification('course_inactivity_warning', $enrollment->user, [
            'course' => $enrollment->course,
            'days_inactive' => $daysInactive,
            'course_url' => $courseUrl,
        ]);
    }

    private function autoUnenroll(Enrollment $enrollment): void
    {
        $coursesUrl = route('courses.index');
        $courseTitle = $enrollment->course->title;
        $user = $enrollment->user;

        Notification::createNotification(
            $enrollment->user_id,
            'course_auto_unenrolled',
            'Auto Unenrollment Notice',
            "You have been automatically unenrolled from {$courseTitle} after 21 days of inactivity.",
            $coursesUrl,
            [
                'enrollment_id' => $enrollment->id,
                'course_id' => $enrollment->course_id,
                'milestone' => 21,
            ]
        );

        EmailNotificationService::sendNotification('course_auto_unenrolled', $user, [
            'course' => $enrollment->course,
            'courses_url' => $coursesUrl,
        ]);

        $enrollment->delete();
    }
}
