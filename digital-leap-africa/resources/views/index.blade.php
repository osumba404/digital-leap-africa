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
    ['label'=>'Articles', 'value'=> \App\Models\Article::count(), 'icon'=>'fa-newspaper'],
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
    /* Hexagon About card (scoped to #about-section to avoid collisions) */
    #about-section .aboutx-card{background:#131a2a;border-radius:24px;overflow:hidden;box-shadow:0 10px 25px rgba(0,0,0,0.5);transition:all .4s cubic-bezier(0.175,0.885,0.32,1.275);max-width:1000px;width:100%;display:flex;position:relative;border:1px solid rgba(59,130,246,0.1);margin:0 auto}
    #about-section .aboutx-card::before{content:'';position:absolute;top:-2px;left:-2px;right:-2px;bottom:-2px;background:linear-gradient(45deg,#3b82f6,#00d4ff,#3b82f6);z-index:-1;border-radius:26px;opacity:0;transition:opacity .5s ease}
    #about-section .aboutx-card:hover::before{opacity:1;animation:aboutx-rotate 3s linear infinite}
    @keyframes aboutx-rotate{0%{filter:hue-rotate(0)}100%{filter:hue-rotate(360deg)}}

    #about-section .aboutx-image{min-width:30%;position:relative;overflow:hidden;display:flex;align-items:center;justify-content:center}
    #about-section .aboutx-hex{width:320px;height:370px;background:linear-gradient(135deg,#3b82f6,#00d4ff);clip-path:polygon(50% 0%,100% 25%,100% 75%,50% 100%,0% 75%,0% 25%);display:flex;align-items:center;justify-content:center;position:relative;transition:inherit}
    #about-section .aboutx-hex-inner{width:300px;height:350px;clip-path:polygon(50% 0%,100% 25%,100% 75%,50% 100%,0% 75%,0% 25%);overflow:hidden;background:#131a2a;display:flex;align-items:center;justify-content:center}
    #about-section .aboutx-hex-inner img{width:100%;height:100%;object-fit:cover;transition:inherit;filter:grayscale(30%)}
    #about-section .aboutx-card:hover .aboutx-hex-inner img{transform:scale(1.1);filter:grayscale(0%)}

    #about-section .aboutx-floating{position:absolute;width:100%;height:100%;pointer-events:none}
    #about-section .aboutx-f{position:absolute;width:40px;height:40px;background:rgba(59,130,246,0.2);border-radius:50%;animation:aboutx-float 6s ease-in-out infinite}
    #about-section .aboutx-f:nth-child(1){top:20%;left:10%;animation-delay:0s;width:30px;height:30px}
    #about-section .aboutx-f:nth-child(2){top:60%;left:80%;animation-delay:1s;width:25px;height:25px}
    #about-section .aboutx-f:nth-child(3){top:80%;left:20%;animation-delay:2s;width:35px;height:35px}
    @keyframes aboutx-float{0%,100%{transform:translateY(0) rotate(0)}50%{transform:translateY(-20px) rotate(180deg)}}

    #about-section .aboutx-content{padding:40px;flex-grow:1;display:flex;flex-direction:column;justify-content:center;position:relative;z-index:2}
    #about-section .aboutx-badge{position:absolute;top:30px;right:30px;background:linear-gradient(45deg,#3b82f6,#00d4ff);color:#fff;padding:8px 20px;border-radius:20px;font-size:.9rem;font-weight:600;box-shadow:0 4px 15px rgba(59,130,246,.4)}
    #about-section .aboutx-title{font-size:2.5rem;color:#f1f5f9;margin-bottom:15px;font-weight:800;background:linear-gradient(90deg,#3b82f6,#00d4ff);-webkit-background-clip:text;-webkit-text-fill-color:transparent;position:relative;display:inline-block}
    #about-section .aboutx-title::after{content:'';position:absolute;bottom:-8px;left:0;width:80px;height:4px;background:linear-gradient(90deg,#3b82f6,#00d4ff);border-radius:2px}
    #about-section .aboutx-sub{color:#94a3b8;font-size:1.2rem;margin-bottom:25px;font-weight:500}
    #about-section .aboutx-desc{color:#94a3b8;line-height:1.7;margin-bottom:30px;font-size:1.05rem}

    #about-section .aboutx-features{display:grid;grid-template-columns:1fr 1fr;gap:15px;margin-bottom:30px}
    #about-section .aboutx-feature{display:flex;align-items:center;gap:10px;color:#94a3b8;font-size:.95rem}
    #about-section .aboutx-feature i{color:#3b82f6;font-size:1rem}

    #about-section .aboutx-cta{align-self:flex-start;background:linear-gradient(45deg,#3b82f6,#00d4ff);color:#fff;border:none;padding:12px 30px;border-radius:30px;font-size:1rem;font-weight:600;cursor:pointer;transition:inherit;box-shadow:0 4px 15px rgba(59,130,246,.3);display:flex;align-items:center;gap:10px;text-decoration:none}
    #about-section .aboutx-cta:hover{transform:translateY(-3px);box-shadow:0 8px 20px rgba(59,130,246,.5)}

    @media (max-width:900px){
      #about-section .aboutx-card{flex-direction:column;max-width:600px}
      #about-section .aboutx-image{width:100%;height:400px}
      #about-section .aboutx-hex{width:280px;height:320px}
      #about-section .aboutx-hex-inner{width:260px;height:300px}
      #about-section .aboutx-content{padding:30px 25px}
      #about-section .aboutx-title{font-size:2rem}
    }
    @media (max-width:480px){
      #about-section .aboutx-card{max-width:100%}
      #about-section .aboutx-image{height:300px}
      #about-section .aboutx-hex{width:220px;height:250px}
      #about-section .aboutx-hex-inner{width:200px;height:230px}
      #about-section .aboutx-features{grid-template-columns:1fr}
    }
  </style>
  
  <div class="container">
    <div class="aboutx-card">
      <div class="aboutx-image">
        <div class="aboutx-hex">
          <div class="aboutx-hex-inner">
            @if($about->image_path)
              <img src="{{ Storage::url($about->image_path) }}" alt="{{ $about->title }}">
            @else
              <img src="https://via.placeholder.com/1000x800.png?text=About" alt="{{ $about->title }}">
            @endif
          </div>
        </div>
        <div class="aboutx-floating">
          <div class="aboutx-f"></div>
          <div class="aboutx-f"></div>
          <div class="aboutx-f"></div>
        </div>
      </div>
      <div class="aboutx-content">
        <div class="aboutx-badge">{{ $about->mini_title ?? 'About Us' }}</div>
        <h1 class="aboutx-title">{{ $about->title }}</h1>
        @if(!empty($about->mini_title))
          <p class="aboutx-sub">{{ $about->mini_title }}</p>
        @endif
        <div class="aboutx-desc">{!! nl2br(e($about->content)) !!}</div>
        @if(!empty($about->bullet_points) && is_array($about->bullet_points))
          <div class="aboutx-features">
            @foreach($about->bullet_points as $bp)
              <div class="aboutx-feature"><i class="fa-solid fa-circle-check"></i><span>{{ $bp }}</span></div>
            @endforeach
          </div>
        @endif
        <a href="{{ route('about') }}" class="aboutx-cta">
          <span>Learn More</span>
          <i class="fas fa-arrow-right"></i>
        </a>
      </div>
    </div>
  </div>
</section>
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
      <div class="row g-0 cards-rail" class="post-card-out" style="margin: 0; padding: 0;">
        @foreach($latestArticles as $post)
          @php
            $image = $pickImage($post);
            $title = $post->title ?? 'Untitled';
            $firstLetter = mb_strtoupper(mb_substr($title, 0, 1));
            $excerpt = method_exists($post, 'getExcerptAttribute')
              ? $post->excerpt
              : (\Illuminate\Support\Str::limit(strip_tags($post->content ?? $post->body ?? ''), 140));
          @endphp

          <div class="col-12 col-md-6" style="margin: 0; padding: 0;">
            <div class="card h-100" class="post-card">
              @if($image)
                <img src="{{ $image }}" alt="{{ $title }}" class="post-thumb">
              @else
                <div class="post-avatar">
                  <span>{{ $firstLetter }}</span>
                </div>
              @endif

              <div class="card-body">
                <h3 class="h5" style="color: #64b5f6">{{ $title }}</h3>
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
                <h3 class="h5" style="color: #64b5f6">{{ $courseTitle }}</h3>
                
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
               
                 <h3 class="h5" style="color: #64b5f6">{{ $title }}</h3>
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