<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\PageController;
use App\Http\Controllers\API\ProfileController;
use App\Http\Controllers\API\CourseController;
use App\Http\Controllers\API\ProjectController;
use App\Http\Controllers\API\ELibraryController;
use App\Http\Controllers\API\ForumController;

/*
|--------------------------------------------------------------------------
| Public API Routes
|--------------------------------------------------------------------------
*/

// Authentication routes are public
Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);

// Publicly accessible page content
Route::get('/pages/{slug}', [PageController::class, 'show']);


/*
|--------------------------------------------------------------------------
| Protected API Routes
|--------------------------------------------------------------------------
*/

// All routes in this group require a valid Sanctum token
Route::middleware('auth:sanctum')->group(function () {
    
    // The standard route to get the authenticated user's data
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Profile routes
    Route::get('/profile/gamification-stats', [ProfileController::class, 'getGamificationStats']);
});


// All routes in this group require BOTH a valid token AND the 'super_admin' role
Route::middleware(['auth:sanctum', 'role:super_admin'])->group(function () {
    Route::get('/admin/stats', function () {
        return response()->json([
            'message' => 'You have accessed admin-only data!',
            'stats' => [
                'total_users' => 150,
                'active_courses' => 25,
            ]
        ]);
    });
});
// Course routes
Route::get('/courses', [CourseController::class, 'index']);

Route::get('/courses/{course}', [CourseController::class, 'show']);

Route::get('/projects', [ProjectController::class, 'index']);

Route::get('/elibrary', [ELibraryController::class, 'index']);

Route::get('/forum-posts', [ForumController::class, 'index']);

