<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    ProfileController,
    PageController,
    CourseController,
    ProjectController,
    ELibraryController,
    JobController,
    EventController,
    ForumController,
    LessonController,
    ArticlesController
};

use App\Http\Controllers\Admin\{
    JobController as AdminJobController,
    CourseController as AdminCourseController,
    ProjectController as AdminProjectController,
    ELibraryResourceController as AdminELibraryResourceController,
    SiteSettingController as AdminSiteSettingController,
    TopicController as AdminTopicController,
    LessonController as AdminLessonController,
    EventController as AdminEventController,
    ForumController as AdminForumController,
    ArticleController as AdminArticleController,
    DashboardController as AdminDashboardController,
    AboutController as AdminAboutController
};

// Authentication Routes
require __DIR__.'/auth.php';

// --- PUBLIC ROUTES ---

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');

Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
Route::get('/courses/{course:slug}', [CourseController::class, 'show'])->name('courses.show');
Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
Route::get('/projects/{project:slug}', [ProjectController::class, 'show'])->name('projects.show');
Route::get('/elibrary', [ELibraryController::class, 'index'])->name('elibrary.index');
Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');
Route::get('/events/{id}', [EventController::class, 'show'])->name('events.show');
Route::get('/forum', [ForumController::class, 'index'])->name('forum.index');
Route::get('/forum/create', [ForumController::class, 'create'])->middleware(['auth', 'verified'])->name('forum.create');
Route::post('/forum', [ForumController::class, 'store'])->middleware(['auth', 'verified'])->name('forum.store');
Route::get('/forum/{id}', [ForumController::class, 'show'])->name('forum.show');
Route::post('/forum/{thread}/reply', [ForumController::class, 'storeReply'])->middleware(['auth', 'verified'])->name('forum.reply');

// Public Articles/Blog
// Route::get('/blog', [ArticlesController::class, 'index'])->name('blog.index');
// Route::get('/blog/{article:slug}', [ArticlesController::class, 'show'])->name('blog.show');
// Public Articles/Blog
Route::get('/blog', [ArticlesController::class, 'index'])->name('blog.index');
Route::get('/blog/{article:slug}', [ArticlesController::class, 'show'])->name('blog.show');
Route::post('/blog/{article:slug}/comments', [ArticlesController::class, 'storeComment'])->middleware(['auth', 'verified'])->name('blog.comments.store');


// --- DASHBOARD ROUTE (PUBLIC/AUTHENTICATED) ---
Route::get('/dashboard', function () {
    if (auth()->check()) {
        return view('dashboard');
    }
    return redirect()->route('home');
})->name('dashboard');

// --- HOME ROUTE (CONDITIONAL) ---
Route::get('/', function() {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    return app(\App\Http\Controllers\PageController::class)->home();
})->name('home');

// --- AUTHENTICATED USER ROUTES ---
Route::middleware(['auth', 'verified'])->group(function () {


    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Course Enrollment
    Route::post('/courses/{course}/enroll', [CourseController::class, 'enroll'])->name('courses.enroll');
    Route::post('/lessons/{lesson}/complete', [LessonController::class, 'complete'])->name('lessons.complete');
});

// --- ADMIN ROUTES ---
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'role:admin'])
    ->group(function () {
        // Dashboard
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        // Content Management
        Route::prefix('content')->group(function () {
            Route::get('/', [AdminDashboardController::class, 'content'])->name('content.index');
        });

        // Articles
            Route::resource('articles', AdminArticleController::class)->names([
                'index' => 'articles.index',
                'create' => 'articles.create',
                'store' => 'articles.store',
                'show' => 'articles.show',
                'edit' => 'articles.edit',
                'update' => 'articles.update',
                'destroy' => 'articles.destroy'
            ]);

        // About Page Management
        Route::prefix('about')->name('about.')->group(function () {
            // Main about page
            Route::get('/', [AdminAboutController::class, 'index'])->name('index');
            
            // About Sections
            Route::prefix('sections')->name('sections.')->group(function () {
                Route::get('/', [AdminAboutController::class, 'index'])->name('index');
                Route::get('/create', [AdminAboutController::class, 'createSection'])->name('create');
                Route::post('/', [AdminAboutController::class, 'storeSection'])->name('store');
                Route::get('/{section}/edit', [AdminAboutController::class, 'editSection'])->name('edit');
                Route::put('/{section}', [AdminAboutController::class, 'updateSection'])->name('update');
                Route::delete('/{section}', [AdminAboutController::class, 'destroySection'])->name('destroy');
            });

            // Team Members
            Route::prefix('team')->name('team.')->group(function () {
                Route::get('/', [AdminAboutController::class, 'index'])->name('index');
                Route::get('/create', [AdminAboutController::class, 'createTeamMember'])->name('create');
                Route::post('/', [AdminAboutController::class, 'storeTeamMember'])->name('store');
                Route::get('/{teamMember}/edit', [AdminAboutController::class, 'editTeamMember'])->name('edit');
                Route::put('/{teamMember}', [AdminAboutController::class, 'updateTeamMember'])->name('update');
                Route::delete('/{teamMember}', [AdminAboutController::class, 'destroyTeamMember'])->name('destroy');
            });

            // Partners
            Route::prefix('partners')->name('partners.')->group(function () {
                Route::get('/', [AdminAboutController::class, 'index'])->name('index');
                Route::get('/create', [AdminAboutController::class, 'createPartner'])->name('create');
                Route::post('/', [AdminAboutController::class, 'storePartner'])->name('store');
                Route::get('/{partner}/edit', [AdminAboutController::class, 'editPartner'])->name('edit');
                Route::put('/{partner}', [AdminAboutController::class, 'updatePartner'])->name('update');
                Route::delete('/{partner}', [AdminAboutController::class, 'destroyPartner'])->name('destroy');
            });
        });

        // Resource Routes
        Route::resource('jobs', AdminJobController::class)->except(['show']);
        Route::resource('courses', AdminCourseController::class)->except(['show']);
        Route::resource('projects', AdminProjectController::class)->except(['show']);
        Route::resource('elibrary-resources', AdminELibraryResourceController::class);
        Route::resource('events', AdminEventController::class)->except(['show']);
        Route::resource('forum', AdminForumController::class)->except(['show']);
        Route::resource('articles', AdminArticleController::class)->except(['show']);

         // Courses
         Route::resource('courses', AdminCourseController::class)->except(['show']);
       

                // Nested Topics under Courses
        Route::prefix('courses/{course}')->group(function () {
            Route::resource('topics', AdminTopicController::class)
                ->names([
                    'index' => 'courses.topics.index',
                    'create' => 'courses.topics.create',
                    'store' => 'courses.topics.store',
                    'edit' => 'courses.topics.edit',
                    'update' => 'courses.topics.update',
                    'destroy' => 'courses.topics.destroy'
                ]);
        });

            Route::resource('topics.lessons', AdminLessonController::class)->except(['index', 'show']);

             // Settings
        Route::prefix('settings')->name('settings.')->group(function () {
            Route::get('/', [AdminSiteSettingController::class, 'index'])->name('index');
            Route::post('/', [AdminSiteSettingController::class, 'update'])->name('update');
        });
        });


        // Settings
        // Route::prefix('settings')->name('settings.')->group(function () {
        //     Route::get('/', [AdminSiteSettingController::class, 'index'])->name('index');
        //     Route::post('/', [AdminSiteSettingController::class, 'update'])->name('update');
        // });

        

// Fallback route - must be at the end
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});