@extends('emails.base')

@section('content')
<div class="greeting">
    <span class="icon icon-danger"></span>Hello {{ $user->name }}!
</div>

<div class="message">
    <p>You have been <strong>automatically unenrolled</strong> from <strong>{{ $course->title }}</strong> after 21 days of inactivity.</p>
    <p>You can still rejoin learning by enrolling again from the courses page.</p>
</div>

<div style="text-align: center; margin: 30px 0;">
    <a href="{{ $courses_url ?? route('courses.index') }}" class="cta-button">Browse Courses</a>
</div>
@endsection
