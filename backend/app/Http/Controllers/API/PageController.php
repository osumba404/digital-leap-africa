<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page; // Make sure to import the Page model

class PageController extends Controller
{
    // Fetches a single page by its slug
    public function show($slug)
    {
        // For now, let's create a dummy page to return
        // Later, this will be: $page = Page::where('slug', $slug)->firstOrFail();
        $page = [
            'title' => 'Sample Page Title',
            'content' => 'This is sample page content coming from the Laravel API.',
            'slug' => $slug,
        ];

        return response()->json($page);
    }
}