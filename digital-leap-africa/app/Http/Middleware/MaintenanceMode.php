<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Helpers\SettingsHelper;

class MaintenanceMode
{
    public function handle(Request $request, Closure $next)
    {
        if (SettingsHelper::get('maintenance_mode', false) && !auth()->check()) {
            return response()->view('maintenance', [], 503);
        }

        return $next($request);
    }
}