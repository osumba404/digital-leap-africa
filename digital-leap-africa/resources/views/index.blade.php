@extends('layouts.app')

@section('title', 'Home')

@section('content')
<section class="hero-section" style="padding:0; margin:0;">
    @php
        $slides = [];
        if (!empty($siteSettings['hero_slides'])) {
            $decoded = json_decode($siteSettings['hero_slides'], true);
            if (is_array($decoded)) {
                foreach ($decoded as $s) {
                    if (!empty($s['enabled'])) { $slides[] = $s; }
                }
            }
        }
    @endphp

    @if(count($slides))
        <div class="hero-rtl" data-interval="6000">
            <div class="hero-fader" style="position:relative;width:100%;height:100%;">
                @foreach($slides as $idx => $s)
                    <div class="hero-item hero-slide fade-slide{{ $idx===0 ? ' is-active' : '' }}" style="position:absolute;inset:0;">
                        @if(!empty($s['image']))
                            <img src="{{ $s['image'] }}" class="hero-img" alt="Hero {{ $idx+1 }}">
                        @endif
                        <div class="hero-overlay" aria-hidden="true"></div>
                        <div class="hero-caption">
                            @if(!empty($s['mini']))
                                <div class="badge bg-primary mb-2">{{ $s['mini'] }}</div>
                            @endif
                            @if(!empty($s['title']))
                                <h1 class="mb-2 hero-title">{{ $s['title'] }}</h1>
                            @endif
                            @if(!empty($s['sub']))
                                <p class="mb-3 hero-sub">{{ $s['sub'] }}</p>
                            @endif
                            <div class="d-flex gap-2 flex-wrap">
                                @if(!empty($s['cta1_label']))
                                    <a class="btn-primary" href="{{ !empty($s['cta1_route']) && Route::has($s['cta1_route']) ? route($s['cta1_route']) : '#' }}">{{ $s['cta1_label'] }}</a>
                                @endif
                                @if(!empty($s['cta2_label']))
                                    <a class="btn-outline" href="{{ !empty($s['cta2_route']) && Route::has($s['cta2_route']) ? route($s['cta2_route']) : '#' }}">{{ $s['cta2_label'] }}</a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="hero-stars" aria-hidden="true"></div>
            </div>
            <div class="hero-dots" style="position:absolute;left:0;right:0;bottom:14px;display:flex;gap:8px;justify-content:center;z-index:5;">
                @foreach($slides as $idx => $s)
                    <button class="hero-dot{{ $idx===0 ? ' is-active' : '' }}" data-index="{{ $idx }}" style="width:9px;height:9px;border-radius:50%;border:none;background:{{ $idx===0 ? '#64b5f6' : 'rgba(255,255,255,.6)' }};cursor:pointer; padding:0;"></button>
                @endforeach
            </div>
        </div>
    @else
        <div class="container" style="padding:3rem 0;">
            <h1 style="margin:0 0 1rem 0;">Welcome to {{ $siteSettings['site_name'] ?? config('app.name') }}</h1>
            <p style="color: var(--cool-gray); max-width: 700px;">
                Empowering learners across Africa with courses, projects, jobs, events, and a vibrant community.
            </p>
            <div style="margin-top:1.5rem; display:flex; gap:.75rem; flex-wrap:wrap;">
                <a class="btn-primary" href="{{ route('courses.index') }}">Browse Courses</a>
                <a class="btn-outline" href="{{ route('projects.index') }}">Explore Projects</a>
                <a class="btn-outline" href="{{ route('elibrary.index') }}">Visit eLibrary</a>
            </div>
        </div>
    @endif
</section>
<style>
  
    .hero-title{font-size:3rem; color:rgb(132, 180, 231) !important;}.
    .hero-sub{font-size:1.25rem;}
    .hero-img{
      opacity: 0.3 !important; 
    }
</style>

{{-- Stats strip --}}
  @php
    $stats = [
      ['label'=>'Courses',  'value'=> \App\Models\Course::count(),      'icon'=>'fa-book-open'],
      ['label'=>'Articles', 'value'=> \App\Models\Article::count(),     'icon'=>'fa-diagram-project'],
      ['label'=>'Partners', 'value'=> \App\Models\Partner::count(),     'icon'=>'fa-handshake'],
      ['label'=>'Members',  'value'=> \App\Models\User::count(),  'icon'=>'fa-users'],
    ];
  @endphp

<!-- About, Mission & Vision, Stats -->
@php
  $aboutText   = $siteSettings['about_us'] ?? $siteSettings['about'] ?? '';
  $missionText = $siteSettings['mission'] ?? '';
  $visionText  = $siteSettings['vision'] ?? '';

  $stats = [
    ['label'=>'Courses',  'value'=> \App\Models\Course::count(),  'icon'=>'fa-book-open'],
    ['label'=>'Projects', 'value'=> \App\Models\Project::count(), 'icon'=>'fa-diagram-project'],
    ['label'=>'Partners', 'value'=> \App\Models\Partner::count(), 'icon'=>'fa-handshake'],
    ['label'=>'Members',  'value'=> \App\Models\User::count(),    'icon'=>'fa-users'],
  ];
@endphp

{{-- About, Mission & Vision from DB --}}
@php
  $about   = \App\Models\AboutSection::where('section_type', 'about')->active()->first();
  $mission = \App\Models\AboutSection::where('section_type','mission')->active()->first();
  $vision  = \App\Models\AboutSection::where('section_type','vision')->active()->first();
@endphp

@if($about)
<section id="about-section" class="section" style="padding:2.5rem 0;">
  <style>
    /* Outer wrap shows ambient glow beyond bounds */
    #about-section .about-visual-wrap{position:relative;overflow:visible}
    #about-section .about-visual-wrap::before{content:"";position:absolute;top:-22%;left:-22%;width:65%;height:65%;background:radial-gradient(closest-side, rgba(59,130,246,.55), transparent 70%);filter: blur(18px);z-index:0;pointer-events:none}
    #about-section .about-visual-wrap::after{content:"";position:absolute;bottom:-25%;left:-25%;width:75%;height:75%;background:radial-gradient(closest-side, rgba(37,99,235,.35), transparent 70%);filter: blur(22px);z-index:0;pointer-events:none}

    /* Inner visual clamps the image with rounded corners */
    #about-section .about-visual{
      position:relative;
      border-radius:16px;
      overflow:hidden;
      background:linear-gradient(135deg,var(--primary-blue),var(--deep-blue));
      /* Blue line on top/left/bottom with glow */
      border-top:3px solid var(--primary-blue);
      border-left:3px solid var(--primary-blue);
      border-bottom:3px solid var(--primary-blue);
      box-shadow:
        -2px 0 16px rgba(59,130,246,.45),
         0 -6px 18px rgba(59,130,246,.35),
         0  6px 18px rgba(59,130,246,.35);
      /* Slightly reduce visual footprint */
      width:92%;
      margin: auto 0 auto 12px;
    }
    #about-section .about-img{
      display:block;
      width:100%;
      height:100%;
      object-fit:cover;
      position:relative;
      z-index:1;      
      filter: drop-shadow(-8px 12px 28px rgba(37,99,235,.35));
    }

    @media (min-width: 768px){ #about-section .about-visual{height:300px;} }
    @media (max-width: 767.98px){ #about-section .about-visual{height:260px;margin-bottom:0.5rem;} }

    #about-section .about-copy .card-title{font-size:2rem;margin-bottom:.5rem;color: #64b5f6;}
    #about-section .about-mini{color:var(--cool-gray)}

    /* side-by-side layout */
    #about-section .about-row{
      display:flex !important; 
      flex-wrap:nowrap !important; 
      align-items:center !important;
    }
    #about-section .about-col{flex:0 0 50% !important; max-width:50% !important; width:50% !important;}
    #about-section .about-col:first-child{padding-right:0.75rem;}
    #about-section .about-col:last-child{padding-left:0.75rem;}
    @media (max-width: 575.98px){
      /* Optional: allow tiny screens to scroll horizontally rather than stack */
      #about-section .about-row{overflow-x:auto;}
    }
    /* Unified card visuals */
    #about-section .about-card{display:flex !important; flex-direction:row !important; align-items:stretch !important; border:1px solid rgba(255,255,255,0.08); border-radius:16px; overflow:hidden; background:rgba(255,255,255,0.03);}
    #about-section .about-media{position:relative; flex:0 0 44% !important; max-width:44% !important;}
    #about-section .about-media .about-visual{height:100%;}
    #about-section .about-content{flex:1 1 auto !important; display:flex;}
    #about-section .about-content .card{border:0; background:transparent;}
    #about-section .about-content .card-body{display:flex; flex-direction:column;}

    /* Ambient blue glow tied to media side */
    #about-section .about-media::before{content:""; position:absolute; top:-18%; left:-18%; width:70%; height:70%; background:radial-gradient(closest-side, rgba(59,130,246,.6), transparent 72%); filter:blur(22px); z-index:0; pointer-events:none}
    #about-section .about-media::after{content:""; position:absolute; bottom:-22%; left:-22%; width:80%; height:80%; background:radial-gradient(closest-side, rgba(37,99,235,.4), transparent 72%); filter:blur(26px); z-index:0; pointer-events:none}
  
/* Fixed-width centered rails for cards */
.cards-rail{display:grid;grid-template-columns:repeat(3, 320px);gap:1rem;justify-content:center;align-items:stretch}
@media (max-width: 992px){ .cards-rail{grid-template-columns:repeat(2, 320px)} }
@media (max-width: 576px){ .cards-rail{grid-template-columns:repeat(1, 320px)} }

/* Equal-height cards and centered content */
.cards-rail > *{display:flex}
.cards-rail .card{display:flex;flex-direction:column;height:100%;min-height:460px}
@media (max-width: 576px){ .cards-rail .card{min-height:420px} }
.cards-rail .card-body{flex:1 1 auto;display:flex;flex-direction:column;align-items:stretch;text-align:left !important;padding-top:0 !important}

/* Buttons inside cards: limit width and align left */
.cards-rail .card .btn-primary,
.cards-rail .card .btn-outline{width:100% !important;width:100%;align-self:flex-start}

.cards-rail {
  --bs-gutter-x: 0;
  --bs-gutter-y: 0;
}


/* Make section bottom buttons full width */
.btn-wide{display:block;width:100%;}

/* Ensure media flush to card edges */
.post-thumb,.course-thumb,.event-thumb{display:block;width:100%;max-width:100%;margin: 0; padding: 0; border-radius: 0;}
.post-card{margin:0; padding:0;}

.post-card-out{margin:0; padding:0;}
/* Section titles centered forcefully */
.section h2{ text-align:center !important; margin-left:auto !important; margin-right:auto !important; }
</style>
  <div class="container">
    <div class="row g-4 align-items-center about-row">
      <div class="col-12">
        <div class="about-card">
          <div class="about-media">
            <div class="about-visual">
              @if($about->image_path)
                <img class="about-img" src="{{ Storage::url($about->image_path) }}" alt="{{ $about->title }}">
              @else
                <div class="d-flex align-items-center justify-content-center about-img" style="background:linear-gradient(135deg,var(--primary-blue),var(--deep-blue));">
                  <i class="fas fa-users" style="font-size:3rem;color:var(--diamond-white);opacity:.35"></i>
                </div>
              @endif
            </div>
          </div>
          <div class="about-content">
            <div class="card h-100 about-copy">
              <div class="card-body d-flex flex-column">
                @if($about->mini_title)
                  <div class="about-mini mb-2">{{ $about->mini_title }}</div>
                @endif
                <h2 class="card-title">{{ $about->title }}</h2>
                <div class="card-text mb-3">{!! nl2br(e($about->content)) !!}</div>
                <a href="{{ route('about') }}" class="btn-primary">
                  <i class="fas fa-arrow-right me-2"></i>Learn more
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endif

@if($mission || $vision)
<section class="section" style="padding:2rem 0;">
  <style>
    .mv-card{display:flex;flex-direction:row;align-items:stretch;border:1px solid rgba(255,255,255,0.08);border-radius:16px;overflow:hidden;background:rgba(255,255,255,0.03);margin-bottom:1rem}
    .mv-card.is-reverse{flex-direction:row-reverse}
    .mv-media{position:relative;flex:0 0 44%;max-width:44%}
    .mv-visual{position:relative;border-radius:16px;overflow:hidden;background:linear-gradient(135deg,var(--primary-blue),var(--deep-blue));border-top:3px solid var(--primary-blue);border-left:3px solid var(--primary-blue);border-bottom:3px solid var(--primary-blue);box-shadow:-2px 0 16px rgba(59,130,246,.45),0 -6px 18px rgba(59,130,246,.35),0 6px 18px rgba(59,130,246,.35);width:92%;margin:auto 0 auto 12px;height:100%}
    .is-reverse .mv-visual{border-left:none;border-right:3px solid var(--primary-blue);box-shadow:2px 0 16px rgba(59,130,246,.45),0 -6px 18px rgba(59,130,246,.35),0 6px 18px rgba(59,130,246,.35);margin:auto 12px auto 0}
    .mv-img{display:block;width:100%;height:100%;object-fit:cover;position:relative;z-index:1;filter:drop-shadow(-8px 12px 28px rgba(37,99,235,.35))}
    @media (min-width:768px){ .mv-visual{height:300px} }
    @media (max-width:767.98px){ .mv-visual{height:260px;margin-bottom:.5rem} }
    .mv-content{flex:1 1 auto;display:flex}
    .mv-content .card{border:0;background:transparent}
    .mv-content .card-body{display:flex;flex-direction:column}
  </style>
  <div class="container">
    @if($mission)
      <div class="mv-card">
        <div class="mv-media">
          <div class="mv-visual">
            @if($mission->image_path)
              <img class="mv-img" src="{{ Storage::url($mission->image_path) }}" alt="{{ $mission->title }}">
            @else
              <div class="d-flex align-items-center justify-content-center mv-img" style="background:linear-gradient(135deg,var(--primary-blue),var(--deep-blue));">
                <i class="fas fa-bullseye" style="font-size:3rem;color:var(--diamond-white);opacity:.35"></i>
              </div>
            @endif
          </div>
        </div>
        <div class="mv-content">
          <div class="card h-100">
            <div class="card-body">
              <h3 class="card-title">{{ $mission->title }}</h3>
              <div class="card-text">{{ $mission->content }}</div>
            </div>
          </div>
        </div>
      </div>
    @endif

    @if($vision)
      <div class="mv-card is-reverse">
        <div class="mv-media">
          <div class="mv-visual">
            @if($vision->image_path)
              <img class="mv-img" src="{{ Storage::url($vision->image_path) }}" alt="{{ $vision->title }}">
            @else
              <div class="d-flex align-items-center justify-content-center mv-img" style="background:linear-gradient(135deg,var(--primary-blue),var(--deep-blue));">
                <i class="fas fa-eye" style="font-size:3rem;color:var(--diamond-white);opacity:.35"></i>
              </div>
            @endif
          </div>
        </div>
        <div class="mv-content">
          <div class="card h-100">
            <div class="card-body">
              <h3 class="card-title">{{ $vision->title }}</h3>
              <div class="card-text">{{ $vision->content }}</div>
            </div>
          </div>
        </div>
      </div>
    @endif
  </div>

@endif

    {{-- Stats strip --}}
    <div class="mt-4">
      <div class="stats-grid">
        @foreach($stats as $s)
          <div class="stat-card">
            <div style="font-size:1.25rem;color:var(--cyan-accent);margin-bottom:.25rem;">
              <i class="fa-solid {{ $s['icon'] }}"></i>
            </div>
            <div class="stat-value">{{ number_format((float)$s['value']) }}</div>
            <div class="stat-label">{{ $s['label'] }}</div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
</section>

<!-- Latest Articles -->
<section style="padding:2rem 0;">
  @php
      try {
          $latestArticles = \App\Models\Article::query()->latest()->take(2)->get();
      } catch (\Throwable $e) {
          $latestArticles = collect();
      }
      // Helper to pick an image field if present
      $pickImage = function($article) {
          return $article->featured_image_url
              ?? $article->image_url
              ?? $article->cover_image
              ?? $article->thumbnail
              ?? $article->featured_image
              ?? null;
      };
  @endphp

  <div class="container">
    <div class="text-center mb-3" style="text-align:center !important; color: #64b5f6; font-size: 22px">
      <h2 class="m-0">Latest Articles</h2>
    </div>

    @if($latestArticles->count())
      <div class="row g-0 cards-rail" class="post-card-out">
        @foreach($latestArticles as $post)
          @php
            $image = $pickImage($post);
            $title = $post->title ?? 'Untitled';
            $firstLetter = mb_strtoupper(mb_substr($title, 0, 1));
            $excerpt = method_exists($post, 'getExcerptAttribute')
              ? $post->excerpt
              : (\Illuminate\Support\Str::limit(strip_tags($post->content ?? $post->body ?? ''), 140));
          @endphp

          <div class="col-12 col-md-6">
            <div class="card h-100" class="post-card">
              @if($image)
                <img src="{{ $image }}" alt="{{ $title }}" class="post-thumb">
              @else
                <div class="post-avatar">
                  <span>{{ $firstLetter }}</span>
                </div>
              @endif

              <div class="card-body">
                <h3 class="h5">{{ $title }}</h3>
                @if(!empty($post->created_at))
                  <div class="text-muted small mb-2">{{ $post->created_at->format('M j, Y') }}</div>
                @endif
                <p style="color:var(--cool-gray)">{{ $excerpt }}</p>

                {{-- Force the Read button to specific URL as requested --}}
                <a class="btn-primary" href="http://127.0.0.1:8000/blog/cybersecurity-in-2025-safeguarding-your-digital-life">
                  Read Article
                </a>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    @else
      <div class="text-muted">No articles published yet.</div>
    @endif
    <div class="text-center mt-3" style="padding-top:1rem !important">
      <a class="btn-outline btn-wide" href="{{ \Illuminate\Support\Facades\Route::has('articles.index') ? route('articles.index') : url('/articles') }}">View all articles</a>
    </div>
  </div>
</section>

<!-- Latest Courses -->
<section style="padding:2rem 0;">
  @php
    try {
      $latestCourses = \App\Models\Course::query()->latest()->take(3)->get();
    } catch (\Throwable $e) {
      $latestCourses = collect();
    }

    // Helper to pick a course image from common fields
    $pickCourseImage = function($course) {
      return $course->image_url
          ?? $course->thumbnail
          ?? $course->cover_image
          ?? $course->banner_image
          ?? null;
    };
  @endphp

  <div class="container">
    <div class="text-center mb-3" style="text-align:center !important; color: #64b5f6; font-size: 22px">
      <h2 class="m-0">Available Courses</h2>
    </div>

    @if($latestCourses->count())
      <div class="row g-3 cards-rail">
        @foreach($latestCourses as $course)
          @php
            $courseImage = $pickCourseImage($course);
            $courseTitle = $course->title ?? 'Untitled';
            $courseLetter = mb_strtoupper(mb_substr($courseTitle, 0, 1));
            $courseExcerpt = \Illuminate\Support\Str::limit(
              strip_tags($course->short_description ?? $course->description ?? $course->summary ?? ''), 140
            );
            $showUrl = \Illuminate\Support\Facades\Route::has('courses.show')
              ? route('courses.show', $course)
              : url('/courses/'.$course->id);
          @endphp

          <div class="col-12 col-md-4">
            <div class="card h-100">
              @if($courseImage)
                <img src="{{ $courseImage }}" alt="{{ $courseTitle }}" class="course-thumb">
              @else
                <div class="course-avatar">
                  <span>{{ $courseLetter }}</span>
                </div>
              @endif

              <div class="card-body d-flex flex-column align-items-center text-center">
                <h3 class="h5">{{ $courseTitle }}</h3>
                @if(!empty($course->created_at))
                  <div class="text-muted small mb-2">{{ $course->created_at->format('M j, Y') }}</div>
                @endif
                <p class="text-muted" style="color:var(--cool-gray)">{{ $courseExcerpt }}</p>
                <div class="mt-auto">
                  <a class="btn-primary" href="{{ $showUrl }}">View Course</a>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    @else
      <div class="text-muted">No courses available yet.</div>
    @endif
    <div class="text-center mt-3" style="padding-top:1rem !important">
      <a class="btn-outline btn-wide" href="{{ \Illuminate\Support\Facades\Route::has('courses.index') ? route('courses.index') : url('/courses') }}">View all courses</a>
    </div>
  </div>
</section>

<!-- Upcoming Events -->
<section style="padding:2rem 0;">
  @php
    try {
      $todayEnd = now()->copy()->endOfDay();
      // Pick 3 events that are closest to happening (soonest first)
      $upcomingTop3 = \App\Models\Event::where('date', '>', $todayEnd)
        ->orderBy('date', 'asc')
        ->take(3)
        ->get();
    } catch (\Throwable $e) {
      $upcomingTop3 = collect();
    }

    // Helper to pick an event image from common fields
    $pickEventImage = function($event) {
      return $event->image_url
          ?? $event->banner_image
          ?? $event->thumbnail
          ?? $event->cover_image
          ?? null;
    };

    $eventsIndexUrl = \Illuminate\Support\Facades\Route::has('events.index')
      ? route('events.index')
      : url('/events');
  @endphp

  <div class="container">
    <div class="text-center mb-3" style="text-align:center !important; color: #64b5f6; font-size: 22px">
      <h2 class="m-0">Upcoming Events</h2>
    </div>

    @if($upcomingTop3->count())
      <div class="row g-3 cards-rail">
        @foreach($upcomingTop3 as $event)
          @php
            $title = $event->title ?? 'Untitled Event';
            $image = $pickEventImage($event);
            $letter = mb_strtoupper(mb_substr($title, 0, 1));
            $when = \Carbon\Carbon::parse($event->date)->format('M j, Y');
            $excerpt = \Illuminate\Support\Str::limit(strip_tags($event->description ?? ''), 140);

            $showUrl = \Illuminate\Support\Facades\Route::has('events.show')
              ? route('events.show', $event->id)
              : url('/events/'.$event->id);
          @endphp

          <div class="col-12 col-md-4">
            <div class="card h-100">
              @if($image)
                <img src="{{ $image }}" alt="{{ $title }}" class="event-thumb">
              @else
                <div class="event-avatar">
                  <span>{{ $letter }}</span>
                </div>
              @endif
              <div class="card-body d-flex flex-column">
                <h3 class="h5">{{ $title }}</h3>
                <div class="text-muted small mb-2">
                  <i class="far fa-calendar-alt me-1"></i>{{ $when }}
                </div>
                <p class="text-muted" style="color:var(--cool-gray)">{{ $excerpt }}</p>
                <div class="mt-auto">
                  <a class="btn-primary" href="{{ $showUrl }}">View Event</a>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    @else
      <div class="text-muted">No upcoming events.</div>
    @endif
    <div class="text-center mt-3" style="padding-top:1rem !important">
      <a class="btn-outline btn-wide" href="{{ $eventsIndexUrl }}">View all events</a>
    </div>
  </div>
</section>

@push('styles')
<style>
/***** Hero Carousel *****/
.hero-carousel { width: 100%; }

.hero-slide {
  position: relative;
  width: 100%;
  height: min(75vh, 720px);
  min-height: 420px;
}

.hero-img {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.hero-overlay {
  position: absolute;
  inset: 0;
  background: rgba(0,0,0,0.45);
}

.hero-caption {
  position: absolute;
  left: 5%;
  right: 5%;
  bottom: 8%;
  text-align: left;
  padding: 0;
}

.hero-caption h1 { color: #fff; }
.hero-sub { max-width: 760px; color: #f1f3f5; }

/* Fade slider */
.fade-slide{opacity:0;transition:opacity .8s ease;}
.fade-slide.is-active{opacity:1}
/* Ensure hero reserves height */
.hero-rtl{position:relative; height: min(75vh, 720px); min-height:420px}
.hero-fader{position:relative; width:100%; height:100%}
.hero-stars{position:absolute;inset:0;pointer-events:none;z-index:3;opacity:0;transition:opacity .6s ease;background-image:
  radial-gradient(2px 2px at 20% 30%, rgba(255,255,255,.9) 40%, transparent 41%),
  radial-gradient(1.5px 1.5px at 60% 20%, rgba(255,255,255,.8) 40%, transparent 41%),
  radial-gradient(2.5px 2.5px at 80% 70%, rgba(255,255,255,.85) 40%, transparent 41%),
  radial-gradient(1.2px 1.2px at 35% 75%, rgba(255,255,255,.7) 40%, transparent 41%),
  radial-gradient(1.8px 1.8px at 70% 55%, rgba(255,255,255,.75) 40%, transparent 41%);
animation: twinkle 2s infinite ease-in-out;
}
.hero-rtl.is-transitioning .hero-stars{opacity:.85}
@keyframes twinkle{0%,100%{filter:brightness(1)}50%{filter:brightness(1.6)}}

@media (max-width: 768px) {
  .hero-slide { height: 56vh; min-height: 320px; }
  .hero-rtl, .hero-fader { height:56vh; min-height:320px }
  .hero-caption { bottom: 6%; }
  .hero-caption h1 { font-size: 1.75rem; }
}


/* Article image and fallback avatar */
.post-thumb {
  width: 100%;
  height: 200px;
  object-fit: cover;
  border-top-left-radius: .5rem;
  border-top-right-radius: .5rem;
}

.post-avatar {
  width: 100%;
  height: 200px;
  border-top-left-radius: .5rem;
  border-top-right-radius: .5rem;
  display: flex;
  align-items: center;
  justify-content: center;
  background: linear-gradient(135deg, #0ea5e9 0%, #6366f1 100%);
  color: #ffffff;
}

.post-avatar span {
  font-size: 3rem;
  line-height: 1;
  font-weight: 800;
  letter-spacing: .04em;
  text-shadow: 0 2px 8px rgba(0,0,0,.25);
}


  /* Stats */
  .stats-grid {
    display:grid;
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
    gap: 1.25rem;
  }
  .stat-card {
    text-align:center; padding: 1.5rem;
    background: rgba(255,255,255,0.03);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: var(--radius);
  }
  .stat-value { font-size: 2rem; font-weight: 800; color: var(--diamond-white); }
  .stat-label { color: var(--cool-gray); }


  /* Course image and fallback avatar */
.course-thumb {
  width: 100%;
  height: 200px;
  object-fit: cover;
  border-top-left-radius: .5rem;
  border-top-right-radius: .5rem;
}

.course-avatar {
  width: 100%;
  height: 200px;
  border-top-left-radius: .5rem;
  border-top-right-radius: .5rem;
  display: flex;
  align-items: center;
  justify-content: center;
  background: linear-gradient(135deg, #10b981 0%, #3b82f6 100%);
  color: #ffffff;
}

.course-avatar span {
  font-size: 2.5rem;
  line-height: 1;
  font-weight: 800;
  letter-spacing: .04em;
  text-shadow: 0 2px 8px rgba(0,0,0,.25);
}


/* Event image and fallback avatar */
.event-thumb {
  width: 100%;
  height: 200px;
  object-fit: cover;
  border-top-left-radius: .5rem;
  border-top-right-radius: .5rem;
}

.event-avatar {
  width: 100%;
  height: 200px;
  border-top-left-radius: .5rem;
  border-top-right-radius: .5rem;
  display: flex;
  align-items: center;
  justify-content: center;
  background: linear-gradient(135deg, #f59e0b 0%, #ef4444 100%);
  color: #ffffff;
}

.event-avatar span {
  font-size: 2.5rem;
  line-height: 1;
  font-weight: 800;
  letter-spacing: .04em;
  text-shadow: 0 2px 8px rgba(0,0,0,.25);
}
</style>
@endpush

@push('scripts')
<script>
(function(){
  var root = document.querySelector('.hero-rtl');
  if(!root) return;
  var slides = root.querySelectorAll('.fade-slide');
  var dots = root.querySelectorAll('.hero-dot');
  var count = slides.length;
  var idx = 0;
  var intv = parseInt(root.getAttribute('data-interval')||'6000',10);
  function show(i){
    var nextIdx = (i+count)%count;
    if(nextIdx===idx) return;
    root.classList.add('is-transitioning');
    slides[idx].classList.remove('is-active');
    slides[nextIdx].classList.add('is-active');
    dots.forEach(function(d,j){ d.style.background = j===nextIdx ? '#64b5f6' : 'rgba(255,255,255,.6)'; d.classList.toggle('is-active', j===nextIdx); });
    idx = nextIdx;
    setTimeout(function(){ root.classList.remove('is-transitioning'); }, 700);
  }
  function nextSlide(){ show(idx+1); }
  var timer = setInterval(nextSlide, intv);
  dots.forEach(function(d){ d.addEventListener('click', function(){ clearInterval(timer); show(parseInt(d.getAttribute('data-index'),10)); timer=setInterval(nextSlide,intv); }); });
})();
</script>
@endpush