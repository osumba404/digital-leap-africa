@extends('layouts.app')

@section('content')
<style>
.dashboard-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 1.5rem 1rem;
}

.dashboard-header {
    margin-bottom: 2rem;
}

.dashboard-header h1 {
    font-size: 1.75rem;
    font-weight: 700;
    margin-bottom: 0.25rem;
    background: linear-gradient(90deg, var(--cyan-accent), var(--purple-accent));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.dashboard-header p {
    color: var(--cool-gray);
    font-size: 0.95rem;
}

.dashboard-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1rem;
    margin-bottom: 2rem;
}

.stat-card {
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 8px;
    padding: 1.25rem;
    text-align: center;
    position: relative;
    overflow: hidden;
    transition: transform 0.2s, box-shadow 0.2s;
}

.stat-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
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
    font-size: 1.75rem;
    font-weight: 700;
    color: var(--cyan-accent);
    display: block;
    margin-bottom: 0.25rem;
}

.stat-label {
    color: var(--cool-gray);
    font-size: 0.75rem;
    text-transform: uppercase;
    font-weight: 500;
    letter-spacing: 0.5px;
}

.course-card {
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 8px;
    padding: 1rem;
    margin-bottom: 0.75rem;
    transition: transform 0.2s, box-shadow 0.2s;
}

.course-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
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
    border-radius: 8px;
    padding: 1.5rem;
    margin-bottom: 1.5rem;
}

.section-title {
    font-size: 1.15rem;
    font-weight: 600;
    color: var(--diamond-white);
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.quick-actions {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
    gap: 0.75rem;
}

.action-card {
    background: rgba(255, 255, 255, 0.02);
    border: 1px solid rgba(255, 255, 255, 0.05);
    border-radius: 8px;
    padding: 1rem;
    text-align: center;
    transition: all 0.2s;
    text-decoration: none;
    color: inherit;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.action-card:hover {
    background: rgba(255, 255, 255, 0.05);
    transform: translateY(-2px);
    color: inherit;
    border-color: rgba(255, 255, 255, 0.15);
}

.action-icon {
    font-size: 1.5rem;
    color: var(--cyan-accent);
    margin-bottom: 0.5rem;
}

.action-card h3 {
    font-size: 0.85rem;
    font-weight: 600;
    margin-bottom: 0.25rem;
}

.action-card p {
    font-size: 0.75rem;
    margin: 0;
    line-height: 1.4;
}

/* ========== Light Mode Styles ========== */
[data-theme="light"] .stat-card {
    background: #FFFFFF;
    border: 1px solid rgba(46, 120, 197, 0.2);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
}

[data-theme="light"] .stat-card::before {
    background: var(--primary-blue);
}

[data-theme="light"] .stat-number {
    color: var(--primary-blue);
}

[data-theme="light"] .stat-label {
    color: var(--cool-gray);
}

[data-theme="light"] .course-card {
    background: #FFFFFF;
    border: 1px solid rgba(46, 120, 197, 0.2);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
}

[data-theme="light"] .course-card:hover {
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
}

[data-theme="light"] .course-card h3 {
    color: var(--primary-blue) !important;
}

[data-theme="light"] .course-card h3 a {
    color: var(--primary-blue) !important;
}

[data-theme="light"] .progress-bar {
    background: rgba(46, 120, 197, 0.1);
}

[data-theme="light"] .progress-fill {
    background: var(--primary-blue);
}

[data-theme="light"] .section-card {
    background: #FFFFFF;
    border: 1px solid rgba(46, 120, 197, 0.2);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
}

[data-theme="light"] .section-card h2 {
    color: var(--primary-blue) !important;
}

[data-theme="light"] .action-card {
    background: rgba(46, 120, 197, 0.05);
    border: 1px solid rgba(46, 120, 197, 0.15);
}

[data-theme="light"] .action-card:hover {
    background: rgba(46, 120, 197, 0.1);
    border-color: rgba(46, 120, 197, 0.3);
}

[data-theme="light"] .action-card h3 {
    color: var(--primary-blue) !important;
}

[data-theme="light"] .action-icon {
    color: var(--primary-blue);
}

/* Mobile Responsive */
@media (max-width: 768px) {
    .dashboard-container {
        padding: 1rem 0.75rem;
    }
    
    .dashboard-header h1 {
        font-size: 1.5rem;
    }
    
    .dashboard-header p {
        font-size: 0.85rem;
    }
    
    .dashboard-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 0.75rem;
    }
    
    .stat-card {
        padding: 1rem;
    }
    
    .stat-number {
        font-size: 1.5rem;
    }
    
    .stat-label {
        font-size: 0.7rem;
    }
    
    .section-card {
        padding: 1rem;
    }
    
    .section-title {
        font-size: 1rem;
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
    
    .action-card h3 {
        font-size: 0.75rem;
    }
    
    .action-card p {
        font-size: 0.7rem;
    }
}

@media (max-width: 480px) {
    .dashboard-grid {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .stat-number {
        font-size: 1.35rem;
    }
}
</style>

<div class="dashboard-container">
    {{-- Welcome Section --}}
    <div class="dashboard-header">
        <h1>Welcome back, {{ Auth::user()->name }}!</h1>
        <p>Ready to continue your digital learning journey?</p>
    </div>

    @if(session('google_signup'))
        <div style="background: linear-gradient(135deg, rgba(255, 193, 7, 0.15), rgba(255, 152, 0, 0.15)); border: 2px solid #ffc107; border-radius: 12px; padding: 1.5rem; margin-bottom: 2rem; animation: pulse 2s infinite;">
            <div style="display: flex; align-items: start; gap: 1rem;">
                <div style="flex-shrink: 0;">
                    <i class="fas fa-exclamation-triangle" style="font-size: 2rem; color: #ffc107;"></i>
                </div>
                <div style="flex: 1;">
                    <h3 style="margin: 0 0 0.5rem 0; color: #ffc107; font-size: 1.25rem; font-weight: 700;">
                        <i class="fas fa-key" style="margin-right: 0.5rem;"></i>Important: Change Your Password
                    </h3>
                    <p style="margin: 0 0 1rem 0; color: var(--diamond-white); font-size: 1rem; line-height: 1.6;">
                        {!! session('google_signup') !!}
                    </p>
                    <a href="{{ route('profile.edit') }}#changePassword" style="background: #ffc107; color: #000; border: none; padding: 0.75rem 1.5rem; border-radius: 8px; font-weight: 600; cursor: pointer; transition: all 0.3s; display: inline-flex; align-items: center; gap: 0.5rem; text-decoration: none;">
                        <i class="fas fa-lock"></i> Go to Profile & Change Password
                    </a>
                </div>
            </div>
        </div>
    @endif

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
            <span class="stat-number">Coming Soon</span>
            <div class="stat-label">Points Earned</div>
        </div>
        
        <div class="stat-card">
            @php
                $certificates = Auth::user()->certificates ?? collect();
            @endphp
            <span class="stat-number">{{ $certificates->count() }}</span>
            <div class="stat-label">Certificates Earned</div>
        </div>
        
        <div class="stat-card">
            @php
                $badges = Auth::user()->badges ?? collect();
            @endphp
            <span class="stat-number">{{ $badges->count() }}</span>
            <div class="stat-label">Badges Earned</div>
        </div>
    </div>

    {{-- My Courses Section --}}
    @if(Auth::user()->courses()->count() > 0)
        <div class="section-card">
            <h2 class="section-title">
                <i class="fas fa-graduation-cap"></i>My Courses
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
                    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 0.75rem; gap: 1rem;">
                        <div style="flex-grow: 1; min-width: 0;">
                            <h3 style="color: var(--diamond-white); font-size: 1rem; font-weight: 600; margin-bottom: 0.25rem;">
                                <a href="{{ route('courses.show', $course) }}" style="color: inherit; text-decoration: none;">
                                    {{ $course->title }}
                                </a>
                            </h3>
                            @if($course->instructor)
                                <p style="color: var(--cyan-accent); font-size: 0.8rem; margin: 0;">
                                    <i class="fas fa-user-tie me-1"></i>{{ $course->instructor }}
                                </p>
                            @endif
                        </div>
                        
                        @if($progress >= 100)
                            <span class="btn-completed" style="padding: 0.4rem 0.85rem; font-size: 0.85rem; white-space: nowrap; background: #22c55e; color: white; border-radius: 6px; font-weight: 600;">
                                Completed
                            </span>
                        @else
                            <a href="{{ route('courses.show', $course) }}" class="btn-primary" style="padding: 0.4rem 0.85rem; font-size: 0.85rem; white-space: nowrap;">
                                Continue
                            </a>
                        @endif
                    </div>
                    
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.4rem;">
                        <span style="color: var(--cool-gray); font-size: 0.75rem;">Progress</span>
                        <span style="color: var(--cyan-accent); font-weight: 600; font-size: 0.85rem;">{{ round($progress) }}%</span>
                    </div>
                    
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: {{ $progress }}%;"></div>
                    </div>
                </div>
            @endforeach
            
            @if(Auth::user()->courses()->count() > 3)
                <div style="text-align: center; margin-top: 1rem;">
                    <a href="{{ route('courses.index') }}" class="btn-outline" style="padding: 0.5rem 1rem; font-size: 0.85rem;">
                        View All My Courses
                    </a>
                </div>
            @endif
        </div>
    @endif

    {{-- Quick Actions --}}
    <div class="section-card">
        <h2 class="section-title">
            <i class="fas fa-bolt"></i>Quick Actions
        </h2>
        
        <div class="quick-actions">
            <a href="{{ route('courses.index') }}" class="action-card">
                <div class="action-icon">
                    <i class="fas fa-search"></i>
                </div>
                <h3 style="color: var(--diamond-white);">Browse Courses</h3>
                <p style="color: var(--cool-gray);">Discover new learning</p>
            </a>
            
            <a href="{{ route('forum.index') }}" class="action-card">
                <div class="action-icon">
                    <i class="fas fa-comments"></i>
                </div>
                <h3 style="color: var(--diamond-white);">Join Forum</h3>
                <p style="color: var(--cool-gray);">Connect with community</p>
            </a>
            
            <a href="{{ route('testimonials.create') }}" class="action-card">
                <div class="action-icon">
                    <i class="fas fa-quote-left"></i>
                </div>
                <h3 style="color: var(--diamond-white);">Share Testimonial</h3>
                <p style="color: var(--cool-gray);">Tell your experience</p>
            </a>

            <a href="{{ route('testimonials.index') }}" class="action-card">
                <div class="action-icon">
                    <i class="fas fa-star"></i>
                </div>
                <h3 style="color: var(--diamond-white);">View Testimonials</h3>
                <p style="color: var(--cool-gray);">Read experiences</p>
            </a>
            

            
            @if(Auth::user()->badges && Auth::user()->badges->count() > 0)
            <a href="#badges" onclick="document.getElementById('badges-section').scrollIntoView({behavior: 'smooth'})" class="action-card">
                <div class="action-icon">
                    <i class="fas fa-medal"></i>
                </div>
                <h3 style="color: var(--diamond-white);">My Badges</h3>
                <p style="color: var(--cool-gray);">View achievements</p>
            </a>
            @endif
            
            @if(Auth::user()->certificates && Auth::user()->certificates->count() > 0)
            <a href="#certificates" onclick="document.getElementById('certificates-section').scrollIntoView({behavior: 'smooth'})" class="action-card">
                <div class="action-icon">
                    <i class="fas fa-certificate"></i>
                </div>
                <h3 style="color: var(--diamond-white);">My Certificates</h3>
                <p style="color: var(--cool-gray);">View & download</p>
            </a>
            @endif
        </div>
    </div>

    {{-- My Badges Section --}}
    @if(Auth::user()->badges && Auth::user()->badges->count() > 0)
        <div class="section-card" id="badges-section">
            <h2 class="section-title">
                <i class="fas fa-medal"></i>My Badges
            </h2>
            
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1rem;">
                @foreach(Auth::user()->badges as $badge)
                    <div style="background: rgba(122, 95, 255, 0.1); border: 1px solid rgba(122, 95, 255, 0.3); border-radius: 8px; padding: 1.25rem; position: relative;">
                        <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1rem;">
                            @if($badge->img_url)
                                <img src="{{ $badge->img_url }}" alt="{{ $badge->badge_name }}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 8px; border: 2px solid rgba(122, 95, 255, 0.4);">
                            @else
                                <div style="width: 50px; height: 50px; background: linear-gradient(135deg, #7a5fff, #a855f7); border-radius: 8px; display: flex; align-items: center; justify-content: center; color: white; font-size: 1.5rem; border: 2px solid rgba(122, 95, 255, 0.4);">
                                    <i class="fas fa-medal"></i>
                                </div>
                            @endif
                            <div>
                                <h3 style="color: var(--diamond-white); font-size: 1rem; font-weight: 600; margin: 0;">{{ $badge->badge_name }}</h3>
                                <p style="color: var(--cool-gray); font-size: 0.8rem; margin: 0;">{{ $badge->description ?? 'Achievement badge' }}</p>
                            </div>
                        </div>
                        
                        @if($badge->pivot && $badge->pivot->awarded_at)
                            <div style="margin-bottom: 1rem;">
                                <p style="color: var(--cool-gray); font-size: 0.75rem; margin: 0;">
                                    <i class="fas fa-calendar me-1"></i>Earned: {{ \Carbon\Carbon::parse($badge->pivot->awarded_at)->format('M j, Y') }}
                                </p>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    {{-- My Certificates Section --}}
    @if(Auth::user()->certificates && Auth::user()->certificates->count() > 0)
        <div class="section-card" id="certificates-section">
            <h2 class="section-title">
                <i class="fas fa-certificate"></i>My Certificates
            </h2>
            
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1rem;">
                @foreach(Auth::user()->certificates as $certificate)
                    <div style="background: rgba(251, 191, 36, 0.1); border: 1px solid rgba(251, 191, 36, 0.3); border-radius: 8px; padding: 1.25rem; position: relative;">
                        <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1rem;">
                            <div style="width: 40px; height: 40px; background: linear-gradient(135deg, #f59e0b, #fbbf24); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 1.2rem;">
                                <i class="fas fa-certificate"></i>
                            </div>
                            <div>
                                <h3 style="color: var(--diamond-white); font-size: 1rem; font-weight: 600; margin: 0;">{{ $certificate->certificate_title }}</h3>
                                <p style="color: var(--cool-gray); font-size: 0.8rem; margin: 0;">{{ $certificate->course->title }}</p>
                            </div>
                        </div>
                        
                        <div style="margin-bottom: 1rem;">
                            <p style="color: var(--cool-gray); font-size: 0.75rem; margin: 0;">Certificate No: {{ $certificate->certificate_number }}</p>
                            <p style="color: var(--cool-gray); font-size: 0.75rem; margin: 0;">Issued: {{ $certificate->issued_at->format('M j, Y') }}</p>
                        </div>
                        
                        <div style="display: flex; gap: 0.5rem; flex-wrap: wrap;">
                            <a href="{{ route('certificates.show', $certificate) }}" class="btn-primary" style="padding: 0.4rem 0.8rem; font-size: 0.8rem; flex: 1; text-align: center;">
                                <i class="fas fa-eye me-1"></i>View
                            </a>
                            <a href="{{ route('certificates.download', $certificate) }}" class="btn-outline" style="padding: 0.4rem 0.8rem; font-size: 0.8rem; flex: 1; text-align: center;">
                                <i class="fas fa-download me-1"></i>Download
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    {{-- Recent Activity or Recommendations --}}
    @if(Auth::user()->courses()->count() == 0)
        <div class="section-card">
            <div style="text-align: center; padding: 1.5rem 0;">
                <i class="fas fa-rocket" style="font-size: 3rem; color: var(--cyan-accent); margin-bottom: 1rem;"></i>
                <h3 style="color: var(--diamond-white); font-size: 1.15rem; margin-bottom: 0.75rem;">Ready to Start Learning?</h3>
                <p style="color: var(--cool-gray); margin-bottom: 1.5rem; max-width: 500px; margin-left: auto; margin-right: auto; font-size: 0.9rem;">
                    You haven't enrolled in any courses yet. Explore our catalog and begin your digital transformation journey today!
                </p>
                <a href="{{ route('courses.index') }}" class="btn-primary" style="padding: 0.6rem 1.5rem; font-size: 0.95rem;">
                    <i class="fas fa-graduation-cap me-2"></i>Browse Courses
                </a>
            </div>
        </div>
    @endif
</div>
@endsection