@extends('layouts.app')

@section('title', 'Home')

@section('content')
<!-- Hero Section -->
@php
    $heroSlides = $siteSettings['hero_slides'] ?? [];
    $hasSlides = !empty($heroSlides) && is_array($heroSlides);
    $enabledSlides = [];
    if (is_array($heroSlides)) {
        foreach ($heroSlides as $slide) {
            if (!empty($slide['enabled'])) {
                $enabledSlides[] = $slide;
            }
        }
    }
    $hasSlides = !empty($enabledSlides);
@endphp

@if($hasSlides)
<section class="hero-carousel">
    <div class="hero-container">
        @foreach($heroSlides as $index => $slide)
            @if(!empty($slide['enabled']))
                <div class="hero-slide {{ $index === 0 ? 'active' : '' }}">
                    @if(!empty($slide['image']))
                        <div class="hero-bg" style="background-image: url('{{ $slide['image'] }}')"></div>
                    @else
                        <div class="hero-bg hero-gradient"></div>
                    @endif
                    <div class="hero-overlay"></div>
                    <div class="hero-content">
                        <div class="container">
                            @if(!empty($slide['mini']))
                                <span class="hero-badge">{{ $slide['mini'] }}</span>
                            @endif
                            @if(!empty($slide['title']))
                                <h1 class="hero-title">{{ $slide['title'] }}</h1>
                            @endif
                            @if(!empty($slide['sub']))
                                <p class="hero-subtitle">{{ $slide['sub'] }}</p>
                            @endif
                            <div class="hero-buttons">
                                @if(!empty($slide['cta1_label']) && !empty($slide['cta1_route']))
                                    <a href="{{ route($slide['cta1_route']) }}" class="btn btn-primary">
                                        {{ $slide['cta1_label'] }}
                                    </a>
                                @endif
                                @if(!empty($slide['cta2_label']) && !empty($slide['cta2_route']))
                                    <a href="{{ route($slide['cta2_route']) }}" class="btn btn-secondary">
                                        {{ $slide['cta2_label'] }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
        
        @if(count(array_filter($heroSlides, fn($slide) => !empty($slide['enabled']))) > 1)
            <div class="hero-dots">
                @foreach($heroSlides as $index => $slide)
                    @if(!empty($slide['enabled']))
                        <button class="dot {{ $index === 0 ? 'active' : '' }}" data-slide="{{ $index }}"></button>
                    @endif
                @endforeach
            </div>
        @endif
    </div>
</section>
@else
<!-- Fallback Hero -->
<section class="hero-carousel">
    <div class="hero-container">
        <div class="hero-slide active">
            <div class="hero-bg hero-gradient"></div>
            <div class="hero-overlay"></div>
            <div class="hero-content">
                <div class="container">
                    <span class="hero-badge">Empowering African Youth</span>
                    <h1 class="hero-title">Welcome to Digital Leap Africa</h1>
                    <p class="hero-subtitle">Empowering learners across Africa with courses, projects, jobs, events, and a vibrant community.</p>
                    <div class="hero-buttons">
                        <a href="{{ route('courses.index') }}" class="btn btn-primary">Browse Courses</a>
                        <a href="{{ route('about') }}" class="btn btn-secondary">About Us</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

<!-- Stats Section -->
<section class="stats-section">
    <div class="container">
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-number">{{ $stats['courses'] }}</div>
                <div class="stat-label">Courses</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $stats['articles'] }}</div>
                <div class="stat-label">Articles</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $stats['partners'] }}</div>
                <div class="stat-label">Partners</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $stats['members'] }}</div>
                <div class="stat-label">Members</div>
            </div>
        </div>
    </div>
</section>

<!-- Articles Section -->
<section class="content-section">
    <div class="container">
        <div class="section-header">
            <span class="section-badge">Blog</span>
            <h2 class="section-title">Latest Articles</h2>
            <p class="section-subtitle">Stay updated with the latest insights, tutorials, and industry trends</p>
        </div>
        
        @if($latestArticles->count())
            <div class="articles-grid">
                @foreach($latestArticles as $article)
                    <div class="article-card">
                        <div class="article-image">
                            @if($article->featured_image_url ?? $article->image_url ?? null)
                                <img src="{{ $article->featured_image_url ?? $article->image_url }}" alt="{{ $article->title }}">
                            @else
                                <div class="article-placeholder">
                                    <i class="fas fa-newspaper"></i>
                                </div>
                            @endif
                        </div>
                        <div class="article-content">
                            <h3 class="article-title">{{ $article->title }}</h3>
                            <p class="article-excerpt">{{ Str::limit(strip_tags($article->content ?? ''), 120) }}</p>
                            <a href="{{ route('blog.show', $article) }}" class="article-link">Read More</a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <div class="empty-icon">
                    <i class="fas fa-newspaper"></i>
                </div>
                <h3>No Articles Yet</h3>
                <p>Stay tuned for exciting content coming soon!</p>
            </div>
        @endif
        
        <div class="section-footer">
            <a href="{{ route('blog.index') }}" class="btn btn-outline">View All Articles</a>
        </div>
    </div>
</section>

<!-- Courses Section -->
<section class="content-section alt">
    <div class="container">
        <div class="section-header">
            <span class="section-badge">Learning</span>
            <h2 class="section-title">Available Courses</h2>
            <p class="section-subtitle">Master new skills with our expert-led courses designed for African learners</p>
        </div>
        
        @if($latestCourses->count())
            <div class="courses-grid">
                @foreach($latestCourses as $course)
                    <div class="course-card">
                        <div class="course-image">
                            @if($course->image_url ?? null)
                                <img src="{{ $course->image_url }}" alt="{{ $course->title }}">
                            @else
                                <div class="course-placeholder">
                                    <i class="fas fa-graduation-cap"></i>
                                </div>
                            @endif
                            <div class="course-price {{ $course->is_free ? 'free' : 'premium' }}">
                                {{ $course->is_free ? 'Free' : 'KES ' . number_format($course->price ?? 0) }}
                            </div>
                        </div>
                        <div class="course-content">
                            <h3 class="course-title">{{ $course->title }}</h3>
                            <div class="course-meta">
                                <span>{{ $course->lessons_count ?? 0 }} lessons</span>
                                <span>{{ $course->instructor ?? 'Instructor' }}</span>
                            </div>
                            <p class="course-description">{{ Str::limit(strip_tags($course->description ?? ''), 100) }}</p>
                            <a href="{{ route('courses.show', $course) }}" class="btn btn-primary btn-sm">View Course</a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
        
        <div class="section-footer">
            <a href="{{ route('courses.index') }}" class="btn btn-outline">View All Courses</a>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
@if($testimonials->count())
<section class="testimonials-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">What People Say About Us</h2>
            <p class="section-subtitle">Hear from our community members</p>
        </div>
        
        <div class="testimonials-slider">
            @foreach($testimonials as $testimonial)
                <div class="testimonial-card">
                    <div class="testimonial-content">
                        <p>"{{ Str::limit($testimonial->quote, 150) }}"</p>
                    </div>
                    <div class="testimonial-author">
                        <div class="author-avatar">
                            @if($testimonial->user && $testimonial->user->profile_photo)
                                <img src="{{ route('me.photo') }}?user_id={{ $testimonial->user_id }}" alt="{{ $testimonial->name }}">
                            @else
                                <div class="avatar-placeholder">{{ strtoupper(substr($testimonial->name ?? 'U', 0, 1)) }}</div>
                            @endif
                        </div>
                        <div class="author-info">
                            <div class="author-name">{{ $testimonial->name }}</div>
                            <div class="author-date">{{ $testimonial->created_at?->format('M d, Y') }}</div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <div class="section-footer">
            <a href="{{ route('testimonials.index') }}" class="btn btn-outline">View All Testimonials</a>
        </div>
    </div>
</section>
@endif

<style>
/* Reset and Base */
* { box-sizing: border-box; }

/* Hero Section */
.hero-carousel {
    position: relative;
    height: 100vh;
    min-height: 600px;
    overflow: hidden;
}

.hero-container {
    position: relative;
    width: 100%;
    height: 100%;
}

.hero-slide {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    transition: opacity 0.8s ease;
}

.hero-slide.active {
    opacity: 1;
}

.hero-bg {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-size: cover;
    background-position: center;
}

.hero-gradient {
    background: linear-gradient(135deg, #0C121C 0%, #1E293B 50%, #0F172A 100%);
}

.hero-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.4);
}

.hero-content {
    position: relative;
    z-index: 10;
    height: 100%;
    display: flex;
    align-items: center;
    text-align: center;
    color: white;
}

.hero-badge {
    display: inline-block;
    background: rgba(59, 130, 246, 0.2);
    border: 1px solid rgba(59, 130, 246, 0.4);
    color: #00d4ff;
    padding: 0.5rem 1rem;
    border-radius: 25px;
    font-size: 0.9rem;
    font-weight: 600;
    margin-bottom: 1rem;
}

.hero-title {
    font-size: clamp(2rem, 5vw, 4rem);
    font-weight: 800;
    line-height: 1.2;
    margin-bottom: 1rem;
    background: linear-gradient(135deg, #fff, #00d4ff);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.hero-subtitle {
    font-size: clamp(1rem, 2.5vw, 1.25rem);
    line-height: 1.6;
    margin-bottom: 2rem;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
    opacity: 0.9;
}

.hero-buttons {
    display: flex;
    gap: 1rem;
    justify-content: center;
    flex-wrap: wrap;
}

.hero-dots {
    position: absolute;
    bottom: 2rem;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    gap: 0.5rem;
    z-index: 20;
}

.dot {
    width: 10px;
    height: 10px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.5);
    border: none;
    cursor: pointer;
    transition: all 0.3s ease;
}

.dot.active {
    background: #00d4ff;
    transform: scale(1.2);
}

/* Buttons */
.btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 0.875rem 2rem;
    border-radius: 50px;
    font-weight: 600;
    font-size: 1rem;
    text-decoration: none;
    transition: all 0.3s ease;
    border: 2px solid transparent;
    min-width: 150px;
}

.btn-primary {
    background: linear-gradient(135deg, #00d4ff, #3b82f6);
    color: white;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0, 212, 255, 0.3);
}

.btn-secondary {
    background: transparent;
    color: white;
    border-color: rgba(255, 255, 255, 0.3);
}

.btn-secondary:hover {
    background: rgba(255, 255, 255, 0.1);
    border-color: rgba(255, 255, 255, 0.5);
}

.btn-outline {
    background: transparent;
    color: var(--primary-blue, #3b82f6);
    border-color: var(--primary-blue, #3b82f6);
}

.btn-outline:hover {
    background: var(--primary-blue, #3b82f6);
    color: white;
}

.btn-sm {
    padding: 0.5rem 1rem;
    font-size: 0.9rem;
    min-width: 120px;
}

/* Container */
.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 1rem;
}

/* Stats Section */
.stats-section {
    padding: 4rem 0;
    background: rgba(255, 255, 255, 0.02);
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 2rem;
}

.stat-card {
    text-align: center;
    padding: 2rem;
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 16px;
    transition: transform 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-5px);
}

.stat-number {
    font-size: 3rem;
    font-weight: 800;
    color: var(--diamond-white, #fff);
    margin-bottom: 0.5rem;
}

.stat-label {
    font-size: 1.1rem;
    color: var(--cool-gray, #94a3b8);
    font-weight: 500;
}

/* Content Sections */
.content-section {
    padding: 6rem 0;
}

.content-section.alt {
    background: rgba(255, 255, 255, 0.02);
}

.section-header {
    text-align: center;
    margin-bottom: 4rem;
}

.section-badge {
    display: inline-block;
    background: rgba(59, 130, 246, 0.1);
    border: 1px solid rgba(59, 130, 246, 0.2);
    color: var(--cyan-accent, #00d4ff);
    padding: 0.5rem 1rem;
    border-radius: 25px;
    font-size: 0.9rem;
    font-weight: 600;
    margin-bottom: 1rem;
}

.section-title {
    font-size: clamp(2rem, 4vw, 3rem);
    font-weight: 800;
    color: var(--diamond-white, #fff);
    margin-bottom: 1rem;
}

.section-subtitle {
    font-size: 1.1rem;
    color: var(--cool-gray, #94a3b8);
    max-width: 600px;
    margin: 0 auto;
}

.section-footer {
    text-align: center;
    margin-top: 3rem;
}

/* Articles Grid */
.articles-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
    margin-bottom: 3rem;
}

.article-card {
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 16px;
    overflow: hidden;
    transition: transform 0.3s ease;
}

.article-card:hover {
    transform: translateY(-5px);
}

.article-image {
    height: 200px;
    overflow: hidden;
}

.article-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.article-placeholder {
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, #3b82f6, #00d4ff);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 3rem;
    color: white;
}

.article-content {
    padding: 1.5rem;
}

.article-title {
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--diamond-white, #fff);
    margin-bottom: 1rem;
}

.article-excerpt {
    color: var(--cool-gray, #94a3b8);
    line-height: 1.6;
    margin-bottom: 1rem;
}

.article-link {
    color: var(--cyan-accent, #00d4ff);
    font-weight: 600;
    text-decoration: none;
}

.article-link:hover {
    text-decoration: underline;
}

/* Courses Grid */
.courses-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
    gap: 2rem;
    margin-bottom: 3rem;
}

.course-card {
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 16px;
    overflow: hidden;
    transition: transform 0.3s ease;
}

.course-card:hover {
    transform: translateY(-5px);
}

.course-image {
    position: relative;
    height: 200px;
    overflow: hidden;
}

.course-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.course-placeholder {
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, #10b981, #3b82f6);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 3rem;
    color: white;
}

.course-price {
    position: absolute;
    top: 1rem;
    right: 1rem;
    padding: 0.5rem 1rem;
    border-radius: 25px;
    font-size: 0.9rem;
    font-weight: 600;
}

.course-price.free {
    background: rgba(16, 185, 129, 0.9);
    color: white;
}

.course-price.premium {
    background: rgba(245, 158, 11, 0.9);
    color: white;
}

.course-content {
    padding: 1.5rem;
}

.course-title {
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--diamond-white, #fff);
    margin-bottom: 0.5rem;
}

.course-meta {
    display: flex;
    gap: 1rem;
    font-size: 0.9rem;
    color: var(--cool-gray, #94a3b8);
    margin-bottom: 1rem;
}

.course-description {
    color: var(--cool-gray, #94a3b8);
    line-height: 1.6;
    margin-bottom: 1.5rem;
}

/* Testimonials */
.testimonials-section {
    padding: 6rem 0;
    background: rgba(255, 255, 255, 0.02);
}

.testimonials-slider {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
    margin-bottom: 3rem;
}

.testimonial-card {
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 16px;
    padding: 2rem;
    transition: transform 0.3s ease;
}

.testimonial-card:hover {
    transform: translateY(-5px);
}

.testimonial-content p {
    font-style: italic;
    color: var(--diamond-white, #fff);
    line-height: 1.6;
    margin-bottom: 1.5rem;
}

.testimonial-author {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.author-avatar {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    overflow: hidden;
}

.author-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.avatar-placeholder {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: linear-gradient(135deg, #00d4ff, #3b82f6);
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    color: white;
}

.author-name {
    font-weight: 600;
    color: var(--cyan-accent, #00d4ff);
}

.author-date {
    font-size: 0.9rem;
    color: var(--cool-gray, #94a3b8);
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 4rem 2rem;
}

.empty-icon {
    width: 100px;
    height: 100px;
    margin: 0 auto 2rem;
    background: rgba(255, 255, 255, 0.05);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2.5rem;
    color: var(--cyan-accent, #00d4ff);
}

.empty-state h3 {
    font-size: 1.5rem;
    margin-bottom: 1rem;
    color: var(--diamond-white, #fff);
}

.empty-state p {
    color: var(--cool-gray, #94a3b8);
}

/* Mobile Responsive */
@media (max-width: 768px) {
    .hero-carousel {
        height: 80vh;
        min-height: 500px;
    }
    
    .hero-buttons {
        flex-direction: column;
        align-items: center;
        gap: 0.75rem;
    }
    
    .btn {
        width: 100%;
        max-width: 280px;
    }
    
    .stats-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
    }
    
    .stat-card {
        padding: 1.5rem;
    }
    
    .stat-number {
        font-size: 2rem;
    }
    
    .content-section {
        padding: 4rem 0;
    }
    
    .articles-grid,
    .courses-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }
    
    .testimonials-slider {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 480px) {
    .hero-carousel {
        height: 70vh;
        min-height: 450px;
    }
    
    .stats-grid {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    
    .btn {
        max-width: 260px;
        padding: 0.75rem 1.5rem;
        font-size: 0.9rem;
    }
    
    .section-header {
        margin-bottom: 3rem;
    }
}
</style>

<script>
// Hero Carousel
document.addEventListener('DOMContentLoaded', function() {
    const slides = document.querySelectorAll('.hero-slide');
    const dots = document.querySelectorAll('.dot');
    let currentSlide = 0;
    
    if (slides.length > 1) {
        // Auto-advance slides
        setInterval(() => {
            slides[currentSlide].classList.remove('active');
            dots[currentSlide].classList.remove('active');
            
            currentSlide = (currentSlide + 1) % slides.length;
            
            slides[currentSlide].classList.add('active');
            dots[currentSlide].classList.add('active');
        }, 6000);
        
        // Dot navigation
        dots.forEach((dot, index) => {
            dot.addEventListener('click', () => {
                slides[currentSlide].classList.remove('active');
                dots[currentSlide].classList.remove('active');
                
                currentSlide = index;
                
                slides[currentSlide].classList.add('active');
                dots[currentSlide].classList.add('active');
            });
        });
    }
});
</script>
@endsection