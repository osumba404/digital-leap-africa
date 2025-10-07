<?php
// app/Http/Controllers/Admin/AdminDashboardController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;
use App\Models\Enrollment;
use App\Models\Job;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $courses = Course::latest()->take(5)->get(); // Get latest 5 courses
        $courseCount = Course::count();
        $userCount = \App\Models\User::count();
        $enrollmentCount = \App\Models\Enrollment::count();
        $jobCount = \App\Models\Job::count();

        return view('admin.dashboard', compact(
            'courses',
            'courseCount',
            'userCount',
            'enrollmentCount',
            'jobCount'
        ));
    }

    // ... rest of your controller methods
}