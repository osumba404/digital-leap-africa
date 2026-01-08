@extends('emails.base')

@section('content')
<div class="greeting">
    <span class="icon icon-danger"></span>Hello {{ $user->name }},
</div>

<div class="message">
    <p>This is to confirm that you have been unenrolled from <strong>{{ $course->title }}</strong>.</p>
</div>

<div class="info-box">
    <h3 style="margin-bottom: 10px; color: #252A32;">Course Details:</h3>
    <ul style="list-style: none; padding: 0;">
        <li style="margin-bottom: 5px;"><strong>Course:</strong> {{ $course->title }}</li>
        <li style="margin-bottom: 5px;"><strong>Instructor:</strong> {{ $course->instructor }}</li>
        <li style="margin-bottom: 5px;"><strong>Status:</strong> Unenrolled</li>
    </ul>
</div>

<div class="message">
    <p><strong>Important:</strong> All progress data and course materials access have been permanently removed.</p>
</div>

<div style="text-align: center; margin: 30px 0;">
    <a href="{{ url('/contact') }}" class="cta-button">Contact Support</a>
</div>

<div class="message">
    <p>If you have questions about this unenrollment or would like to explore other courses, please contact our support team.</p>
    <p>Thank you for being part of our learning community.</p>
</div>
@endsection