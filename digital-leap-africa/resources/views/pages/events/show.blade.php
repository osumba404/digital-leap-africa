@extends('layouts.app')

@section('title', $event->title ?? 'Event')

@section('content')
@php
    // Model casts ensure $event->date and $event->ends_at are Carbon|null
    $start = $event->date;
    $end   = $event->ends_at;
    $sameDay = ($start && $end) ? $start->isSameDay($end) : false;
    $whenText = $start ? $start->format('M j, Y g:ia') : '';
    if ($end) {
        $whenText .= $sameDay ? ' – ' . $end->format('g:ia') : ' – ' . $end->format('M j, Y g:ia');
    }
    
    // Determine event status
    $now = now();
    $isUpcoming = $start && $start->isFuture();
    $isPast = $end ? $end->isPast() : ($start && $start->isPast());
    $isOngoing = !$isUpcoming && !$isPast;
@endphp

<style>
    .event-hero {
        background: linear-gradient(135deg, rgba(10, 15, 28, 0.95) 0%, rgba(19, 26, 42, 0.9) 100%);
        padding: 3rem 0;
        margin: -2rem -5% 2rem;
        border-radius: 0 0 24px 24px;
        position: relative;
        overflow: hidden;
    }
    
    [data-theme="light"] .event-hero {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.98) 0%, rgba(230, 242, 255, 0.95) 100%);
        border-bottom: 2px solid rgba(46, 120, 197, 0.2);
    }
    
    .event-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: radial-gradient(circle at 20% 50%, rgba(0, 201, 255, 0.1) 0%, transparent 50%);
        pointer-events: none;
    }
    
    .event-hero-content {
        position: relative;
        z-index: 1;
    }
    
    .event-title {
        font-size: 2.5rem;
        font-weight: 800;
        color: var(--diamond-white);
        margin: 0 0 1rem 0;
        line-height: 1.2;
    }
    
    [data-theme="light"] .event-title {
        color: #1a202c;
    }
    
    .event-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 1.5rem;
        align-items: center;
        margin-bottom: 1.5rem;
    }
    
    .event-meta-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: var(--cool-gray);
        font-size: 1rem;
    }
    
    .event-meta-item i {
        color: var(--cyan-accent);
        font-size: 1.1rem;
    }
    
    [data-theme="light"] .event-meta-item {
        color: #4A5568;
    }
    
    [data-theme="light"] .event-meta-item i {
        color: var(--primary-blue);
    }
    
    .event-status-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1rem;
        border-radius: 999px;
        font-weight: 600;
        font-size: 0.9rem;
    }
    
    .event-status-badge.upcoming {
        background: rgba(59, 130, 246, 0.15);
        color: #64b5f6;
        border: 1px solid rgba(59, 130, 246, 0.3);
    }
    
    .event-status-badge.ongoing {
        background: rgba(16, 185, 129, 0.15);
        color: #10b981;
        border: 1px solid rgba(16, 185, 129, 0.3);
    }
    
    .event-status-badge.past {
        background: rgba(156, 163, 175, 0.15);
        color: #9ca3af;
        border: 1px solid rgba(156, 163, 175, 0.3);
    }
    
    [data-theme="light"] .event-status-badge.upcoming {
        background: rgba(46, 120, 197, 0.1);
        color: var(--primary-blue);
        border-color: rgba(46, 120, 197, 0.3);
    }
    
    [data-theme="light"] .event-status-badge.ongoing {
        background: rgba(16, 185, 129, 0.1);
        color: #059669;
        border-color: rgba(16, 185, 129, 0.3);
    }
    
    .event-topic-badge {
        background: linear-gradient(90deg, var(--cyan-accent), var(--purple-accent));
        color: #07101a;
        padding: 0.5rem 1rem;
        border-radius: 999px;
        font-weight: 600;
        font-size: 0.9rem;
        display: inline-block;
    }
    
    [data-theme="light"] .event-topic-badge {
        background: linear-gradient(90deg, var(--primary-blue), #6B46C1);
        color: #FFFFFF;
    }
    
    .event-image-container {
        margin: 2rem 0;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
    }
    
    [data-theme="light"] .event-image-container {
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(46, 120, 197, 0.2);
    }
    
    .event-image {
        width: 100%;
        max-height: 500px;
        object-fit: cover;
        display: block;
    }
    
    .event-content-card {
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 16px;
        padding: 2rem;
        margin-bottom: 2rem;
    }
    
    [data-theme="light"] .event-content-card {
        background: #FFFFFF;
        border: 1px solid rgba(46, 120, 197, 0.2);
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.05);
    }
    
    .event-description {
        color: var(--cool-gray);
        font-size: 1.1rem;
        line-height: 1.8;
        margin: 0;
    }
    
    [data-theme="light"] .event-description {
        color: #4A5568;
    }
    
    .event-actions {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
        margin-top: 1.5rem;
    }
    
    .btn-register {
        background: linear-gradient(90deg, var(--cyan-accent), var(--purple-accent));
        color: #07101a;
        padding: 0.75rem 2rem;
        border-radius: 999px;
        font-weight: 600;
        font-size: 1rem;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 14px rgba(0, 201, 255, 0.3);
    }
    
    .btn-register:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 201, 255, 0.4);
        color: #07101a;
    }
    
    [data-theme="light"] .btn-register {
        background: linear-gradient(90deg, var(--primary-blue), #6B46C1);
        color: #FFFFFF;
        box-shadow: 0 4px 14px rgba(46, 120, 197, 0.3);
    }
    
    [data-theme="light"] .btn-register:hover {
        box-shadow: 0 8px 25px rgba(46, 120, 197, 0.4);
        color: #FFFFFF;
    }
    
    .btn-back {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: var(--diamond-white);
        padding: 0.5rem 1rem;
        border-radius: 8px;
        font-weight: 500;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
        margin-bottom: 2rem;
    }
    
    .btn-back:hover {
        background: rgba(255, 255, 255, 0.1);
        border-color: rgba(255, 255, 255, 0.3);
        transform: translateX(-3px);
        color: var(--diamond-white);
    }
    
    [data-theme="light"] .btn-back {
        background: rgba(46, 120, 197, 0.05);
        border: 1px solid rgba(46, 120, 197, 0.3);
        color: var(--primary-blue);
    }
    
    [data-theme="light"] .btn-back:hover {
        background: rgba(46, 120, 197, 0.15);
        border-color: rgba(46, 120, 197, 0.5);
        color: var(--primary-blue);
    }
    
    @media (max-width: 768px) {
        .event-hero {
            padding: 2rem 0;
            margin: -1rem -2.5% 1.5rem;
        }
        
        .event-title {
            font-size: 1.75rem;
        }
        
        .event-meta {
            gap: 1rem;
        }
        
        .event-meta-item {
            font-size: 0.9rem;
        }
        
        .event-content-card {
            padding: 1.5rem;
        }
        
        .event-description {
            font-size: 1rem;
        }
    }
</style>

<section class="container">
    <a class="btn-back" href="{{ route('events.index') }}">
        <i class="fas fa-arrow-left"></i> Back to Events
    </a>

    <div class="event-hero">
        <div class="event-hero-content container">
            <h1 class="event-title">{{ $event->title }}</h1>
            
            <div class="event-meta">
                <div class="event-meta-item">
                    <i class="fas fa-calendar"></i>
                    <span>{{ $whenText }}</span>
                </div>
                
                @if(!empty($event->location))
                    <div class="event-meta-item">
                        <i class="fas fa-location-dot"></i>
                        <span>{{ $event->location }}</span>
                    </div>
                @endif
                
                <div>
                    @if($isUpcoming)
                        <span class="event-status-badge upcoming">
                            <i class="fas fa-clock"></i> Upcoming
                        </span>
                    @elseif($isOngoing)
                        <span class="event-status-badge ongoing">
                            <i class="fas fa-circle" style="font-size: 0.5rem;"></i> Happening Now
                        </span>
                    @else
                        <span class="event-status-badge past">
                            <i class="fas fa-check"></i> Completed
                        </span>
                    @endif
                </div>
            </div>
            
            @if(!empty($event->topic))
                <div>
                    <span class="event-topic-badge">
                        <i class="fas fa-tag"></i> {{ $event->topic }}
                    </span>
                </div>
            @endif
        </div>
    </div>

    @if(!empty($event->image_path))
        <div class="event-image-container">
            <img class="event-image" src="{{ $event->image_path }}" alt="{{ $event->title }}">
        </div>
    @endif

    @if(!empty($event->description))
        <div class="event-content-card">
            <h2 style="color: var(--cyan-accent); margin-top: 0; margin-bottom: 1rem; font-size: 1.5rem;">
                <i class="fas fa-info-circle"></i> About This Event
            </h2>
            <div class="event-description">
                {!! nl2br(e($event->description)) !!}
            </div>
        </div>
    @endif

    @if(!empty($event->registration_url))
        <div class="event-content-card">
            <h2 style="color: var(--cyan-accent); margin-top: 0; margin-bottom: 1rem; font-size: 1.5rem;">
                <i class="fas fa-user-plus"></i> Registration
            </h2>
            <p class="event-description" style="margin-bottom: 1.5rem;">
                @if($isUpcoming)
                    Secure your spot at this event! Registration is now open.
                @elseif($isOngoing)
                    This event is currently happening. You may still be able to join!
                @else
                    This event has concluded. Check out our upcoming events.
                @endif
            </p>
            <div class="event-actions">
                <a class="btn-register" href="{{ $event->registration_url }}" target="_blank" rel="noopener">
                    <i class="fas fa-external-link-alt"></i>
                    Join Event
                </a>
                <a class="btn-back" href="{{ route('events.index') }}" style="margin: 0;">
                    <i class="fas fa-calendar-days"></i> View All Events
                </a>
            </div>
        </div>
    @endif
</section>
@endsection