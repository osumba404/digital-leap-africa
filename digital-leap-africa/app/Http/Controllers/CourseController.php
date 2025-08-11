<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CourseController extends Controller
{
    /**
     * Display a listing of the courses.
     */
    public function index(): View
    {
        $courses = Course::latest()->get();
        return view('pages.courses.index', ['courses' => $courses]);
    }

    /**
     * Display the specified course.
     */
    public function show(Course $course): View
    {
        return view('pages.courses.show', ['course' => $course]);
    }
}