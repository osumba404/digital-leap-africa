@extends('layouts.app')

@section('title', ($event->title ?? 'Event') . ' | Digital Leap Africa Events')
@section('meta_description', Str::limit(strip_tags($event->description ?? ''), 160))
@section('meta_keywords', implode(', ', array_merge([$event->topic ?? 'technology'], ['tech events', 'workshops', 'developer meetups', 'programming', 'digital transformation', 'Africa'])))
@section('canonical', route('events.show', $event))

@push('meta')
<!-- Open Graph / Facebook -->
<meta property="og:type" content="event">
<meta property="og:url" content="{{ route('events.show', $event) }}">
<meta property="og:title" content="{{ $event->title ?? 'Event' }}">
<meta property="og:description" content="{{ Str::limit(strip_tags($event->description ?? ''), 160) }}">
<meta property="og:image" content="{{ $event->image_url ?? asset('images/event-default.jpg') }}">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta property="og:site_name" content="Digital Leap Africa">
<meta property="og:locale" content="en_US">
@if($event->date)
<meta property="event:start_time" content="{{ $event->date->toISOString() }}">
@endif
@if($event->ends_at)
<meta property="event:end_time" content="{{ $event->ends_at->toISOString() }}">
@endif
@if($event->location)
<meta property="event:location" content="{{ $event->location }}">
@endif

<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:url" content="{{ route('events.show', $event) }}">
<meta property="twitter:title" content="{{ $event->title ?? 'Event' }}">
<meta property="twitter:description" content="{{ Str::limit(strip_tags($event->description ?? ''), 160) }}">
<meta property="twitter:image" content="{{ $event->image_url ?? asset('images/event-default.jpg') }}">
<meta property="twitter:creator" content="@DigitalLeapAfrica">
<meta property="twitter:site" content="@DigitalLeapAfrica">

<!-- Additional SEO -->
<meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
<meta name="author" content="Digital Leap Africa">
<meta name="publisher" content="Digital Leap Africa">
<meta name="geo.region" content="KE">
<meta name="geo.country" content="Kenya">
<meta name="geo.placename" content="{{ $event->location ?? 'Nairobi' }}">
<meta name="language" content="English">
<meta name="theme-color" content="#0a192f">
<meta name="mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<meta name="format-detection" content="telephone=no">
<meta name="referrer" content="origin-when-cross-origin">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://cdnjs.cloudflare.com">
<link rel="dns-prefetch" href="//fonts.googleapis.com">
<link rel="dns-prefetch" href="//cdnjs.cloudflare.com">

<!-- Event Structured Data -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Event",
  "name": "{{ addslashes($event->title ?? 'Event') }}",
  "description": "{{ addslashes(Str::limit(strip_tags($event->description ?? ''), 200)) }}",
  "url": "{{ route('events.show', $event) }}",
  @if($event->date)
  "startDate": "{{ $event->date->toISOString() }}",
  @endif
  @if($event->ends_at)
  "endDate": "{{ $event->ends_at->toISOString() }}",
  @endif
  "eventStatus": "{{ $event->date && $event->date->isFuture() ? 'https://schema.org/EventScheduled' : ($event->date && $event->date->isPast() ? 'https://schema.org/EventPostponed' : 'https://schema.org/EventScheduled') }}",
  "eventAttendanceMode": "{{ $event->location ? 'https://schema.org/OfflineEventAttendanceMode' : 'https://schema.org/OnlineEventAttendanceMode' }}",
  @if($event->image_url)
  "image": {
    "@type": "ImageObject",
    "url": "{{ $event->image_url }}",
    "width": 1200,
    "height": 630
  },
  @endif
  @if($event->location)
  "location": {
    "@type": "Place",
    "name": "{{ addslashes($event->location) }}",
    "address": {
      "@type": "PostalAddress",
      "streetAddress": "{{ addslashes($event->location) }}",
      "addressCountry": "Kenya"
    }
  },
  @else
  "location": {
    "@type": "VirtualLocation",
    "url": "{{ route('events.show', $event) }}"
  },
  @endif
  "organizer": {
    "@type": "Organization",
    "name": "Digital Leap Africa",
    "url": "{{ url('/') }}",
    "logo": {
      "@type": "ImageObject",
      "url": "{{ asset('images/logo.png') }}"
    },
    "contactPoint": {
      "@type": "ContactPoint",
      "contactType": "customer service",
      "url": "{{ route('contact') }}"
    }
  },
  "offers": {
    "@type": "Offer",
    "price": "0",
    "priceCurrency": "USD",
    "availability": "https://schema.org/InStock",
    "url": "{{ $event->registration_url ?? route('events.show', $event) }}",
    "validFrom": "{{ $event->created_at->toISOString() }}"
  },
  @if($event->topic)
  "about": {
    "@type": "Thing",
    "name": "{{ $event->topic }}"
  },
  @endif
  "performer": {
    "@type": "Organization",
    "name": "Digital Leap Africa"
  },
  "audience": {
    "@type": "Audience",
    "audienceType": "Developers, Tech Enthusiasts, Students"
  },
  "inLanguage": "en-US",
  "isAccessibleForFree": true
}
</script>

<!-- Breadcrumb Structured Data -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [
    {
      "@type": "ListItem",
      "position": 1,
      "name": "Home",
      "item": "{{ url('/') }}"
    },
    {
      "@type": "ListItem",
      "position": 2,
      "name": "Events",
      "item": "{{ route('events.index') }}"
    },
    {
      "@type": "ListItem",
      "position": 3,
      "name": "{{ $event->title ?? 'Event' }}",
      "item": "{{ route('events.show', $event) }}"
    }
  ]
}
</script>

<!-- WebPage Structured Data -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "WebPage",
  "name": "{{ $event->title ?? 'Event' }}",
  "description": "{{ Str::limit(strip_tags($event->description ?? ''), 160) }}",
  "url": "{{ route('events.show', $event) }}",
  "mainEntity": {
    "@id": "{{ route('events.show', $event) }}#event"
  },
  "breadcrumb": {
    "@id": "{{ route('events.show', $event) }}#breadcrumb"
  },
  "isPartOf": {
    "@type": "WebSite",
    "name": "Digital Leap Africa",
    "url": "{{ url('/') }}"
  },
  "potentialAction": [
    {
      "@type": "ViewAction",
      "target": "{{ route('events.show', $event) }}"
    },
    {
      "@type": "ShareAction",
      "target": "{{ route('events.show', $event) }}"
    }
    @if($event->registration_url)
    ,{
      "@type": "RegisterAction",
      "target": "{{ $event->registration_url }}"
    }
    @endif
  ]
}
</script>
@endpush

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
        will-change: transform;
        backface-visibility: hidden;
        transform: translateZ(0);
        aspect-ratio: 2/1;
    }
    
    .lazy-load {
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .lazy-load.loaded {
        opacity: 1;
    }
    
    .event-image.lazy-load {
        background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
        background-size: 200% 100%;
        animation: loading 1.5s infinite;
    }
    
    @keyframes loading {
        0% { background-position: 200% 0; }
        100% { background-position: -200% 0; }
    }
    
    [data-theme="light"] .event-image.lazy-load {
        background: linear-gradient(90deg, #f8f9fa 25%, #e9ecef 50%, #f8f9fa 75%);
        background-size: 200% 100%;
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

    @if(!empty($event->image_url))
        <div class="event-image-container">
            <img class="event-image" src="{{ $event->image_url }}" alt="{{ $event->title }}">
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