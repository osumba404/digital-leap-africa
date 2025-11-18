<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Course;
use App\Models\Project;
use App\Models\Event;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;

class SitemapController extends Controller
{
    public function index()
    {
        return Cache::remember('sitemap_index', 3600, function() {
            $sitemap = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
            $sitemap .= '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
            
            // Main sitemap
            $sitemap .= '<sitemap>' . "\n";
            $sitemap .= '<loc>' . url('/sitemap-main.xml') . '</loc>' . "\n";
            $sitemap .= '<lastmod>' . now()->toISOString() . '</lastmod>' . "\n";
            $sitemap .= '</sitemap>' . "\n";
            
            // Blog sitemap
            $sitemap .= '<sitemap>' . "\n";
            $sitemap .= '<loc>' . url('/sitemap-blog.xml') . '</loc>' . "\n";
            $sitemap .= '<lastmod>' . now()->toISOString() . '</lastmod>' . "\n";
            $sitemap .= '</sitemap>' . "\n";
            
            $sitemap .= '</sitemapindex>';
            
            return response($sitemap, 200, ['Content-Type' => 'application/xml']);
        });
    }

    public function main()
    {
        return Cache::remember('sitemap_main', 3600, function() {
            $sitemap = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
            $sitemap .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
            
            // Static pages
            $staticPages = [
                ['url' => url('/'), 'priority' => '1.0', 'changefreq' => 'daily'],
                ['url' => route('about'), 'priority' => '0.8', 'changefreq' => 'monthly'],
                ['url' => route('courses.index'), 'priority' => '0.9', 'changefreq' => 'weekly'],
                ['url' => route('projects.index'), 'priority' => '0.8', 'changefreq' => 'weekly'],
                ['url' => route('jobs.index'), 'priority' => '0.7', 'changefreq' => 'daily'],
                ['url' => route('events.index'), 'priority' => '0.7', 'changefreq' => 'weekly'],
                ['url' => route('blog.index'), 'priority' => '0.9', 'changefreq' => 'daily'],
                ['url' => route('contact'), 'priority' => '0.6', 'changefreq' => 'monthly'],
            ];
            
            foreach ($staticPages as $page) {
                $sitemap .= '<url>' . "\n";
                $sitemap .= '<loc>' . $page['url'] . '</loc>' . "\n";
                $sitemap .= '<lastmod>' . now()->toISOString() . '</lastmod>' . "\n";
                $sitemap .= '<changefreq>' . $page['changefreq'] . '</changefreq>' . "\n";
                $sitemap .= '<priority>' . $page['priority'] . '</priority>' . "\n";
                $sitemap .= '</url>' . "\n";
            }
            
            // Courses
            $courses = Course::all();
            foreach ($courses as $course) {
                $sitemap .= '<url>' . "\n";
                $sitemap .= '<loc>' . route('courses.show', $course->slug) . '</loc>' . "\n";
                $sitemap .= '<lastmod>' . $course->updated_at->toISOString() . '</lastmod>' . "\n";
                $sitemap .= '<changefreq>weekly</changefreq>' . "\n";
                $sitemap .= '<priority>0.8</priority>' . "\n";
                $sitemap .= '</url>' . "\n";
            }
            
            // Projects
            $projects = Project::all();
            foreach ($projects as $project) {
                $sitemap .= '<url>' . "\n";
                $sitemap .= '<loc>' . route('projects.show', $project->slug) . '</loc>' . "\n";
                $sitemap .= '<lastmod>' . $project->updated_at->toISOString() . '</lastmod>' . "\n";
                $sitemap .= '<changefreq>monthly</changefreq>' . "\n";
                $sitemap .= '<priority>0.7</priority>' . "\n";
                $sitemap .= '</url>' . "\n";
            }
            
            // Events
            $events = Event::all();
            foreach ($events as $event) {
                $sitemap .= '<url>' . "\n";
                $sitemap .= '<loc>' . route('events.show', $event->slug) . '</loc>' . "\n";
                $sitemap .= '<lastmod>' . $event->updated_at->toISOString() . '</lastmod>' . "\n";
                $sitemap .= '<changefreq>weekly</changefreq>' . "\n";
                $sitemap .= '<priority>0.7</priority>' . "\n";
                $sitemap .= '</url>' . "\n";
            }
            
            $sitemap .= '</urlset>';
            
            return response($sitemap, 200, ['Content-Type' => 'application/xml']);
        });
    }

    public function blog()
    {
        return Cache::remember('sitemap_blog', 1800, function() {
            $sitemap = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
            $sitemap .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:news="http://www.google.com/schemas/sitemap-news/0.9">' . "\n";
            
            // Blog articles
            $articles = Article::whereNotNull('published_at')->orderBy('updated_at', 'desc')->get();
            foreach ($articles as $article) {
                $sitemap .= '<url>' . "\n";
                $sitemap .= '<loc>' . route('blog.show', $article->slug) . '</loc>' . "\n";
                $sitemap .= '<lastmod>' . $article->updated_at->toISOString() . '</lastmod>' . "\n";
                $sitemap .= '<changefreq>weekly</changefreq>' . "\n";
                $sitemap .= '<priority>0.8</priority>' . "\n";
                
                // Add news sitemap data for recent articles
                if ($article->published_at && $article->published_at->isAfter(now()->subDays(2))) {
                    $sitemap .= '<news:news>' . "\n";
                    $sitemap .= '<news:publication>' . "\n";
                    $sitemap .= '<news:name>Digital Leap Africa</news:name>' . "\n";
                    $sitemap .= '<news:language>en</news:language>' . "\n";
                    $sitemap .= '</news:publication>' . "\n";
                    $sitemap .= '<news:publication_date>' . $article->published_at->toISOString() . '</news:publication_date>' . "\n";
                    $sitemap .= '<news:title>' . htmlspecialchars($article->title) . '</news:title>' . "\n";
                    $sitemap .= '</news:news>' . "\n";
                }
                
                $sitemap .= '</url>' . "\n";
            }
            
            $sitemap .= '</urlset>';
            
            return response($sitemap, 200, ['Content-Type' => 'application/xml']);
        });
    }
}