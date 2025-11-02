<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course; // Make sure this model is imported
use App\Models\User;
use App\Models\Notification;
use App\Services\EmailNotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\Enrollment;
use App\Services\GamificationService;

class CourseController extends Controller
{
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
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['active'] = $request->boolean('active');
        $validated['is_free'] = $request->boolean('is_free');
        $validated['price'] = $validated['is_free'] ? 0 : ($validated['price'] ?? 0);

        if ($request->hasFile('image_url')) {
            $path = $request->file('image_url')->store('public/courses');
            $validated['image_url'] = Storage::url($path);
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
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['active'] = $request->boolean('active');
        $validated['is_free'] = $request->boolean('is_free');
        $validated['price'] = $validated['is_free'] ? 0 : ($validated['price'] ?? 0);

        if ($request->hasFile('image_url')) {
            if ($course->image_url) {
                Storage::delete(str_replace('/storage', 'public', $course->image_url));
            }
            $path = $request->file('image_url')->store('public/courses');
            $validated['image_url'] = Storage::url($path);
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
        $course->load('lessons');
        $totalLessons = $course->lessons->count();

        $enrollments = Enrollment::with('user')
            ->where('course_id', $course->id)
            ->orderByDesc('enrolled_at')
            ->get();

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
}