@extends('layouts.app')
@push('styles')

@push('styles')
<!-- Configure Tailwind BEFORE loading the CDN script -->
<script>
  window.tailwind = window.tailwind || {};
  tailwind.config = {
    theme: {
      colors: {
        transparent: 'transparent',
        current: 'currentColor',
        white: '#ffffff',
        black: '#000000',
        // Platform palette
        primary: '#1c2333',
        'primary-dark': '#121826',
        accent: '#64b5f6',
        gray: {
          50:  '#f7f9fc',
          100: '#eef2f6',
          200: '#e3e8ef',
          300: '#cdd5df',
          400: '#9aa4b2',
          500: '#697586',
          600: '#4b5565',
          700: '#364152',
          800: '#202939',
          900: '#121826',
        },
      },
      container: { center: true, padding: '1rem' }
    }
  }
</script>
<script src="https://cdn.tailwindcss.com"></script>

<!-- Icons (one link only) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<!-- Your custom helpers (these complement Tailwind) -->
<style>
  .shadow-md { box-shadow: 0 8px 24px rgba(18, 38, 63, 0.06); }
  .shadow-lg { box-shadow: 0 12px 32px rgba(18, 38, 63, 0.12); }
  .text-primary { color: #64b5f6; } /* keep if you still use this non-TW class */
  .bg-primary-light { background: rgba(100, 181, 246, 0.12); }
  /* ... keep your other helpers ... */
</style>
@endpush

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<style>
  /* Elevation and color helpers */
  .shadow-md { box-shadow: 0 8px 24px rgba(18, 38, 63, 0.06); }
  .shadow-lg { box-shadow: 0 12px 32px rgba(18, 38, 63, 0.12); }
  .text-primary { color: #64b5f6; }
  .bg-primary-light { background: rgba(100, 181, 246, 0.12); }
  
  /* New styling enhancements */
  .section-divider {
    height: 1px;
    background: linear-gradient(90deg, transparent, rgba(0,0,0,0.1), transparent);
  }
  
  .floating-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }
  
  .floating-card:hover {
    transform: translateY(-5px);
  }
  
  .bg-pattern {
    background-image: radial-gradient(circle, rgba(255,255,255,0.1) 1px, transparent 1px);
    background-size: 20px 20px;
  }
  
  .gradient-border {
    position: relative;
  }
  
  .gradient-border::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #64b5f6, #64b5f6, #64b5f6);
  }
  
  .animate-float {
    animation: float 6s ease-in-out infinite;
  }
  
  @keyframes float {
    0% { transform: translateY(0px); }
    50% { transform: translateY(-10px); }
    100% { transform: translateY(0px); }
  }
  
  .fade-in-up {
    opacity: 0;
    transform: translateY(20px);
    transition: opacity 0.5s ease, transform 0.5s ease;
  }
  
  .fade-in-up.visible {
    opacity: 1;
    transform: translateY(0);
  }
  
  .hero-bg {
    position: relative;
    overflow: hidden;
  }
  
  .hero-bg::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(45deg, rgba(255,255,255,0.1) 0%, transparent 50%, rgba(255,255,255,0.1) 100%);
  }
  
  .stat-card {
    transition: all 0.3s ease;
  }
  
  .stat-card:hover {
    transform: scale(1.05);
  }
  
  .team-member-card {
    position: relative;
    overflow: hidden;
  }
  
  .team-member-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(to top, rgba(0,0,0,0.7) 0%, transparent 50%);
    opacity: 0;
    transition: opacity 0.3s ease;
    display: flex;
    align-items: flex-end;
    justify-content: center;
    padding-bottom: 1.5rem;
  }
  
  .team-member-card:hover .team-member-overlay {
    opacity: 1;
  }
  
  .partner-logo {
    transition: all 0.3s ease;
    filter: grayscale(100%);
    opacity: 0.7;
  }
  
  .partner-logo:hover {
    filter: grayscale(0%);
    opacity: 1;
    transform: scale(1.1);
  }
</style>
@endpush

@section('content')
    <!-- Hero Section -->
    @php
        $hero = \App\Models\AboutSection::where('section_type', 'hero')->active()->first();
    @endphp
    @if($hero)
    <section class="py-20 bg-gradient-to-r from-primary to-primary-dark text-white hero-bg">
        <div class="absolute inset-0 bg-pattern opacity-10"></div>
        <div class="container mx-auto px-4 relative z-10">
            <div class="max-w-4xl mx-auto text-center fade-in-up">
                @if($hero->mini_title)
                    <span class="text-yellow-400 font-semibold text-lg mb-4 block tracking-wider">{{ $hero->mini_title }}</span>
                @endif
                <h1 class="text-5xl md:text-6xl font-bold mb-8 leading-tight">{{ $hero->title }}</h1>
                <p class="text-xl text-gray-100 mb-10 leading-relaxed">{{ $hero->content }}</p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="#about" class="bg-white text-primary font-semibold px-8 py-4 rounded-lg hover:bg-gray-100 transition-colors duration-300 shadow-lg">
                        Learn More
                    </a>
                    <a href="#contact" class="bg-transparent border-2 border-white text-white font-semibold px-8 py-4 rounded-lg hover:bg-white hover:bg-opacity-10 transition-colors duration-300">
                        Get Involved
                    </a>
                </div>
            </div>
        </div>
        <div class="absolute bottom-0 left-0 right-0 h-16 bg-gradient-to-t from-white to-transparent"></div>
    </section>
    @endif

    <!-- About Section -->
    @php
        $about = \App\Models\AboutSection::where('section_type', 'about')->active()->first();
    @endphp
    @if($about)
    <section id="about" class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="flex flex-col lg:flex-row items-center">
                <div class="lg:w-1/2 mb-12 lg:mb-0 lg:pr-12 fade-in-up">
                    <div class="relative">
                        @if($about->image_path)
                            <div class="rounded-xl overflow-hidden shadow-2xl">
                                <img src="{{ Storage::url($about->image_path) }}" alt="{{ $about->title }}"
                                    class="w-full h-auto object-cover">
                            </div>
                            <div class="absolute -bottom-6 -right-6 w-24 h-24 bg-primary rounded-lg shadow-lg flex items-center justify-center">
                                <span class="text-white font-bold text-4xl">5+</span>
                            </div>
                            <div class="absolute -top-6 -left-6 w-20 h-20 bg-yellow-400 rounded-full shadow-lg flex items-center justify-center animate-float">
                                <i class="fas fa-users text-white text-2xl"></i>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="lg:w-1/2 fade-in-up">
                    <div class="max-w-lg">
                        @if($about->mini_title)
                            <span class="text-primary font-semibold text-lg mb-4 block tracking-wider">{{ $about->mini_title }}</span>
                        @endif
                        <h2 class="text-4xl font-bold mb-6 leading-tight">{{ $about->title }}</h2>
                        <div class="prose max-w-none text-gray-700 mb-8">
                            {!! nl2br(e($about->content)) !!}
                        </div>
                        <div class="flex flex-wrap gap-4">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-primary-light rounded-full flex items-center justify-center mr-3">
                                    <i class="fas fa-shield-alt text-primary"></i>
                                </div>
                                <span class="font-medium">Cybersecurity</span>
                            </div>
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-primary-light rounded-full flex items-center justify-center mr-3">
                                    <i class="fas fa-code text-primary"></i>
                                </div>
                                <span class="font-medium">Development</span>
                            </div>
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-primary-light rounded-full flex items-center justify-center mr-3">
                                    <i class="fas fa-graduation-cap text-primary"></i>
                                </div>
                                <span class="font-medium">Education</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- Impact Stats -->
    @php
        $stats = [
            ['label' => 'Courses', 'value' => \App\Models\Course::count(), 'icon' => 'fa-book-open'],
            ['label' => 'Projects', 'value' => \App\Models\Project::count(), 'icon' => 'fa-diagram-project'],
            ['label' => 'Partners', 'value' => \App\Models\Partner::count(), 'icon' => 'fa-handshake'],
            ['label' => 'Team', 'value' => \App\Models\TeamMember::count(), 'icon' => 'fa-users'],
        ];
    @endphp
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                @foreach($stats as $s)
                <div class="bg-white rounded-xl shadow-lg p-8 text-center stat-card floating-card">
                    <div class="mx-auto mb-4 flex items-center justify-center w-16 h-16 rounded-full bg-primary-light">
                        <i class="fa-solid {{ $s['icon'] }} text-primary text-2xl"></i>
                    </div>
                    <div class="text-4xl font-extrabold text-primary mb-2">{{ number_format($s['value']) }}+</div>
                    <div class="text-gray-600 font-medium text-lg">{{ $s['label'] }}</div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <div class="section-divider"></div>

    <!-- Mission & Vision -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16 fade-in-up">
                <h2 class="text-4xl font-bold mb-4">Our Purpose</h2>
                <p class="text-gray-600 max-w-2xl mx-auto text-lg">Guided by a clear mission and vision, we work towards a digitally empowered Africa</p>
            </div>
            
            <div class="grid lg:grid-cols-2 gap-12 max-w-6xl mx-auto">
                @php
                    $mission = \App\Models\AboutSection::where('section_type', 'mission')->active()->first();
                    $vision = \App\Models\AboutSection::where('section_type', 'vision')->active()->first();
                @endphp
                
                @if($mission)
                <div class="bg-white rounded-xl shadow-lg overflow-hidden gradient-border floating-card fade-in-up">
                    <div class="p-8">
                        <div class="flex items-center mb-6">
                            <div class="w-16 h-16 bg-primary-light rounded-full flex items-center justify-center mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold">{{ $mission->title }}</h3>
                        </div>
                        <p class="text-gray-700 text-lg leading-relaxed">{{ $mission->content }}</p>
                        @if($mission->image_path)
                            <div class="mt-6 rounded-lg overflow-hidden">
                                <img src="{{ Storage::url($mission->image_path) }}" alt="{{ $mission->title }}"
                                    class="w-full h-48 object-cover">
                            </div>
                        @endif
                    </div>
                </div>
                @endif

                @if($vision)
                <div class="bg-white rounded-xl shadow-lg overflow-hidden gradient-border floating-card fade-in-up">
                    <div class="p-8">
                        <div class="flex items-center mb-6">
                            <div class="w-16 h-16 bg-primary-light rounded-full flex items-center justify-center mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold">{{ $vision->title }}</h3>
                        </div>
                        <p class="text-gray-700 text-lg leading-relaxed">{{ $vision->content }}</p>
                        @if($vision->image_path)
                            <div class="mt-6 rounded-lg overflow-hidden">
                                <img src="{{ Storage::url($vision->image_path) }}" alt="{{ $vision->title }}"
                                    class="w-full h-48 object-cover">
                            </div>
                        @endif
                    </div>
                </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Values Section -->
    @php
        $values = \App\Models\AboutSection::where('section_type', 'values')->active()->ordered()->get();
    @endphp
    @if($values->count())
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16 fade-in-up">
                <h2 class="text-4xl font-bold mb-4">Our Values</h2>
                <p class="text-gray-600 max-w-2xl mx-auto text-lg">Principles that shape our culture and impact.</p>
            </div>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($values as $value)
                <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 p-8 floating-card fade-in-up">
                    @if($value->image_path)
                        <div class="rounded-lg overflow-hidden mb-6">
                            <img src="{{ Storage::url($value->image_path) }}" alt="{{ $value->title }}"
                                 class="w-full h-48 object-cover">
                        </div>
                    @endif
                    @if($value->mini_title)
                        <span class="text-primary font-semibold text-sm mb-3 block tracking-wider">{{ $value->mini_title }}</span>
                    @endif
                    <h3 class="text-2xl font-bold mb-4">{{ $value->title }}</h3>
                    <div class="prose max-w-none text-gray-700 text-lg leading-relaxed">
                        {!! nl2br(e($value->content)) !!}
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Team Section -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16 fade-in-up">
                <h2 class="text-4xl font-bold mb-4">Meet Our Team</h2>
                <p class="text-gray-600 max-w-2xl mx-auto text-lg">Our dedicated team of professionals is committed to driving digital transformation across Africa.</p>
            </div>
            
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                @php
                    $teamMembers = \App\Models\TeamMember::active()->ordered()->get();
                @endphp
                
                @forelse($teamMembers as $member)
                    <div class="bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300 team-member-card floating-card fade-in-up">
                        @if($member->image_path)
                            <div class="relative">
                                <img src="{{ $member->image_url }}" alt="{{ $member->name }}"
                                class="w-full h-80 object-cover">
                                <div class="team-member-overlay">
                                    <div class="flex space-x-4">
                                        @if($member->linkedin_url)
                                            <a href="{{ $member->linkedin_url }}" target="_blank" class="w-12 h-12 bg-white rounded-full flex items-center justify-center hover:bg-blue-100 transition-colors">
                                                <i class="fab fa-linkedin-in text-blue-600 text-xl"></i>
                                            </a>
                                        @endif
                                        @if($member->twitter_url)
                                            <a href="{{ $member->twitter_url }}" target="_blank" class="w-12 h-12 bg-white rounded-full flex items-center justify-center hover:bg-blue-100 transition-colors">
                                                <i class="fab fa-twitter text-blue-400 text-xl"></i>
                                            </a>
                                        @endif
                                        @if($member->instagram_url)
                                            <a href="{{ $member->instagram_url }}" target="_blank" class="w-12 h-12 bg-white rounded-full flex items-center justify-center hover:bg-pink-100 transition-colors">
                                                <i class="fab fa-instagram text-pink-600 text-xl"></i>
                                            </a>
                                        @endif
                                        @if($member->github_url)
                                            <a href="{{ $member->github_url }}" target="_blank" class="w-12 h-12 bg-white rounded-full flex items-center justify-center hover:bg-gray-100 transition-colors">
                                                <i class="fab fa-github text-gray-800 text-xl"></i>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="p-6">
                            <h3 class="text-xl font-bold mb-2">{{ $member->name }}</h3>
                            <p class="text-primary font-medium mb-4 text-lg">{{ $member->role }}</p>
                            <p class="text-gray-600 mb-6 leading-relaxed">{{ Str::limit($member->bio, 120) }}</p>
                        </div>
                    </div>
                @empty
                    <div class="col-span-4 text-center py-12 fade-in-up">
                        <p class="text-gray-500 text-lg">No team members found.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Partners Section -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16 fade-in-up">
                <h2 class="text-4xl font-bold mb-4">Our Partners</h2>
                <p class="text-gray-600 max-w-2xl mx-auto text-lg">We're proud to collaborate with these amazing organizations to make a greater impact.</p>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8 items-center max-w-6xl mx-auto">
                @php
                    $partners = \App\Models\Partner::active()->ordered()->get();
                @endphp
                
                @forelse($partners as $partner)
                    <a href="{{ $partner->website_url }}" target="_blank" class="block bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 h-full flex items-center justify-center floating-card fade-in-up">
                        @if($partner->logo_path)
                            <img src="{{ Storage::url($partner->logo_path) }}" alt="{{ $partner->name }}"
                                class="h-16 w-auto object-contain partner-logo" style="max-width: 180px;">
                        @else
                            <span class="text-gray-700 font-medium text-lg">{{ $partner->name }}</span>
                        @endif
                    </a>
                @empty
                    <div class="col-span-5 text-center py-12 fade-in-up">
                        <p class="text-gray-500 text-lg">No partners found.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-primary text-white relative overflow-hidden">
        <div class="absolute inset-0 bg-pattern opacity-10"></div>
        <div class="container mx-auto px-4 text-center relative z-10 fade-in-up">
            <h2 class="text-4xl font-bold mb-6">Ready to join our mission?</h2>
            <p class="text-xl mb-10 max-w-2xl mx-auto">Become a partner, volunteer, or support our initiatives to drive digital transformation in Africa.</p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="{{ route('contact') }}" class="bg-white text-primary font-semibold px-8 py-4 rounded-lg hover:bg-gray-100 transition-colors duration-300 shadow-lg">
                    Contact Us
                </a>
                <a href="{{ route('donate') }}" class="bg-transparent border-2 border-white text-white font-semibold px-8 py-4 rounded-lg hover:bg-white hover:bg-opacity-10 transition-colors duration-300">
                    Donate Now
                </a>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
    // Scroll animation
    document.addEventListener('DOMContentLoaded', function() {
        const fadeElements = document.querySelectorAll('.fade-in-up');
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, { threshold: 0.1 });
        
        fadeElements.forEach(element => {
            observer.observe(element);
        });
        
        // Add loading animation for stats
        const statCards = document.querySelectorAll('.stat-card');
        statCards.forEach((card, index) => {
            card.style.animationDelay = `${index * 0.1}s`;
        });
    });
</script>
@endpush

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .prose {
            line-height: 1.75;
        }
        .prose p:not(:last-child) {
            margin-bottom: 1.25em;
        }
    </style>
@endpush