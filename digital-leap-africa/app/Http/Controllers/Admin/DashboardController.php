<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Course;
use App\Models\Event;
use App\Models\Job;
use App\Models\Project;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class DashboardController extends Controller
{
    public function index()
    {
        // Top-line counts
        $userCount = User::count();
        $courseCount = Course::count();
        $projectCount = Project::count();
        $eventCount = Event::count();
        $jobCount = Job::count();
        $articleCount = Article::count();

        // Build last 12 months labels
        $months = Collection::times(12, function ($i) {
            return Carbon::now()->startOfMonth()->subMonths(12 - $i);
        });
        $labels = $months->map(fn ($m) => $m->format('M Y'));

        // Dataset helper
        $countPerMonth = function ($modelClass, $dateCol = 'created_at') use ($months) {
            $start = $months->first()->copy();
            $end = $months->last()->copy()->endOfMonth();

            $rows = $modelClass::query()
                ->whereBetween($dateCol, [$start, $end])
                ->get([$dateCol])
                ->groupBy(fn ($row) => Carbon::parse($row[$dateCol])->format('Y-m'))
                ->map->count();

            return $months->map(fn ($m) => $rows->get($m->format('Y-m'), 0));
        };

        $usersSeries = $countPerMonth(User::class);
        $articlesSeries = $countPerMonth(Article::class);
        $coursesSeries = $countPerMonth(Course::class);

        // Recent activities (simple examples)
        $recentActivities = [
            ['icon' => 'user-plus', 'description' => 'New user registered', 'time' => optional(User::latest('id')->first())->created_at?->diffForHumans() ?? '—'],
            ['icon' => 'newspaper', 'description' => 'Latest article updated', 'time' => optional(Article::latest('updated_at')->first())->updated_at?->diffForHumans() ?? '—'],
            ['icon' => 'graduation-cap', 'description' => 'Course added/updated', 'time' => optional(Course::latest('updated_at')->first())->updated_at?->diffForHumans() ?? '—'],
        ];

        return view('admin.dashboard', [
            'userCount' => $userCount,
            'courseCount' => $courseCount,
            'projectCount' => $projectCount,
            'eventCount' => $eventCount,
            'jobCount' => $jobCount,
            'articleCount' => $articleCount,
            'recentActivities' => $recentActivities,
            // charts
            'chartLabels' => $labels,
            'usersSeries' => $usersSeries,
            'articlesSeries' => $articlesSeries,
            'coursesSeries' => $coursesSeries,
        ]);
    }
}
