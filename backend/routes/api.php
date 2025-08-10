<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\PageController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Authentication Routes
Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);

// Page content routes
Route::get('/pages/{slug}', [PageController::class, 'show']);

// This is a protected route, requires authentication
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});