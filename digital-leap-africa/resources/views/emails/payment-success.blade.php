@extends('emails.base')

@section('content')
<div class="greeting">Payment Successful, {{ $user->name }}! ✅</div>

<div class="message">
    Your payment has been processed successfully. Thank you for your purchase!
</div>

<div class="info-box">
    <strong>💳 Transaction Details:</strong><br>
    <strong>Transaction ID:</strong> {{ $payment->transaction_id }}<br>
    <strong>Amount:</strong> KSH {{ number_format($payment->amount, 2) }}<br>
    <strong>Date:</strong> {{ $payment->created_at->format('M d, Y H:i') }}<br>
    <strong>Status:</strong> <span style="color: #00C9FF;">Completed</span>
</div>

@if(isset($course))
<div class="message">
    <strong>Course Access:</strong><br>
    You now have full access to <strong>{{ $course->title }}</strong>. Start learning immediately!
</div>

<a href="{{ url('/courses/' . $course->id) }}" class="cta-button">
    Access Your Course
</a>
@endif

<div class="message">
    <strong>What's Included:</strong><br>
    • Lifetime access to course materials<br>
    • All future course updates<br>
    • Community forum access<br>
    • Certificate upon completion<br>
    • Priority support
</div>

<div class="message">
    A receipt for this transaction has been sent to your email. If you have any questions about your purchase, please contact our support team.
</div>
@endsection