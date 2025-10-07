<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class PageController extends Controller
{
    /**
     * Display the homepage.
     */
    public function home(): View
    {
        // We will fetch dynamic data here later
        return view('index');
    }

    /**
     * Display the public About page.
     */
    public function about(): View
    {
        return view('about');
    }
}