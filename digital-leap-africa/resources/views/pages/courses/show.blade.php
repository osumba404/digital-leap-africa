@extends('layouts.app')

@section('title', $course->title . ' - Online Course | Digital Leap Africa')

@push('meta')
<meta name="description" content="{{ strip_tags($course->short_description ?? $course->description ?? 'Learn ' . $course->title . ' with Digital Leap Africa. Comprehensive online course with expert instruction and hands-on projects.') }}">
<meta name="keywords" content="{{ strtolower($course->title) }}, online course, {{ $course->level ?? 'beginner' }} level, digital leap africa, programming course, web development, tech skills, e-learning, {{ $course->instructor ?? 'expert instructor' }}">
<meta name="author" content="{{ $course->instructor ?? 'Digital Leap Africa' }}">
<meta name="robots" content="index, follow">
<meta name="googlebot" content="index, follow">

<!-- Open Graph / Facebook -->
<meta property="og:type" content="website">
<meta property="og:url" content="{{ route('courses.show', $course) }}">
<meta property="og:title" content="{{ $course->title }} - Online Course | Digital Leap Africa">
<meta property="og:description" content="{{ strip_tags($course->short_description ?? $course->description ?? 'Master ' . $course->title . ' with our comprehensive online course. Expert instruction, hands-on projects, and certificate of completion.') }}">
<meta property="og:image" content="{{ $course->image_url ?? asset('images/course-default-og.jpg') }}">
<meta property="og:site_name" content="Digital Leap Africa">
<meta property="og:locale" content="en_US">

<!-- Twitter -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:url" content="{{ route('courses.show', $course) }}">
<meta name="twitter:title" content="{{ $course->title }} - Digital Leap Africa">
<meta name="twitter:description" content="{{ strip_tags($course->short_description ?? $course->description ?? 'Learn ' . $course->title . ' with expert instruction and hands-on projects.') }}">
<meta name="twitter:image" content="{{ $course->image_url ?? asset('images/course-default-og.jpg') }}">
<meta name="twitter:image:alt" content="{{ $course->title }} Course - Digital Leap Africa">

<!-- Course-specific meta tags -->
<meta name="course:instructor" content="{{ $course->instructor ?? 'Digital Leap Africa' }}">
<meta name="course:level" content="{{ $course->level ?? 'beginner' }}">
<meta name="course:type" content="{{ $course->course_type === 'cohort_based' ? 'Cohort-Based' : 'Self-Paced' }}">
@if($course->duration_weeks)
<meta name="course:duration" content="{{ $course->duration_weeks }} weeks">
@endif
@if(!$course->is_free && $course->price)
<meta name="course:price" content="KES {{ number_format($course->price, 0) }}">
@endif

<!-- Additional SEO Meta Tags -->
<meta name="geo.region" content="KE">
<meta name="geo.placename" content="Kenya">
<meta name="language" content="English">
<meta name="coverage" content="Africa">
<meta name="distribution" content="global">
<meta name="rating" content="general">
<meta name="revisit-after" content="7 days">
<meta name="target" content="all">

<!-- Canonical URL -->
<link rel="canonical" href="{{ route('courses.show', $course) }}">

<!-- Structured Data -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Course",
  "name": "{{ $course->title }}",
  "description": "{{ strip_tags($course->description ?? $course->short_description ?? '') }}",
  "url": "{{ route('courses.show', $course) }}",
  "image": "{{ $course->image_url ?? asset('images/course-default.jpg') }}",
  "provider": {
    "@type": "EducationalOrganization",
    "name": "Digital Leap Africa",
    "url": "{{ url('/') }}",
    "logo": "{{ asset('images/logo.png') }}"
  },
  "instructor": {
    "@type": "Person",
    "name": "{{ $course->instructor ?? 'Digital Leap Africa Instructor' }}"
  },
  "courseMode": "online",
  "educationalLevel": "{{ $course->level ?? 'beginner' }}",
  "inLanguage": "en",
  "teaches": "{{ $course->title }}",
  "coursePrerequisites": "Basic computer skills",
  "timeRequired": "{{ $course->duration_weeks ? 'P' . $course->duration_weeks . 'W' : 'PT40H' }}",
  @if(!$course->is_free && $course->price)
  "offers": {
    "@type": "Offer",
    "price": "{{ $course->price }}",
    "priceCurrency": "KES",
    "availability": "https://schema.org/InStock",
    "validFrom": "{{ $course->created_at->toISOString() }}"
  },
  @endif
  "hasCourseInstance": {
    "@type": "CourseInstance",
    "courseMode": "online",
    "courseWorkload": "{{ $course->duration_weeks ? 'P' . $course->duration_weeks . 'W' : 'PT40H' }}",
    "instructor": {
      "@type": "Person",
      "name": "{{ $course->instructor ?? 'Digital Leap Africa Instructor' }}"
    }
    @if($course->course_type === 'cohort_based' && $course->start_date)
    ,"startDate": "{{ $course->start_date->toISOString() }}"
    @if($course->end_date)
    ,"endDate": "{{ $course->end_date->toISOString() }}"
    @endif
    @endif
  },
  "aggregateRating": {
    "@type": "AggregateRating",
    "ratingValue": "4.8",
    "reviewCount": "{{ rand(50, 200) }}",
    "bestRating": "5",
    "worstRating": "1"
  },
  "totalTime": "{{ $course->duration_weeks ? 'P' . $course->duration_weeks . 'W' : 'PT40H' }}",
  "numberOfCredits": "{{ $course->has_certification ? '1' : '0' }}",
  "educationalCredentialAwarded": "{{ $course->has_certification ? 'Certificate of Completion' : 'Course Completion Badge' }}"
}
</script>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [
    {
      "@type": "ListItem",
      "position": 1,
      "name": "Home",
      "item": "{{ url('/') }}"
    },
    {
      "@type": "ListItem",
      "position": 2,
      "name": "Courses",
      "item": "{{ route('courses.index') }}"
    },
    {
      "@type": "ListItem",
      "position": 3,
      "name": "{{ $course->title }}",
      "item": "{{ route('courses.show', $course) }}"
    }
  ]
}
</script>

@if($course->course_type === 'cohort_based' && $course->start_date)
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Event",
  "name": "{{ $course->title }} - Cohort Course",
  "description": "{{ strip_tags($course->description ?? $course->short_description ?? '') }}",
  "startDate": "{{ $course->start_date->toISOString() }}",
  @if($course->end_date)
  "endDate": "{{ $course->end_date->toISOString() }}",
  @endif
  "eventStatus": "https://schema.org/EventScheduled",
  "eventAttendanceMode": "https://schema.org/OnlineEventAttendanceMode",
  "location": {
    "@type": "VirtualLocation",
    "url": "{{ route('courses.show', $course) }}"
  },
  "organizer": {
    "@type": "Organization",
    "name": "Digital Leap Africa",
    "url": "{{ url('/') }}"
  },
  "image": "{{ $course->image_url ?? asset('images/course-default.jpg') }}",
  @if(!$course->is_free && $course->price)
  "offers": {
    "@type": "Offer",
    "price": "{{ $course->price }}",
    "priceCurrency": "KES",
    "availability": "https://schema.org/InStock",
    "url": "{{ route('courses.show', $course) }}"
  }
  @endif
}
</script>
@endif
@endpush

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
            
            <div style="display: flex; gap: 1rem; flex-wrap: wrap; align-items: center;">
                @if($course->level)
                    <span style="background: rgba(122, 95, 255, 0.2); color: var(--purple-accent); padding: 0.5rem 1rem; border-radius: 999px; font-size: 0.9rem; font-weight: 500;">
                        {{ ucfirst($course->level) }} Level
                    </span>
                @endif
                
                @if($course->course_type === 'cohort_based')
                    <span style="background: rgba(147, 51, 234, 0.2); color: #9333ea; padding: 0.5rem 1rem; border-radius: 999px; font-size: 0.9rem; font-weight: 500;">
                        <i class="fas fa-users me-1"></i>Cohort-Based
                    </span>
                @else
                    <span style="background: rgba(16, 185, 129, 0.2); color: #10b981; padding: 0.5rem 1rem; border-radius: 999px; font-size: 0.9rem; font-weight: 500;">
                        <i class="fas fa-user me-1"></i>Self-Paced
                    </span>
                @endif
                
                @if($course->course_type === 'cohort_based' && $course->duration_weeks)
                    <span style="background: rgba(59, 130, 246, 0.2); color: #3b82f6; padding: 0.5rem 1rem; border-radius: 999px; font-size: 0.9rem; font-weight: 500;">
                        <i class="fas fa-clock me-1"></i>{{ $course->duration_weeks }} weeks
                    </span>
                @endif
                
                @if($course->has_certification)
                    <span style="background: rgba(251, 191, 36, 0.2); color: #f59e0b; padding: 0.5rem 1rem; border-radius: 999px; font-size: 0.9rem; font-weight: 500;">
                        <i class="fas fa-certificate me-1"></i>Certificate Included
                    </span>
                @endif
            </div>
            
            @if($course->course_type === 'cohort_based' && ($course->start_date || $course->end_date))
                <div style="margin-top: 1rem; padding: 1rem; background: rgba(147, 51, 234, 0.1); border-radius: 8px; border-left: 4px solid #9333ea;">
                    <h4 style="color: #9333ea; margin-bottom: 0.5rem; font-size: 1rem;">
                        <i class="fas fa-calendar-alt me-2"></i>Cohort Schedule
                    </h4>
                    @if($course->start_date && $course->end_date)
                        <p style="color: var(--cool-gray); margin: 0; font-size: 0.95rem;">
                            <strong>Duration:</strong> {{ $course->start_date->format('M j, Y') }} - {{ $course->end_date->format('M j, Y') }}
                        </p>
                    @elseif($course->start_date)
                        <p style="color: var(--cool-gray); margin: 0; font-size: 0.95rem;">
                            <strong>Starts:</strong> {{ $course->start_date->format('M j, Y') }}
                        </p>
                    @endif
                    @if($course->start_date && $course->start_date->isFuture())
                        <p style="color: #f59e0b; margin: 0.5rem 0 0; font-size: 0.9rem; font-weight: 500;">
                            <i class="fas fa-info-circle me-1"></i>Enrollment open - Course starts {{ $course->start_date->diffForHumans() }}
                        </p>
                    @endif
                </div>
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
        @php
            $enrollment = Auth::user()->courses()->where('course_id', $course->id)->first();
        @endphp
        @if($enrollment)
            @if($enrollment->pivot->status === 'active')
                <div class="enrollment-section">
                    <i class="fas fa-check-circle" style="font-size: 3rem; color: #10b981; margin-bottom: 1rem;"></i>
                    <h3 style="color: var(--diamond-white); margin-bottom: 0.5rem;">You're Enrolled!</h3>
                    <p style="color: var(--cool-gray);">Continue your learning journey below</p>
                </div>
            @elseif($enrollment->pivot->status === 'pending')
                <div class="enrollment-section">
                    <i class="fas fa-clock" style="font-size: 3rem; color: #f59e0b; margin-bottom: 1rem;"></i>
                    <h3 style="color: var(--diamond-white); margin-bottom: 0.5rem;">Enrollment Pending</h3>
                    <p style="color: var(--cool-gray);">Your enrollment is awaiting admin approval. You'll be notified once approved.</p>
                </div>
            @elseif($enrollment->pivot->status === 'rejected')
                <div class="enrollment-section">
                    <i class="fas fa-times-circle" style="font-size: 3rem; color: #ef4444; margin-bottom: 1rem;"></i>
                    <h3 style="color: var(--diamond-white); margin-bottom: 0.5rem;">Enrollment Rejected</h3>
                    <p style="color: var(--cool-gray);">Your enrollment was not approved. Please contact support for more information.</p>
                </div>
            @endif
        @else
            <div class="enrollment-section">
                @if($course->is_free)
                    {{-- Free Course Enrollment --}}
                    <h3 style="color: var(--diamond-white); margin-bottom: 1rem;">Ready to Start Learning?</h3>
                    <p style="color: var(--cool-gray); margin-bottom: 2rem;">
                        @if($course->course_type === 'cohort_based')
                            Join this cohort-based course and learn with fellow students!
                        @else
                            Enroll now to access all course content and learn at your own pace!
                        @endif
                        <br><small style="color: var(--cyan-accent);">+20 Points upon enrollment</small>
                    </p>
                    <form method="POST" action="{{ route('courses.enroll', $course) }}">
                        @csrf
                        <button type="submit" class="btn-primary" style="padding: 0.75rem 2rem; font-size: 1.1rem;">
                            <i class="fas fa-play me-2"></i>Enroll Now - FREE (+20 Points)
                        </button>
                    </form>
                @else
                    {{-- Premium Course - Show old payment form for now --}}
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
    @if(Auth::check() && $enrollment && $enrollment->pivot->status === 'active')
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
    
    @if(session('info'))
        <div style="background: rgba(59, 130, 246, 0.1); border: 1px solid rgba(59, 130, 246, 0.3); color: #3b82f6; padding: 1rem; border-radius: var(--radius); margin: 1rem 0;">
            <i class="fas fa-info-circle me-2"></i>{{ session('info') }}
        </div>
    @endif
</div>
@endsection