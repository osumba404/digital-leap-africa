@extends('admin.layout')

@push('styles')
<style>
.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.stat-card {
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: var(--radius);
    padding: 1.5rem;
    text-align: center;
    transition: all 0.3s;
}

.stat-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    border-color: rgba(0, 201, 255, 0.3);
}

.stat-icon {
    font-size: 2.5rem;
    color: var(--cyan-accent);
    margin-bottom: 1rem;
}

.stat-value {
    font-size: 2rem;
    font-weight: 700;
    color: var(--diamond-white);
    margin-bottom: 0.5rem;
}

.stat-label {
    color: var(--cool-gray);
    font-size: 0.9rem;
}

.quick-actions {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1rem;
    margin: 2rem 0;
}

.action-card {
    background: rgba(255, 255, 255, 0.02);
    border: 1px solid rgba(255, 255, 255, 0.05);
    border-radius: var(--radius);
    padding: 1.5rem;
    text-decoration: none;
    color: var(--diamond-white);
    transition: all 0.3s;
    text-align: center;
}

.action-card:hover {
    background: rgba(255, 255, 255, 0.05);
    border-color: rgba(0, 201, 255, 0.3);
    color: var(--diamond-white);
    transform: translateY(-2px);
}

.action-icon {
    font-size: 2rem;
    color: var(--cyan-accent);
    margin-bottom: 1rem;
}

.action-title {
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.action-desc {
    font-size: 0.9rem;
    color: var(--cool-gray);
}
</style>
@endpush

@section('admin-content')
<div class="page-header">
    <h1 class="page-title">Dashboard Overview</h1>
    <div class="page-actions">
        <span style="color: var(--cool-gray);">Welcome back, {{ Auth::user()->name }}!</span>
    </div>
</div>

<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon"><i class="fas fa-users"></i></div>
        <div class="stat-value">{{ $userCount ?? 0 }}</div>
        <div class="stat-label">Total Users</div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon"><i class="fas fa-graduation-cap"></i></div>
        <div class="stat-value">{{ $courseCount ?? 0 }}</div>
        <div class="stat-label">Courses</div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon"><i class="fas fa-project-diagram"></i></div>
        <div class="stat-value">{{ $projectCount ?? 0 }}</div>
        <div class="stat-label">Projects</div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon"><i class="fas fa-briefcase"></i></div>
        <div class="stat-value">{{ $jobCount ?? 0 }}</div>
        <div class="stat-label">Jobs</div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon"><i class="fas fa-newspaper"></i></div>
        <div class="stat-value">{{ $articleCount ?? 0 }}</div>
        <div class="stat-label">Articles</div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon"><i class="fas fa-calendar-alt"></i></div>
        <div class="stat-value">{{ $eventCount ?? 0 }}</div>
        <div class="stat-label">Events</div>
    </div>
</div>

<h2 style="color: var(--diamond-white); margin: 2rem 0 1rem;">Quick Actions</h2>
<div class="quick-actions">
    <a href="{{ route('admin.courses.create') }}" class="action-card">
        <div class="action-icon"><i class="fas fa-plus"></i></div>
        <div class="action-title">Add Course</div>
        <div class="action-desc">Create new learning content</div>
    </a>
    
    <a href="{{ route('admin.articles.create') }}" class="action-card">
        <div class="action-icon"><i class="fas fa-pen"></i></div>
        <div class="action-title">Write Article</div>
        <div class="action-desc">Publish blog content</div>
    </a>
    
    <a href="{{ route('admin.jobs.create') }}" class="action-card">
        <div class="action-icon"><i class="fas fa-briefcase"></i></div>
        <div class="action-title">Post Job</div>
        <div class="action-desc">Add career opportunity</div>
    </a>
    
    <a href="{{ route('admin.projects.create') }}" class="action-card">
        <div class="action-icon"><i class="fas fa-rocket"></i></div>
        <div class="action-title">Add Project</div>
        <div class="action-desc">Showcase community work</div>
    </a>
</div>

@if(isset($recentActivities) && count($recentActivities) > 0)
<h2 style="color: var(--diamond-white); margin: 2rem 0 1rem;">Recent Activity</h2>
<div style="background: rgba(255, 255, 255, 0.02); border: 1px solid rgba(255, 255, 255, 0.05); border-radius: var(--radius); padding: 1.5rem;">
    @foreach($recentActivities as $activity)
    <div style="display: flex; align-items: center; gap: 1rem; padding: 1rem 0; border-bottom: 1px solid rgba(255, 255, 255, 0.05);">
        <div style="width: 40px; height: 40px; background: rgba(0, 201, 255, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
            <i class="fas fa-{{ $activity['icon'] }}" style="color: var(--cyan-accent);"></i>
        </div>
        <div style="flex: 1;">
            <div style="color: var(--diamond-white);">{{ $activity['description'] }}</div>
            <div style="color: var(--cool-gray); font-size: 0.9rem;">{{ $activity['time'] }}</div>
        </div>
    </div>
    @endforeach
</div>
@endif
@endsection