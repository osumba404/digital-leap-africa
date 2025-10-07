<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Project;
use App\Models\Job;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PageController extends Controller
{
    /**
     * Display the homepage.
     */
    public function home(): View
    {
        $featuredCourses = Course::latest()->take(3)->get();
        $recentProjects = Project::latest()->take(3)->get();
        $latestJobs = Job::latest('posted_at')->take(3)->get();
        $recentArticles = Article::whereNotNull('published_at')
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('pages.home', compact(
            'featuredCourses',
            'recentProjects', 
            'latestJobs',
            'recentArticles'
        ));
    }
}