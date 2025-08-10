<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    // Method to list all courses
    public function index()
    {
        $courses = Course::latest()->get();
        return response()->json($courses);
    }

    // Method to show a single course by its ID
    public function show(Course $course)
    {
        return response()->json($course);
    }
}