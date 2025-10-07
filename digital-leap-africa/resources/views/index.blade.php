@extends('layouts.app')

@section('title', 'Home')

@section('content')
<section class="hero-section" style="padding:3rem 0; margin:0;">
    <div class="container">
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