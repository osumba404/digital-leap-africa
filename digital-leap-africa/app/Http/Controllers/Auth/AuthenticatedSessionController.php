<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();
        
        // Get the intended URL
        $intendedUrl = $request->session()->get('url.intended');
        
        // List of URLs that should NOT be redirected to after login
        $excludedPaths = [
            '/me/photo',
            '/storage/',
            '/images/',
            '/css/',
            '/js/',
        ];
        
        // Check if intended URL should be excluded
        $shouldExclude = false;
        if ($intendedUrl) {
            foreach ($excludedPaths as $path) {
                if (str_contains($intendedUrl, $path)) {
                    $shouldExclude = true;
                    break;
                }
            }
        }
        
        // If intended URL is an asset/excluded path, clear it and go to dashboard
        if ($shouldExclude) {
            $request->session()->forget('url.intended');
            return redirect(RouteServiceProvider::HOME);
        }
        
        // Otherwise, redirect to intended URL or dashboard
        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
