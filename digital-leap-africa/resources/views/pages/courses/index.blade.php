@extends('layouts.app')

@section('content')
<style>
.courses-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    gap: 2rem;
    margin: 2rem 0;
}

.course-card {
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: var(--radius);
    overflow: hidden;
    transition: transform 0.3s, box-shadow 0.3s;
}

.course-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
}

.course-image {
    width: 100%;
    height: 200px;
    object-fit: cover;
    background: linear-gradient(135deg, var(--primary-blue), var(--deep-blue));
}

.course-content {
    padding: 1.5rem;
}

.course-title {
    font-size: 1.25rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
    color: var(--diamond-white);
}

.course-instructor {
    color: var(--cyan-accent);
    font-size: 0.9rem;
    margin-bottom: 1rem;
}

.course-description {
    color: var(--cool-gray);
    line-height: 1.6;
    margin-bottom: 1.5rem;
}

.course-meta {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 1rem;
    padding-top: 1rem;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
}

.course-level {
    background: rgba(122, 95, 255, 0.2);
    color: var(--purple-accent);
    padding: 0.25rem 0.75rem;
    border-radius: 999px;
    font-size: 0.8rem;
    font-weight: 500;
}
</style>

<div class="container">
    <div style="text-align: center; margin-bottom: 3rem;">
        <h1 style="font-size: 2.5rem; font-weight: 700; margin-bottom: 1rem;">Our Courses</h1>
        <p style="color: var(--cool-gray); font-size: 1.1rem;">Discover expert-led courses designed to accelerate your digital journey</p>
    </div>

    @if($courses->count() > 0)
        <div class="courses-grid">
            @foreach ($courses as $course)
                <div class="course-card">
                    @if($course->image_url)
                        <img src="{{ $course->image_url }}" alt="{{ $course->title }}" class="course-image">
                    @else
                        <div class="course-image" style="display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-graduation-cap" style="font-size: 3rem; color: var(--diamond-white); opacity: 0.3;"></i>
                        </div>
                    @endif
                    
                    <div class="course-content">
                        <h3 class="course-title">
                            <a href="{{ route('courses.show', $course) }}" style="color: inherit; text-decoration: none;">
                                {{ $course->title }}
                            </a>
                        </h3>
                        
                        @if($course->instructor)
                            <div class="course-instructor">
                                <i class="fas fa-user-tie me-1"></i>{{ $course->instructor }}
                            </div>
                        @endif
                        
                        <p class="course-description">
                            {{ Str::limit($course->description, 120) }}
                        </p>
                        
                        <div class="course-meta">
                            @if($course->level)
                                <span class="course-level">{{ ucfirst($course->level) }}</span>
                            @endif
                            
                            <a href="{{ route('courses.show', $course) }}" class="btn-primary" style="padding: 0.5rem 1.25rem;">
                                View Course
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        {{-- Pagination --}}
        <div style="margin-top: 3rem; display: flex; justify-content: center;">
            {{ $courses->links() }}
        </div>
    @else
        <div style="text-align: center; padding: 4rem 0;">
            <i class="fas fa-graduation-cap" style="font-size: 4rem; color: var(--cool-gray); opacity: 0.5; margin-bottom: 1rem;"></i>
            <h3 style="color: var(--cool-gray); margin-bottom: 1rem;">No Courses Available</h3>
            <p style="color: var(--cool-gray);">Check back soon for new courses!</p>
        </div>
    @endif
</div>
@endsection