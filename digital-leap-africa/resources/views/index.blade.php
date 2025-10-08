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

<section style="padding:2rem 0;">
    <div class="container">
        <div class="feature-grid" style="display:grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap:1rem;">
            <div class="card">
                <h3 style="margin-top:0;">Learn</h3>
                <p style="color:var(--cool-gray)">High‑quality, practical courses across in‑demand skills.</p>
            </div>
            <div class="card">
                <h3 style="margin-top:0;">Build</h3>
                <p style="color:var(--cool-gray)">Hands‑on projects and a growing portfolio of success stories.</p>
            </div>
            <div class="card">
                <h3 style="margin-top:0;">Grow</h3>
                <p style="color:var(--cool-gray)">Jobs, events, and community to accelerate your journey.</p>
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
    @endphp
    <div class="container">
        <div class="d-flex justify-content-between align-items-end mb-3">
            <h2 class="m-0">Latest Articles</h2>
            <a class="btn-outline" href="{{ \Illuminate\Support\Facades\Route::has('articles.index') ? route('articles.index') : url('/articles') }}">View all articles</a>
        </div>

        @if($latestArticles->count())
            <div class="row g-3">
                @foreach($latestArticles as $post)
                    <div class="col-12 col-md-6">
                        <div class="card h-100" style="height:100%;">
                            <div class="card-body">
                                <h3 class="h5">{{ $post->title ?? 'Untitled' }}</h3>
                                @if(!empty($post->created_at))
                                    <div class="text-muted small mb-2">{{ $post->created_at->format('M j, Y') }}</div>
                                @endif
                                @php
                                    $excerpt = method_exists($post, 'getExcerptAttribute') ? $post->excerpt : (Str::limit(strip_tags($post->content ?? $post->body ?? ''), 140));
                                @endphp
                                <p style="color:var(--cool-gray)">{{ $excerpt }}</p>
                                <a class="btn-primary" href="{{ \Illuminate\Support\Facades\Route::has('articles.show') ? route('articles.show', $post->id) : url('/articles/'.$post->id) }}">Read</a>
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

<!-- About, Mission & Vision, Stats -->
<section style="padding:2rem 0;">
    @php
        $aboutText = $siteSettings['about_us'] ?? $siteSettings['about'] ?? '';
        $missionText = $siteSettings['mission'] ?? '';
        $visionText = $siteSettings['vision'] ?? '';
        $stat1 = $siteSettings['stat_learners'] ?? null;
        $stat2 = $siteSettings['stat_courses'] ?? null;
        $stat3 = $siteSettings['stat_projects'] ?? null;
        $stat4 = $siteSettings['stat_events'] ?? null;
    @endphp
    <div class="container">
        <div class="row g-4 align-items-start">
            <div class="col-12 col-lg-6">
                <h2>About Us</h2>
                @if(!empty($aboutText))
                    <p style="color:var(--cool-gray)">{{ $aboutText }}</p>
                @else
                    <p style="color:var(--cool-gray)">We empower learners and builders across Africa with practical learning, real projects, and a thriving community.</p>
                @endif
                <a class="btn-outline" href="{{ \Illuminate\Support\Facades\Route::has('about') ? route('about') : url('/about') }}">Learn more</a>
            </div>
            <div class="col-12 col-lg-6">
                <div class="mb-3">
                    <h3 class="h5 m-0">Our Mission</h3>
                    <p class="m-0" style="color:var(--cool-gray)">{{ $missionText ?: 'Deliver accessible, job-ready education and opportunities across Africa.' }}</p>
                </div>
                <div class="mb-3">
                    <h3 class="h5 m-0">Our Vision</h3>
                    <p class="m-0" style="color:var(--cool-gray)">{{ $visionText ?: 'A continent of creators, innovators, and leaders shaping global impact.' }}</p>
                </div>
            </div>
        </div>

        <div class="row g-3 mt-4">
            @if(!is_null($stat1))
                <div class="col-6 col-md-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <div class="h3 m-0">{{ number_format((float)$stat1) }}</div>
                            <div class="text-muted">Learners</div>
                        </div>
                    </div>
                </div>
            @endif
            @if(!is_null($stat2))
                <div class="col-6 col-md-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <div class="h3 m-0">{{ number_format((float)$stat2) }}</div>
                            <div class="text-muted">Courses</div>
                        </div>
                    </div>
                </div>
            @endif
            @if(!is_null($stat3))
                <div class="col-6 col-md-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <div class="h3 m-0">{{ number_format((float)$stat3) }}</div>
                            <div class="text-muted">Projects</div>
                        </div>
                    </div>
                </div>
            @endif
            @if(!is_null($stat4))
                <div class="col-6 col-md-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <div class="h3 m-0">{{ number_format((float)$stat4) }}</div>
                            <div class="text-muted">Events</div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>

@endsection

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
</style>
@endpush