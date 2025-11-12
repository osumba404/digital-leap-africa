@extends('layouts.app')

@section('title', 'Digital Leap Africa - Empowering African Youth Through Technology')
@section('meta_description', 'Transform your career with expert-led programming courses, real-world projects, and job opportunities. Join thousands of African youth building successful tech careers.')
@section('meta_keywords', 'African tech education, programming courses, web development, mobile app development, data science, cybersecurity, digital skills, tech jobs Africa, online learning, coding bootcamp')

@section('content')
<style>
/* Hero Section */
.hero-slider {
    position: relative;
    min-height: 100vh;
    width: 100vw;
    margin-left: calc(-50vw + 50%);
    background: linear-gradient(135deg, var(--navy-bg), var(--charcoal));
    overflow: hidden;
}

.hero-slide {
    display: none;
    padding: 2rem 2rem;
    text-align: center;
    position: relative;
    min-height: 100vh;
    background-size: cover !important;
    background-position: center !important;
    background-repeat: no-repeat !important;
}

.hero-slide.active {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    min-height: 100vh;
}

.hero-title {
    font-size: 3rem;
    font-weight: 700;
    margin-bottom: 1rem;
    color: #ffffff;
    text-shadow: 0 4px 8px rgba(0,0,0,0.9), 0 0 20px rgba(0, 212, 255, 0.5);
}

.hero-subtitle {
    font-size: 1.2rem;
    color: #00d4ff;
    margin-bottom: 2rem;
    max-width: 600px;
    text-shadow: 0 3px 6px rgba(0,0,0,0.9), 0 0 15px rgba(0, 212, 255, 0.3);
}

.hero-actions {
    display: flex;
    gap: 1rem;
    justify-content: center;
    flex-wrap: wrap;
}

.btn-primary, .btn-outline, .btn-course {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
    cursor: pointer;
}

.btn-primary {
    background: var(--cyan-accent);
    color: var(--navy-bg);
    border: none;
}

.btn-primary:hover {
    background: var(--purple-accent);
    transform: translateY(-2px);
}

.btn-outline {
    background: transparent;
    color: var(--cyan-accent);
    border: 2px solid var(--cyan-accent);
}

.btn-outline:hover {
    background: var(--cyan-accent);
    color: var(--navy-bg);
}

.slider-nav {
    position: absolute;
    bottom: 2rem;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    gap: 0.5rem;
}

.slider-dot {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    border: 2px solid var(--cyan-accent);
    background: transparent;
    cursor: pointer;
    transition: all 0.3s;
}

.slider-dot.active {
    background: var(--cyan-accent);
}

/* Stats Section */
.stats-section {
    padding: 2.5rem 0;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
    gap: 1.25rem;
}

.stat-card {
    text-align: center;
    padding: 1.5rem;
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 12px;
}

.stat-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

.stat-value {
    font-size: 2rem;
    font-weight: 800;
    color: var(--diamond-white);
}

.stat-label {
    color: var(--cool-gray);
}

/* Container */
.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 1rem;
}

/* Section Styles */
.section {
    padding: 2.5rem 0;
}

.section-header {
    text-align: center;
    margin-bottom: 2rem;
}

.section-header h2 {
    font-size: 2rem;
    font-weight: 700;
    background: linear-gradient(90deg, var(--cyan-accent), var(--purple-accent));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    margin-bottom: 0.5rem;
}

.section-header p {
    color: var(--cool-gray);
    margin-bottom: 1rem;
    font-size: 1.1rem;
}

/* Fade in animation */
.fade-in-up {
    opacity: 0;
    transform: translateY(12px);
    transition: opacity .4s ease, transform .4s ease;
}

.fade-in-up.visible {
    opacity: 1;
    transform: translateY(0);
}

/* Mobile Responsive */
@media (max-width: 768px) {
    .hero-title {
        font-size: 2rem;
    }
    
    .hero-subtitle {
        font-size: 1rem;
    }
    
    .stats-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
    }
    
    .hero-actions {
        flex-direction: column;
        align-items: center;
    }
    
    .section-header h2 {
        font-size: 1.5rem;
    }
    
    .container {
        padding: 0 0.75rem;
    }
    
    .section {
        padding: 1.5rem 0;
    }
}

@media (max-width: 480px) {
    .stats-grid {
        grid-template-columns: 1fr;
        gap: 0.75rem;
    }
    
    .hero-title {
        font-size: 2rem;
        line-height: 1.2;
    }
    
    .hero-subtitle {
        font-size: 1rem;
    }
    
    .hero-slide {
        padding: 1.5rem 1rem;
        background-attachment: scroll !important;
    }
    
    .section-header h2 {
        font-size: 1.25rem;
    }
    
    .container {
        padding: 0 0.5rem;
    }
    
    .testimonial-slide {
        padding: 0 0.5rem !important;
    }
    
    .testimonial-slide > div {
        height: 350px !important;
        padding: 1rem !important;
    }
    
    .testimonial-prev, .testimonial-next {
        width: 35px !important;
        height: 35px !important;
        font-size: 0.9rem !important;
    }
}
</style>

<!-- Hero Slider Section -->
<section class="hero-slider">
    @php
        $heroSlides = $siteSettings['hero_slides'] ?? [];
        $activeSlides = collect($heroSlides)->where('enabled', 1);
    @endphp
    
    @if($activeSlides->count() > 0)
        @foreach($activeSlides as $index => $slide)
            <div class="hero-slide @if($loop->first) active @endif" @if($slide['image']) style="background-image: linear-gradient(rgba(12, 18, 28, 0.7), rgba(12, 18, 28, 0.7)), url('{{ $slide['image'] }}'); background-size: cover; background-position: center;" @endif>
                <h1 class="hero-title">{{ $slide['title'] }}</h1>
                <p class="hero-subtitle">{{ $slide['sub'] }}</p>
                <div class="hero-actions">
                    @if($slide['cta1_label'] && $slide['cta1_route'])
                        <a href="{{ route($slide['cta1_route']) }}" class="btn-primary">{{ $slide['cta1_label'] }}</a>
                    @endif
                    @if($slide['cta2_label'] && $slide['cta2_route'])
                        <a href="{{ route($slide['cta2_route']) }}" class="btn-outline">{{ $slide['cta2_label'] }}</a>
                    @endif
                </div>
            </div>
        @endforeach
        

    @else
        <div class="hero-slide active">
            <h1 class="hero-title">Empowering African Tech Talent</h1>
            <p class="hero-subtitle">Transform your career with expert-led programming courses, real-world projects, and job opportunities across Africa.</p>
            <div class="hero-actions">
                <a href="{{ route('courses.index') }}" class="btn-primary">Start Learning Today</a>
                <a href="{{ route('about') }}" class="btn-outline">Discover Our Mission</a>
            </div>
        </div>
    @endif
</section>

<!-- Statistics Section -->
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

<!-- Blog Posts Section -->
<section class="section">
    <div class="container">
        <div class="section-header">
            <h2>Latest Blog Posts</h2>
            <p>Stay updated with our latest insights and articles</p>
        </div>
        
        @php
            $blogPosts = \App\Models\Article::where('status', 'published')->latest()->take(3)->get();
        @endphp
        
        @if($blogPosts->count() > 0)
            <div style="display:grid;grid-template-columns:repeat(auto-fit, minmax(280px,1fr));gap:1.5rem;">
                @foreach($blogPosts as $post)
                    @php
                        $pickBlogImage = function($post) {
                            return $post->featured_image_url
                                ?? $post->image_url
                                ?? $post->cover_image
                                ?? $post->thumbnail
                                ?? $post->featured_image
                                ?? null;
                        };
                        $blogImage = $pickBlogImage($post);
                        $category = $post->category_name ?? $post->category ?? null;
                    @endphp
                    <div onclick="window.location.href='{{ route('blog.show', $post) }}'" style="background-color:#112240;border-radius:12px;overflow:hidden;box-shadow:0 10px 30px rgba(2,12,27,0.7);transition:all .4s cubic-bezier(0.175,0.885,0.32,1.275);height:100%;display:flex;flex-direction:column;padding:0;cursor:pointer;">
                        <div style="position:relative;overflow:hidden;margin:0;padding:0;line-height:0;border-top-left-radius:12px;border-top-right-radius:12px;">
                            @if($blogImage)
                                <img src="{{ $blogImage }}" alt="{{ $post->title }}" style="width:100%;height:200px;object-fit:cover;display:block;margin:0;transition:transform .5s ease;">
                            @else
                                <img src="https://via.placeholder.com/1000x600.png?text=Article" alt="{{ $post->title }}" style="width:100%;height:200px;object-fit:cover;display:block;margin:0;transition:transform .5s ease;">
                            @endif
                            @if($category)
                                <span style="position:absolute;top:1rem;right:1rem;padding:.5rem 1rem;border-radius:25px;font-weight:800;font-size:.8rem;z-index:10;box-shadow:0 4px 15px rgba(0,0,0,0.4);backdrop-filter:blur(10px);border:2px solid rgba(255,255,255,0.2);text-transform:uppercase;letter-spacing:0.5px;background:linear-gradient(135deg,#10b981,#059669);color:#fff;">{{ $category }}</span>
                            @endif
                            <h3 style="position:absolute;bottom:0;left:0;right:0;background:linear-gradient(transparent, rgba(10,25,47,0.95));padding:1.25rem 1.25rem .6rem;margin:0;font-size:1.1rem;font-weight:700;line-height:1.35;text-shadow:0 2px 4px rgba(0,0,0,0.5);color:#e6f1ff;">{{ $post->title }}</h3>
                        </div>
                        <div style="padding:1.25rem;flex-grow:1;display:flex;flex-direction:column;">
                            <div style="display:flex;justify-content:space-between;color:#8892b0;font-size:.85rem;margin-bottom:.85rem;border-bottom:1px solid rgba(136,146,176,0.2);padding-bottom:.6rem;">
                                <span><i class="fas fa-calendar"></i> {{ $post->created_at->format('M j, Y') }}</span>
                                <span><i class="fas fa-eye"></i> Article</span>
                            </div>
                            <p style="color:#8892b0;line-height:1.6;margin-bottom:1rem;flex-grow:1;display:-webkit-box;-webkit-line-clamp:3;-webkit-box-orient:vertical;overflow:hidden;">{{ Str::limit(strip_tags($post->content), 140) }}</p>
                            <span style="display:inline-flex;align-items:center;justify-content:center;background-color:transparent;color:#3b82f6;padding:.6rem 1.2rem;border:1px solid #3b82f6;border-radius:6px;text-decoration:none;font-size:.9rem;font-weight:600;transition:all .3s ease;cursor:pointer;gap:.5rem;">
                                Read Article <i class="fas fa-arrow-right"></i>
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <div style="text-align: center; margin-top: 2rem;">
                <a href="{{ route('blog.index') }}" class="btn-outline">Read More Blogs</a>
            </div>
        @endif
    </div>
</section>

<!-- Featured Courses Section -->
<section class="section">
    <div class="container">
        <div class="section-header">
            <h2>Featured Courses</h2>
            <p>Master in-demand skills with our expert-led courses</p>
        </div>
        
        @php
            $featuredCourses = \App\Models\Course::where('active', true)->latest()->take(4)->get();
        @endphp
        
        @if($featuredCourses->count() > 0)
            <div style="display:grid;grid-template-columns:repeat(auto-fit, minmax(280px,1fr));gap:1.5rem;">
                @foreach($featuredCourses as $course)
                    @php
                        $pickCourseImage = function($course) {
                            return $course->image_url
                                ?? $course->thumbnail
                                ?? $course->cover_image
                                ?? $course->banner_image
                                ?? null;
                        };
                        $courseImage = $pickCourseImage($course);
                        $lessonsCount = 0;
                        if (method_exists($course, 'lessons')) {
                            $lessonsCount = $course->relationLoaded('lessons') ? $course->lessons->count() : $course->lessons()->count();
                        } else {
                            $lessonsCount = $course->lessons_count ?? $course->lectures_count ?? 0;
                        }
                        $isEnrolled = false;
                        if (Auth::check()) {
                            $isEnrolled = Auth::user()->courses()->where('course_id', $course->id)->exists();
                        }
                    @endphp
                    <div style="background-color:#112240;border-radius:12px;overflow:hidden;box-shadow:0 10px 30px rgba(2,12,27,0.7);transition:all .4s cubic-bezier(0.175,0.885,0.32,1.275);height:100%;display:flex;flex-direction:column;padding:0;">
                        <div style="position:relative;overflow:hidden;margin:0;padding:0;line-height:0;border-top-left-radius:12px;border-top-right-radius:12px;">
                            @if($courseImage)
                                <img src="{{ $courseImage }}" alt="{{ $course->title }}" style="width:100%;height:200px;object-fit:cover;display:block;margin:0;transition:transform .5s ease;">
                            @else
                                <img src="https://via.placeholder.com/1000x600.png?text=Course" alt="{{ $course->title }}" style="width:100%;height:200px;object-fit:cover;display:block;margin:0;transition:transform .5s ease;">
                            @endif
                            @if($course->is_free)
                                <span style="position:absolute;top:1rem;right:1rem;padding:.5rem 1rem;border-radius:25px;font-weight:800;font-size:.8rem;z-index:10;box-shadow:0 4px 15px rgba(0,0,0,0.4);backdrop-filter:blur(10px);border:2px solid rgba(255,255,255,0.2);text-transform:uppercase;letter-spacing:0.5px;background:linear-gradient(135deg,#10b981,#059669);color:#fff;">FREE</span>
                            @else
                                <span style="position:absolute;top:1rem;right:1rem;padding:.5rem 1rem;border-radius:25px;font-weight:800;font-size:.8rem;z-index:10;box-shadow:0 4px 15px rgba(0,0,0,0.4);backdrop-filter:blur(10px);border:2px solid rgba(255,255,255,0.2);text-transform:uppercase;letter-spacing:0.5px;background:linear-gradient(135deg,#3b82f6,#1d4ed8);color:#fff;">KES {{ number_format($course->price, 0) }}</span>
                            @endif
                            <h3 style="position:absolute;bottom:0;left:0;right:0;background:linear-gradient(transparent, rgba(10,25,47,0.95));padding:1.25rem 1.25rem .6rem;margin:0;font-size:1.1rem;font-weight:700;line-height:1.35;text-shadow:0 2px 4px rgba(0,0,0,0.5);color:#e6f1ff;">{{ $course->title }}</h3>
                        </div>
                        <div style="padding:1.25rem;flex-grow:1;display:flex;flex-direction:column;">
                            <div style="display:flex;justify-content:space-between;color:#8892b0;font-size:.85rem;margin-bottom:.85rem;border-bottom:1px solid rgba(136,146,176,0.2);padding-bottom:.6rem;">
                                <span><i class="fas fa-play-circle"></i> {{ $lessonsCount }} lessons</span>
                                @if($course->course_type === 'cohort_based')
                                    <span><i class="fas fa-users"></i> Cohort-Based</span>
                                @else
                                    <span><i class="fas fa-user"></i> Self-Paced</span>
                                @endif
                            </div>
                            @if($course->course_type === 'cohort_based' && ($course->duration_weeks || $course->start_date))
                                <div style="margin-bottom: 1rem; padding: 0.5rem; background: rgba(147, 51, 234, 0.1); border-radius: 6px; border-left: 3px solid #9333ea;">
                                    @if($course->duration_weeks)
                                        <div style="color: #9333ea; font-size: 0.85rem; font-weight: 600;">
                                            <i class="fas fa-clock"></i> {{ $course->duration_weeks }} weeks duration
                                        </div>
                                    @endif
                                    @if($course->start_date && $course->end_date)
                                        <div style="color: var(--cool-gray); font-size: 0.8rem; margin-top: 0.25rem;">
                                            {{ $course->start_date->format('M j') }} - {{ $course->end_date->format('M j, Y') }}
                                        </div>
                                    @elseif($course->start_date)
                                        <div style="color: var(--cool-gray); font-size: 0.8rem; margin-top: 0.25rem;">
                                            Starts {{ $course->start_date->format('M j, Y') }}
                                        </div>
                                    @endif
                                </div>
                            @endif
                            @if($course->has_certification)
                                <div style="margin-bottom: 1rem; padding: 0.5rem; background: rgba(251, 191, 36, 0.1); border-radius: 6px; border-left: 3px solid #f59e0b;">
                                    <div style="color: #f59e0b; font-size: 0.85rem; font-weight: 600;">
                                        <i class="fas fa-certificate"></i> Certificate of Completion
                                    </div>
                                    <div style="color: var(--cool-gray); font-size: 0.8rem; margin-top: 0.25rem;">
                                        Earn a professional certificate upon course completion
                                    </div>
                                </div>
                            @endif
                            <p style="color:#8892b0;line-height:1.6;margin-bottom:1rem;flex-grow:1;display:-webkit-box;-webkit-line-clamp:3;-webkit-box-orient:vertical;overflow:hidden;">{{ Str::limit(strip_tags($course->short_description ?? $course->description ?? ''), 140) }}</p>
                            @if($isEnrolled)
                                <a href="{{ route('courses.show', $course) }}" style="display:inline-flex;align-items:center;justify-content:center;background-color:transparent;color:#3b82f6;padding:.6rem 1.2rem;border:1px solid #3b82f6;border-radius:6px;text-decoration:none;font-size:.9rem;font-weight:600;transition:all .3s ease;cursor:pointer;gap:.5rem;">
                                    Continue Learning <i class="fas fa-arrow-right"></i>
                                </a>
                            @else
                                <a href="{{ route('courses.show', $course) }}" style="display:inline-flex;align-items:center;justify-content:center;background-color:transparent;color:#3b82f6;padding:.6rem 1.2rem;border:1px solid #3b82f6;border-radius:6px;text-decoration:none;font-size:.9rem;font-weight:600;transition:all .3s ease;cursor:pointer;gap:.5rem;">
                                    View Course <i class="fas fa-arrow-right"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
            
            <div style="text-align: center; margin-top: 2rem;">
                <a href="{{ route('courses.index') }}" class="btn-outline">View All Courses</a>
            </div>
        @endif
    </div>
</section>

<!-- Testimonials Section -->
<section class="section" style="background: rgba(255, 255, 255, 0.02);">
    <div class="container">
        <div class="section-header">
            <h2>Success Stories</h2>
            <p>Hear from our graduates who transformed their careers</p>
        </div>
        
        @php
            $testimonials = \App\Models\Testimonial::with('user')->where('is_active', true)->latest()->take(3)->get();
        @endphp
        
        @if($testimonials->count() > 0)
            <div style="position: relative; overflow: hidden;">
                <div class="testimonials-slider" style="display: flex; transition: transform 0.5s ease;">
                    @foreach($testimonials as $testimonial)
                        <div class="testimonial-slide" style="min-width: 100%; padding: 0 1rem; display: flex; align-items: stretch; justify-content: center;">
                            <div style="background: rgba(255, 255, 255, 0.05);border-radius: 12px;padding: 1.5rem;border: 1px solid rgba(255, 255, 255, 0.1); width: 100%; max-width: 600px; height: 400px; display: flex; flex-direction: column; justify-content: space-between; overflow: hidden;">
                                <div style="flex-grow: 1; display: flex; flex-direction: column;">
                                    <div style="color: var(--cyan-accent);font-size: 1.8rem;margin-bottom: 1rem; text-align: center;">
                                        <i class="fas fa-quote-left"></i>
                                    </div>
                                    <div style="flex-grow: 1; overflow-y: auto; margin-bottom: 1rem;">
                                        <p style="color: var(--cool-gray);font-style: italic; text-align: center; font-size: 0.95rem; line-height: 1.5; margin: 0; word-wrap: break-word; overflow-wrap: break-word;">"{{ $testimonial->quote }}"</p>
                                    </div>
                                </div>
                                <div style="display: flex;align-items: center;gap: 1rem; justify-content: center; flex-shrink: 0;">
                                    <div style="width: 45px;height: 45px;border-radius: 50%;overflow: hidden; flex-shrink: 0;">
                                        @if($testimonial->user && $testimonial->user->profile_photo)
                                            <img src="{{ route('me.photo') }}?user_id={{ $testimonial->user_id }}" alt="{{ $testimonial->name }}" style="width: 100%;height: 100%;object-fit: cover;">
                                        @elseif($testimonial->avatar_path)
                                            <img src="{{ Storage::url($testimonial->avatar_path) }}" alt="{{ $testimonial->name }}" style="width: 100%;height: 100%;object-fit: cover;">
                                        @else
                                            <div style="width: 100%;height: 100%;background: linear-gradient(135deg, var(--cyan-accent), var(--purple-accent));display: flex;align-items: center;justify-content: center;color: white;font-weight: 700; font-size: 0.9rem;">
                                                {{ strtoupper(substr($testimonial->name ?? 'U', 0, 1)) }}
                                            </div>
                                        @endif
                                    </div>
                                    <div style="text-align: center;">
                                        <h4 style="color: var(--diamond-white);margin: 0; font-size: 0.95rem; word-wrap: break-word;">{{ $testimonial->name ?? 'Anonymous' }}</h4>
                                        <p style="color: var(--cool-gray);margin: 0;font-size: 0.8rem;">{{ $testimonial->created_at?->format('M d, Y') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                @if($testimonials->count() > 1)
                    <button class="testimonial-prev" onclick="moveTestimonialSlide(-1)" style="position: absolute; left: 0.5rem; top: 50%; transform: translateY(-50%); background: rgba(0, 201, 255, 0.2); border: 2px solid var(--cyan-accent); color: var(--cyan-accent); width: 40px; height: 40px; border-radius: 50%; cursor: pointer; font-size: 1rem; transition: all 0.3s ease; z-index: 10;" onmouseover="this.style.background='var(--cyan-accent)'; this.style.color='var(--navy-bg)';" onmouseout="this.style.background='rgba(0, 201, 255, 0.2)'; this.style.color='var(--cyan-accent)';">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button class="testimonial-next" onclick="moveTestimonialSlide(1)" style="position: absolute; right: 0.5rem; top: 50%; transform: translateY(-50%); background: rgba(0, 201, 255, 0.2); border: 2px solid var(--cyan-accent); color: var(--cyan-accent); width: 40px; height: 40px; border-radius: 50%; cursor: pointer; font-size: 1rem; transition: all 0.3s ease; z-index: 10;" onmouseover="this.style.background='var(--cyan-accent)'; this.style.color='var(--navy-bg)';" onmouseout="this.style.background='rgba(0, 201, 255, 0.2)'; this.style.color='var(--cyan-accent)';">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                    
                    <div style="display: flex; justify-content: center; gap: 0.5rem; margin-top: 2rem;">
                        @foreach($testimonials as $index => $testimonial)
                            <button class="testimonial-dot" onclick="goToTestimonialSlide({{ $index }})" style="width: 12px; height: 12px; border-radius: 50%; border: 2px solid var(--cyan-accent); background: {{ $loop->first ? 'var(--cyan-accent)' : 'transparent' }}; cursor: pointer; transition: all 0.3s;"></button>
                        @endforeach
                    </div>
                @endif
            </div>
            
            <div style="text-align: center; margin-top: 2rem;">
                <a href="{{ route('testimonials.index') }}" class="btn-outline">View All Testimonials</a>
            </div>
        @endif
    </div>
</section>

<!-- Partners Section -->
<section class="section">
    <div class="container">
        <div class="section-header">
            <h2>Our Partners</h2>
            <p>We collaborate with leading organizations</p>
        </div>
        
        @php
            $partners = \App\Models\Partner::where('is_active', true)->take(8)->get();
        @endphp
        
        @if($partners->count() > 0)
            <div style="display:grid;grid-template-columns:repeat(auto-fit, minmax(160px,1fr));gap:1.25rem;align-items:center;">
                @foreach($partners as $partner)
                    <a href="{{ $partner->website_url ?? '#' }}" target="_blank" style="background: rgba(255,255,255,0.03);border:1px solid rgba(255,255,255,0.1);border-radius: 8px;padding: 1.25rem;display:flex;align-items:center;justify-content:center;transition: transform .3s, box-shadow .3s, filter .3s, opacity .3s;filter: grayscale(100%);opacity: .8;text-decoration: none;" onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 10px 30px rgba(0,0,0,0.3)'; this.style.filter='grayscale(0%)'; this.style.opacity='1';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'; this.style.filter='grayscale(100%)'; this.style.opacity='.8';">
                        @if($partner->logo_path)
                            <img src="{{ Storage::url($partner->logo_path) }}" alt="{{ $partner->name }}" style="max-height: 42px;width:auto;object-fit:contain;">
                        @else
                            <span style="color: var(--cool-gray);">{{ $partner->name }}</span>
                        @endif
                    </a>
                @endforeach
            </div>
            
            <div style="text-align: center; margin-top: 2rem;">
                <a href="{{ route('partners.apply') }}" class="btn-outline">Become a Partner</a>
            </div>
        @endif
    </div>
</section>

<!-- Upcoming Events Section -->
<section class="section" style="background: rgba(255, 255, 255, 0.02);">
    <div class="container">
        <div class="section-header">
            <h2>Upcoming Events</h2>
            <p>Join our community events and workshops</p>
        </div>
        
        @php
            $upcomingEvents = \App\Models\Event::where('date', '>', now())->orderBy('date', 'asc')->take(3)->get();
        @endphp
        
        @if($upcomingEvents->count() > 0)
            <div style="display:grid;grid-template-columns:repeat(auto-fill, minmax(320px,1fr));gap:2rem;">
                @foreach($upcomingEvents as $event)
                    @php
                        $pickEventImage = function($event) {
                            return $event->image_url
                                ?? $event->banner_image
                                ?? $event->thumbnail
                                ?? $event->cover_image
                                ?? null;
                        };
                        $eventImage = $pickEventImage($event);
                        $title = $event->title ?? 'Untitled Event';
                        $showUrl = route('events.show', $event->slug ?? $event->id);
                        $start = $event->date;
                        $end = $event->ends_at;
                        $timeText = '';
                        if ($start) {
                            $timeText = $start->format('g:ia');
                            if ($end) { $timeText .= ' - ' . $end->format('g:ia'); }
                        }
                        $day = $start ? $start->format('d') : '';
                        $month = $start ? strtoupper($start->format('M')) : '';
                        $category = $event->topic ?? null;
                        $excerpt = Str::limit(strip_tags($event->description ?? ''), 140);
                        $ctaUrl = !empty($event->registration_url) ? $event->registration_url : $showUrl;
                        $ctaText = !empty($event->registration_url) ? 'Join Event' : 'View Event';
                    @endphp
                    <div style="background-color:#112240;border-radius:12px;overflow:hidden;box-shadow:0 10px 30px rgba(2,12,27,0.7);transition:all .4s cubic-bezier(0.175,0.885,0.32,1.275);position:relative;border:0;padding:0;">
                        @if($eventImage)
                            <img src="{{ $eventImage }}" alt="{{ $title }}" style="width:100%;height:180px;object-fit:cover;display:block;margin:0;border-radius:0;transition:transform .5s ease;">
                        @else
                            <img src="https://via.placeholder.com/1200x700.png?text=Event" alt="{{ $title }}" style="width:100%;height:180px;object-fit:cover;display:block;margin:0;border-radius:0;transition:transform .5s ease;">
                        @endif
                        
                        @if($category)
                            <span style="position:relative;display:inline-flex;align-items:center;gap:.4rem;background:rgba(59,130,246,0.85);color:#fff;padding:.35rem .65rem;border-radius:999px;font-size:.7rem;font-weight:800;text-transform:uppercase;letter-spacing:.04em;backdrop-filter:saturate(140%) blur(6px);box-shadow:0 6px 16px rgba(59,130,246,.35);margin-top:-1.6rem;margin-left:.75rem;z-index:2;">{{ $category }}</span>
                        @endif
                        
                        @if($start)
                            <div style="position:absolute;top:0.5rem;right:0.5rem;background:#3b82f6;color:#ffffff;width:64px;height:75px;display:flex;flex-direction:column;align-items:center;justify-content:center;text-align:center;font-weight:800;line-height:1.1;z-index:2;clip-path:polygon(50% 0%,100% 25%,100% 75%,50% 100%,0% 75%,0% 25%);box-shadow:0 4px 12px rgba(0,0,0,0.3);">
                                <span style="font-size:1.35rem;display:block;margin-bottom:-2px;color:#ffffff;">{{ $day }}</span>
                                <span style="font-size:.75rem;display:block;font-weight:800;letter-spacing:.5px;color:#ffffff;">{{ $month }}</span>
                            </div>
                        @endif

                        <div style="padding:1.25rem;">
                            <h3 style="font-size:1.15rem;margin-bottom:.5rem;color:#e6f1ff;line-height:1.35;">{{ $title }}</h3>
                            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:.65rem;">
                                @if($timeText)
                                    <span style="display:inline-flex;align-items:center;gap:.45rem;color:#3b82f6;font-size:.9rem;"><i class="far fa-clock"></i> {{ $timeText }}</span>
                                @endif
                                @if(!empty($event->location))
                                    <span style="display:inline-flex;align-items:center;gap:.45rem;color:#8892b0;font-size:.9rem;"><i class="fas fa-map-marker-alt"></i> {{ $event->location }}</span>
                                @endif
                            </div>
                            @if(!empty($excerpt))
                                <p style="color:#8892b0;line-height:1.55;margin-bottom:1rem;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;">{{ $excerpt }}</p>
                            @endif
                            <a href="{{ $ctaUrl }}" style="display:inline-flex;align-items:center;justify-content:center;background-color:transparent;color:#3b82f6;padding:.5rem 1rem;border:1px solid #3b82f6;border-radius:6px;text-decoration:none;font-size:.9rem;font-weight:500;transition:all .3s ease;cursor:pointer;gap:.5rem;">{{ $ctaText }} <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <div style="text-align: center; margin-top: 2rem;">
                <a href="{{ route('events.index') }}" class="btn-outline">View All Events</a>
            </div>
        @endif
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const slides = document.querySelectorAll('.hero-slide');
    const dots = document.querySelectorAll('.slider-dot');
    let currentSlide = 0;
    
    if (slides.length > 1) {
        function showSlide(index) {
            slides.forEach((slide, i) => {
                slide.classList.toggle('active', i === index);
            });
            dots.forEach((dot, i) => {
                dot.classList.toggle('active', i === index);
            });
        }
        
        function nextSlide() {
            currentSlide = (currentSlide + 1) % slides.length;
            showSlide(currentSlide);
        }
        
        setInterval(nextSlide, 5000);
        
        dots.forEach((dot, index) => {
            dot.addEventListener('click', () => {
                currentSlide = index;
                showSlide(currentSlide);
            });
        });
    }
});

// Testimonials slider
let currentTestimonialSlide = 0;
const testimonialSlides = document.querySelectorAll('.testimonial-slide');
const testimonialDots = document.querySelectorAll('.testimonial-dot');

function updateTestimonialSlider() {
    const slider = document.querySelector('.testimonials-slider');
    if (slider) {
        slider.style.transform = `translateX(-${currentTestimonialSlide * 100}%)`;
        
        testimonialDots.forEach((dot, index) => {
            dot.style.background = index === currentTestimonialSlide ? 'var(--cyan-accent)' : 'transparent';
        });
    }
}

function moveTestimonialSlide(direction) {
    currentTestimonialSlide += direction;
    if (currentTestimonialSlide < 0) currentTestimonialSlide = testimonialSlides.length - 1;
    if (currentTestimonialSlide >= testimonialSlides.length) currentTestimonialSlide = 0;
    updateTestimonialSlider();
}

function goToTestimonialSlide(index) {
    currentTestimonialSlide = index;
    updateTestimonialSlider();
}

// Auto-slide testimonials
if (testimonialSlides.length > 1) {
    setInterval(() => {
        moveTestimonialSlide(1);
    }, 6000);
}

// Fade in animation for stats
const fadeElements = document.querySelectorAll('.fade-in-up');
const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('visible');
        }
    });
}, { threshold: 0.1 });
fadeElements.forEach(el => observer.observe(el));
</script>
@endsection