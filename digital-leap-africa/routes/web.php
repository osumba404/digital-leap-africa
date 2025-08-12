<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ELibraryController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\Admin\JobController as AdminJobController;
use App\Http\Controllers\Admin\CourseController as AdminCourseController;
use App\Http\Controllers\Admin\ProjectController as AdminProjectController;
use App\Http\Controllers\Admin\ELibraryResourceController as AdminELibraryResourceController;
use App\Http\Controllers\Admin\SiteSettingController as AdminSiteSettingController;
use App\Http\Controllers\Admin\TopicController as AdminTopicController;
use App\Http\Controllers\Admin\LessonController as AdminLessonController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- PUBLIC ROUTES ---
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
Route::get('/courses/{course:slug}', [CourseController::class, 'show'])->name('courses.show');
Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
Route::get('/projects/{project:slug}', [ProjectController::class, 'show'])->name('projects.show');
Route::get('/elibrary', [ELibraryController::class, 'index'])->name('elibrary.index');
Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');


// --- AUTHENTICATED USER ROUTES ---
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // MOVE THE ENROLL ROUTE HERE
    // This is an action for any logged-in user, not just admins.
    Route::post('/courses/{course}/enroll', [CourseController::class, 'enroll'])->name('courses.enroll');
});


// --- ADMIN ROUTES ---
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Job Management
    Route::resource('jobs', AdminJobController::class)->except(['show']);

    // Course Management
    Route::resource('courses', AdminCourseController::class)->except(['show']);
    Route::resource('courses.topics', AdminTopicController::class)->except(['index', 'show']);

    // Project Management
    Route::resource('projects', AdminProjectController::class)->except(['show']);

    // eLibrary Management
    Route::resource('elibrary-resources', AdminELibraryResourceController::class);

        // --- NEW: Site Settings Routes ---
    Route::get('/settings', [AdminSiteSettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [AdminSiteSettingController::class, 'update'])->name('settings.update');

     // --- NEW: Course Topics Management ---
    // This page will show a course and list its topics
    Route::get('/courses/{course}/topics', [AdminTopicController::class, 'index'])->name('courses.topics.index');
    // This handles the form submission for creating a new topic
    Route::post('/courses/{course}/topics', [AdminTopicController::class, 'store'])->name('courses.topics.store');
    // This handles deleting a topic
    Route::delete('/topics/{topic}', [AdminTopicController::class, 'destroy'])->name('topics.destroy');

        // --- NEW: Topic Lessons Management ---
    // This creates all the necessary routes for lesson CRUD under a topic
    Route::resource('topics.lessons', AdminLessonController::class)->except(['show']);

    
});


require __DIR__.'/auth.php';