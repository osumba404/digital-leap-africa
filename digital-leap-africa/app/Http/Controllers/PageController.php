<?php

namespace App\Http\Controllers;

use App\Models\{
    Testimonial,
    Course,
    Article,
    Partner,
    Event,
    Faq,
    User,
    AboutSection,
    SiteSetting
};
use Illuminate\Http\Request;
use Illuminate\View\View;

class PageController extends Controller
{
    /**
     * Display the homepage.
     */
    public function home(): View
    {
        // Fetch testimonials
        try {
            $testimonials = Testimonial::query()
                ->with('user')
                ->where('is_active', true)
                ->latest()
                ->limit(10)
                ->get();
        } catch (\Exception $e) {
            $testimonials = collect();
        }

        // Fetch latest courses with lessons count
        try {
            $latestCourses = Course::query()
                ->where('active', true)
                ->withCount('lessons')
                ->latest()
                ->limit(3)
                ->get();
        } catch (\Exception $e) {
            $latestCourses = collect();
        }

        // Fetch latest articles
        try {
            $latestArticles = Article::query()
                ->where('status', 'published')
                ->latest()
                ->limit(3)
                ->get();
        } catch (\Exception $e) {
            $latestArticles = collect();
        }

        // Fetch active partners
        try {
            $partners = Partner::query()
                ->where('is_active', true)
                ->orderBy('order')
                ->get();
        } catch (\Exception $e) {
            $partners = collect();
        }

        // Fetch upcoming events
        try {
            $upcomingEvents = Event::query()
                ->where('date', '>', now())
                ->orderBy('date')
                ->limit(3)
                ->get();
        } catch (\Exception $e) {
            $upcomingEvents = collect();
        }

        // Fetch active FAQs
        try {
            $faqs = Faq::query()
                ->where('is_active', true)
                ->orderBy('order')
                ->limit(6)
                ->get();
        } catch (\Exception $e) {
            $faqs = collect();
        }

        // Fetch about sections
        try {
            $aboutSection = AboutSection::query()
                ->where('section_type', 'about')
                ->where('is_active', true)
                ->first();
        } catch (\Exception $e) {
            $aboutSection = null;
        }

        // Statistics
        $stats = [
            'courses' => Course::count(),
            'articles' => Article::count(),
            'partners' => Partner::count(),
            'members' => User::count(),
        ];

        // Fetch site settings for carousel
        try {
            $siteSettings = SiteSetting::pluck('value', 'key')->toArray();
            // Decode JSON values
            foreach ($siteSettings as $key => $value) {
                $decoded = json_decode($value, true);
                if (json_last_error() === JSON_ERROR_NONE) {
                    $siteSettings[$key] = $decoded;
                }
            }
        } catch (\Exception $e) {
            $siteSettings = [];
        }
        
        // Debug: Check if hero_slides exists
        if (empty($siteSettings['hero_slides'])) {
            // Force load hero slides if empty
            $heroSlidesJson = SiteSetting::where('key', 'hero_slides')->value('value');
            if ($heroSlidesJson) {
                $siteSettings['hero_slides'] = json_decode($heroSlidesJson, true);
            }
        }
        
        return view('pages.home', compact(
            'testimonials',
            'latestCourses',
            'latestArticles',
            'partners',
            'upcomingEvents',
            'faqs',
            'aboutSection',
            'stats',
            'siteSettings'
        ));
    }

    /**
     * Display the public About page.
     */
    public function about(): View
    {
        return view('about');
    }
}