<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ELibraryController;
use App\Http\Controllers\JobController;

use App\Http\Controllers\EventController;
use App\Http\Controllers\ForumController;

use App\Http\Controllers\LessonController; // The public lesson controller
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

Route::get('/events/{id}', [EventController::class, 'show'])->name('events.show');
Route::get('/forum/{id}', [ForumController::class, 'show'])->name('forum.show');


// --- AUTHENTICATED USER ROUTES ---
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () { return view('dashboard'); })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Course & Lesson Actions for any logged-in user
    Route::post('/courses/{course}/enroll', [CourseController::class, 'enroll'])->name('courses.enroll');
    Route::get('/lessons/{lesson}', [LessonController::class, 'show'])->name('lessons.show');
    Route::post('/lessons/{lesson}/complete', [LessonController::class, 'complete'])->name('lessons.complete');
});


// --- ADMIN ROUTES ---
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () { return view('admin.dashboard'); })->name('dashboard');

    // Site Settings
    Route::get('/settings', [AdminSiteSettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [AdminSiteSettingController::class, 'update'])->name('settings.update');

    // CMS Resource Routes
    Route::resource('jobs', AdminJobController::class)->except(['show']);
    Route::resource('courses', AdminCourseController::class)->except(['show']);
    Route::resource('projects', AdminProjectController::class)->except(['show']);
    Route::resource('elibrary-resources', AdminELibraryResourceController::class);

    // Minimal Events index route (closure) until Admin controller is added
    Route::get('/events', function () {
        $events = \App\Models\Event::latest()->paginate(20);
        return view('admin.events.index', compact('events'));
    })->name('events.index');

    // Minimal Forum index route (closure) until Admin controller is added
    Route::get('/forum', function () {
        // Provide an empty collection if Thread model is unavailable
        $threads = class_exists('App\\Models\\Thread')
            ? \App\Models\Thread::withCount('replies')->with('latestReply','user')->latest()->paginate(20)
            : collect();
        return view('admin.forum.index', compact('threads'));
    })->name('forum.index');

    // Nested Course Content Routes
    Route::get('/courses/{course}/topics', [AdminTopicController::class, 'index'])->name('courses.topics.index');
    Route::post('/courses/{course}/topics', [AdminTopicController::class, 'store'])->name('courses.topics.store');
    Route::delete('/topics/{topic}', [AdminTopicController::class, 'destroy'])->name('topics.destroy');
    Route::resource('topics.lessons', AdminLessonController::class)->except(['show']);
});

require __DIR__.'/auth.php';