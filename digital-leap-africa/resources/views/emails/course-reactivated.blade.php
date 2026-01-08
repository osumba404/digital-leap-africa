@extends('emails.base')

@section('content')
<div class="greeting">
    <span class="icon icon-success"></span>Hello {{ $user->name }},
</div>

<div class="message">
    <p>Great news! Your access to <strong>{{ $course->title }}</strong> has been restored and reactivated.</p>
</div>

<div class="info-box">
    <h3 style="margin-bottom: 10px; color: #252A32;">Course Details:</h3>
    <ul style="list-style: none; padding: 0;">
        <li style="margin-bottom: 5px;"><strong>Course:</strong> {{ $course->title }}</li>
        <li style="margin-bottom: 5px;"><strong>Instructor:</strong> {{ $course->instructor }}</li>
        <li style="margin-bottom: 5px;"><strong>Status:</strong> Active</li>
    </ul>
</div>

<div class="message">
    <p>You can now continue your learning journey where you left off. All your previous progress has been preserved.</p>
    
    <div style="text-align: center; margin: 30px 0;">
        <a href="{{ route('courses.show', $course->id) }}" class="cta-button">Continue Learning</a>
    </div>
    
    <p>We're excited to have you back and look forward to supporting your continued success!</p>
</div>
@endsection