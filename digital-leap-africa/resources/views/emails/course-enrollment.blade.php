@extends('emails.base')

@section('content')
<div class="greeting">Hello {{ $user->name }}! 🎉</div>

<div class="message">
    Congratulations! You have successfully enrolled in <strong>{{ $course->title }}</strong>.
</div>

<div class="info-box">
    <strong>Course Details:</strong><br>
    <strong>Title:</strong> {{ $course->title }}<br>
    <strong>Duration:</strong> {{ $course->duration ?? 'Self-paced' }}<br>
    <strong>Level:</strong> {{ ucfirst($course->level ?? 'Beginner') }}<br>
    @if($course->price > 0)
    <strong>Type:</strong> Premium Course<br>
    @else
    <strong>Type:</strong> Free Course<br>
    @endif
</div>

<div class="message">
    @if($course->price > 0)
    Your enrollment is currently <strong>pending approval</strong>. You'll receive another email once your enrollment is approved by our team.
    @else
    You can start learning immediately! Access your course content and begin your learning journey.
    @endif
</div>

<a href="{{ url('/courses/' . $course->id) }}" class="cta-button">
    @if($course->price > 0)
    View Course Details
    @else
    Start Learning Now
    @endif
</a>

<div class="message">
    <strong>What's Next?</strong><br>
    • Complete lessons to earn points<br>
    • Engage with the community forum<br>
    • Track your progress on your dashboard<br>
    • Earn badges and certificates
</div>

<div class="message">
    Welcome to the Digital Leap Africa community! We're excited to support your learning journey.
</div>
@endsection