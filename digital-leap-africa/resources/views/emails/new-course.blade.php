@extends('emails.base')

@section('content')
<div class="notification-content">
    <div class="notification-icon success">
        <i class="fas fa-plus-circle"></i>
    </div>
    
    <h1>New Course Available!</h1>
    
    <p>Hello {{ $user->name }},</p>
    
    <p>We're excited to announce a new course that's now available on Digital Leap Africa!</p>
    
    <div class="course-info">
        <h3>{{ $course->title }}</h3>
        <p>{{ $course->description }}</p>
        
        <ul>
            <li><strong>Instructor:</strong> {{ $course->instructor }}</li>
            <li><strong>Type:</strong> {{ ucfirst(str_replace('_', ' ', $course->course_type ?? 'self_paced')) }}</li>
            @if($course->is_free)
                <li><strong>Price:</strong> Free</li>
            @else
                <li><strong>Price:</strong> ${{ number_format($course->price, 2) }}</li>
            @endif
        </ul>
    </div>
    
    <div class="action-section">
        <p>Don't miss out on this opportunity to expand your skills and advance your career!</p>
        
        <a href="{{ route('courses.show', $course->id) }}" class="btn btn-primary">View Course Details</a>
        <a href="{{ route('courses.index') }}" class="btn btn-secondary">Browse All Courses</a>
    </div>
    
    <p>Start your learning journey today and join thousands of students already transforming their careers with Digital Leap Africa.</p>
</div>
@endsection