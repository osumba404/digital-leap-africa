@extends('emails.base')

@section('content')
<div class="greeting">Hello {{ $user->name }},</div>

<div class="message">
    Thank you for your interest in <strong>{{ $course->title }}</strong>. After reviewing your enrollment request, we need to discuss your application further.
</div>

<div class="info-box">
    <strong>📋 Next Steps:</strong><br>
    Our admissions team would like to connect with you to better understand your learning goals and ensure this course is the perfect fit for your needs.
</div>

<a href="{{ url('/contact') }}" class="cta-button">
    Contact Support Team
</a>

<div class="message">
    <strong>Alternative Options:</strong><br>
    • Explore our free courses to get started<br>
    • Check prerequisite requirements<br>
    • Consider our beginner-friendly programs<br>
    • Join our community forum for guidance
</div>

<div class="message">
    <strong>We're Here to Help:</strong><br>
    This isn't a rejection - it's an opportunity to find the best learning path for you. Our team is committed to supporting your educational journey.
</div>

<div class="message">
    Please don't hesitate to reach out to our support team. We're here to help you succeed!
</div>
@endsection