@extends('emails.base')

@section('content')
<div class="greeting">
    <span class="icon icon-danger"></span>Hello {{ $user->name }}!
</div>

<div class="message">
    <p>This is a <strong>formal warning</strong> regarding inactivity in <strong>{{ $course->title }}</strong>.</p>
    <p>You have been inactive for <strong>{{ $days_inactive }} days</strong>. If inactivity continues, you may be automatically unenrolled on day 21.</p>
</div>

<div style="text-align: center; margin: 30px 0;">
    <a href="{{ $course_url ?? route('courses.show', $course) }}" class="cta-button">Resume Coursework</a>
</div>
@endsection
