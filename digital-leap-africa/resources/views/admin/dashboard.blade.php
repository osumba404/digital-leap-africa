@extends('admin.layout')

@push('styles')
<style>
    /* Dashboard specific styles */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: linear-gradient(135deg, rgba(46, 120, 197, 0.1) 0%, rgba(30, 76, 124, 0.1) 100%);
        border: 1px solid rgba(46, 120, 197, 0.1);
        border-radius: var(--radius);
        padding: 1.5rem;
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
    }

    .stat-card__value {
        font-size: 2rem;
        font-weight: 700;
        color: var(--cyan-accent);
        margin: 0.5rem 0 0.25rem;
        line-height: 1.2;
    }

    .stat-card__label {
        font-size: 0.9rem;
        color: var(--cool-gray);
        margin: 0;
    }

    .stat-card__icon {
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        background: rgba(0, 201, 255, 0.1);
        color: var(--cyan-accent);
        margin-bottom: 1rem;
    }

    .quick-actions {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .quick-action-card {
        background: rgba(255, 255, 255, 0.02);
        border: 1px solid rgba(255, 255, 255, 0.05);
        border-radius: var(--radius);
        padding: 1.5rem;
        transition: all 0.2s;
    }

    .quick-action-card:hover {
        background: rgba(255, 255, 255, 0.05);
        border-color: rgba(0, 201, 255, 0.2);
    }

    .quick-action-card h3 {
        font-size: 1.1rem;
        font-weight: 600;
        margin: 0 0 1rem 0;
        color: var(--diamond-white);
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .quick-action-card h3 i {
        color: var(--cyan-accent);
    }

    .quick-action-links {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
    }

    .quick-action-link {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.75rem;
        background: rgba(255, 255, 255, 0.02);
        border-radius: 8px;
        color: var(--diamond-white);
        text-decoration: none;
        transition: all 0.2s;
    }

    .quick-action-link:hover {
        background: rgba(0, 201, 255, 0.1);
        color: var(--cyan-accent);
    }

    .quick-action-link i {
        width: 20px;
        text-align: center;
        opacity: 0.8;
    }

    .recent-activity {
        background: rgba(255, 255, 255, 0.02);
        border: 1px solid rgba(255, 255, 255, 0.05);
        border-radius: var(--radius);
        padding: 1.5rem;
    }

    .recent-activity h2 {
        font-size: 1.25rem;
        font-weight: 600;
        margin: 0 0 1.5rem 0;
        color: var(--diamond-white);
    }

    .activity-item {
        display: flex;
        align-items: flex-start;
        gap: 1rem;
        padding: 1rem 0;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    }

    .activity-item:last-child {
        border-bottom: none;
    }

    .activity-icon {
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        background: rgba(0, 201, 255, 0.1);
        color: var(--cyan-accent);
        flex-shrink: 0;
    }

    .activity-details {
        flex: 1;
    }

    .activity-text {
        margin: 0 0 0.25rem 0;
        color: var(--diamond-white);
    }

    .activity-time {
        font-size: 0.85rem;
        color: var(--cool-gray);
    }

    @media (max-width: 768px) {
        .stats-grid {
            grid-template-columns: 1fr;
        }
        
        .quick-actions {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('title', 'Dashboard')

@section('admin-content')
<div class="welcome-message mb-5">
    <h1 class="mb-2">Welcome back, {{ Auth::user()->name }}!</h1>
    <p class="text-gray-400">Here's what's happening with your platform today.</p>
</div>

<!-- Stats Grid -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-card__icon">
            <i class="fas fa-users"></i>
        </div>
        <div class="stat-card__value">{{ $userCount ?? 0 }}</div>
        <p class="stat-card__label">Total Users</p>
    </div>
    
    <div class="stat-card">
        <div class="stat-card__icon">
            <i class="fas fa-graduation-cap"></i>
        </div>
        <div class="stat-card__value">{{ $courseCount ?? 0 }}</div>
        <p class="stat-card__label">Active Courses</p>
    </div>
    
    <div class="stat-card">
        <div class="stat-card__icon">
            <i class="fas fa-project-diagram"></i>
        </div>
        <div class="stat-card__value">{{ $projectCount ?? 0 }}</div>
        <p class="stat-card__label">Projects</p>
    </div>
    
    <div class="stat-card">
        <div class="stat-card__icon">
            <i class="fas fa-calendar-alt"></i>
        </div>
        <div class="stat-card__value">{{ $eventCount ?? 0 }}</div>
        <p class="stat-card__label">Upcoming Events</p>
    </div>
    <div class="stat-card">
        <div class="stat-card__icon">
            <i class="fas fa-newspaper"></i>
        </div>
        <div class="stat-card__value">{{ $articleCount ?? 0 }}</div>
        <p class="stat-card__label">Articles</p>
    </div>
    <div class="stat-card">
        <div class="stat-card__icon">
            <i class="fas fa-briefcase"></i>
        </div>
        <div class="stat-card__value">{{ $jobCount ?? 0 }}</div>
        <p class="stat-card__label">Jobs</p>
    </div>
</div>

<!-- Quick Actions -->
<h2 class="mb-4">Quick Actions</h2>
<div class="quick-actions">
    <div class="quick-action-card">
        <h3><i class="fas fa-graduation-cap"></i> Courses</h3>
        <div class="quick-action-links">
            <a href="{{ route('admin.courses.create') }}" class="quick-action-link">
                <i class="fas fa-plus"></i>
                <span>Add New Course</span>
            </a>
            <a href="{{ route('admin.courses.index') }}" class="quick-action-link">
                <i class="fas fa-list"></i>
                <span>View All Courses</span>
            </a>
            @php
                // Get the first course to link to its lessons
                $firstCourse = \App\Models\Course::first();
            @endphp
            @if($firstCourse)
            <a href="{{ route('admin.courses.topics.index', $firstCourse) }}" class="quick-action-link">
                <i class="fas fa-book"></i>
                <span>Manage Lessons</span>
            </a>
            @endif
        </div>
    </div>
    
    <div class="quick-action-card">
        <h3><i class="fas fa-project-diagram"></i> Projects</h3>
        <div class="quick-action-links">
            <a href="{{ route('admin.projects.create') }}" class="quick-action-link">
                <i class="fas fa-plus"></i>
                <span>Add New Project</span>
            </a>
            <a href="{{ route('admin.projects.index') }}" class="quick-action-link">
                <i class="fas fa-list"></i>
                <span>View All Projects</span>
            </a>
        </div>
    </div>
    
    <div class="quick-action-card">
        <h3><i class="fas fa-bullhorn"></i> Content</h3>
        <div class="quick-action-links">
            <a href="{{ route('admin.jobs.create') }}" class="quick-action-link">
                <i class="fas fa-briefcase"></i>
                <span>Post a Job</span>
            </a>
            <a href="{{ route('admin.events.create') }}" class="quick-action-link">
                <i class="fas fa-calendar-plus"></i>
                <span>Create Event</span>
            </a>
            <a href="{{ route('admin.articles.create') }}" class="quick-action-link">
                <i class="fas fa-newspaper"></i>
                <span>Write Article</span>
            </a>
            <a href="{{ route('admin.articles.index') }}" class="quick-action-link">
                <i class="fas fa-list"></i>
                <span>Manage Articles</span>
            </a>
            <a href="{{ route('admin.elibrary-resources.create') }}" class="quick-action-link">
                <i class="fas fa-book"></i>
                <span>Add to eLibrary</span>
            </a>
        </div>
    </div>
</div>

<!-- Analytics -->
<div class="admin-card mt-4">
    <div class="admin-card-header">
        <h2>Analytics</h2>
    </div>
    <div class="row g-4">
        <div class="col-lg-7">
            <canvas id="trendChart" height="140"></canvas>
        </div>
        <div class="col-lg-5">
            <canvas id="totalsChart" height="140"></canvas>
        </div>
    </div>
    <small class="text-muted d-block mt-2">Last 12 months</small>
</div>

<!-- Recent Activity -->
<div class="recent-activity mt-5">
    <h2>Recent Activity</h2>
    
    @forelse(($recentActivities ?? []) as $activity)
        <div class="activity-item">
            <div class="activity-icon">
                <i class="fas fa-{{ $activity['icon'] }}"></i>
            </div>
            <div class="activity-details">
                <p class="activity-text">{{ $activity['description'] }}</p>
                <div class="activity-time">
                    <i class="far fa-clock"></i> {{ $activity['time'] }}
                </div>
            </div>
        </div>
    @empty
        <div class="text-center py-4 text-gray-400">
            <i class="fas fa-inbox fa-2x mb-2"></i>
            <p>No recent activity to display</p>
        </div>
    @endforelse
    
    @if(count(($recentActivities ?? [])) > 0)
        <div class="text-center mt-4">
            <a href="#" class="btn btn-outline">View All Activity</a>
        </div>
    @endif
</div>

<!-- System Status -->
<div class="admin-card mt-5">
    <div class="admin-card-header">
        <h2>System Status</h2>
    </div>
    <div class="d-flex flex-wrap gap-4">
        <div>
            <div class="text-gray-400 mb-1">Laravel Version</div>
            <div class="text-white">{{ app()->version() }}</div>
        </div>
        <div>
            <div class="text-gray-400 mb-1">PHP Version</div>
            <div class="text-white">{{ phpversion() }}</div>
        </div>
        <div>
            <div class="text-gray-400 mb-1">Environment</div>
            <div class="text-white">
                <span class="badge bg-{{ app()->environment('production') ? 'success' : 'warning' }}">
                    {{ app()->environment() }}
                </span>
            </div>
        </div>
        <div>
            <div class="text-gray-400 mb-1">Debug Mode</div>
            <div class="text-white">
                <span class="badge bg-{{ config('app.debug') ? 'danger' : 'success' }}">
                    {{ config('app.debug') ? 'ON' : 'OFF' }}
                </span>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script>
    (function(){
        const labels = @json(($chartLabels ?? collect())->values());
        const usersSeries = @json(($usersSeries ?? collect())->values());
        const coursesSeries = @json(($coursesSeries ?? collect())->values());
        const articlesSeries = @json(($articlesSeries ?? collect())->values());

        const ctx1 = document.getElementById('trendChart');
        if (ctx1) {
            new Chart(ctx1, {
                type: 'line',
                data: {
                    labels,
                    datasets: [
                        { label: 'Users', data: usersSeries, borderColor: '#00C9FF', backgroundColor: 'rgba(0,201,255,0.15)', tension: 0.3, fill: true, pointRadius: 2 },
                        { label: 'Courses', data: coursesSeries, borderColor: '#7A5FFF', backgroundColor: 'rgba(122,95,255,0.15)', tension: 0.3, fill: true, pointRadius: 2 },
                        { label: 'Articles', data: articlesSeries, borderColor: '#2E78C5', backgroundColor: 'rgba(46,120,197,0.15)', tension: 0.3, fill: true, pointRadius: 2 },
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { labels: { color: '#F5F7FA', boxWidth: 10 } } },
                    scales: {
                        x: { ticks: { color: '#AEB8C2' }, grid: { color: 'rgba(255,255,255,0.06)' } },
                        y: { ticks: { color: '#AEB8C2' }, grid: { color: 'rgba(255,255,255,0.06)' } }
                    }
                }
            });
        }

        const ctx2 = document.getElementById('totalsChart');
        if (ctx2) {
            new Chart(ctx2, {
                type: 'bar',
                data: {
                    labels: ['Users','Courses','Projects','Events','Jobs','Articles'],
                    datasets: [{
                        label: 'Totals',
                        data: [{{ $userCount ?? 0 }}, {{ $courseCount ?? 0 }}, {{ $projectCount ?? 0 }}, {{ $eventCount ?? 0 }}, {{ $jobCount ?? 0 }}, {{ $articleCount ?? 0 }}],
                        backgroundColor: ['#00C9FF','#7A5FFF','#2E78C5','#1E4C7C','#34C759','#F59E0B']
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        x: { ticks: { color: '#AEB8C2' }, grid: { display: false } },
                        y: { ticks: { color: '#AEB8C2' }, grid: { color: 'rgba(255,255,255,0.06)' } }
                    }
                }
            });
        }
    })();
</script>
@endpush