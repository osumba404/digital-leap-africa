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
        <div id="homeHeroCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                @foreach($slides as $idx => $s)
                    <button type="button" data-bs-target="#homeHeroCarousel" data-bs-slide-to="{{ $idx }}" class="{{ $idx===0 ? 'active' : '' }}" aria-current="{{ $idx===0 ? 'true' : 'false' }}" aria-label="Slide {{ $idx+1 }}"></button>
                @endforeach
            </div>
            <div class="carousel-inner">
                @foreach($slides as $idx => $s)
                    <div class="carousel-item {{ $idx===0 ? 'active' : '' }}">
                        @if(!empty($s['image']))
                            <img src="{{ $s['image'] }}" class="d-block w-100" alt="Hero {{ $idx+1 }}" style="max-height:560px; object-fit:cover;">
                        @endif
                        <div class="carousel-caption d-md-block" style="text-align:left; background: linear-gradient(180deg, rgba(0,0,0,0.35), rgba(0,0,0,0)); padding: 2rem;">
                            @if(!empty($s['mini']))
                                <div class="badge bg-primary mb-2">{{ $s['mini'] }}</div>
                            @endif
                            @if(!empty($s['title']))
                                <h1 class="mb-2">{{ $s['title'] }}</h1>
                            @endif
                            @if(!empty($s['sub']))
                                <p class="mb-3" style="max-width: 720px; color: var(--diamond-white);">{{ $s['sub'] }}</p>
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
@endsection