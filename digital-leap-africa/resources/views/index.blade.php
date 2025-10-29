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
        <div class="hero-rtl hero-slides-container" data-interval="6000">
            <div class="hero-fader" style="position:relative;width:100%;height:100%;">
                @foreach($slides as $idx => $s)
                    @php $isAltA = ($idx % 2) === 0; @endphp
                    @php
                        $bgUrl = !empty($s['image']) ? $s['image'] : ($isAltA
                            ? 'https://images.unsplash.com/photo-1552664730-d307ca884978?ixlib=rb-4.0.3&auto=format&fit=crop&w=1600&q=80'
                            : 'https://images.unsplash.com/photo-1451187580459-43490279c0fa?ixlib=rb-4.0.3&auto=format&fit=crop&w=1600&q=80');
                        $bgStyle = $isAltA
                            ? "background: linear-gradient(135deg, rgba(10, 15, 28, 0.85) 0%, rgba(10, 15, 28, 0.75) 100%), url('{$bgUrl}');"
                            : "background: linear-gradient(90deg, var(--dark-bg) 40%, transparent 70%), url('{$bgUrl}');";
                    @endphp
                    <section class="hero-item hero-slide fade-slide {{ $isAltA ? 'slide-2' : 'slide-8' }}{{ $idx===0 ? ' is-active' : '' }}" style="{{ $bgStyle }} background-size:cover;background-position:center;background-attachment:fixed;position:absolute;inset:0;">
                        @if($isAltA)
                            <div class="floating-shapes">
                                <div class="floating-shape"></div>
                                <div class="floating-shape"></div>
                                <div class="floating-shape"></div>
                            </div>
                        @endif
                        <div class="slide-content">
                            @if(!empty($s['mini']))
                                <p class="mini-title">{{ $s['mini'] }}</p>
                            @endif
                            @if(!empty($s['title']))
                                <h1 class="main-title">{{ $s['title'] }}</h1>
                            @endif
                            @if(!empty($s['sub']))
                                <p class="hero-text">{{ $s['sub'] }}</p>
                            @endif
                            <div class="cta-buttons">
                                @if(!empty($s['cta1_label']))
                                    <a href="{{ !empty($s['cta1_route']) && Route::has($s['cta1_route']) ? route($s['cta1_route']) : '#' }}" class="btn btn-primary">
                                        <i class="fas {{ $isAltA ? 'fa-bolt' : 'fa-cloud' }}"></i>
                                        {{ $s['cta1_label'] }}
                                    </a>
                                @endif
                                @if(!empty($s['cta2_label']))
                                    <a href="{{ !empty($s['cta2_route']) && Route::has($s['cta2_route']) ? route($s['cta2_route']) : '#' }}" class="btn btn-secondary">
                                        <i class="fas {{ $isAltA ? 'fa-book' : 'fa-server' }}"></i>
                                        {{ $s['cta2_label'] }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </section>
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
:root{--dark-bg:#0a0f1c;--card-bg:#131a2a;--accent-blue:#3b82f6;--neon-blue:#00d4ff;--light-blue:#60a5fa;--text-primary:#f1f5f9;--text-secondary:#94a3b8;--shadow:0 10px 25px rgba(0,0,0,0.5);--transition:all .4s cubic-bezier(0.175,0.885,0.32,1.275)}
*{margin:0;padding:0;box-sizing:border-box;font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif}
body{background:var(--dark-bg);color:var(--text-primary);overflow-x:hidden}

/* New styles for hero slides */
.hero-slide{min-height:100vh;display:flex;align-items:center;padding:0 5%;position:relative;overflow:hidden}
.slide-content{max-width:1200px;margin:0 auto;width:100%}

/* Optional nav (not rendered) */
.slides-nav{position:fixed;top:20px;right:20px;z-index:1000;display:flex;gap:10px}
.nav-btn{background:rgba(19,26,42,0.8);color:var(--text-primary);border:1px solid rgba(59,130,246,0.3);padding:8px 15px;border-radius:20px;cursor:pointer;transition:var(--transition);font-size:.9rem}
.nav-btn:hover{background:var(--accent-blue);transform:translateY(-2px)}

    .hero-slides-container{min-height:100vh}
    .mini-title{color:#00d4ff;font-size:1rem;font-weight:600;margin-bottom:15px;text-transform:uppercase;letter-spacing:2px}
    .main-title{font-size:3.5rem;font-weight:800;margin-bottom:20px;line-height:1.1}
    .hero-text{color:#94a3b8;font-size:1.1rem;line-height:1.6;margin-bottom:30px;max-width:600px}
    .cta-buttons{display:flex;gap:15px;flex-wrap:wrap}
    .btn{padding:14px 30px;border-radius:30px;font-weight:600;font-size:1rem;cursor:pointer;transition:all .4s cubic-bezier(0.175,0.885,0.32,1.275);text-decoration:none;display:inline-flex;align-items:center;gap:10px}
    
    /* Dark Mode Secondary Button */
    .btn-secondary{background:rgba(59, 130, 246, 0.08);color:#64b5f6;border:2px solid #3b82f6}
    .btn-secondary:hover{background:rgba(59,130,246,0.2);border-color:#64b5f6;color:#64b5f6;transform:translateY(-3px)}
    
    /* Light Mode Hero Styles */
    [data-theme="light"] .hero-slide{background:linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(230, 242, 255, 0.9) 100%), url('https://images.unsplash.com/photo-1552664730-d307ca884978?ixlib=rb-4.0.3&auto=format&fit=crop&w=1600&q=80') !important;background-size:cover !important;background-position:center !important}
    [data-theme="light"] .mini-title{color:#2E78C5}
    [data-theme="light"] .main-title{color:#1a202c}
    [data-theme="light"] .hero-text{color:#4A5568}
    [data-theme="light"] .btn-secondary{background:rgba(46, 120, 197, 0.05);color:#2E78C5;border:2px solid #2E78C5}
    [data-theme="light"] .btn-secondary:hover{background:rgba(46, 120, 197, 0.15);border-color:#1E4C7C;color:#1E4C7C;transform:translateY(-3px)}
    [data-theme="light"] .slide-2{background:linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(230, 242, 255, 0.9) 100%), url('https://images.unsplash.com/photo-1552664730-d307ca884978?ixlib=rb-4.0.3&auto=format&fit=crop&w=1600&q=80') !important}
    [data-theme="light"] .slide-8{background:linear-gradient(90deg, rgba(255, 255, 255, 0.95) 40%, rgba(230, 242, 255, 0.85) 70%), url('https://images.unsplash.com/photo-1451187580459-43490279c0fa?ixlib=rb-4.0.3&auto=format&fit=crop&w=1600&q=80') !important}
    [data-theme="light"] .slide-2 .main-title{background:linear-gradient(90deg,#2E78C5,#1E4C7C);-webkit-background-clip:text;-webkit-text-fill-color:transparent}
    [data-theme="light"] .slide-8 .main-title{background:linear-gradient(90deg,#1a202c,#2E78C5);-webkit-background-clip:text;-webkit-text-fill-color:transparent}
    [data-theme="light"] .floating-shape{background:rgba(46, 120, 197, 0.08)}

    /* Slide 2 background and effects */
    .slide-2{background:linear-gradient(135deg, rgba(10, 15, 28, 0.85) 0%, rgba(10, 15, 28, 0.75) 100%), url('https://images.unsplash.com/photo-1552664730-d307ca884978?ixlib=rb-4.0.3&auto=format&fit=crop&w=1600&q=80');background-size:cover;background-position:center;background-attachment:fixed;position:relative}
    .slide-2::before{content:'';position:absolute;top:0;left:0;width:100%;height:100%;background:radial-gradient(circle at 30% 50%, rgba(59,130,246,0.15) 0%, transparent 50%);pointer-events:none}
    .slide-2 .slide-content{max-width:700px;position:relative;z-index:2}
    .slide-2 .main-title{background:linear-gradient(90deg,#3b82f6,#00d4ff);-webkit-background-clip:text;-webkit-text-fill-color:transparent;text-shadow:0 5px 15px rgba(0,0,0,0.3)}
    .slide-2 .hero-text{font-size:1.3rem;padding:20px}

    .floating-shapes{position:absolute;width:100%;height:100%;pointer-events:none;z-index:1}
    .floating-shape{position:absolute;border-radius:50%;background:rgba(59,130,246,0.1);animation:float 8s ease-in-out infinite}
    .floating-shape:nth-child(1){width:80px;height:80px;top:20%;left:10%;animation-delay:0s}
    .floating-shape:nth-child(2){width:120px;height:120px;top:60%;left:85%;animation-delay:2s}
    .floating-shape:nth-child(3){width:60px;height:60px;top:80%;left:15%;animation-delay:4s}
    @keyframes float{0%,100%{transform:translateY(0) rotate(0deg)}50%{transform:translateY(-20px) rotate(10deg)}}

    /* Slide 8 background and effects */
    .slide-8{background:linear-gradient(90deg, var(--dark-bg) 40%, transparent 70%), url('https://images.unsplash.com/photo-1451187580459-43490279c0fa?ixlib=rb-4.0.3&auto=format&fit=crop&w=1600&q=80');background-size:cover;background-position:center;background-attachment:fixed;position:relative}
    .slide-8::before{content:'';position:absolute;top:0;right:0;width:100%;height:100%;background:linear-gradient(45deg, transparent 60%, #3b82f6 200%);opacity:.1;z-index:1}
    .slide-8 .slide-content{max-width:650px;position:relative;z-index:2}
    .slide-8 .main-title{font-size:3.8rem;margin-bottom:15px;background:linear-gradient(90deg,#ffffff,#00d4ff);-webkit-background-clip:text;-webkit-text-fill-color:transparent;text-shadow:0 5px 15px rgba(0,0,0,0.3)}
    .slide-8 .hero-text{font-size:1.1rem;margin-bottom:25px;padding:20px;border-radius:15px}

    @media (max-width:1024px){
        .slide-8{background:linear-gradient(rgba(10,15,28,0.9), rgba(10,15,28,0.8)), url('https://images.unsplash.com/photo-1451187580459-43490279c0fa?ixlib=rb-4.0.3&auto=format&fit=crop&w=1600&q=80');background-size:cover;background-position:center}
        .main-title{font-size:2.8rem}
        .slide-8 .main-title{font-size:3.2rem}
    }
    @media (max-width:768px){
        .main-title{font-size:2.2rem}
        .slide-8 .main-title{font-size:2.5rem}
        .hero-text{font-size:1rem}
        .btn{padding:12px 25px;font-size:.9rem}
    }
    @media (max-width:480px){
        .main-title{font-size:1.8rem}
        .slide-8 .main-title{font-size:2rem}
        .cta-buttons{flex-direction:column;align-items:flex-start}
        .btn{width:100%;justify-content:center}
    }

    /* Light Mode Hero Styles */
    [data-theme="light"] .hero-slide {
        background: linear-gradient(135deg, rgba(230, 242, 255, 0.95) 0%, rgba(248, 250, 252, 0.9) 100%), var(--bg-image) !important;
    }
    [data-theme="light"] .slide-2 {
        background: linear-gradient(135deg, rgba(230, 242, 255, 0.95) 0%, rgba(248, 250, 252, 0.9) 100%), url('https://images.unsplash.com/photo-1552664730-d307ca884978?ixlib=rb-4.0.3&auto=format&fit=crop&w=1600&q=80') !important;
    }
    [data-theme="light"] .slide-8 {
        background: linear-gradient(90deg, rgba(230, 242, 255, 0.95) 40%, rgba(248, 250, 252, 0.85) 70%), url('https://images.unsplash.com/photo-1451187580459-43490279c0fa?ixlib=rb-4.0.3&auto=format&fit=crop&w=1600&q=80') !important;
    }
    [data-theme="light"] .mini-title {
        color: var(--primary-blue);
    }
    [data-theme="light"] .main-title {
        color: var(--diamond-white);
    }
    [data-theme="light"] .hero-text {
        color: var(--cool-gray);
    }
    [data-theme="light"] .btn-secondary {
        border-color: var(--primary-blue);
        color: var(--primary-blue);
    }
    [data-theme="light"] .btn-secondary:hover {
        background: rgba(46, 120, 197, 0.1);
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
    #about-section .aboutx-card{background:#131a2a;border-radius:24px;overflow:hidden;box-shadow:0 10px 25px rgba(0,0,0,0.5);transition:all .4s cubic-bezier(0.175,0.885,0.32,1.275);max-width:100%;width:100%;display:flex;position:relative;border:1px solid rgba(59,130,246,0.1);margin:0 auto}

    #about-section .aboutx-card::before{content:'';position:absolute;top:-2px;left:-2px;right:-2px;bottom:-2px;background:linear-gradient(45deg,#3b82f6,#00d4ff,#3b82f6);z-index:-1;border-radius:26px;opacity:0;transition:opacity .5s ease}
    #about-section .aboutx-card:hover::before{opacity:1;animation:aboutx-rotate 3s linear infinite}
    @keyframes aboutx-rotate{0%{filter:hue-rotate(0)}100%{filter:hue-rotate(360deg)}}

    #about-section .aboutx-image{min-width:30%;position:relative;overflow:hidden;display:flex;align-items:center;justify-content:center}
    #about-section .aboutx-hex{width:320px;height:370px;background:linear-gradient(135deg,#3b82f6,#00d4ff);clip-path:polygon(50% 0%,100% 25%,100% 75%,50% 100%,0% 75%,0% 25%);display:flex;align-items:center;justify-content:center;position:relative;transition:inherit}
    #about-section .aboutx-hex-inner{width:300px;height:350px;clip-path:polygon(50% 0%,100% 25%,100% 75%,50% 100%,0% 75%,0% 25%);overflow:hidden;background:#131a2a;display:flex;align-items:center;justify-content:center}
    #about-section .aboutx-hex-inner img{width:100%;height:100%;object-fit:cover;transition:inherit;filter:grayscale(30%)}
    #about-section .aboutx-hex-inner:hover img{transform:scale(1.1);filter:grayscale(0%)}

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
    #about-section .aboutx-feature .chk{width:16px;height:16px;color:#3b82f6;flex-shrink:0}

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

    /* Light Mode About Card */
    [data-theme="light"] #about-section .aboutx-card {
        background: #FFFFFF;
        border: 1px solid rgba(46, 120, 197, 0.2);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
    }
    [data-theme="light"] #about-section .aboutx-card::before {
        background: linear-gradient(45deg, var(--primary-blue), var(--cyan-accent), var(--primary-blue));
    }
    [data-theme="light"] #about-section .aboutx-hex-inner {
        background: #FFFFFF;
    }
    [data-theme="light"] #about-section .aboutx-title {
        color: var(--primary-blue);
        background: linear-gradient(90deg, var(--primary-blue), var(--cyan-accent));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    [data-theme="light"] #about-section .aboutx-sub,
    [data-theme="light"] #about-section .aboutx-desc,
    [data-theme="light"] #about-section .aboutx-feature {
        color: var(--cool-gray);
    }
    [data-theme="light"] #about-section .aboutx-feature .chk {
        color: var(--primary-blue);
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
              <div class="aboutx-feature">
                <svg class="chk" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M20 6L9 17l-5-5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <span>{{ $bp }}</span>
              </div>
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
      <div class="container">
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
  </div>
</section>

 

<!-- Latest Articles -->
<section id="articles-section" style="padding:2rem 0;">
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
      <div class="cards-grid">
        @foreach($latestArticles as $post)
          @php
            $image = $pickImage($post);
            $title = $post->title ?? 'Untitled';
            $excerpt = method_exists($post, 'getExcerptAttribute')
              ? $post->excerpt
              : (\Illuminate\Support\Str::limit(strip_tags($post->content ?? $post->body ?? ''), 140));
            $readMinutes = max(1, ceil(str_word_count(strip_tags($post->content ?? $post->body ?? ''))/200));
            $category = $post->category_name ?? $post->category ?? null;
            $dateText = !empty($post->created_at) ? $post->created_at->format('M j, Y') : null;
          @endphp

          <div class="card">
            <div class="card-image-container">
              @if($image)
                <img src="{{ $image }}" alt="{{ $title }}" class="card-image">
              @else
                <img src="https://via.placeholder.com/1000x600.png?text=Article" alt="{{ $title }}" class="card-image">
              @endif
              @if($category)
                <div class="card-category">{{ $category }}</div>
              @endif
              <h3 class="card-title">{{ $title }}</h3>
            </div>
            <div class="card-content">
              <div class="card-meta">
                <span><i class="far fa-clock"></i> {{ $readMinutes }} min read</span>
                @if($dateText)
                  <span><i class="far fa-calendar"></i> {{ $dateText }}</span>
                @endif
              </div>
              <p class="card-body">{{ $excerpt }}</p>
              {{-- Force the Read button to specific URL as requested --}}
              <a class="card-button" href="http://127.0.0.1:8000/blog/cybersecurity-in-2025-safeguarding-your-digital-life">
                Read Article <i class="fas fa-arrow-right"></i>
              </a>
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

<style>
  /* Articles overlay card styles (scoped) */
  #articles-section .cards-grid{display:grid;grid-template-columns:repeat(auto-fill, minmax(320px,1fr));gap:2rem}
  #articles-section .card{background-color:#112240;border-radius:12px;overflow:hidden;box-shadow:0 10px 30px rgba(2,12,27,0.7);transition:all .4s cubic-bezier(0.175,0.885,0.32,1.275);height:100%;display:flex;flex-direction:column;padding:0}
  #articles-section .card:hover{transform:translateY(-8px);box-shadow:0 20px 40px rgba(2,12,27,0.9)}
  #articles-section .card-image-container{position:relative;overflow:hidden;margin:0;padding:0;line-height:0;border-top-left-radius:12px;border-top-right-radius:12px}
  #articles-section .card-image{width:100%;height:200px;object-fit:cover;display:block;margin:0;transition:transform .5s ease}
  #articles-section .card:hover .card-image{transform:scale(1.05)}
  #articles-section .card-title{position:absolute;bottom:0;left:0;right:0;background:linear-gradient(transparent, rgba(10,25,47,0.95));padding:1.5rem 1.5rem .75rem;margin:0;font-size:1.3rem;font-weight:600;line-height:1.4;text-shadow:0 2px 4px rgba(0,0,0,0.5)}
  #articles-section .card-content{padding:1.5rem;flex-grow:1;display:flex;flex-direction:column}
  #articles-section .card-body{color:#8892b0;line-height:1.6;margin-bottom:1.5rem;flex-grow:1;display:-webkit-box;-webkit-line-clamp:3;-webkit-box-orient:vertical;overflow:hidden}
  #articles-section .card-meta{display:flex;justify-content:space-between;color:#8892b0;font-size:.85rem;margin-bottom:1rem;border-bottom:1px solid rgba(136,146,176,0.2);padding-bottom:.75rem}
  #articles-section .card-button{display:inline-flex;align-items:center;justify-content:center;background-color:transparent;color:#3b82f6;padding:.6rem 1.2rem;border:1px solid #3b82f6;border-radius:6px;text-decoration:none;font-size:.9rem;font-weight:500;transition:all .3s ease;cursor:pointer;gap:.5rem}
  #articles-section .card-button:hover{background-color:rgba(59,130,246,.1);transform:translateY(-2px);box-shadow:0 4px 12px rgba(59,130,246,.2)}
  #articles-section .card-category{position:absolute;top:1rem;left:1rem;background:rgba(100,255,218,0.9);color:#0a192f;padding:.3rem .8rem;border-radius:20px;font-size:.75rem;font-weight:600;text-transform:uppercase;letter-spacing:.5px}
  @media (max-width:768px){#articles-section .cards-grid{grid-template-columns:repeat(auto-fill, minmax(280px,1fr));gap:1.5rem}#articles-section .card-title{font-size:1.2rem;padding:1.25rem 1.25rem .5rem}}

  /* Light Mode Articles */
  [data-theme="light"] #articles-section .card {
      background-color: #FFFFFF;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
      border: 1px solid rgba(46, 120, 197, 0.15);
  }
  [data-theme="light"] #articles-section .card:hover {
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
  }
  [data-theme="light"] #articles-section .card-title {
      background: linear-gradient(transparent, rgba(230, 242, 255, 0.95));
      color: var(--diamond-white);
  }
  [data-theme="light"] #articles-section .card-body,
  [data-theme="light"] #articles-section .card-meta {
      color: var(--cool-gray);
  }
  [data-theme="light"] #articles-section .card-button {
      color: var(--primary-blue);
      border-color: var(--primary-blue);
  }
  [data-theme="light"] #articles-section .card-button:hover {
      background-color: rgba(46, 120, 197, 0.1);
      box-shadow: 0 4px 12px rgba(46, 120, 197, 0.2);
  }
  [data-theme="light"] #articles-section .card-category {
      background: rgba(46, 120, 197, 0.9);
      color: #FFFFFF;
  }
</style>

<style>
  /* Courses overlay card styles (scoped) */
  #courses-section .cards-grid{display:grid;grid-template-columns:repeat(auto-fill, minmax(320px,1fr));gap:2rem}
  #courses-section .card{background-color:#112240;border-radius:12px;overflow:hidden;box-shadow:0 10px 30px rgba(2,12,27,0.7);transition:all .4s cubic-bezier(0.175,0.885,0.32,1.275);height:100%;display:flex;flex-direction:column;padding:0}
  #courses-section .card:hover{transform:translateY(-8px);box-shadow:0 20px 40px rgba(2,12,27,0.9)}
  #courses-section .card-image-container{position:relative;overflow:hidden;margin:0;padding:0;line-height:0;border-top-left-radius:12px;border-top-right-radius:12px}
  #courses-section .card-image{width:100%;height:200px;object-fit:cover;display:block;margin:0;transition:transform .5s ease}
  #courses-section .card:hover .card-image{transform:scale(1.05)}
  #courses-section .card-title{position:absolute;bottom:0;left:0;right:0;background:linear-gradient(transparent, rgba(10,25,47,0.95));padding:1.25rem 1.25rem .6rem;margin:0;font-size:1.1rem;font-weight:700;line-height:1.35;text-shadow:0 2px 4px rgba(0,0,0,0.5)}
  #courses-section .card-content{padding:1.25rem;flex-grow:1;display:flex;flex-direction:column}
  #courses-section .card-body{color:#8892b0;line-height:1.6;margin-bottom:1rem;flex-grow:1;display:-webkit-box;-webkit-line-clamp:3;-webkit-box-orient:vertical;overflow:hidden}
  #courses-section .card-meta{display:flex;justify-content:space-between;color:#8892b0;font-size:.85rem;margin-bottom:.85rem;border-bottom:1px solid rgba(136,146,176,0.2);padding-bottom:.6rem}
  #courses-section .card-button{display:inline-flex;align-items:center;justify-content:center;background-color:transparent;color:#3b82f6;padding:.6rem 1.2rem;border:1px solid #3b82f6;border-radius:6px;text-decoration:none;font-size:.9rem;font-weight:600;transition:all .3s ease;cursor:pointer;gap:.5rem}
  #courses-section .card-button:hover{background-color:rgba(59,130,246,.1);transform:translateY(-2px);box-shadow:0 4px 12px rgba(59,130,246,.2)}
  .btn-wide{width: 100%;}
  @media (max-width:768px){#courses-section .cards-grid{grid-template-columns:repeat(auto-fill, minmax(280px,1fr));gap:1.5rem}#courses-section .card-title{font-size:1rem;padding:1rem 1rem .45rem}}

  /* Light Mode Courses */
  [data-theme="light"] #courses-section .card {
      background-color: #FFFFFF;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
      border: 1px solid rgba(46, 120, 197, 0.15);
  }
  [data-theme="light"] #courses-section .card:hover {
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
  }
  [data-theme="light"] #courses-section .card-title {
      background: linear-gradient(transparent, rgba(230, 242, 255, 0.95));
      color: var(--diamond-white);
  }
  [data-theme="light"] #courses-section .card-body,
  [data-theme="light"] #courses-section .card-meta {
      color: var(--cool-gray);
  }
  [data-theme="light"] #courses-section .card-button {
      color: var(--primary-blue);
      border-color: var(--primary-blue);
  }
  [data-theme="light"] #courses-section .card-button:hover {
      background-color: rgba(46, 120, 197, 0.1);
      box-shadow: 0 4px 12px rgba(46, 120, 197, 0.2);
  }
</style>





<!-- Latest Courses -->
<section id="courses-section" style="padding:2rem 0;">
  @php
    try {
      $latestCourses = \App\Models\Course::query()
        ->where('active', true)
        ->latest()
        ->take(3)
        ->get();
    } catch (\Throwable $e) {
      $latestCourses = collect();
    }
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
      <div class="cards-grid">
        @foreach($latestCourses as $course)
          @php
            $courseImage   = $pickCourseImage($course);
            $courseTitle   = $course->title ?? 'Untitled';
            $courseExcerpt = \Illuminate\Support\Str::limit(strip_tags($course->short_description ?? $course->description ?? $course->summary ?? ''), 140);
            $showUrl       = \Illuminate\Support\Facades\Route::has('courses.show') ? route('courses.show', $course) : url('/courses/'.$course->id);
            // Lessons count (relation preferred, fallback to *_count fields)
            $lessonsCount = 0;
            if (method_exists($course, 'lessons')) {
              $lessonsCount = $course->relationLoaded('lessons') ? $course->lessons->count() : $course->lessons()->count();
            } else {
              $lessonsCount = $course->lessons_count ?? $course->lectures_count ?? 0;
            }
          @endphp

          <div class="card">
            <div class="card-image-container">
              @if($courseImage)
                <img src="{{ $courseImage }}" alt="{{ $courseTitle }}" class="card-image">
              @else
                <img src="https://via.placeholder.com/1000x600.png?text=Course" alt="{{ $courseTitle }}" class="card-image">
              @endif
              <h3 class="card-title">{{ $courseTitle }}</h3>
            </div>
            <div class="card-content">
              <div class="card-meta">
                <span><i class="fas fa-play-circle"></i> {{ $lessonsCount }} lessons</span>
                @if(!empty($course->created_at))
                  <span><i class="far fa-calendar"></i> {{ $course->created_at->format('M j, Y') }}</span>
                @endif
              </div>
              <p class="card-body">{{ $courseExcerpt }}</p>
              <a class="card-button" href="{{ $showUrl }}">
                View Course <i class="fas fa-arrow-right"></i>
              </a>
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

<!-- Testimonials Carousel -->
<section id="testimonials-section" style="padding:3rem 0; background: rgba(255, 255, 255, 0.02);">
  <div class="container">
    <div class="text-center mb-4" style="text-align:center !important; margin-bottom: 2rem !important;">
      <h2 class="m-0" style="color: #64b5f6; font-size: 28px; margin-bottom: 0.5rem !important;">What People Say About Us</h2>
      <p style="color: var(--cool-gray); font-size: 1rem;">Hear from our community members</p>
    </div>

    @if(isset($testimonials) && $testimonials->count())
    <div class="testimonials-carousel-wrapper" style="position: relative; overflow: hidden; padding: 0 3rem;">
      <button class="carousel-nav carousel-prev" onclick="scrollTestimonials('prev')" aria-label="Previous testimonial">
        <i class="fas fa-chevron-left"></i>
      </button>
      
      <div class="testimonials-carousel" id="testimonialsCarousel">
        @foreach($testimonials as $testimonial)
        <div class="testimonial-slide">
          <div class="testimonial-content">
            <div class="testimonial-quote-home">
              <i class="fas fa-quote-left quote-icon"></i>
              {{ \Illuminate\Support\Str::limit($testimonial->quote, 200) }}
            </div>
            <div class="testimonial-author-home">
              <div class="testimonial-avatar-wrapper">
                @if($testimonial->user && $testimonial->user->profile_photo)
                  <img src="{{ route('me.photo') }}?user_id={{ $testimonial->user_id }}" 
                       alt="{{ $testimonial->name }}" 
                       class="testimonial-avatar-home"
                       onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                  <div class="testimonial-avatar-placeholder-home" style="display:none;">
                    {{ strtoupper(substr($testimonial->name ?? 'U', 0, 1)) }}
                  </div>
                @elseif($testimonial->avatar_path)
                  <img src="{{ Storage::url($testimonial->avatar_path) }}" 
                       alt="{{ $testimonial->name }}" 
                       class="testimonial-avatar-home"
                       onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                  <div class="testimonial-avatar-placeholder-home" style="display:none;">
                    {{ strtoupper(substr($testimonial->name ?? 'U', 0, 1)) }}
                  </div>
                @else
                  <div class="testimonial-avatar-placeholder-home">
                    {{ strtoupper(substr($testimonial->name ?? 'U', 0, 1)) }}
                  </div>
                @endif
              </div>
              <div class="testimonial-author-info">
                <div class="author-name">{{ $testimonial->name ?? 'Anonymous' }}</div>
                <div class="author-date">
                  <i class="far fa-calendar"></i> {{ $testimonial->created_at?->format('M d, Y') }}
                </div>
              </div>
            </div>
          </div>
        </div>
        @endforeach
      </div>
      
      <button class="carousel-nav carousel-next" onclick="scrollTestimonials('next')" aria-label="Next testimonial">
        <i class="fas fa-chevron-right"></i>
      </button>
    </div>

    <div class="text-center mt-4" style="padding-top:2rem !important">
      <a class="btn-outline btn-wide" href="{{ route('testimonials.index') }}" style="text-decoration: none;">
        View All Testimonials <i class="fas fa-arrow-right"></i>
      </a>
    </div>
    @else
    <div class="text-center" style="color: var(--cool-gray); padding: 2rem;">
      <p>No testimonials yet. Be the first to share your experience!</p>
      @auth
      <a class="btn-primary" href="{{ route('testimonials.create') }}" style="text-decoration: none; margin-top: 1rem; display: inline-block;">
        Share Your Testimonial
      </a>
      @endauth
    </div>
    @endif
  </div>
</section>

<style>
.testimonials-carousel-wrapper {
  position: relative;
  margin: 0 auto;
  max-width: 1200px;
}

.testimonials-carousel {
  display: flex;
  gap: 1.5rem;
  overflow-x: auto;
  scroll-behavior: smooth;
  scrollbar-width: none;
  -ms-overflow-style: none;
  padding: 1rem 0;
}

.testimonials-carousel::-webkit-scrollbar {
  display: none;
}

.testimonial-slide {
  flex: 0 0 350px;
  min-width: 350px;
}

.testimonial-content {
  background: rgba(255, 255, 255, 0.03);
  border: 1px solid rgba(255, 255, 255, 0.1);
  border-radius: 12px;
  padding: 2rem;
  height: 100%;
  display: flex;
  flex-direction: column;
  gap: 1rem;
  transition: all 0.3s ease;
}

.testimonial-content:hover {
  background: rgba(255, 255, 255, 0.05);
  border-color: rgba(0, 201, 255, 0.3);
  transform: translateY(-4px);
  box-shadow: 0 8px 24px rgba(0, 0, 0, 0.3);
}

.testimonial-avatar-wrapper {
  flex-shrink: 0;
}

.testimonial-avatar-home {
  width: 50px;
  height: 50px;
  border-radius: 50%;
  object-fit: cover;
  border: 2px solid rgba(0, 201, 255, 0.4);
}

.testimonial-avatar-placeholder-home {
  width: 50px;
  height: 50px;
  border-radius: 50%;
  background: linear-gradient(135deg, var(--cyan-accent), var(--purple-accent));
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: 600;
  font-size: 1.2rem;
  color: white;
}

.testimonial-quote-home {
  color: var(--diamond-white);
  line-height: 1.6;
  font-style: italic;
  text-align: left;
  position: relative;
  flex: 1;
}

.quote-icon {
  color: var(--cyan-accent);
  font-size: 1.2rem;
  opacity: 0.3;
  margin-bottom: 0.5rem;
  display: block;
}

.testimonial-author-home {
  display: flex;
  align-items: center;
  gap: 1rem;
  padding-top: 1rem;
  border-top: 1px solid rgba(255, 255, 255, 0.1);
}

.testimonial-author-info {
  flex: 1;
  text-align: left;
}

.author-name {
  font-weight: 600;
  color: var(--cyan-accent);
  margin-bottom: 0.25rem;
}

.author-date {
  font-size: 0.85rem;
  color: var(--cool-gray);
}

/* Light Mode Testimonials */
[data-theme="light"] .testimonial-content {
    background: #FFFFFF;
    border: 1px solid rgba(46, 120, 197, 0.2);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
}
[data-theme="light"] .testimonial-content:hover {
    background: #FFFFFF;
    border-color: rgba(46, 120, 197, 0.4);
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
}
[data-theme="light"] .testimonial-quote-home {
    color: var(--diamond-white);
}
[data-theme="light"] .quote-icon {
    color: var(--primary-blue);
}
[data-theme="light"] .author-name {
    color: var(--primary-blue);
}
[data-theme="light"] .author-date {
    color: var(--cool-gray);
}
[data-theme="light"] .carousel-nav {
    background: rgba(46, 120, 197, 0.15);
    border-color: rgba(46, 120, 197, 0.4);
    color: var(--primary-blue);
}
[data-theme="light"] .carousel-nav:hover {
    background: rgba(46, 120, 197, 0.25);
    border-color: var(--primary-blue);
}

.carousel-nav {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  background: rgba(0, 201, 255, 0.2);
  border: 1px solid rgba(0, 201, 255, 0.4);
  color: var(--cyan-accent);
  width: 45px;
  height: 45px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition: all 0.3s ease;
  z-index: 10;
  backdrop-filter: blur(10px);
}

.carousel-nav:hover {
  background: rgba(0, 201, 255, 0.3);
  border-color: var(--cyan-accent);
  transform: translateY(-50%) scale(1.1);
}

.carousel-prev {
  left: 0;
}

.carousel-next {
  right: 0;
}

@media (max-width: 768px) {
  .testimonials-carousel-wrapper {
    padding: 0 2.5rem;
  }
  
  .testimonial-slide {
    flex: 0 0 280px;
    min-width: 280px;
  }
  
  .testimonial-content {
    padding: 1.5rem;
  }
  
  .carousel-nav {
    width: 40px;
    height: 40px;
  }
}

@media (max-width: 480px) {
  .testimonials-carousel-wrapper {
    padding: 0 2rem;
  }
  
  .testimonial-slide {
    flex: 0 0 260px;
    min-width: 260px;
  }
  
  .testimonial-content {
    padding: 1.25rem;
  }
  
  .testimonial-avatar-home,
  .testimonial-avatar-placeholder-home {
    width: 45px;
    height: 45px;
    font-size: 1.1rem;
  }
  
  .carousel-nav {
    width: 35px;
    height: 35px;
    font-size: 0.9rem;
  }
}
</style>

<script>
let autoScrollInterval;
let isUserScrolling = false;

function scrollTestimonials(direction) {
  const carousel = document.getElementById('testimonialsCarousel');
  if (!carousel) return;
  
  const scrollAmount = 370; // slide width + gap
  const currentScroll = carousel.scrollLeft;
  
  if (direction === 'next') {
    carousel.scrollLeft = currentScroll + scrollAmount;
  } else {
    carousel.scrollLeft = currentScroll - scrollAmount;
  }
  
  // Reset auto-scroll after manual interaction
  isUserScrolling = true;
  clearInterval(autoScrollInterval);
  setTimeout(() => {
    isUserScrolling = false;
    startAutoScroll();
  }, 5000);
}

function startAutoScroll() {
  const carousel = document.getElementById('testimonialsCarousel');
  if (!carousel) return;
  
  clearInterval(autoScrollInterval);
  
  autoScrollInterval = setInterval(() => {
    if (isUserScrolling) return;
    
    const maxScroll = carousel.scrollWidth - carousel.clientWidth;
    const currentScroll = carousel.scrollLeft;
    
    if (currentScroll >= maxScroll - 10) {
      // Reset to start
      carousel.scrollLeft = 0;
    } else {
      // Scroll to next
      carousel.scrollLeft = currentScroll + 370;
    }
  }, 4000); // Auto-scroll every 4 seconds
}

// Initialize auto-scroll when page loads
document.addEventListener('DOMContentLoaded', function() {
  startAutoScroll();
  
  // Pause auto-scroll when user manually scrolls
  const carousel = document.getElementById('testimonialsCarousel');
  if (carousel) {
    carousel.addEventListener('scroll', () => {
      isUserScrolling = true;
      clearInterval(autoScrollInterval);
      setTimeout(() => {
        isUserScrolling = false;
        startAutoScroll();
      }, 3000);
    });
  }
});

// Clean up on page unload
window.addEventListener('beforeunload', () => {
  clearInterval(autoScrollInterval);
});
</script>

<!-- Partners Logos -->
<section id="partners-section" style="padding:2rem 0;">
  @php
    try {
      $partners = \App\Models\Partner::query()->active()->ordered()->get();
    } catch (\Throwable $e) {
      $partners = collect();
    }
    $applyUrl = \Illuminate\Support\Facades\Route::has('partners.apply')
      ? route('partners.apply')
      : url('/partners/apply');
  @endphp

  <div class="container">
    <div class="text-center mb-3" style="text-align:center !important; color: #64b5f6; font-size: 22px">
      <h2 class="m-0">Our Partners</h2>
    </div>

    @if($partners->count())
      <div class="partners-grid">
        @foreach($partners as $p)
          <a class="partner-item" href="{{ $p->website_url ?: '#' }}" @if(!empty($p->website_url)) target="_blank" rel="noopener" @endif title="{{ $p->name }}">
            @if(!empty($p->logo_url))
              <img src="{{ $p->logo_url }}" alt="{{ $p->name }}">
            @else
              <div class="partner-fallback">{{ \Illuminate\Support\Str::limit($p->name, 20) }}</div>
            @endif
          </a>
        @endforeach
      </div>
    @else
      <div class="text-muted" style="text-align:center">No partners yet.</div>
    @endif

    <div class="text-center mt-3" style="padding-top:1rem !important">
      <a class="btn-outline btn-wide" href="{{ $applyUrl }}">Become a Partner</a>
    </div>
  </div>
</section>

<style>
  /* Partners grid (scoped) */
  #partners-section .partners-grid{display:grid;grid-template-columns:repeat(auto-fill, minmax(140px,1fr));gap:1.25rem;align-items:center}
  #partners-section .partner-item{display:flex;align-items:center;justify-content:center;background-color:#0f1a2f;border:1px solid rgba(136,146,176,0.2);border-radius:12px;min-height:90px;padding:12px;transition:transform .2s ease, box-shadow .2s ease}
  #partners-section .partner-item:hover{transform:translateY(-3px);box-shadow:0 8px 20px rgba(2,12,27,0.6)}
  #partners-section .partner-item img{max-width:100%;max-height:56px;object-fit:contain;filter:grayscale(20%);opacity:.95}
  #partners-section .partner-fallback{color:#94a3b8;font-weight:700}
  @media (max-width:768px){#partners-section .partners-grid{grid-template-columns:repeat(auto-fill, minmax(120px,1fr))}}

  /* Light Mode Partners */
  [data-theme="light"] #partners-section .partner-item {
      background-color: #FFFFFF;
      border: 1px solid rgba(46, 120, 197, 0.2);
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
  }
  [data-theme="light"] #partners-section .partner-item:hover {
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
  }
  [data-theme="light"] #partners-section .partner-fallback {
      color: var(--primary-blue);
  }
</style>


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
      color: var(--diamond-white);
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
</style>

<!-- Upcoming Events -->
<section id="events-section" style="padding:2rem 0;">
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
      <div class="cards-grid">
        @foreach($upcomingTop3 as $event)
          @php
            $title = $event->title ?? 'Untitled Event';
            $image = $pickEventImage($event);
            $showUrl = \Illuminate\Support\Facades\Route::has('events.show')
              ? route('events.show', $event->slug ?? $event->id)
              : url('/events/'.($event->slug ?? $event->id));
            $start = $event->date; // cast to Carbon in model
            $end   = $event->ends_at;
            $timeText = '';
            if ($start) {
              $timeText = $start->format('g:ia');
              if ($end) { $timeText .= ' - ' . ($start->isSameDay($end) ? $end->format('g:ia') : $end->format('M j, Y g:ia')); }
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
    @else
      <div class="text-muted">No upcoming events.</div>
    @endif
    <div class="text-center mt-3" style="padding-top:1rem !important">
      <a class="btn-outline btn-wide" href="{{ $eventsIndexUrl }}">View all events</a>
    </div>
  </div>
</section>

<!-- FAQs -->
<section id="faq-section" style="padding:2rem 0;">
  @php
    try {
      $faqs = \App\Models\Faq::query()->where('is_active', true)->latest()->take(6)->get();
    } catch (\Throwable $e) {
      $faqs = collect();
    }
  @endphp

  <div class="container">
    <div class="text-center mb-3" style="text-align:center !important; color: #64b5f6; font-size: 22px">
      <h2 class="m-0">Frequently Asked Questions</h2>
    </div>

    @if($faqs->count())
      <div class="faq-accordion">
        @foreach($faqs as $i => $f)
          <details class="faq-item" @if($i===0) open @endif>
            <summary class="faq-q">{{ $f->question }}</summary>
            <div class="faq-a">{!! nl2br(e($f->answer)) !!}</div>
          </details>
        @endforeach
      </div>
    @else
      <div class="text-muted" style="text-align:center">No FAQs yet.</div>
    @endif
  </div>
</section>

<style>
  /* FAQ styles (scoped) */
  #faq-section .faq-accordion{display:grid;gap:.75rem}
  #faq-section .faq-item{background:#112240;border:1px solid rgba(136,146,176,0.2);border-radius:12px;overflow:hidden}
  #faq-section .faq-q{cursor:pointer;padding:1rem 1.25rem;list-style:none;display:flex;align-items:center;gap:.75rem;font-weight:700;color:#e6f1ff}
  #faq-section .faq-q::-webkit-details-marker{display:none}
  #faq-section .faq-q:after{content:'+';margin-left:auto;color:#64b5f6;font-weight:800}
  #faq-section .faq-item[open] .faq-q:after{content:'−'}
  #faq-section .faq-a{padding:0 1.25rem 1rem;color:#94a3b8;line-height:1.6}
  @media (max-width:768px){#faq-section .faq-q{padding:0.9rem 1rem}#faq-section .faq-a{padding:0 1rem 1rem}}

  /* Light Mode FAQs */
  [data-theme="light"] #faq-section .faq-item {
      background: #FFFFFF;
      border: 1px solid rgba(46, 120, 197, 0.2);
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
  }
  [data-theme="light"] #faq-section .faq-q {
      color: var(--primary-blue);
  }
  [data-theme="light"] #faq-section .faq-q:after {
      color: var(--primary-blue);
  }
  [data-theme="light"] #faq-section .faq-a {
      color: var(--cool-gray);
  }
</style>

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
.hero-rtl{position:relative; height: 100vh; min-height:100vh}
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
  .hero-slide { height: 80vh; min-height: 360px; }
  .hero-rtl, .hero-fader { height:80vh; min-height:360px }
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
  
  /* Mobile: 2 columns for stats */
  @media (max-width: 768px) {
    .stats-grid {
      grid-template-columns: repeat(2, 1fr);
      gap: 1rem;
    }
  }
  
  @media (max-width: 480px) {
    .stats-grid {
      grid-template-columns: repeat(2, 1fr);
      gap: 0.75rem;
    }
    .stat-card {
      padding: 1rem;
    }
    .stat-value {
      font-size: 1.5rem;
    }
  }
  .stat-card {
    text-align:center; padding: 1.5rem;
    background: rgba(255,255,255,0.03);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: var(--radius);
  }
  .stat-value { font-size: 2rem; font-weight: 800; color: var(--diamond-white); }
  .stat-label { color: var(--cool-gray); }

  /* Light Mode Stats */
  [data-theme="light"] .stat-card {
      background: #FFFFFF;
      border: 1px solid rgba(46, 120, 197, 0.2);
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
  }
  [data-theme="light"] .stat-value {
      color: var(--primary-blue);
  }
  [data-theme="light"] .stat-label {
      color: var(--cool-gray);
  }


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