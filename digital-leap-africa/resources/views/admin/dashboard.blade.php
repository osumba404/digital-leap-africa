@extends('admin.layout')

@push('styles')
<style>
.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
    gap: 1rem;
    margin-bottom: 1.5rem;
}

.stat-card {
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 8px;
    padding: 1rem;
    text-align: center;
    transition: all 0.2s;
}

.stat-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    border-color: rgba(0, 201, 255, 0.3);
}

.stat-icon {
    font-size: 1.75rem;
    color: var(--cyan-accent);
    margin-bottom: 0.5rem;
}

.stat-value {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--diamond-white);
    margin-bottom: 0.25rem;
}

.stat-label {
    color: var(--cool-gray);
    font-size: 0.75rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.quick-actions {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
    gap: 0.75rem;
    margin: 1.5rem 0;
}

.action-card {
    background: rgba(255, 255, 255, 0.02);
    border: 1px solid rgba(255, 255, 255, 0.05);
    border-radius: 8px;
    padding: 1rem;
    text-decoration: none;
    color: var(--diamond-white);
    transition: all 0.2s;
    text-align: center;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.action-card:hover {
    background: rgba(255, 255, 255, 0.05);
    border-color: rgba(0, 201, 255, 0.3);
    color: var(--diamond-white);
    transform: translateY(-2px);
}

.action-icon {
    font-size: 1.5rem;
    color: var(--cyan-accent);
    margin-bottom: 0.5rem;
}

.action-title {
    font-weight: 600;
    font-size: 0.9rem;
    margin-bottom: 0.25rem;
}

.action-desc {
    font-size: 0.75rem;
    color: var(--cool-gray);
    line-height: 1.3;
}

/* Light Mode Styles */
[data-theme="light"] .stat-card {
    background: #FFFFFF;
    border: 1px solid rgba(46, 120, 197, 0.2);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
}

[data-theme="light"] .stat-card:hover {
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    border-color: rgba(46, 120, 197, 0.4);
}

[data-theme="light"] .stat-icon {
    color: var(--primary-blue);
}

[data-theme="light"] .stat-value {
    color: var(--primary-blue);
}

[data-theme="light"] .stat-label {
    color: var(--cool-gray);
}

[data-theme="light"] .action-card {
    background: rgba(46, 120, 197, 0.05);
    border: 1px solid rgba(46, 120, 197, 0.15);
    color: var(--charcoal);
}

[data-theme="light"] .action-card:hover {
    background: rgba(46, 120, 197, 0.1);
    border-color: rgba(46, 120, 197, 0.3);
    color: var(--charcoal);
}

[data-theme="light"] .action-icon {
    color: var(--primary-blue);
}

[data-theme="light"] .action-title {
    color: var(--primary-blue);
}

[data-theme="light"] .action-desc {
    color: var(--cool-gray);
}

[data-theme="light"] .recent-activity {
    background: #FFFFFF;
    border: 1px solid rgba(46, 120, 197, 0.2);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
}

/* Mobile Responsive */
@media (max-width: 768px) {
    .stats-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 0.75rem;
    }
    
    .stat-card {
        padding: 0.75rem;
    }
    
    .stat-icon {
        font-size: 1.5rem;
        margin-bottom: 0.4rem;
    }
    
    .stat-value {
        font-size: 1.25rem;
    }
    
    .stat-label {
        font-size: 0.7rem;
    }
    
    .quick-actions {
        grid-template-columns: repeat(2, 1fr);
        gap: 0.5rem;
    }
    
    .action-card {
        padding: 0.75rem 0.5rem;
    }
    
    .action-icon {
        font-size: 1.25rem;
        margin-bottom: 0.4rem;
    }
    
    .action-title {
        font-size: 0.8rem;
    }
    
    .action-desc {
        font-size: 0.7rem;
    }
}

@media (max-width: 480px) {
    .stats-grid {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .stat-icon {
        font-size: 1.35rem;
    }
    
    .stat-value {
        font-size: 1.15rem;
    }
}
</style>
@endpush

@section('admin-content')
<div class="page-header">
    <h1 class="page-title">Dashboard</h1>
    <div class="page-actions">
        <span style="color: var(--cool-gray); font-size: 0.9rem;">Welcome, {{ Auth::user()->name }}!</span>
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

<h2 style="color: var(--diamond-white); margin: 1.5rem 0 0.75rem; font-size: 1.15rem;">Quick Actions</h2>
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
<h2 style="color: var(--diamond-white); margin: 1.5rem 0 0.75rem; font-size: 1.15rem;">Recent Activity</h2>
<div class="recent-activity" style="background: rgba(255, 255, 255, 0.02); border: 1px solid rgba(255, 255, 255, 0.05); border-radius: 8px; padding: 1rem;">
    @foreach($recentActivities as $activity)
    <div style="display: flex; align-items: center; gap: 0.75rem; padding: 0.75rem 0; border-bottom: 1px solid rgba(255, 255, 255, 0.05);">
        <div style="width: 36px; height: 36px; background: rgba(0, 201, 255, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
            <i class="fas fa-{{ $activity['icon'] }}" style="color: var(--cyan-accent); font-size: 0.9rem;"></i>
        </div>
        <div style="flex: 1; min-width: 0;">
            <div style="color: var(--diamond-white); font-size: 0.9rem;">{{ $activity['description'] }}</div>
            <div style="color: var(--cool-gray); font-size: 0.75rem;">{{ $activity['time'] }}</div>
        </div>
    </div>
    @endforeach
</div>
@endif
@endsection