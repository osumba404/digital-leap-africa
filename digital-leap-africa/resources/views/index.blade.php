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
        <div id="homeHeroCarousel" class="carousel slide hero-carousel" data-bs-ride="carousel" data-bs-interval="6000" data-bs-touch="true" data-bs-pause="hover">
            <div class="carousel-indicators">
                @foreach($slides as $idx => $s)
                    <button type="button" data-bs-target="#homeHeroCarousel" data-bs-slide-to="{{ $idx }}" class="{{ $idx===0 ? 'active' : '' }}" aria-current="{{ $idx===0 ? 'true' : 'false' }}" aria-label="Slide {{ $idx+1 }}"></button>
                @endforeach
            </div>

            <div class="carousel-inner">
                @foreach($slides as $idx => $s)
                    <div class="carousel-item {{ $idx===0 ? 'active' : '' }} hero-slide">
                        @if(!empty($s['image']))
                            <img src="{{ $s['image'] }}" class="hero-img" alt="Hero {{ $idx+1 }}">
                        @endif
                        <div class="hero-overlay" aria-hidden="true"></div>

                        <div class="carousel-caption d-md-block hero-caption">
                            @if(!empty($s['mini']))
                                <div class="badge bg-primary mb-2">{{ $s['mini'] }}</div>
                            @endif

                            @if(!empty($s['title']))
                                <h1 class="mb-2">{{ $s['title'] }}</h1>
                            @endif

                            @if(!empty($s['sub']))
                                <p class="mb-3 hero-sub">{{ $s['sub'] }}</p>
                            @endif

                            <div class="d-flex gap-2 flex-wrap">
                                @if(!empty($s['cta1_label']))
                                    <a class="btn-primary"
                                       href="{{ !empty($s['cta1_route']) && Route::has($s['cta1_route']) ? route($s['cta1_route']) : '#' }}">
                                        {{ $s['cta1_label'] }}
                                    </a>
                                @endif

                                @if(!empty($s['cta2_label']))
                                    <a class="btn-outline"
                                       href="{{ !empty($s['cta2_route']) && Route::has($s['cta2_route']) ? route($s['cta2_route']) : '#' }}">
                                        {{ $s['cta2_label'] }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#homeHeroCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#homeHeroCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
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



{{-- Stats strip --}}
  @php
    $stats = [
      ['label'=>'Courses',  'value'=> \App\Models\Course::count(),      'icon'=>'fa-book-open'],
      ['label'=>'Projects', 'value'=> \App\Models\Project::count(),     'icon'=>'fa-diagram-project'],
      ['label'=>'Partners', 'value'=> \App\Models\Partner::count(),     'icon'=>'fa-handshake'],
      ['label'=>'Members',     'value'=> \App\Models\User::count(),  'icon'=>'fa-users'],
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
<section class="section" style="padding:2rem 0;">
  <div class="container">
    <div class="row g-4 align-items-start">
      <div class="col-12 col-lg-6">
        <div class="card h-100">
          @if($about->image_path)
            <img class="w-100" style="height:240px;object-fit:cover;"
                 src="{{ Storage::url($about->image_path) }}"
                 alt="{{ $about->title }}">
          @else
            <div class="w-100" style="height:240px;background:linear-gradient(135deg,var(--primary-blue),var(--deep-blue));display:flex;align-items:center;justify-content:center;">
              <i class="fas fa-users" style="font-size:3rem;color:var(--diamond-white);opacity:.3;"></i>
            </div>
          @endif
        </div>
      </div>
      <div class="col-12 col-lg-6">
        <div class="card h-100">
          <div class="card-body">
            @if($about->mini_title)
              <div class="text-muted mb-2">{{ $about->mini_title }}</div>
            @endif
            <h2 class="card-title" style="font-size:1.75rem;">{{ $about->title }}</h2>
            <div class="card-text">{!! nl2br(e($about->content)) !!}</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endif

@if($mission || $vision)
<section class="section" style="padding:2rem 0;">
  <div class="container">
    <div class="row g-4">
      @if($mission)
        <div class="col-12 col-lg-6">
          <div class="card h-100">
            @if($mission->image_path)
              <img class="w-100" style="height:240px;object-fit:cover;"
                   src="{{ Storage::url($mission->image_path) }}"
                   alt="{{ $mission->title }}">
            @endif
            <div class="card-body">
              <h3 class="card-title">{{ $mission->title }}</h3>
              <div class="card-text">{{ $mission->content }}</div>
            </div>
          </div>
        </div>
      @endif

      @if($vision)
        <div class="col-12 col-lg-6">
          <div class="card h-100">
            @if($vision->image_path)
              <img class="w-100" style="height:240px;object-fit:cover;"
                   src="{{ Storage::url($vision->image_path) }}"
                   alt="{{ $vision->title }}">
            @endif
            <div class="card-body">
              <h3 class="card-title">{{ $vision->title }}</h3>
              <div class="card-text">{{ $vision->content }}</div>
            </div>
          </div>
        </div>
      @endif
    </div>
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
    <div class="d-flex justify-content-between align-items-end mb-3">
      <h2 class="m-0">Latest Articles</h2>
      <a class="btn-outline" href="{{ \Illuminate\Support\Facades\Route::has('articles.index') ? route('articles.index') : url('/articles') }}">
        View all articles
      </a>
    </div>

    @if($latestArticles->count())
      <div class="row g-3">
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
            <div class="card h-100">
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
                  Read
                </a>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    @else
      <div class="text-muted">No articles published yet.</div>
    @endif
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
    <div class="d-flex justify-content-between align-items-end mb-3">
      <h2 class="m-0">Latest Courses</h2>
      <a class="btn-outline" href="{{ \Illuminate\Support\Facades\Route::has('courses.index') ? route('courses.index') : url('/courses') }}">
        View all courses
      </a>
    </div>

    @if($latestCourses->count())
      <div class="row g-3">
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

              <div class="card-body d-flex flex-column">
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
    <div class="d-flex justify-content-between align-items-end mb-3">
      <h2 class="m-0">Upcoming Events</h2>
      <a class="btn-outline" href="{{ $eventsIndexUrl }}">View all events</a>
    </div>

    @if($upcomingTop3->count())
      <div class="row g-3">
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

@media (max-width: 768px) {
  .hero-slide { height: 56vh; min-height: 320px; }
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