<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Partner;
use App\Models\TeamMember;
use App\Models\AboutSection;
use Illuminate\View\View;

class PageController extends Controller
{
    /**
     * Display the homepage.
     */
    public function home(): View
    {
        // Get latest published articles
        $latestBlogs = Article::published()
            ->latest('published_at')
            ->take(3)
            ->get();

        // Get upcoming events (you'll need to implement this)
        $upcomingEvents = []; // Replace with actual events query

        // Get statistics (you'll need to implement these)
        $stats = [
            'students' => 0,  // Replace with actual count
            'courses' => 0,   // Replace with actual count
            'graduates' => 0, // Replace with actual count
        ];

        // Get active partners
        $partners = Partner::active()
            ->ordered()
            ->get();

        return view('pages.home', compact('stats', 'latestBlogs', 'upcomingEvents', 'partners'));
    }

    /**
     * Display the about page.
     */
    public function about(): View
    {
        // Get all active about sections
        $aboutSections = AboutSection::active()
            ->ordered()
            ->get()
            ->groupBy('section_type');

        // Get active team members
        $teamMembers = TeamMember::active()
            ->ordered()
            ->get();

        // Get active partners
        $partners = Partner::active()
            ->ordered()
            ->get();

        return view('pages.about', compact('aboutSections', 'teamMembers', 'partners'));
    }
}