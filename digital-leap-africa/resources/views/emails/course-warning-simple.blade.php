@extends('emails.base')

@section('content')
<div class="greeting">
    <span class="icon icon-warning"></span>Hello {{ $user->name }}!
</div>

<div class="message">
    <p>You have received a warning regarding your enrollment in <strong>{{ $course->title }}</strong>.</p>
</div>

<div class="info-box">
    <h3 style="margin-bottom: 10px; color: #252A32;">Course Details:</h3>
    <ul style="list-style: none; padding: 0;">
        <li style="margin-bottom: 5px;"><strong>Course:</strong> {{ $course->title }}</li>
        <li style="margin-bottom: 5px;"><strong>Status:</strong> Warning Issued</li>
    </ul>
</div>

<div style="text-align: center; margin: 30px 0;">
    <a href="{{ url('/contact') }}" class="cta-button">Contact Support</a>
</div>

<div class="message">
    <p>Please review your course participation and contact support if needed.</p>
</div>
@endsection