@extends('emails.base')

@section('content')
<div class="greeting">Hello {{ $user->name }},</div>

<div class="message">
    <p>We're excited to announce a new course that's now available on Digital Leap Africa!</p>
</div>

<div class="info-box">
    <h3>{{ $course->title }}</h3>
    <p style="margin-bottom: 12px;">{{ Str::limit(strip_tags($course->description ?? ''), 200) }}</p>
    <ul style="list-style: none; padding: 0;">
        <li style="margin-bottom: 6px;"><strong>Instructor:</strong> {{ $course->instructor ?? 'Digital Leap Africa' }}</li>
        <li style="margin-bottom: 6px;"><strong>Type:</strong> {{ ucfirst(str_replace('_', ' ', $course->course_type ?? 'self_paced')) }}</li>
        @if(!empty($course->is_free) || (isset($course->price) && $course->price == 0))
            <li style="margin-bottom: 6px;"><strong>Price:</strong> Free</li>
        @else
            <li style="margin-bottom: 6px;"><strong>Price:</strong> KES {{ number_format($course->price ?? 0, 0) }}</li>
        @endif
    </ul>
</div>

<div class="message">
    <p>Don't miss out on this opportunity to expand your skills and advance your career!</p>
</div>

<div style="text-align: center; margin: 24px 0;">
    <a href="{{ route('courses.show', $course->slug ?? $course->id) }}" class="cta-button">View Course Details</a>
</div>
<p style="text-align: center; margin-top: 12px;">
    <a href="{{ route('courses.index') }}" style="color: #00C9FF; font-size: 14px;">Browse all courses</a>
</p>

<div class="message">
    <p>Start your learning journey today with Digital Leap Africa.</p>
</div>
@endsection