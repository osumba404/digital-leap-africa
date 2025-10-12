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
  .team-grid { display:grid; grid-template-columns: repeat(auto-fit, minmax(260px,1fr)); gap: 2rem; }
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

  /* Creative team card */
  .team-card{position:relative;background:rgba(255,255,255,0.04);border:1px solid rgba(255,255,255,0.08);border-radius:24px;overflow:hidden;transition:transform .3s, box-shadow .3s}
  .team-card:hover{transform:translateY(-6px);box-shadow:0 14px 34px rgba(0,0,0,.35)}
  .team-hero{position:relative;height:110px;background:linear-gradient(135deg, #0ea5e9 0%, #6366f1 100%);}
  .team-avatar{position:absolute;left:50%;top:100%;transform:translate(-50%, -50%);width:88px;height:88px;border-radius:50%;object-fit:cover;border:3px solid rgba(255,255,255,.9);box-shadow:0 6px 18px rgba(0,0,0,.35)}
  .team-avatar--fallback{display:flex;align-items:center;justify-content:center;background:rgba(0,0,0,.25);color:#fff;font-size:1.5rem}
  .team-body{padding:3.25rem 1rem 1.25rem 1rem;text-align:center}
  .team-name{font-weight:800;color:var(--diamond-white);margin-bottom:.25rem}
  .team-role{color:#9ecbff;margin-bottom:.5rem}
  .team-bio{color:var(--cool-gray)}

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

  {{-- About block (image + text) --}}
  @php $about = \App\Models\AboutSection::where('section_type', 'about')->active()->first(); @endphp
  @if($about)
  <section class="section">
    <div class="container">
      <div class="about-card fade-in-up">
        <div class="about-media">
          <div class="about-visual">
            @if($about->image_path)
              <img class="about-img" src="{{ Storage::url($about->image_path) }}" alt="{{ $about->title }}">
            @else
              <div class="about-img d-flex align-items-center justify-content-center" style="background:linear-gradient(135deg,var(--primary-blue),var(--deep-blue));">
                <i class="fas fa-users" style="font-size:3rem;color:var(--diamond-white);opacity:.35"></i>
              </div>
            @endif
          </div>
        </div>
        <div class="about-content">
          <div class="card h-100" style="border:0;background:transparent;">
            <div class="card-body d-flex flex-column">
              @if($about->mini_title)
                <div class="muted" style="margin-bottom:.5rem;">{{ $about->mini_title }}</div>
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
        <div class="team-card fade-in-up">
          <div class="team-hero">
            @if($member->image_path)
              <img class="team-avatar" src="{{ $member->image_url }}" alt="{{ $member->name }}">
            @else
              <div class="team-avatar team-avatar--fallback">
                <i class="fas fa-user"></i>
              </div>
            @endif
          </div>
          <div class="team-body">
            <h3 class="team-name">{{ $member->name }}</h3>
            <div class="team-role">{{ $member->role }}</div>
            <div class="team-bio">{{ Str::limit($member->bio, 130) }}</div>
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