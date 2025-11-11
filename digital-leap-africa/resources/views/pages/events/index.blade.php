@extends('layouts.app')

@section('title', 'Tech Events & Workshops - Digital Leap Africa Community Events')
@section('meta_description', 'Join our technology events, workshops, and community meetups. Connect with fellow developers, learn new skills, and advance your tech career in Africa.')
@section('meta_keywords', 'tech events, programming workshops, developer meetups, technology conferences, coding bootcamps, web development events, Africa tech community, networking events')
@section('canonical', route('events.index'))

@push('meta')
<!-- Open Graph / Facebook -->
<meta property="og:type" content="website">
<meta property="og:url" content="{{ route('events.index') }}">
<meta property="og:title" content="Tech Events & Workshops - Digital Leap Africa Community Events">
<meta property="og:description" content="Join our technology events, workshops, and community meetups. Connect with fellow developers, learn new skills, and advance your tech career in Africa.">
<meta property="og:image" content="{{ asset('images/events-og-image.jpg') }}">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta property="og:site_name" content="Digital Leap Africa">
<meta property="og:locale" content="en_US">

<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:url" content="{{ route('events.index') }}">
<meta property="twitter:title" content="Tech Events & Workshops - Digital Leap Africa Community Events">
<meta property="twitter:description" content="Join our technology events, workshops, and community meetups. Connect with fellow developers and advance your tech career.">
<meta property="twitter:image" content="{{ asset('images/events-og-image.jpg') }}">
<meta property="twitter:creator" content="@DigitalLeapAfrica">
<meta property="twitter:site" content="@DigitalLeapAfrica">

<!-- Additional SEO -->
<meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
<meta name="author" content="Digital Leap Africa">
<meta name="publisher" content="Digital Leap Africa">
<meta name="geo.region" content="KE">
<meta name="geo.country" content="Kenya">
<meta name="geo.placename" content="Nairobi">
<meta name="language" content="English">
<meta name="theme-color" content="#0a192f">

<!-- Structured Data -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "CollectionPage",
  "name": "Digital Leap Africa Events",
  "description": "Technology events, workshops, and community meetups for developers and tech enthusiasts in Africa",
  "url": "{{ route('events.index') }}",
  "publisher": {
    "@type": "Organization",
    "name": "Digital Leap Africa",
    "url": "{{ url('/') }}",
    "logo": {
      "@type": "ImageObject",
      "url": "{{ asset('images/logo.png') }}"
    }
  },
  "mainEntity": {
    "@type": "ItemList",
    "numberOfItems": {{ $ongoing->count() + $upcoming->count() + $past->count() }},
    "itemListElement": [
      @php $allEvents = $ongoing->concat($upcoming)->concat($past); @endphp
      @if($allEvents->count())
        @foreach($allEvents->take(5) as $index => $event)
          {
            "@type": "Event",
            "position": {{ $index + 1 }},
            "name": "{{ addslashes($event->title ?? 'Tech Event') }}",
            "description": "{{ addslashes(Str::limit(strip_tags($event->description ?? ''), 160)) }}",
            "startDate": "{{ $event->date ? $event->date->toISOString() : '' }}",
            @if($event->ends_at)
              "endDate": "{{ $event->ends_at->toISOString() }}",
            @endif
            "eventStatus": "{{ $event->date && $event->date->isFuture() ? 'https://schema.org/EventScheduled' : 'https://schema.org/EventPostponed' }}",
            "eventAttendanceMode": "https://schema.org/MixedEventAttendanceMode",
            @if($event->location)
              "location": {
                "@type": "Place",
                "name": "{{ addslashes($event->location) }}",
                "address": "{{ addslashes($event->location) }}"
              },
            @endif
            "organizer": {
              "@type": "Organization",
              "name": "Digital Leap Africa",
              "url": "{{ url('/') }}"
            },
            "offers": {
              "@type": "Offer",
              "price": "0",
              "priceCurrency": "USD",
              "availability": "https://schema.org/InStock",
              "url": "{{ $event->registration_url ?? route('events.index') }}"
            }
          }{{ $index < min(4, $allEvents->count() - 1) ? ',' : '' }}
        @endforeach
      @endif
    ]
  }
}
</script>

<!-- Organization Schema -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Organization",
  "name": "Digital Leap Africa",
  "url": "{{ url('/') }}",
  "logo": "{{ asset('images/logo.png') }}",
  "description": "Leading technology education platform organizing events, workshops, and community meetups across Africa",
  "address": {
    "@type": "PostalAddress",
    "addressCountry": "Kenya",
    "addressRegion": "Nairobi"
  },
  "sameAs": [
    "https://twitter.com/DigitalLeapAfrica",
    "https://linkedin.com/company/digital-leap-africa"
  ],
  "event": [
    @if($upcoming->count())
      @foreach($upcoming->take(3) as $index => $event)
        {
          "@type": "Event",
          "name": "{{ addslashes($event->title ?? 'Tech Event') }}",
          "startDate": "{{ $event->date ? $event->date->toISOString() : '' }}",
          "location": {
            "@type": "Place",
            "name": "{{ addslashes($event->location ?? 'Online') }}"
          }
        }{{ $index < min(2, $upcoming->count() - 1) ? ',' : '' }}
      @endforeach
    @endif
  ]
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
    }
  ]
}
</script>
@endpush

@section('content')


<style>
  /* Events card styles (scoped) */
  #events-section .cards-grid{display:grid;grid-template-columns:repeat(auto-fill, minmax(320px,1fr));gap:2rem}
  #events-section .card{background-color:#112240;border-radius:12px;overflow:hidden;box-shadow:0 10px 30px rgba(2,12,27,0.7);transition:all .4s cubic-bezier(0.175,0.885,0.32,1.275);position:relative;border:0;padding:0}
  #events-section .card:hover{transform:translateY(-8px);box-shadow:0 20px 40px rgba(2,12,27,0.9)}
  /* Image container to allow overlays */
  #events-section .card-image-container{position:relative;line-height:0;font-size:0;margin:0;padding:0;display:block;border-top-left-radius:12px;border-top-right-radius:12px;overflow:hidden}
  /* Top image: full width, fixed height to reduce card length */
  #events-section .card-image{width:100%;height:180px;object-fit:cover;display:block;margin:0;border-radius:0;transition:transform .5s ease}
  #events-section .card:hover .card-image{transform:scale(1.03)}
  #events-section .card-content{padding:1.25rem}
  #events-section .card-title{font-size:1.15rem;margin-bottom:.5rem;color:#e6f1ff;line-height:1.35}
  /* shorter description to reduce height */
  #events-section .card-body{color:#8892b0;line-height:1.55;margin-bottom:1rem;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden}
  /* CTA button (blue) */
  #events-section .card-button{display:inline-flex;align-items:center;justify-content:center;background-color:transparent;color:#3b82f6;padding:.5rem 1rem;border:1px solid #3b82f6;border-radius:6px;text-decoration:none;font-size:.9rem;font-weight:500;transition:all .3s ease;cursor:pointer;gap:.5rem}
  #events-section .card-button:hover{background-color:rgba(59,130,246,.1);transform:translateY(-2px);box-shadow:0 4px 12px rgba(59,130,246,.2)}
  /* Meta row: time left, location right */
  #events-section .event-meta{display:flex;align-items:center;justify-content:space-between;margin-bottom:.65rem}
  #events-section .event-date{display:inline-flex;align-items:center;gap:.45rem;color:#3b82f6;font-size:.9rem}
  #events-section .event-location{display:inline-flex;align-items:center;gap:.45rem;color:#8892b0;font-size:.9rem}
  /* Topic badge over image, bottom-left (no container): overlap upward */
  #events-section .event-category{position:relative;display:inline-flex;align-items:center;gap:.4rem;background:rgba(59,130,246,0.85);color:#fff;padding:.35rem .65rem;border-radius:999px;font-size:.7rem;font-weight:800;text-transform:uppercase;letter-spacing:.04em;backdrop-filter:saturate(140%) blur(6px);box-shadow:0 6px 16px rgba(59,130,246,.35);margin-top:-1.6rem;margin-left:.75rem;z-index:2}
  #events-section .event-category::before{content:"\f02b";font-family:"Font Awesome 6 Free";font-weight:900;font-size:.75rem;display:inline-block}
  #events-section .event-category::after{content:"";display:inline-block;width:4px;height:4px;border-radius:50%;background:rgba(255,255,255,.8)}
  #events-section .card-style-2{position:relative}
  /* Hex date badge with white text */
  #events-section .event-date-badge{position:absolute;top:0.5rem;right:0.5rem;background:#3b82f6;color:#ffffff;width:64px;height:75px;display:flex;flex-direction:column;align-items:center;justify-content:center;text-align:center;font-weight:800;line-height:1.1;z-index:2;clip-path:polygon(50% 0%,100% 25%,100% 75%,50% 100%,0% 75%,0% 25%);box-shadow:0 4px 12px rgba(0,0,0,0.3)}
  #events-section .event-date-badge .day{font-size:1.35rem;display:block;margin-bottom:-2px;color:#ffffff}
  #events-section .event-date-badge .month{font-size:.75rem;display:block;font-weight:800;letter-spacing:.5px;color:#ffffff}
  @media (max-width:768px){#events-section .cards-grid{grid-template-columns:repeat(auto-fill, minmax(280px,1fr));gap:1.25rem}#events-section .card-image{height:160px}#events-section .event-date-badge{width:60px;height:70px}#events-section .event-date-badge .day{font-size:1.2rem}#events-section .event-date-badge .month{font-size:.7rem}}

  /* Light Mode Events */
  [data-theme="light"] #events-section .card {
      background-color: #FFFFFF;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
      border: 1px solid rgba(46, 120, 197, 0.15);
  }
  [data-theme="light"] #events-section .card:hover {
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
  }
  [data-theme="light"] #events-section .card-title {
      color: var(--primary-blue);
  }
  [data-theme="light"] #events-section .card-body,
  [data-theme="light"] #events-section .event-location {
      color: var(--cool-gray);
  }
  [data-theme="light"] #events-section .event-date {
      color: var(--primary-blue);
  }
  [data-theme="light"] #events-section .card-button {
      color: var(--primary-blue);
      border-color: var(--primary-blue);
  }
  [data-theme="light"] #events-section .card-button:hover {
      background-color: rgba(46, 120, 197, 0.1);
      box-shadow: 0 4px 12px rgba(46, 120, 197, 0.2);
  }
  [data-theme="light"] #events-section .event-date-badge {
      background: var(--primary-blue);
  }
  [data-theme="light"] #events-section .event-category {
      background: rgba(46, 120, 197, 0.85);
  }
</style>

<!-- Events Listing (Grouped) -->
<section id="events-section" style="padding:2rem 0;">
  @php
    try {
      $now = now();
      // Helper to pick an event image from common fields
      $pickEventImage = function($event) {
        return $event->image_url
            ?? $event->banner_image
            ?? $event->thumbnail
            ?? $event->cover_image
            ?? null;
      };

      // Ongoing: either spans now (has ends_at >= now) or is today when ends_at is null
      $ongoing = \App\Models\Event::query()
        ->where(function($q) use ($now) {
          $q->where(function($q2) use ($now) {
              $q2->whereNotNull('ends_at')
                 ->where('date', '<=', $now)
                 ->where('ends_at', '>=', $now);
            })
            ->orWhere(function($q2) use ($now) {
              $q2->whereNull('ends_at')
                 ->whereDate('date', $now->toDateString());
            });
        })
        ->orderBy('date', 'asc')
        ->get();

      // Upcoming: starts in the future
      $upcoming = \App\Models\Event::query()
        ->where('date', '>', $now)
        ->orderBy('date', 'asc')
        ->get();

      // Use the paginated past events from controller
      // Don't redefine $past here since it comes from controller
    } catch (\Throwable $e) {
      $ongoing = collect();
      $upcoming = collect();
      $past = collect();
    }
  @endphp

  <div class="container">
    <div class="text-center mb-3" style="text-align:center !important; color: #64b5f6; font-size: 22px">
      <h2 class="m-0">Events</h2>
    </div>

    @if($ongoing->count())
      <h3 class="mb-2" style="color:#e6f1ff;">Ongoing Events</h3>
      <div class="cards-grid" style="margin-bottom:1.75rem;">
        @foreach($ongoing as $event)
          @php
            $title = $event->title ?? 'Untitled Event';
            $image = $pickEventImage($event);
            $showUrl = \Illuminate\Support\Facades\Route::has('events.show')
              ? route('events.show', $event->slug ?? $event->id)
              : url('/events/'.($event->slug ?? $event->id));
            $start = $event->date;
            $end   = $event->ends_at;
            $timeText = '';
            if ($start) {
              $timeText = $start->format('g:ia');
              if ($end) { $timeText .= ' - ' . $end->format('g:ia'); }
            }
            $day = $start ? $start->format('d') : '';
            $month = $start ? strtoupper($start->format('M')) : '';
            $category = $event->topic ?? null;
            $excerpt = \Illuminate\Support\Str::limit(strip_tags($event->description ?? ''), 140);
            $ctaUrl = !empty($event->registration_url) ? $event->registration_url : $showUrl;
            $ctaText = !empty($event->registration_url) ? 'Join Event' : 'View Event';
          @endphp

          <div class="card card-style-2">
            @if($image)
              <img src="{{ $image }}" alt="{{ $title }}" class="card-image">
            @else
              <img src="https://via.placeholder.com/1200x700.png?text=Event" alt="{{ $title }}" class="card-image">
            @endif
            @if($category)
              <span class="event-category">{{ $category }}</span>
            @endif
            @if($start)
              <div class="event-date-badge">
                <span class="day">{{ $day }}</span>
                <span class="month">{{ $month }}</span>
              </div>
            @endif

            <div class="card-content">
              <h3 class="card-title">{{ $title }}</h3>
              <div class="event-meta">
                @if($timeText)
                  <span class="event-date"><i class="far fa-clock"></i> {{ $timeText }}</span>
                @endif
                @if(!empty($event->location))
                  <span class="event-location"><i class="fas fa-map-marker-alt"></i> {{ $event->location }}</span>
                @endif
              </div>
              @if(!empty($excerpt))
                <p class="card-body">{{ $excerpt }}</p>
              @endif
              <a href="{{ $ctaUrl }}" class="card-button">{{ $ctaText }} <i class="fas fa-arrow-right"></i></a>
            </div>
          </div>
        @endforeach
      </div>
    @endif

    @if($upcoming->count())
      <h3 class="mb-2" style="color:#e6f1ff;">Upcoming Events</h3>
      <div class="cards-grid" style="margin-bottom:1.75rem;">
        @foreach($upcoming as $event)
          @php
            $title = $event->title ?? 'Untitled Event';
            $image = $pickEventImage($event);
            $showUrl = \Illuminate\Support\Facades\Route::has('events.show')
              ? route('events.show', $event->slug ?? $event->id)
              : url('/events/'.($event->slug ?? $event->id));
            $start = $event->date;
            $end   = $event->ends_at;
            $timeText = '';
            if ($start) {
              $timeText = $start->format('g:ia');
              if ($end) { $timeText .= ' - ' . $end->format('g:ia'); }
            }
            $day = $start ? $start->format('d') : '';
            $month = $start ? strtoupper($start->format('M')) : '';
            $category = $event->topic ?? null;
            $excerpt = \Illuminate\Support\Str::limit(strip_tags($event->description ?? ''), 140);
            $ctaUrl = !empty($event->registration_url) ? $event->registration_url : $showUrl;
            $ctaText = !empty($event->registration_url) ? 'Join Event' : 'View Event';
          @endphp

          <div class="card card-style-2">
            @if($image)
              <img src="{{ $image }}" alt="{{ $title }}" class="card-image">
            @else
              <img src="https://via.placeholder.com/1200x700.png?text=Event" alt="{{ $title }}" class="card-image">
            @endif
            @if($category)
              <span class="event-category">{{ $category }}</span>
            @endif
            @if($start)
              <div class="event-date-badge">
                <span class="day">{{ $day }}</span>
                <span class="month">{{ $month }}</span>
              </div>
            @endif

            <div class="card-content">
              <h3 class="card-title">{{ $title }}</h3>
              <div class="event-meta">
                @if($timeText)
                  <span class="event-date"><i class="far fa-clock"></i> {{ $timeText }}</span>
                @endif
                @if(!empty($event->location))
                  <span class="event-location"><i class="fas fa-map-marker-alt"></i> {{ $event->location }}</span>
                @endif
              </div>
              @if(!empty($excerpt))
                <p class="card-body">{{ $excerpt }}</p>
              @endif
              <a href="{{ $ctaUrl }}" class="card-button">{{ $ctaText }} <i class="fas fa-arrow-right"></i></a>
            </div>
          </div>
        @endforeach
      </div>
    @endif

    @if($past->count())
      <h3 class="mb-2" style="color:#e6f1ff;">Past Events</h3>
      <div class="cards-grid">
        @foreach($past as $event)
          @php
            $title = $event->title ?? 'Untitled Event';
            $image = $pickEventImage($event);
            $showUrl = \Illuminate\Support\Facades\Route::has('events.show')
              ? route('events.show', $event->slug ?? $event->id)
              : url('/events/'.($event->slug ?? $event->id));
            $start = $event->date;
            $end   = $event->ends_at;
            $timeText = '';
            if ($start) {
              $timeText = $start->format('g:ia');
              if ($end) { $timeText .= ' - ' . $end->format('g:ia'); }
            }
            $day = $start ? $start->format('d') : '';
            $month = $start ? strtoupper($start->format('M')) : '';
            $category = $event->topic ?? null;
            $excerpt = \Illuminate\Support\Str::limit(strip_tags($event->description ?? ''), 140);
            $ctaUrl = !empty($event->registration_url) ? $event->registration_url : $showUrl;
            $ctaText = !empty($event->registration_url) ? 'Join Event' : 'View Event';
          @endphp

          <div class="card card-style-2">
            @if($image)
              <img src="{{ $image }}" alt="{{ $title }}" class="card-image">
            @else
              <img src="https://via.placeholder.com/1200x700.png?text=Event" alt="{{ $title }}" class="card-image">
            @endif
            @if($category)
              <span class="event-category">{{ $category }}</span>
            @endif
            @if($start)
              <div class="event-date-badge">
                <span class="day">{{ $day }}</span>
                <span class="month">{{ $month }}</span>
              </div>
            @endif

            <div class="card-content">
              <h3 class="card-title">{{ $title }}</h3>
              <div class="event-meta">
                @if($timeText)
                  <span class="event-date"><i class="far fa-clock"></i> {{ $timeText }}</span>
                @endif
                @if(!empty($event->location))
                  <span class="event-location"><i class="fas fa-map-marker-alt"></i> {{ $event->location }}</span>
                @endif
              </div>
              @if(!empty($excerpt))
                <p class="card-body">{{ $excerpt }}</p>
              @endif
              <a href="{{ $ctaUrl }}" class="card-button">{{ $ctaText }} <i class="fas fa-arrow-right"></i></a>
            </div>
          </div>
        @endforeach
      </div>
      
      {{-- Pagination for Past Events --}}
      @if(method_exists($past, 'links'))
        <div class="pagination-wrapper" style="display: flex; justify-content: center; margin-top: 3rem;">
          <div class="pagination-container" style="background: var(--charcoal); border-radius: 12px; padding: 1rem; border: 1px solid rgba(100, 181, 246, 0.1);">
            {{ $past->links() }}
          </div>
        </div>
      @endif
    @endif

  </div>
</section>