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
    public function handle(Request $request, Closure $next, string $roles)
    {
        // If not authenticated, redirect to login
        if (!Auth::check()) {
            return redirect()->guest(route('login'));
        }
    
        $user = Auth::user();
    
        // Support multiple delimiters: "admin,editor" or "admin|editor"
        $allowedRoles = array_filter(array_map('trim', preg_split('/[|,]/', $roles)));
    
        // If no roles provided, allow (or change to forbid if you prefer)
        if (empty($allowedRoles)) {
            return $next($request);
        }
    
        if (!in_array($user->role, $allowedRoles, true)) {
            abort(403, 'USER DOES NOT HAVE THE RIGHT ROLES.');
        }
    
        return $next($request);
    }
}