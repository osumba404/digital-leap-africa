@extends('emails.base')

@section('content')
<div class="greeting">
    <span class="icon icon-success"></span>Great News, {{ $user->name }}!
</div>

<div class="message">
    <p>Your enrollment for <strong>{{ $course->title }}</strong> has been <strong style="color: #00C9FF;">approved</strong>!</p>
</div>

<div class="info-box">
    <h3 style="margin-bottom: 10px; color: #252A32;">Course Access Granted</h3>
    <p>You now have full access to all course materials, lessons, and resources. Start learning at your own pace!</p>
</div>

<div style="text-align: center; margin: 30px 0;">
    <a href="{{ url('/courses/' . $course->id) }}" class="cta-button">
        Access Your Course
    </a>
</div>

<div class="message">
    <h4>Your Learning Journey Starts Now:</h4>
    <ul style="text-align: left; margin: 15px 0;">
        <li>Complete lessons to earn 50 points each</li>
        <li>Finish the entire course for 200 bonus points</li>
        <li>Participate in discussions and forums</li>
        <li>Earn your completion certificate</li>
    </ul>
</div>

<div class="message">
    <p>Need help? Our support team is here to assist you every step of the way. Happy learning!</p>
</div>
@endsection