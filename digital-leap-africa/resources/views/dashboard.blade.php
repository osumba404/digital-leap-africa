@extends('layouts.app')

@section('content')
<style>
.dashboard-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 2rem;
    margin: 2rem 0;
}

.stat-card {
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: var(--radius);
    padding: 2rem;
    text-align: center;
    position: relative;
    overflow: hidden;
}

.stat-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 4px;
    height: 100%;
    background: var(--cyan-accent);
}

.stat-number {
    font-size: 2.5rem;
    font-weight: 700;
    color: var(--cyan-accent);
    display: block;
    margin-bottom: 0.5rem;
}

.stat-label {
    color: var(--cool-gray);
    font-size: 0.9rem;
    text-transform: uppercase;
    font-weight: 500;
}

.course-card {
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: var(--radius);
    padding: 1.5rem;
    margin-bottom: 1rem;
    transition: transform 0.2s, box-shadow 0.2s;
}

.course-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
}

.progress-bar {
    background: rgba(255, 255, 255, 0.1);
    height: 8px;
    border-radius: 4px;
    overflow: hidden;
    margin: 1rem 0;
}

.progress-fill {
    background: var(--cyan-accent);
    height: 100%;
    border-radius: 4px;
    transition: width 0.3s ease;
}

.section-card {
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: var(--radius);
    padding: 2rem;
    margin-bottom: 2rem;
}

.quick-actions {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1rem;
    margin: 2rem 0;
}

.action-card {
    background: rgba(255, 255, 255, 0.02);
    border: 1px solid rgba(255, 255, 255, 0.05);
    border-radius: var(--radius);
    padding: 1.5rem;
    text-align: center;
    transition: all 0.2s;
    text-decoration: none;
    color: inherit;
}

.action-card:hover {
    background: rgba(255, 255, 255, 0.05);
    transform: translateY(-2px);
    color: inherit;
}

.action-icon {
    font-size: 2rem;
    color: var(--cyan-accent);
    margin-bottom: 1rem;
}
</style>

<div class="container">
    {{-- Welcome Section --}}
    <div style="text-align: center; margin-bottom: 3rem;">
        <h1 style="font-size: 2.5rem; font-weight: 700; margin-bottom: 1rem; background: linear-gradient(90deg, var(--cyan-accent), var(--purple-accent)); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
            Welcome back, {{ Auth::user()->name }}!
        </h1>
        <p style="color: var(--cool-gray); font-size: 1.1rem;">Ready to continue your digital learning journey?</p>
    </div>

    {{-- Stats Dashboard --}}
    <div class="dashboard-grid">
        <div class="stat-card">
            <span class="stat-number">{{ Auth::user()->courses()->count() }}</span>
            <div class="stat-label">Courses Enrolled</div>
        </div>
        
        <div class="stat-card">
            <span class="stat-number">{{ Auth::user()->lessons()->count() }}</span>
            <div class="stat-label">Lessons Completed</div>
        </div>
        
        <div class="stat-card">
            @php
                $points = Auth::user()->gamificationPoints()->sum('points') ?? 0;
            @endphp
            <span class="stat-number">{{ $points }}</span>
            <div class="stat-label">Points Earned</div>
        </div>
        
        <div class="stat-card">
            <span class="stat-number">{{ Auth::user()->created_at->diffInDays(now()) }}</span>
            <div class="stat-label">Days Active</div>
        </div>
    </div>

    {{-- My Courses Section --}}
    @if(Auth::user()->courses()->count() > 0)
        <div class="section-card">
            <h2 style="font-size: 1.5rem; font-weight: 600; color: var(--diamond-white); margin-bottom: 1.5rem;">
                <i class="fas fa-graduation-cap me-2"></i>My Courses
            </h2>
            
            @foreach(Auth::user()->courses()->take(3)->get() as $course)
                @php
                    $totalLessons = $course->topics->sum(function($topic) { return $topic->lessons->count(); });
                    $completedLessons = Auth::user()->lessons()->whereIn('lesson_id', 
                        $course->topics->flatMap->lessons->pluck('id')
                    )->count();
                    $progress = $totalLessons > 0 ? ($completedLessons / $totalLessons) * 100 : 0;
                @endphp
                
                <div class="course-card">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 1rem;">
                        <div style="flex-grow: 1;">
                            <h3 style="color: var(--diamond-white); font-size: 1.25rem; font-weight: 600; margin-bottom: 0.5rem;">
                                <a href="{{ route('courses.show', $course) }}" style="color: inherit; text-decoration: none;">
                                    {{ $course->title }}
                                </a>
                            </h3>
                            @if($course->instructor)
                                <p style="color: var(--cyan-accent); font-size: 0.9rem; margin-bottom: 1rem;">
                                    <i class="fas fa-user-tie me-1"></i>{{ $course->instructor }}
                                </p>
                            @endif
                        </div>
                        
                        <a href="{{ route('courses.show', $course) }}" class="btn-primary" style="padding: 0.5rem 1rem;">
                            Continue
                        </a>
                    </div>
                    
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                        <span style="color: var(--cool-gray); font-size: 0.9rem;">Progress</span>
                        <span style="color: var(--cyan-accent); font-weight: 600;">{{ round($progress) }}%</span>
                    </div>
                    
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: {{ $progress }}%;"></div>
                    </div>
                </div>
            @endforeach
            
            @if(Auth::user()->courses()->count() > 3)
                <div style="text-align: center; margin-top: 1.5rem;">
                    <a href="{{ route('courses.index') }}" class="btn-outline" style="padding: 0.75rem 1.5rem;">
                        View All My Courses
                    </a>
                </div>
            @endif
        </div>
    @endif

    {{-- Quick Actions --}}
    <div class="section-card">
        <h2 style="font-size: 1.5rem; font-weight: 600; color: var(--diamond-white); margin-bottom: 1.5rem;">
            <i class="fas fa-bolt me-2"></i>Quick Actions
        </h2>
        
        <div class="quick-actions">
            <a href="{{ route('courses.index') }}" class="action-card">
                <div class="action-icon">
                    <i class="fas fa-search"></i>
                </div>
                <h3 style="color: var(--diamond-white); font-size: 1rem; font-weight: 600; margin-bottom: 0.5rem;">Browse Courses</h3>
                <p style="color: var(--cool-gray); font-size: 0.9rem; margin: 0;">Discover new learning opportunities</p>
            </a>
            
            <a href="{{ route('projects.index') }}" class="action-card">
                <div class="action-icon">
                    <i class="fas fa-project-diagram"></i>
                </div>
                <h3 style="color: var(--diamond-white); font-size: 1rem; font-weight: 600; margin-bottom: 0.5rem;">View Projects</h3>
                <p style="color: var(--cool-gray); font-size: 0.9rem; margin: 0;">Explore community projects</p>
            </a>
            
            <a href="{{ route('forum.index') }}" class="action-card">
                <div class="action-icon">
                    <i class="fas fa-comments"></i>
                </div>
                <h3 style="color: var(--diamond-white); font-size: 1rem; font-weight: 600; margin-bottom: 0.5rem;">Join Forum</h3>
                <p style="color: var(--cool-gray); font-size: 0.9rem; margin: 0;">Connect with the community</p>
            </a>
            
            <a href="{{ route('jobs.index') }}" class="action-card">
                <div class="action-icon">
                    <i class="fas fa-briefcase"></i>
                </div>
                <h3 style="color: var(--diamond-white); font-size: 1rem; font-weight: 600; margin-bottom: 0.5rem;">Find Jobs</h3>
                <p style="color: var(--cool-gray); font-size: 0.9rem; margin: 0;">Discover career opportunities</p>
            </a>
        </div>
    </div>

    {{-- Recent Activity or Recommendations --}}
    @if(Auth::user()->courses()->count() == 0)
        <div class="section-card">
            <div style="text-align: center; padding: 2rem 0;">
                <i class="fas fa-rocket" style="font-size: 4rem; color: var(--cyan-accent); margin-bottom: 1.5rem;"></i>
                <h3 style="color: var(--diamond-white); font-size: 1.5rem; margin-bottom: 1rem;">Ready to Start Learning?</h3>
                <p style="color: var(--cool-gray); margin-bottom: 2rem; max-width: 500px; margin-left: auto; margin-right: auto;">
                    You haven't enrolled in any courses yet. Explore our catalog and begin your digital transformation journey today!
                </p>
                <a href="{{ route('courses.index') }}" class="btn-primary" style="padding: 0.75rem 2rem; font-size: 1.1rem;">
                    <i class="fas fa-graduation-cap me-2"></i>Browse Courses
                </a>
            </div>
        </div>
    @endif
</div>
@endsection