@extends('emails.base')

@section('content')
<div class="greeting">Hello {{ $user->name }}! 📧</div>

<div class="message">
    {{ $message ?? 'You have a new notification from Digital Leap Africa.' }}
</div>

@if(isset($title))
<div class="info-box">
    <strong>{{ $title }}</strong>
</div>
@endif

@if(isset($actionUrl) && isset($actionText))
<a href="{{ $actionUrl }}" class="cta-button">
    {{ $actionText }}
</a>
@endif

<div class="message">
    Stay connected with Digital Leap Africa for the latest updates, courses, and opportunities to advance your tech skills.
</div>

<div class="message">
    <strong>Quick Links:</strong><br>
    • <a href="{{ url('/dashboard') }}" style="color: #2E78C5;">Your Dashboard</a><br>
    • <a href="{{ url('/courses') }}" style="color: #2E78C5;">Browse Courses</a><br>
    • <a href="{{ url('/forum') }}" style="color: #2E78C5;">Community Forum</a><br>
    • <a href="{{ url('/profile') }}" style="color: #2E78C5;">Your Profile</a>
</div>
@endsection