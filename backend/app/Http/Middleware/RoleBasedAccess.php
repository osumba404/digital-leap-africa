<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleBasedAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  ...$roles  A list of allowed roles.
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // First, check if the user is authenticated at all.
        if (!Auth::check()) {
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }

        // Get the authenticated user.
        $user = Auth::user();

        // Check if the user's role is in the list of allowed roles.
        if (!in_array($user->role, $roles)) {
            // If not, return a 403 Forbidden error.
            return response()->json(['message' => 'This action is unauthorized.'], 403);
        }

        // If the user has the correct role, allow the request to proceed.
        return $next($request);
    }
}