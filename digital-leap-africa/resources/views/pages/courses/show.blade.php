@extends('layouts.app')

@section('content')
<style>
.course-hero {
    background: linear-gradient(135deg, var(--navy-bg) 0%, var(--deep-blue) 100%);
    border-radius: var(--radius);
    overflow: hidden;
    margin-bottom: 2rem;
}

.course-image {
    width: 100%;
    height: 300px;
    object-fit: cover;
    background: linear-gradient(135deg, var(--primary-blue), var(--deep-blue));
}

.progress-bar {
    background: var(--cyan-accent);
    height: 8px;
    border-radius: 4px;
    transition: width 0.3s ease;
}

.progress-container {
    background: rgba(255, 255, 255, 0.1);
    height: 8px;
    border-radius: 4px;
    overflow: hidden;
}

.topic-section {
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: var(--radius);
    padding: 1.5rem;
    margin-bottom: 1.5rem;
}

.lesson-item {
    display: flex;
    align-items: center;
    padding: 0.75rem 0;
    border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    transition: background 0.2s;
}

.lesson-item:hover {
    background: rgba(255, 255, 255, 0.02);
    border-radius: 8px;
}

.lesson-item:last-child {
    border-bottom: none;
}

.lesson-link {
    color: var(--diamond-white);
    text-decoration: none;
    flex-grow: 1;
    font-weight: 500;
}

.lesson-link:hover {
    color: var(--cyan-accent);
}

.completed-icon {
    color: #10b981;
    margin-left: 1rem;
}

.enrollment-section {
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: var(--radius);
    padding: 2rem;
    text-align: center;
    margin: 2rem 0;
}

/* Light Mode Styles */
[data-theme="light"] .topic-section {
    background: #FFFFFF;
    border: 1px solid rgba(46, 120, 197, 0.2);
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.05);
}

[data-theme="light"] .lesson-item {
    border-bottom: 1px solid rgba(46, 120, 197, 0.1);
}

[data-theme="light"] .lesson-item:hover {
    background: rgba(46, 120, 197, 0.05);
}

[data-theme="light"] .lesson-link {
    color: #1A202C;
}

[data-theme="light"] .lesson-link:hover {
    color: #2E78C5;
}

[data-theme="light"] .enrollment-section {
    background: #FFFFFF;
    border: 1px solid rgba(46, 120, 197, 0.2);
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.05);
}

[data-theme="light"] .course-hero {
    background: linear-gradient(135deg, #E8F4F8 0%, #D6EAF8 100%);
}

[data-theme="light"] .progress-container {
    background: rgba(46, 120, 197, 0.1);
}
</style>

<div class="container">
    {{-- Course Hero Section --}}
    <div class="course-hero">
        @if($course->image_url)
            <img src="{{ $course->image_url }}" alt="{{ $course->title }}" class="course-image">
        @else
            <div class="course-image" style="display: flex; align-items: center; justify-content: center;">
                <i class="fas fa-graduation-cap" style="font-size: 4rem; color: var(--diamond-white); opacity: 0.3;"></i>
            </div>
        @endif
        
        <div style="padding: 2rem;">
            @if($course->instructor)
                <p style="color: var(--cyan-accent); margin-bottom: 0.5rem; font-weight: 500;">
                    <i class="fas fa-user-tie me-2"></i>{{ $course->instructor }}
                </p>
            @endif
            
            <h1 style="font-size: 2.5rem; font-weight: 700; margin-bottom: 1rem; color: var(--diamond-white);">
                {{ $course->title }}
            </h1>
            
            <p style="font-size: 1.1rem; color: var(--cool-gray); line-height: 1.6; margin-bottom: 1.5rem;">
                {{ $course->description }}
            </p>
            
            @if($course->level)
                <span style="background: rgba(122, 95, 255, 0.2); color: var(--purple-accent); padding: 0.5rem 1rem; border-radius: 999px; font-size: 0.9rem; font-weight: 500;">
                    {{ ucfirst($course->level) }} Level
                </span>
            @endif

            {{-- Progress Bar for Enrolled Users --}}
            @if(Auth::check() && Auth::user()->courses()->where('course_id', $course->id)->exists())
                @php
                    // Calculate progress - you may need to implement this method in User model
                    $totalLessons = $course->topics->sum(function($topic) { return $topic->lessons->count(); });
                    $completedLessons = Auth::user()->lessons()->whereIn('lesson_id', 
                        $course->topics->flatMap->lessons->pluck('id')
                    )->count();
                    $progress = $totalLessons > 0 ? ($completedLessons / $totalLessons) * 100 : 0;
                @endphp
                <div style="margin-top: 2rem;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                        <span style="color: var(--cool-gray); font-weight: 500;">Your Progress</span>
                        <span style="color: var(--cyan-accent); font-weight: 600;">{{ round($progress) }}%</span>
                    </div>
                    <div class="progress-container">
                        <div class="progress-bar" style="width: {{ $progress }}%;"></div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    {{-- Enrollment Section --}}
    @auth
        @if(Auth::user()->courses()->where('course_id', $course->id)->exists())
            <div class="enrollment-section">
                <i class="fas fa-check-circle" style="font-size: 3rem; color: #10b981; margin-bottom: 1rem;"></i>
                <h3 style="color: var(--diamond-white); margin-bottom: 0.5rem;">You're Enrolled!</h3>
                <p style="color: var(--cool-gray);">Continue your learning journey below</p>
            </div>
        @else
            <div class="enrollment-section">
                @if($course->is_free)
                    {{-- Free Course Enrollment --}}
                    <h3 style="color: var(--diamond-white); margin-bottom: 1rem;">Ready to Start Learning?</h3>
                    <p style="color: var(--cool-gray); margin-bottom: 2rem;">Enroll now to access all course content and earn points!</p>
                    <form method="POST" action="{{ route('courses.enroll', $course) }}">
                        @csrf
                        <button type="submit" class="btn-primary" style="padding: 0.75rem 2rem; font-size: 1.1rem;">
                            <i class="fas fa-play me-2"></i>Enroll Now - FREE (+50 Points)
                        </button>
                    </form>
                @else
                    {{-- Paid Course Payment --}}
                    <div style="max-width: 500px; margin: 0 auto;">
                        <div style="background: rgba(59, 130, 246, 0.1); border: 2px solid #3b82f6; border-radius: 12px; padding: 1.5rem; margin-bottom: 2rem;">
                            <div style="text-align: center; margin-bottom: 1rem;">
                                <i class="fas fa-graduation-cap" style="font-size: 3rem; color: #3b82f6;"></i>
                            </div>
                            <h3 style="color: var(--diamond-white); margin-bottom: 0.5rem; text-align: center;">Premium Course</h3>
                            <div style="text-align: center; margin: 1.5rem 0;">
                                <span style="font-size: 2.5rem; font-weight: 700; color: #3b82f6;">KES {{ number_format($course->price, 0) }}</span>
                            </div>
                            <p style="color: var(--cool-gray); text-align: center; margin-bottom: 0;">One-time payment for lifetime access</p>
                        </div>

                        <form method="POST" action="{{ route('courses.pay', $course) }}" id="payment-form">
                            @csrf
                            <div style="margin-bottom: 1.5rem;">
                                <label for="phone_number" style="display: block; color: var(--diamond-white); font-weight: 600; margin-bottom: 0.5rem;">
                                    <i class="fas fa-mobile-alt me-2"></i>M-Pesa Phone Number
                                </label>
                                <input type="text" 
                                       id="phone_number" 
                                       name="phone_number" 
                                       class="form-control" 
                                       placeholder="254712345678" 
                                       pattern="254[0-9]{9}"
                                       required
                                       style="padding: 0.75rem; font-size: 1rem; text-align: center; letter-spacing: 1px;">
                                <small style="color: var(--cool-gray); display: block; margin-top: 0.5rem; text-align: center;">
                                    Enter your phone number in format: 254XXXXXXXXX
                                </small>
                            </div>

                            <button type="submit" class="btn-primary" style="width: 100%; padding: 1rem; font-size: 1.1rem; font-weight: 600;">
                                <i class="fas fa-lock me-2"></i>Pay with M-Pesa
                            </button>
                        </form>

                        <div style="margin-top: 1.5rem; padding: 1rem; background: rgba(16, 185, 129, 0.1); border-radius: 8px; border-left: 4px solid #10b981;">
                            <p style="color: var(--cool-gray); font-size: 0.9rem; margin: 0;">
                                <i class="fas fa-shield-alt me-2" style="color: #10b981;"></i>
                                <strong>Secure Payment:</strong> You'll receive an M-Pesa prompt on your phone. Enter your PIN to complete the payment. You'll be enrolled automatically once payment is confirmed.
                            </p>
                        </div>
                    </div>
                @endif
            </div>
        @endif
    @else
        <div class="enrollment-section">
            <h3 style="color: var(--diamond-white); margin-bottom: 1rem;">Join Digital Leap Africa</h3>
            @if(!$course->is_free)
                <div style="background: rgba(59, 130, 246, 0.1); border: 2px solid #3b82f6; border-radius: 8px; padding: 1rem; margin-bottom: 1rem; display: inline-block;">
                    <span style="font-size: 1.5rem; font-weight: 700; color: #3b82f6;">KES {{ number_format($course->price, 0) }}</span>
                </div>
            @endif
            <p style="color: var(--cool-gray); margin-bottom: 2rem;">Create an account to enroll in courses and track your progress</p>
            <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                <a href="{{ route('login') }}" class="btn-outline" style="padding: 0.75rem 1.5rem;">
                    <i class="fas fa-sign-in-alt me-2"></i>Log In
                </a>
                <a href="{{ route('register') }}" class="btn-primary" style="padding: 0.75rem 1.5rem;">
                    <i class="fas fa-user-plus me-2"></i>Sign Up
                </a>
            </div>
        </div>
    @endauth

    {{-- Course Curriculum Section --}}
    @if(Auth::check() && Auth::user()->courses()->where('course_id', $course->id)->exists())
        <div style="margin-top: 3rem;">
            <h2 style="font-size: 2rem; font-weight: 600; margin-bottom: 2rem; color: var(--diamond-white);">
                <i class="fas fa-list-ul me-2"></i>Course Curriculum
            </h2>
            
            @forelse ($course->topics as $topic)
                <div class="topic-section">
                    <h3 style="color: var(--cyan-accent); font-size: 1.25rem; font-weight: 600; margin-bottom: 1rem;">
                        {{ $topic->title }}
                    </h3>
                    
                    @forelse ($topic->lessons as $lesson)
                        <div class="lesson-item">
                            <i class="fas fa-play-circle" style="color: var(--cool-gray); margin-right: 1rem;"></i>
                            <a href="{{ route('lessons.show', $lesson) }}" class="lesson-link">
                                {{ $lesson->title }}
                            </a>
                            @if(Auth::user()->lessons()->where('lesson_id', $lesson->id)->exists())
                                <i class="fas fa-check-circle completed-icon"></i>
                            @endif
                        </div>
                    @empty
                        <p style="color: var(--cool-gray); font-style: italic; margin-left: 2rem;">
                            No lessons have been added to this topic yet.
                        </p>
                    @endforelse
                </div>
            @empty
                <div style="text-align: center; padding: 3rem; background: rgba(255, 255, 255, 0.03); border-radius: var(--radius);">
                    <i class="fas fa-book-open" style="font-size: 3rem; color: var(--cool-gray); opacity: 0.5; margin-bottom: 1rem;"></i>
                    <h3 style="color: var(--cool-gray); margin-bottom: 0.5rem;">Curriculum Coming Soon</h3>
                    <p style="color: var(--cool-gray);">The instructor is working on adding course content. Check back soon!</p>
                </div>
            @endforelse
        </div>
    @endif

    {{-- Success/Error Messages --}}
    @if(session('success'))
        <div style="background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.3); color: #10b981; padding: 1rem; border-radius: var(--radius); margin: 1rem 0;">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        </div>
    @endif
    
    @if(session('error'))
        <div style="background: rgba(239, 68, 68, 0.1); border: 1px solid rgba(239, 68, 68, 0.3); color: #ef4444; padding: 1rem; border-radius: var(--radius); margin: 1rem 0;">
            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
        </div>
    @endif
</div>
@endsection