@extends('layouts.app')

@section('title', $event->title ?? 'Event')

@section('content')
<section class="container">
    <div class="mb-3">
        <a class="btn-outline btn-sm" href="{{ route('events.index') }}">&larr; Back to Events</a>
    </div>

    <div class="card">
        <h1 class="m-0">{{ $event->title }}</h1>
        <div class="text-muted mt-1">
            {{ optional($event->date)->format('M j, Y g:ia') }} • {{ $event->location }}
        </div>

        @if(!empty($event->image_path))
            <img class="mt-3" src="{{ $event->image_path }}" alt="{{ $event->title }}"
                 style="width:100%;max-height:420px;object-fit:cover;border-radius:12px;">
        @endif

        @if(!empty($event->registration_url))
            <div class="mt-3">
                <a class="btn-primary" href="{{ $event->registration_url }}" target="_blank" rel="noopener">Register</a>
            </div>
        @endif

        @if(!empty($event->description))
            <div class="mt-3" style="color:var(--diamond-white);">
                {!! nl2br(e($event->description)) !!}
            </div>
        @endif
    </div>
</section>
@endsection