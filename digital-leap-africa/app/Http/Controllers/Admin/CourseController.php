<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;
use App\Models\Notification;
use App\Services\EmailNotificationService;
use App\Traits\HasWebPImages;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\Enrollment;
use App\Services\GamificationService;

class CourseController extends Controller
{
    use HasWebPImages;
    public function index()
    {
        $courses = Course::latest()->get();
        return view('admin.courses.index', compact('courses'));
    }

    public function create()
    {
        $instructors = User::where('role', 'admin')->orderBy('name')->get(['id','name']);
        return view('admin.courses.create', [
            'course' => new Course(),
            'instructors' => $instructors,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'instructor' => 'required|string|max:255',
            'description' => 'required|string',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'active' => 'nullable|boolean',
            'is_free' => 'nullable|boolean',
            'price' => 'nullable|numeric|min:0',
            'course_type' => 'required|in:self_paced,cohort_based',
            'duration_weeks' => 'nullable|integer|min:1|max:52',
            'start_date' => 'nullable|date|after_or_equal:today',
            'end_date' => 'nullable|date|after:start_date',
            'has_certification' => 'nullable|boolean',
            'certificate_title' => 'nullable|string|max:255',
            'slots' => 'nullable|integer|min:1',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['active'] = $request->boolean('active');
        $validated['is_free'] = $request->boolean('is_free');
        $validated['price'] = $validated['is_free'] ? 0 : ($validated['price'] ?? 0);

        if ($request->hasFile('image_url')) {
            $validated['image_url'] = $this->storeWebPImage($request->file('image_url'), 'courses');
        }

        $course = Course::create($validated);

        // Notify all users about new course (only if active)
        if ($course->active) {
            $users = User::all();
            foreach ($users as $user) {
                Notification::createNotification(
                    $user->id,
                    'new_course',
                    'New Course Available',
                    "Check out our new course: {$course->title}",
                    route('courses.show', $course->id)
                );

                // Send email notification
                EmailNotificationService::sendNotification('new_course', $user, ['course' => $course]);
            }
        }

        return redirect()->route('admin.courses.index')->with('success', 'Course created successfully.');
    }

    public function edit(Course $course)
    {
        $instructors = User::where('role', 'admin')->orderBy('name')->get(['id','name']);
        return view('admin.courses.edit', compact('course', 'instructors'));
    }

    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'instructor' => 'required|string|max:255',
            'description' => 'required|string',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'active' => 'nullable|boolean',
            'is_free' => 'nullable|boolean',
            'price' => 'nullable|numeric|min:0',
            'course_type' => 'required|in:self_paced,cohort_based',
            'duration_weeks' => 'nullable|integer|min:1|max:52',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after:start_date',
            'has_certification' => 'nullable|boolean',
            'certificate_title' => 'nullable|string|max:255',
            'slots' => 'nullable|integer|min:1',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['active'] = $request->boolean('active');
        $validated['is_free'] = $request->boolean('is_free');
        $validated['price'] = $validated['is_free'] ? 0 : ($validated['price'] ?? 0);

        if ($request->hasFile('image_url')) {
            if ($course->image_url) {
                Storage::disk('public')->delete($course->image_url);
            }
            $validated['image_url'] = $this->storeWebPImage($request->file('image_url'), 'courses');
        }

        $course->update($validated);

        return redirect()->route('admin.courses.index')->with('success', 'Course updated successfully.');
    }

    public function manage(Course $course)
    {
        $course->load('lessons');
        $totalLessons = $course->lessons->count();

        $enrollments = \App\Models\Enrollment::with('user')
            ->where('course_id', $course->id)
            ->orderByDesc('enrolled_at')
            ->get();

        return view('admin.courses.manage', compact('course', 'enrollments', 'totalLessons'));
    }

    public function enrollments(Course $course)
    {
        $course->load(['lessons', 'topics.lessons']);
        $totalLessons = $course->lessons->count();

        $enrollments = Enrollment::with(['user', 'user.completedLessons'])
            ->where('course_id', $course->id)
            ->orderByDesc('enrolled_at')
            ->get();

        // Calculate progress for each enrollment
        foreach ($enrollments as $enrollment) {
            $completedLessons = $enrollment->user->completedLessons()
                ->whereIn('lesson_id', $course->lessons->pluck('id'))
                ->count();
            
            $enrollment->completed_lessons = $completedLessons;
            $enrollment->progress_percentage = $totalLessons > 0 ? round(($completedLessons / $totalLessons) * 100, 1) : 0;
        }

        return view('admin.courses.enrollments', compact('course', 'enrollments', 'totalLessons'));
    }

    public function approveEnrollment(Enrollment $enrollment)
    {
        $enrollment->update(['status' => 'active']);

        $gamification = new \App\Services\GamificationService();
        $gamification->awardPoints($enrollment->user, 'course_enroll', 'Enrolled in course: ' . $enrollment->course->title);

        Notification::createNotification(
            $enrollment->user_id,
            'course_enrollment_approved',
            'Enrollment Approved!',
            "Your enrollment in {$enrollment->course->title} has been approved. You can now access the course content.",
            route('courses.show', $enrollment->course_id)
        );

        // Send email notification
        EmailNotificationService::sendNotification('course_enrollment_approved', $enrollment->user, ['course' => $enrollment->course]);

        return redirect()->back()->with('success', 'Enrollment approved successfully.');
    }

    public function rejectEnrollment(Enrollment $enrollment)
    {
        $enrollment->update(['status' => 'rejected']);

        Notification::createNotification(
            $enrollment->user_id,
            'course_enrollment_rejected',
            'Enrollment Rejected',
            "Your enrollment in {$enrollment->course->title} has been rejected. Please contact support for more information.",
            route('courses.show', $enrollment->course_id)
        );

        // Send email notification
        EmailNotificationService::sendNotification('course_enrollment_rejected', $enrollment->user, ['course' => $enrollment->course]);

        return redirect()->back()->with('success', 'Enrollment rejected.');
    }

    public function suspendEnrollment(Enrollment $enrollment)
    {
        $enrollment->update(['status' => 'suspended']);

        Notification::createNotification(
            $enrollment->user_id,
            'course_enrollment_suspended',
            'Enrollment Suspended',
            "Your enrollment in {$enrollment->course->title} has been suspended. Please contact support for more information.",
            route('courses.show', $enrollment->course_id)
        );

        EmailNotificationService::sendNotification('course_enrollment_suspended', $enrollment->user, ['course' => $enrollment->course]);

        return redirect()->back()->with('success', 'Enrollment suspended successfully.');
    }

    public function dropEnrollment(Enrollment $enrollment)
    {
        $enrollment->update(['status' => 'dropped']);

        Notification::createNotification(
            $enrollment->user_id,
            'course_enrollment_dropped',
            'Dropped from Course',
            "You have been dropped from {$enrollment->course->title}. Please contact support if you have questions.",
            route('courses.show', $enrollment->course_id)
        );

        EmailNotificationService::sendNotification('course_enrollment_dropped', $enrollment->user, ['course' => $enrollment->course]);

        return redirect()->back()->with('success', 'Student dropped from course.');
    }

    public function reenrollStudent(Enrollment $enrollment)
    {
        $enrollment->update(['status' => 'active']);

        $gamification = new \App\Services\GamificationService();
        $gamification->awardPoints($enrollment->user, 'course_reenroll', 'Re-enrolled in course: ' . $enrollment->course->title);

        Notification::createNotification(
            $enrollment->user_id,
            'course_enrollment_reactivated',
            'Enrollment Reactivated',
            "Your enrollment in {$enrollment->course->title} has been reactivated. You can now access the course content again.",
            route('courses.show', $enrollment->course_id)
        );

        EmailNotificationService::sendNotification('course_enrollment_reactivated', $enrollment->user, ['course' => $enrollment->course]);

        return redirect()->back()->with('success', 'Student re-enrolled successfully.');
    }

    public function warnStudent(Enrollment $enrollment)
    {
        Notification::createNotification(
            $enrollment->user_id,
            'course_warning',
            'Course Warning',
            "You have received a warning regarding your enrollment in {$enrollment->course->title}. Please review your course participation and contact support if needed.",
            route('courses.show', $enrollment->course_id)
        );

        EmailNotificationService::sendNotification('course_warning', $enrollment->user, ['course' => $enrollment->course]);

        return redirect()->back()->with('success', 'Warning sent to student.');
    }

    public function unenrollStudent(Enrollment $enrollment)
    {
        $courseName = $enrollment->course->title;
        $user = $enrollment->user;

        Notification::createNotification(
            $enrollment->user_id,
            'course_unenrolled',
            'Unenrolled from Course',
            "You have been unenrolled from {$courseName}. All progress has been removed.",
            route('courses.index')
        );

        EmailNotificationService::sendNotification('course_unenrolled', $user, ['course' => $enrollment->course]);

        $enrollment->delete();

        return redirect()->back()->with('success', 'Student unenrolled successfully.');
    }

    public function destroy(Course $course)
    {
        if ($course->image_url) {
            Storage::disk('public')->delete($course->image_url);
        }
        $course->delete();
        return redirect()->route('admin.courses.index')->with('success', 'Course deleted successfully.');
    }
}