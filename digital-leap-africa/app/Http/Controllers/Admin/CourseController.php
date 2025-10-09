<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course; // Make sure this model is imported
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

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
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['active'] = $request->boolean('active');

        if ($request->hasFile('image_url')) {
            $path = $request->file('image_url')->store('public/courses');
            $validated['image_url'] = Storage::url($path);
        }

        Course::create($validated);

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
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['active'] = $request->boolean('active');

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
        // you can load topics/lessons here or just link to their pages
        return view('admin.courses.manage', compact('course'));
    }

    

    // DO NOT ADD THE enroll() METHOD HERE
}