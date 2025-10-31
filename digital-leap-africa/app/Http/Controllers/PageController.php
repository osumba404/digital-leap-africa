<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PageController extends Controller
{
    /**
     * Display the homepage.
     */
    public function home(): View
    {
        // Fetch approved testimonials for homepage carousel (handle missing table gracefully)
        try {
            $testimonials = Testimonial::query()
                ->with('user')
                ->where('is_active', true)
                ->latest()
                ->limit(10)
                ->get();
        } catch (\Exception $e) {
            $testimonials = collect(); // Empty collection if table doesn't exist
        }
        
        return view('index', compact('testimonials'));
    }

    /**
     * Display the public About page.
     */
    public function about(): View
    {
        return view('about');
    }
}