<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role  The role required to access the route.
     * @return mixed
     */
    public function handle(Request $request, Closure $next, string $role)
    {
        // Check if the user is authenticated and has the required role
        if (!Auth::check() || Auth::user()->role !== $role) {
            // If not, abort with a 403 Forbidden error
            abort(403, 'USER DOES NOT HAVE THE RIGHT ROLES.');
        }

        return $next($request);
    }
}