@extends('emails.base')

@section('content')
<div class="greeting">
    <span class="icon icon-warning"></span>Hello {{ $user->name }},
</div>

<div class="message">
    <p>You have received a warning regarding your enrollment in <strong>{{ $course->title }}</strong>.</p>
</div>

<div class="info-box">
    <h3 style="margin-bottom: 10px; color: #252A32;">Course Details:</h3>
    <ul style="list-style: none; padding: 0;">
        <li style="margin-bottom: 5px;"><strong>Course:</strong> {{ $course->title }}</li>
        <li style="margin-bottom: 5px;"><strong>Instructor:</strong> {{ $course->instructor }}</li>
        <li style="margin-bottom: 5px;"><strong>Status:</strong> Active (Warning Issued)</li>
    </ul>
</div>

<div class="message">
    <h4>What this means:</h4>
    <p>This warning may be related to course participation, assignment submissions, or community guidelines. Please review your recent activity and ensure you're following all course requirements.</p>
</div>

<div class="message">
    <p>We encourage you to reach out to our support team if you need clarification or assistance with your course participation.</p>
    
    <div style="text-align: center; margin: 30px 0;">
        <a href="{{ route('contact') }}" class="cta-button">Contact Support</a>
    </div>
    
    <p>We're here to help you succeed in your learning journey.</p>
</div>
@endsection