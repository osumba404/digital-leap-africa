@extends('emails.base')

@section('content')
<div class="greeting">
    <span class="icon icon-warning"></span>Hello {{ $user->name }}!
</div>

<div class="message">
    <p>We noticed you have been inactive in <strong>{{ $course->title }}</strong> for <strong>{{ $days_inactive }} days</strong>.</p>
    <p>Please continue your coursework to remain in good standing.</p>
</div>

<div class="info-box">
    <h3>Reminder Milestone</h3>
    <p>This is your day {{ $milestone ?? $days_inactive }} inactivity reminder.</p>
</div>

<div style="text-align: center; margin: 30px 0;">
    <a href="{{ $course_url ?? route('courses.show', $course) }}" class="cta-button">Continue Course</a>
</div>
@endsection
