<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\EmailTemplate;
use App\Models\Event;
use App\Models\Lesson;
use App\Models\Payment;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class EmailTemplateController extends Controller
{
    /** System email template names (Blade views in resources/views/emails/). */
    public static function systemTemplateList(): array
    {
        return [
            'course-enrollment' => 'Course Enrollment',
            'course-approved' => 'Course Approved',
            'course-rejected' => 'Course Rejected',
            'course-suspended' => 'Course Suspended',
            'course-dropped' => 'Course Dropped',
            'course-reactivated' => 'Course Reactivated',
            'course-unenrolled-simple' => 'Course Unenrolled',
            'course-warning-simple' => 'Course Warning',
            'new-course' => 'New Course Available',
            'new-article' => 'New Article Published',
            'new-event' => 'New Event',
            'account-verified' => 'Account Verified',
            'lesson-completed' => 'Lesson Completed',
            'course-completed' => 'Course Completed',
            'payment-success' => 'Payment Success',
            'password-reset' => 'Password Reset',
            'general-notification' => 'General Notification',
        ];
    }

    /** Preview page listing all system email templates (dark blue layout). */
    public function systemPreview(): View
    {
        $templates = self::systemTemplateList();
        return view('admin.email-templates.system-preview', compact('templates'));
    }

    /** Render a single system email template with sample data for preview. */
    public function systemPreviewShow(string $template)
    {
        if (!array_key_exists($template, self::systemTemplateList())) {
            abort(404, 'Template not found');
        }
        $user = auth()->user() ?? new User(['name' => 'John Doe', 'email' => 'john@example.com']);
        $course = new Course([
            'title' => 'Advanced Laravel Development',
            'description' => 'Master Laravel with advanced concepts and best practices.',
            'price' => 2500,
            'level' => 'intermediate',
            'duration_weeks' => 8,
            'instructor' => 'Jane Instructor',
            'course_type' => 'self_paced',
            'is_free' => false,
            'slug' => 'advanced-laravel-development',
        ]);
        $topic = new Topic(['title' => 'Module 1', 'course_id' => 1]);
        $topic->setRelation('course', $course);
        $lesson = new Lesson(['title' => 'Building RESTful APIs', 'content' => 'Learn to build APIs']);
        $lesson->setRelation('topic', $topic);
        $payment = new Payment([
            'transaction_id' => 'TXN123456789',
            'amount' => 2500,
            'created_at' => now(),
        ]);
        $article = new \App\Models\Article([
            'title' => 'Getting Started with Laravel',
            'excerpt' => 'A quick guide to building modern web applications.',
            'slug' => 'getting-started-with-laravel',
        ]);
        $event = new Event([
            'title' => 'Tech Meetup Nairobi',
            'date' => now()->addDays(14),
            'location' => 'Nairobi, Kenya',
            'topic' => 'Web Development',
            'description' => 'Join us for an evening of talks and networking.',
            'slug' => 'tech-meetup-nairobi',
        ]);
        $data = [
            'user' => $user,
            'course' => $course,
            'lesson' => $lesson,
            'payment' => $payment,
            'article' => $article,
            'event' => $event,
            'resetUrl' => url('/reset-password/sample-token'),
            'subject' => 'Sample Email - Digital Leap Africa',
            'title' => 'Sample Notification',
            'message' => 'This is a sample message for the email template preview.',
            'actionUrl' => url('/dashboard'),
            'actionText' => 'View Dashboard',
        ];
        return view('emails.' . $template, $data);
    }

    public function index(): View
    {
        $templates = EmailTemplate::latest()->paginate(10);
        return view('admin.email-templates.index', compact('templates'));
    }

    public function create(): View
    {
        return view('admin.email-templates.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'content' => 'required|string',
            'active' => 'boolean'
        ]);

        EmailTemplate::create($validated);

        return redirect()->route('admin.email-templates.index')
            ->with('success', 'Email template created successfully.');
    }

    public function show(EmailTemplate $emailTemplate): View
    {
        return view('admin.email-templates.show', compact('emailTemplate'));
    }

    public function edit(EmailTemplate $emailTemplate): View
    {
        return view('admin.email-templates.edit', compact('emailTemplate'));
    }

    public function update(Request $request, EmailTemplate $emailTemplate): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'content' => 'required|string',
            'active' => 'boolean'
        ]);

        $emailTemplate->update($validated);

        return redirect()->route('admin.email-templates.index')
            ->with('success', 'Email template updated successfully.');
    }

    public function destroy(EmailTemplate $emailTemplate): RedirectResponse
    {
        $emailTemplate->delete();

        return redirect()->route('admin.email-templates.index')
            ->with('success', 'Email template deleted successfully.');
    }
}