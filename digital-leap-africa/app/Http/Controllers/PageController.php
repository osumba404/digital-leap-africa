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
        // Fetch approved testimonials for homepage carousel
        $testimonials = Testimonial::query()
            ->with('user')
            ->where('is_active', true)
            ->latest()
            ->limit(10)
            ->get();
        
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