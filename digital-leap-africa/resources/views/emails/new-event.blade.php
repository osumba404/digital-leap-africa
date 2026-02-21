@extends('emails.base')

@section('content')
<div class="greeting">Hello {{ $user->name }},</div>

<div class="message">
    <p>We've added a new event you might be interested in.</p>
</div>

<div class="info-box">
    <h3>{{ $event->title }}</h3>
    <ul style="list-style: none; padding: 0; margin: 12px 0 0;">
        <li style="margin-bottom: 6px;"><strong>Date:</strong> {{ \Carbon\Carbon::parse($event->date)->format('l, F j, Y') }}</li>
        <li style="margin-bottom: 6px;"><strong>Location:</strong> {{ $event->location ?? 'TBA' }}</li>
        @if(!empty($event->topic))
            <li style="margin-bottom: 6px;"><strong>Topic:</strong> {{ $event->topic }}</li>
        @endif
    </ul>
    @if(!empty($event->description))
        <p style="margin-top: 12px; margin-bottom: 0;">{{ Str::limit(strip_tags($event->description), 180) }}</p>
    @endif
</div>

<div style="text-align: center; margin: 24px 0;">
    <a href="{{ route('events.show', $event->slug ?? $event->id) }}" class="cta-button">View Event Details</a>
</div>

<div class="message">
    <p>We hope to see you there!</p>
</div>
@endsection
