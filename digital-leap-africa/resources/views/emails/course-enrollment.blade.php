@extends('emails.base')

@section('content')
<div class="greeting">
    <span class="icon icon-success"></span>Hello {{ $user->name }}!
</div>

<div class="message">
    <p>Congratulations! You have successfully enrolled in <strong>{{ $course->title }}</strong>.</p>
</div>

<div class="info-box">
    <h3 style="margin-bottom: 10px; color: #252A32;">Course Details:</h3>
    <ul style="list-style: none; padding: 0;">
        <li style="margin-bottom: 5px;"><strong>Title:</strong> {{ $course->title }}</li>
        <li style="margin-bottom: 5px;"><strong>Duration:</strong> {{ $course->duration ?? 'Self-paced' }}</li>
        <li style="margin-bottom: 5px;"><strong>Level:</strong> {{ ucfirst($course->level ?? 'Beginner') }}</li>
        @if($course->price > 0)
        <li style="margin-bottom: 5px;"><strong>Type:</strong> Premium Course</li>
        @else
        <li style="margin-bottom: 5px;"><strong>Type:</strong> Free Course</li>
        @endif
    </ul>
</div>

<div class="message">
    @if($course->price > 0)
    <p>Your enrollment is currently <strong>pending approval</strong>. You'll receive another email once your enrollment is approved by our team.</p>
    @else
    <p>You can start learning immediately! Access your course content and begin your learning journey.</p>
    @endif
</div>

<div style="text-align: center; margin: 30px 0;">
    <a href="{{ url('/courses/' . $course->id) }}" class="cta-button">
        @if($course->price > 0)
        View Course Details
        @else
        Start Learning Now
        @endif
    </a>
</div>

<div class="message">
    <h4>What's Next?</h4>
    <ul style="text-align: left; margin: 15px 0;">
        <li>Complete lessons to earn points</li>
        <li>Engage with the community forum</li>
        <li>Track your progress on your dashboard</li>
        <li>Earn badges and certificates</li>
    </ul>
</div>

<div class="message">
    <p>Welcome to the Digital Leap Africa community! We're excited to support your learning journey.</p>
</div>
@endsection