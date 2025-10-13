@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<style>
  /* Page sections */
  .section { padding: 2.5rem 0; }
  .section-title { text-align:center; margin-bottom: 0 !important; }
  .section-title h1, .section-title h2 { font-weight: 700; color: #64b5f6; }
  .section-title p { color: var(--cool-gray); }

  /* Grid & cards (aligned to Courses page style) */
  .about-grid {
    display:grid;
    grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
    gap: 2rem;
  }
  .team-grid { display:grid; grid-template-columns: repeat(2, 1fr); gap: 2rem; }
  @media (max-width: 991.98px){ .team-grid { grid-template-columns: 1fr; } }
  .partner-grid { display:grid; grid-template-columns: repeat(auto-fit, minmax(160px,1fr)); gap: 1.25rem; align-items:center; }

  .card {
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 100px 16px 100px 16px;
    overflow: hidden;
    transition: transform 0.3s, box-shadow 0.3s;
    box-shadow: -2px 0 16px rgba(59,130,246,.35), 0 6px 18px rgba(59,130,246,.25);
  }
  .card:hover { transform: translateY(-5px); box-shadow: 0 12px 34px rgba(0, 0, 0, 0.35); }
  .card-body { padding: 1.5rem; }
  .card-title { font-size: 1.35rem; font-weight: 700; color: var(--diamond-white); margin-bottom: .75rem; }
  .card-text { color: var(--cool-gray); line-height: 1.6; }

  .media {
    width: 100%;
    height: 240px;
    object-fit: cover;
    background: linear-gradient(135deg, var(--primary-blue), var(--deep-blue));
    border-radius: 100px 16px 100px 16px;
    box-shadow: -8px 12px 28px rgba(37,99,235,.35);
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

  /* Partners */
  .partner-card {
    background: rgba(255,255,255,0.03);
    border:1px solid rgba(255,255,255,0.1);
    border-radius: var(--radius);
    padding: 1.25rem;
    display:flex; align-items:center; justify-content:center;
    transition: transform .3s, box-shadow .3s, filter .3s, opacity .3s;
    filter: grayscale(100%); opacity: .8;
  }
  .partner-card:hover { transform: translateY(-4px); box-shadow: 0 10px 30px rgba(0,0,0,0.3); filter: grayscale(0%); opacity: 1; }

  /* Utilities */
  .muted { color: var(--cool-gray); }

  /* Subtle in-view animation (optional) */
  .fade-in-up { opacity: 0; transform: translateY(12px); transition: opacity .4s ease, transform .4s ease; }
  .fade-in-up.visible { opacity: 1; transform: translateY(0); }
  /* Accent mini labels */
  .muted { color: var(--cool-gray); }
  .section-title p { color: var(--cool-gray); }

  /* Responsive tweaks to keep cards elegant on small screens */
  @media (max-width: 767.98px){
    .media{ height: 220px; }
    .card-title{ font-size: 1.25rem; }
  }
  /* Tighten About header spacing */
  .about-hero{padding: .75rem 0 .75rem !important}
  .about-hero .section-title{margin: 0 0 .75rem 0 !important}
  .about-hero .section-title h1{margin:0 !important}

  /* About split card with edge-to-edge media */
  .about-card{display:flex;flex-direction:row;align-items:stretch;border:1px solid rgba(255,255,255,0.08);border-radius:100px 16px 100px 16px;overflow:hidden;background:rgba(255,255,255,0.03)}
  .about-media{position:relative;flex:0 0 48% !important;max-width:48% !important}
  .about-visual{position:relative;height:100%;width:100% !important;margin:0 !important;border-radius:100px 16px 100px 16px;overflow:hidden;background:linear-gradient(135deg,var(--primary-blue),var(--deep-blue));border-top:3px solid var(--primary-blue);border-left:3px solid var(--primary-blue);border-bottom:3px solid var(--primary-blue);box-shadow:-2px 0 16px rgba(59,130,246,.35),0 -6px 18px rgba(59,130,246,.25),0 6px 18px rgba(59,130,246,.25)}
  .about-img{display:block;width:100% !important;height:100% !important;object-fit:cover}
  .about-content{flex:1 1 auto !important;display:flex}

  @media (max-width: 768px){
    .about-card{flex-direction:column}
    .about-media,.about-content{max-width:100% !important;flex-basis:100% !important}
    .about-visual{border-radius:24px}
  }

  /* Team card */
  .tm-card{background:#1e293b;border-radius:16px;overflow:hidden;box-shadow:0 10px 25px rgba(0,0,0,0.3);transition:all .3s ease;max-width:580px;max-height:325px;width:100%;height:100%;display:flex;border:1px solid rgba(255,255,255,0.05)}
  .tm-card:hover{transform:translateY(-5px);box-shadow:0 12px 25px rgba(0,0,0,0.4)}
  .tm-image-container{min-width:40% !important; max-width:40% !important; overflow:hidden;position:relative}
  .tm-image-container img{width:100% !important;height:100% !important;object-fit:cover;transition:all .3s ease;display:block}
  .tm-card:hover .tm-image-container img{transform:scale(1.03)}
  .tm-image-overlay{position:absolute;bottom:0;left:0;width:100%;height:40%;background:linear-gradient(to top, rgba(30,41,59,0.9), transparent);pointer-events:none}
  .tm-content{padding:20px;flex-grow:1;display:flex;flex-direction:column;justify-content:space-between;position:relative;overflow:hidden}
  .tm-name{font-size:1.3rem;color:#f1f5f9;margin-bottom:0 !important; margin-top: -0.25rem; font-weight:700;background:linear-gradient(90deg,#3b82f6,#60a5fa);-webkit-background-clip:text;-webkit-text-fill-color:transparent;line-height:1.2}
  .tm-position{color:#fff;background:#3b82f6;padding:5px 12px;border-radius:8px;font-size:.75rem;font-weight:500;display:inline-block;margin-bottom:15px;position:relative}
  .tm-position::after{content:'';position:absolute;bottom:-8px;left:0;width:45px;height:3px;background:#3b82f6;border-radius:2px}
  .tm-bio{color:#94a3b8;line-height:1.3;margin-bottom:15px;font-size:.9rem;max-width:100%;overflow:hidden}

  /* Socials and contact (from template) */
  .socials{display:flex;gap:8px;margin-bottom:15px}
  .socials a{display:flex;align-items:center;justify-content:center;width:36px;height:36px;border-radius:10px;background:rgba(59,130,246,0.1);color:#60a5fa;transition:all .3s ease;text-decoration:none;border:1px solid rgba(59,130,246,0.2);font-size:.9rem}
  .socials a:hover{background:#3b82f6;color:#fff;transform:translateY(-3px);box-shadow:0 4px 10px rgba(59,130,246,0.4)}
  .contact-info{display:flex;flex-direction:column;gap:8px}
  .contact-item{display:flex;align-items:center;gap:8px;color:#94a3b8;font-size:.8rem;padding:6px 10px;background:rgba(255,255,255,0.05);border-radius:8px;transition:all .3s ease}
  .contact-item:hover{background:rgba(255,255,255,0.08)}
  .contact-item i{color:#3b82f6;font-size:.8rem}

  @media (max-width:650px){
    .tm-card{flex-direction:column;max-height:unset;height:auto}
    .tm-image-container{width:100%;height:180px}
    .tm-content{padding:20px}
    .tm-name{font-size:1.4rem}
  }

  /* Make images truly flush with the card edges */
  .media{border-radius:0 !important;margin:0 !important}
</style>
@endpush

@section('content')
  {{-- Header --}}
  <section class="section about-hero">
    <div class="container">
      <div class="section-title">
        <h1 style="font-size: 2.5rem;">About Us</h1>
        
      </div>
    </div>
  </section>

  {{-- About block (hexagon card) --}}
  @php $about = \App\Models\AboutSection::where('section_type', 'about')->active()->first(); @endphp
  @if($about)
  <section class="section">
    <style>
      /* Scoped styles for About hex card on the About page */
      .about-hex-card{background:#131a2a;border-radius:24px;overflow:hidden;box-shadow:0 10px 25px rgba(0,0,0,0.5);transition:all .4s cubic-bezier(0.175,0.885,0.32,1.275);max-width:1000px;width:100%;display:flex;position:relative;border:1px solid rgba(59,130,246,0.1);margin:0 auto}
      .about-hex-card::before{content:'';position:absolute;top:-2px;left:-2px;right:-2px;bottom:-2px;background:linear-gradient(45deg,#3b82f6,#00d4ff,#3b82f6);z-index:-1;border-radius:26px;opacity:0;transition:opacity .5s ease}
      .about-hex-card:hover::before{opacity:0;animation:none}
      @keyframes abouthex-rotate{0%{filter:hue-rotate(0)}100%{filter:hue-rotate(360deg)}}

      .about-hex-image{min-width:30%;position:relative;overflow:hidden;display:flex;align-items:center;justify-content:center}
      .about-hex{width:320px;height:370px;background:linear-gradient(135deg,#3b82f6,#00d4ff);clip-path:polygon(50% 0%,100% 25%,100% 75%,50% 100%,0% 75%,0% 25%);display:flex;align-items:center;justify-content:center;position:relative}
      .about-hex-inner{width:300px;height:350px;clip-path:polygon(50% 0%,100% 25%,100% 75%,50% 100%,0% 75%,0% 25%);overflow:hidden;background:#131a2a;display:flex;align-items:center;justify-content:center}
      .about-hex-inner img{width:100%;height:100%;object-fit:cover;transition:all .4s cubic-bezier(0.175,0.885,0.32,1.275);filter:grayscale(30%)}
      .about-hex-card:hover .about-hex-inner img{transform:none;filter:grayscale(30%)}

      .about-hex-floating{position:absolute;width:100%;height:100%;pointer-events:none}
      .about-hex-f{position:absolute;width:40px;height:40px;background:rgba(59,130,246,0.2);border-radius:50%;animation:abouthex-float 6s ease-in-out infinite}
      .about-hex-f:nth-child(1){top:20%;left:10%;animation-delay:0s;width:30px;height:30px}
      .about-hex-f:nth-child(2){top:60%;left:80%;animation-delay:1s;width:25px;height:25px}
      .about-hex-f:nth-child(3){top:80%;left:20%;animation-delay:2s;width:35px;height:35px}
      @keyframes abouthex-float{0%,100%{transform:translateY(0) rotate(0)}50%{transform:translateY(-20px) rotate(180deg)}}

      .about-hex-content{padding:40px;flex-grow:1;display:flex;flex-direction:column;justify-content:center;position:relative;z-index:2}
      .about-hex-badge{position:absolute;top:30px;right:30px;background:linear-gradient(45deg,#3b82f6,#00d4ff);color:#fff;padding:8px 20px;border-radius:20px;font-size:.9rem;font-weight:600;box-shadow:0 4px 15px rgba(59,130,246,.4)}
      .about-hex-title{font-size:2.5rem;color:#f1f5f9;margin-bottom:15px;font-weight:800;background:linear-gradient(90deg,#3b82f6,#00d4ff);-webkit-background-clip:text;-webkit-text-fill-color:transparent;position:relative;display:inline-block}
      .about-hex-title::after{content:'';position:absolute;bottom:-8px;left:0;width:80px;height:4px;background:linear-gradient(90deg,#3b82f6,#00d4ff);border-radius:2px}
      .about-hex-sub{color:#94a3b8;font-size:1.2rem;margin-bottom:25px;font-weight:500}
      .about-hex-desc{color:#94a3b8;line-height:1.7;margin-bottom:30px;font-size:1.05rem}
      .about-hex-features{display:grid;grid-template-columns:1fr 1fr;gap:15px;margin-bottom:30px}
      .about-hex-feature{display:flex;align-items:center;gap:10px;color:#94a3b8;font-size:.95rem}
      .about-hex-feature i{color:#3b82f6;font-size:1rem}

      @media (max-width:900px){
        .about-hex-card{flex-direction:column;max-width:600px}
        .about-hex-image{width:100%;height:400px}
        .about-hex{width:280px;height:320px}
        .about-hex-inner{width:260px;height:300px}
        .about-hex-content{padding:30px 25px}
        .about-hex-title{font-size:2rem}
      }
      @media (max-width:480px){
        .about-hex-card{max-width:100%}
        .about-hex-image{height:300px}
        .about-hex{width:220px;height:250px}
        .about-hex-inner{width:200px;height:230px}
        .about-hex-features{grid-template-columns:1fr}
      }
    </style>
    <div class="container">
      <div class="about-hex-card fade-in-up">
        <div class="about-hex-image">
          <div class="about-hex">
            <div class="about-hex-inner">
              @if($about->image_path)
                <img src="{{ Storage::url($about->image_path) }}" alt="{{ $about->title }}">
              @else
                <img src="https://via.placeholder.com/1000x800.png?text=About" alt="{{ $about->title }}">
              @endif
            </div>
          </div>
          <div class="about-hex-floating">
            <div class="about-hex-f"></div>
            <div class="about-hex-f"></div>
            <div class="about-hex-f"></div>
          </div>
        </div>
        <div class="about-hex-content">
          <div class="about-hex-badge">{{ $about->mini_title ?? 'About Us' }}</div>
          <h1 class="about-hex-title">{{ $about->title }}</h1>
          @if(!empty($about->mini_title))
            <p class="about-hex-sub">{{ $about->mini_title }}</p>
          @endif
          <div class="about-hex-desc">{!! nl2br(e($about->content)) !!}</div>
          @if(!empty($about->bullet_points) && is_array($about->bullet_points) && count($about->bullet_points))
            <div class="about-hex-features">
              @foreach($about->bullet_points as $bp)
                <div class="about-hex-feature"><i class="fa-solid fa-circle-check"></i><span>{{ $bp }}</span></div>
              @endforeach
            </div>
          @endif
        </div>
      </div>
    </div>
  </section>
  @endif

  {{-- Stats strip --}}
  @php
    $stats = [
      ['label'=>'Courses',  'value'=> \App\Models\Course::count(),      'icon'=>'fa-book-open'],
      ['label'=>'Articles', 'value'=> \App\Models\Article::count(),     'icon'=>'fa-diagram-project'],
      ['label'=>'Partners', 'value'=> \App\Models\Partner::count(),     'icon'=>'fa-handshake'],
      ['label'=>'Members',  'value'=> \App\Models\User::count(),        'icon'=>'fa-users'],
    ];
  @endphp
  <section class="section">
    <div class="container">
      <div class="stats-grid">
        @foreach($stats as $s)
          <div class="stat-card fade-in-up">
            <div style="font-size:1.25rem;color:var(--cyan-accent);margin-bottom:.25rem;">
              <i class="fa-solid {{ $s['icon'] }}"></i>
            </div>
            <div class="stat-value">{{ number_format($s['value']) }}</div>
            <div class="stat-label">{{ $s['label'] }}</div>
          </div>
        @endforeach
      </div>
    </div>
  </section>

  {{-- Mission & Vision --}}
  @php
    $mission = \App\Models\AboutSection::where('section_type','mission')->active()->first();
    $vision  = \App\Models\AboutSection::where('section_type','vision')->active()->first();
  @endphp
  @if($mission || $vision)
  <section class="section">
    <div class="container">
      <div class="section-title fade-in-up">
        <h2 style="font-size:2rem;">Our Purpose</h2>
        <p>Guided by a clear mission and vision for a digitally empowered Africa.</p>
      </div>
      <div class="about-grid">
        @if($mission)
        <div class="card fade-in-up">
          @if($mission->image_path)
            <img class="media" src="{{ Storage::url($mission->image_path) }}" alt="{{ $mission->title }}">
          @endif
          <div class="card-body">
            <h3 class="card-title">{{ $mission->title }}</h3>
            <div class="card-text">{{ $mission->content }}</div>
            @if(!empty($mission->bullet_points) && is_array($mission->bullet_points) && count($mission->bullet_points))
              <ul class="card-text" style="margin-top:.75rem; padding-left:1.1rem; list-style: disc;">
                @foreach($mission->bullet_points as $bp)
                  <li><i class="fas fa-circle-check" style="margin-right:6px;color:#3b82f6"></i>{{ $bp }}</li>
                @endforeach
              </ul>
            @endif
          </div>
        </div>
        @endif

        @if($vision)
        <div class="card fade-in-up">
          @if($vision->image_path)
            <img class="media" src="{{ Storage::url($vision->image_path) }}" alt="{{ $vision->title }}">
          @endif
          <div class="card-body">
            <h3 class="card-title">{{ $vision->title }}</h3>
            <div class="card-text">{{ $vision->content }}</div>
            @if(!empty($vision->bullet_points) && is_array($vision->bullet_points) && count($vision->bullet_points))
              <ul class="card-text" style="margin-top:.75rem; padding-left:1.1rem; list-style: disc;">
                @foreach($vision->bullet_points as $bp)
                  <li><i class="fas fa-circle-check" style="margin-right:6px;color:#3b82f6"></i>{{ $bp }}</li>
                @endforeach
              </ul>
            @endif
          </div>
        </div>
        @endif
      </div>
    </div>
  </section>
  @endif

  {{-- Values --}}
  @php $values = \App\Models\AboutSection::where('section_type','values')->active()->ordered()->get(); @endphp
  @if($values->count())
  <section class="section">
    <div class="container">
      <div class="section-title fade-in-up">
        <h2 style="font-size:2rem;">Our Values</h2>
        <p>Principles that shape our culture and impact.</p>
      </div>
      <div class="about-grid">
        @foreach($values as $value)
        <div class="card fade-in-up">
          @if($value->image_path)
            <img class="media" src="{{ Storage::url($value->image_path) }}" alt="{{ $value->title }}">
          @endif
          <div class="card-body">
            @if($value->mini_title)
              <div class="muted" style="margin-bottom:.5rem;">{{ $value->mini_title }}</div>
            @endif
            <h3 class="card-title">{{ $value->title }}</h3>
            <div class="card-text">{!! nl2br(e($value->content)) !!}</div>
            @if(!empty($value->bullet_points) && is_array($value->bullet_points) && count($value->bullet_points))
              <ul class="card-text" style="margin-top:.75rem; padding-left:1.1rem; list-style: disc;">
                @foreach($value->bullet_points as $bp)
                  <li><i class="fas fa-circle-check" style="margin-right:6px;color:#3b82f6"></i>{{ $bp }}</li>
                @endforeach
              </ul>
            @endif
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </section>
  @endif

  {{-- Team --}}
  <section class="section">
    <div class="container">
      <div class="section-title fade-in-up">
        <h2 style="font-size:2rem;">Meet Our Team</h2>
        <p>Our dedicated team is driving digital transformation across Africa.</p>
      </div>
      @php $teamMembers = \App\Models\TeamMember::active()->ordered()->get(); @endphp
      @if($teamMembers->count())
      <div class="team-grid">
        @foreach($teamMembers as $member)
        <div class="tm-card fade-in-up">
          <div class="tm-image-container">
            @if($member->image_path)
              <img src="{{ $member->image_url }}" alt="{{ $member->name }}">
            @else
              <img src="https://via.placeholder.com/600x600.png?text=Profile" alt="{{ $member->name }}">
            @endif
            <div class="tm-image-overlay"></div>
          </div>
          <div class="tm-content">
            <div>
              <h3 class="tm-name">{{ $member->name }}</h3>
              <p class="tm-position">{{ $member->role }}</p>
              <p class="tm-bio">{{ Str::limit($member->bio, 180) }}</p>
            </div>
            <div>
              <div class="socials">
                @if(!empty($member->instagram_url))
                  <a href="{{ $member->instagram_url }}" target="_blank" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                @endif
                @if(!empty($member->facebook_url))
                  <a href="{{ $member->facebook_url }}" target="_blank" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                @endif
                @if(!empty($member->twitter_url))
                  <a href="{{ $member->twitter_url }}" target="_blank" aria-label="Twitter"><i class="fab fa-x-twitter"></i></a>
                @endif
                @if(!empty($member->linkedin_url))
                  <a href="{{ $member->linkedin_url }}" target="_blank" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                @endif
              </div>
              <div class="contact-info">
                @if(!empty($member->email))
                  <div class="contact-item">
                    <i class="fas fa-envelope"></i>
                    <span>{{ $member->email }}</span>
                  </div>
                @endif
              </div>
            </div>
          </div>
        </div>
        @endforeach
      </div>
      @else
        <div class="muted" style="text-align:center; padding: 3rem 0;">No team members found.</div>
      @endif
    </div>
  </section>

  {{-- Partners --}}
  <section class="section">
    <div class="container">
      <div class="section-title fade-in-up">
        <h2 style="font-size:2rem;">Our Partners</h2>
        <p>We collaborate with leading organizations to amplify impact.</p>
      </div>
      @php $partners = \App\Models\Partner::active()->ordered()->get(); @endphp
      @if($partners->count())
      <div class="partner-grid">
        @foreach($partners as $partner)
          <a href="{{ $partner->website_url }}" target="_blank" class="partner-card fade-in-up">
            @if($partner->logo_path)
              <img src="{{ Storage::url($partner->logo_path) }}" alt="{{ $partner->name }}" style="max-height: 42px; width:auto; object-fit:contain;">
            @else
              <span class="muted">{{ $partner->name }}</span>
            @endif
          </a>
        @endforeach
      </div>
      @else
        <div class="muted" style="text-align:center; padding: 3rem 0;">No partners found.</div>
      @endif
    </div>
  </section>

  {{-- CTA --}}
  <section class="section">
    <div class="container" style="text-align:center;">
      <h2 style="font-size:2rem; font-weight:700; color:var(--diamond-white); margin-bottom: .75rem;">Ready to join our mission?</h2>
      <p class="muted" style="margin-bottom: 1.25rem;">Become a partner, volunteer, or support our initiatives.</p>
      <div style="display:flex; gap:.75rem; justify-content:center; flex-wrap:wrap;">
        <a href="{{ route('contact') }}" class="btn-primary">Contact Us</a>
        <a href="{{ route('donate') }}" class="btn-outline">Donate Now</a>
      </div>
    </div>
  </section>
@endsection

@push('scripts')
<script>
  // Reveal elements on scroll
  document.addEventListener('DOMContentLoaded', function() {
    const fadeElements = document.querySelectorAll('.fade-in-up');
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => { if (entry.isIntersecting) entry.target.classList.add('visible'); });
    }, { threshold: 0.1 });
    fadeElements.forEach(el => observer.observe(el));
  });
</script>
@endpush