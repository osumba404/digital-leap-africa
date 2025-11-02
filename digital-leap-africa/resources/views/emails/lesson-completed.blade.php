@extends('emails.base')

@section('content')
<div class="greeting">Well Done, {{ $user->name }}! 🎯</div>

<div class="message">
    You've successfully completed the lesson: <strong>{{ $lesson->title }}</strong>
</div>

<div class="info-box">
    <strong>🏆 Achievement Unlocked!</strong><br>
    <strong>Points Earned:</strong> +50 points<br>
    <strong>Course:</strong> {{ $lesson->topic->course->title ?? 'Course' }}<br>
    <strong>Progress:</strong> Keep up the momentum!
</div>

<a href="{{ url('/courses/' . ($lesson->topic->course->id ?? '#')) }}" class="cta-button">
    Continue Learning
</a>

<div class="message">
    <strong>Your Learning Stats:</strong><br>
    • Lesson completed: {{ $lesson->title }}<br>
    • Points earned today: 50<br>
    • Keep going to unlock more achievements!
</div>

<div class="message">
    Every lesson completed brings you closer to mastering new skills. Stay consistent and keep building your expertise!
</div>
@endsection