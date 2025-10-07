@extends('layouts.app')

@push('styles')
<style>
/* Animations */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes fadeInLeft {
    from {
        opacity: 0;
        transform: translateX(-30px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes fadeInRight {
    from {
        opacity: 0;
        transform: translateX(30px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes pulse {
    0%, 100% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.05);
    }
}

@keyframes float {
    0%, 100% {
        transform: translateY(0px);
    }
    50% {
        transform: translateY(-10px);
    }
}

@keyframes countUp {
    from {
        opacity: 0;
        transform: scale(0.5);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}

.hero-section {
    background: linear-gradient(135deg, var(--navy-bg) 0%, var(--deep-blue) 100%);
    padding: 4rem 0;
    margin: -2rem -5% 3rem;
    border-radius: 0 0 2rem 2rem;
    position: relative;
    overflow: hidden;
}

.hero-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M 10 0 L 0 0 0 10" fill="none" stroke="rgba(0,201,255,0.1)" stroke-width="0.5"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
    opacity: 0.3;
}

.hero-content {
    position: relative;
    z-index: 2;
    animation: fadeInUp 1s ease-out;
}

.hero-title {
    font-size: 3rem;
    font-weight: 700;
    margin-bottom: 1.5rem;
    background: linear-gradient(90deg, var(--cyan-accent), var(--purple-accent));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    animation: fadeInUp 1s ease-out 0.2s both;
}

.hero-subtitle {
    font-size: 1.25rem;
    color: var(--cool-gray);
    margin-bottom: 2rem;
    line-height: 1.6;
    animation: fadeInUp 1s ease-out 0.4s both;
}

.hero-buttons {
    display: flex;
    gap: 1rem;
    justify-content: center;
    flex-wrap: wrap;
    animation: fadeInUp 1s ease-out 0.6s both;
}

.feature-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 2rem;
    margin: 3rem 0;
}

.feature-card {
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: var(--radius);
    padding: 2rem;
    text-align: center;
    transition: all 0.3s ease;
    animation: fadeInUp 1s ease-out both;
    position: relative;
    overflow: hidden;
}

.feature-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(0, 201, 255, 0.1), transparent);
    transition: left 0.5s;
}

.feature-card:hover::before {
    left: 100%;
}

.feature-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.4);
    border-color: rgba(0, 201, 255, 0.3);
}

.feature-card:nth-child(1) { animation-delay: 0.1s; }
.feature-card:nth-child(2) { animation-delay: 0.2s; }
.feature-card:nth-child(3) { animation-delay: 0.3s; }
.feature-card:nth-child(4) { animation-delay: 0.4s; }

.feature-icon {
    font-size: 3rem;
    color: var(--cyan-accent);
    margin-bottom: 1rem;
    animation: float 3s ease-in-out infinite;
    display: inline-block;
}

.feature-card:nth-child(2) .feature-icon { animation-delay: 0.5s; }
.feature-card:nth-child(3) .feature-icon { animation-delay: 1s; }
.feature-card:nth-child(4) .feature-icon { animation-delay: 1.5s; }

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 2rem;
    margin: 3rem 0;
}

.stat-card {
    text-align: center;
    padding: 1.5rem;
    animation: fadeInUp 1s ease-out both;
    transition: transform 0.3s ease;
}

.stat-card:hover {
    transform: scale(1.05);
}

.stat-card:nth-child(1) { animation-delay: 0.1s; }
.stat-card:nth-child(2) { animation-delay: 0.2s; }
.stat-card:nth-child(3) { animation-delay: 0.3s; }
.stat-card:nth-child(4) { animation-delay: 0.4s; }

.stat-number {
    font-size: 2.5rem;
    font-weight: 700;
    color: var(--cyan-accent);
    display: block;
    animation: countUp 0.8s ease-out both;
}

.stat-label {
    color: var(--cool-gray);
    font-size: 0.9rem;
    margin-top: 0.5rem;
}

.section-title {
    animation: fadeInUp 1s ease-out both;
}

.btn-primary, .btn-outline {
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.btn-primary:hover, .btn-outline:hover {
    animation: pulse 0.6s ease-in-out;
}

/* Mobile Responsive */
@media (max-width: 768px) {
    .hero-section {
        padding: 2rem 0;
        margin: -1rem -2.5% 2rem;
    }
    
    .hero-title {
        font-size: 2.2rem;
    }
    
    .hero-subtitle {
        font-size: 1.1rem;
    }
    
    .hero-buttons {
        flex-direction: column;
        align-items: center;
    }
    
    .hero-buttons .btn-primary,
    .hero-buttons .btn-outline {
        width: 100%;
        max-width: 280px;
    }
    
    .feature-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }
    
    .feature-card {
        padding: 1.5rem;
    }
    
    .feature-icon {
        font-size: 2.5rem;
    }
    
    .stats-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
    }
    
    .stat-number {
        font-size: 2rem;
    }
}

@media (max-width: 480px) {
    .hero-section {
        padding: 1.5rem 0;
    }
    
    .hero-title {
        font-size: 1.8rem;
    }
    
    .hero-subtitle {
        font-size: 1rem;
    }
    
    .feature-card {
        padding: 1.25rem;
    }
    
    .feature-icon {
        font-size: 2rem;
    }
    
    .stats-grid {
        grid-template-columns: 1fr;
    }
    
    .stat-card {
        padding: 1rem;
    }
    
    .stat-number {
        font-size: 1.8rem;
    }
}
</style>
@endpush

@section('content')
{{-- Hero Section --}}
<div class="hero-section">
    <div class="container">
        <div class="hero-content" style="text-align: center; max-width: 800px; margin: 0 auto;">
            <h1 class="hero-title">
                The Future of African Youth is Digital
            </h1>
            <p class="hero-subtitle">
                Empowering African youth through technology education, collaboration, and professional opportunities. Join our community and leap into the digital future.
            </p>
            <div class="hero-buttons">
                @guest
                    <a href="{{ route('register') }}" class="btn-primary" style="padding: 0.75rem 2rem; font-size: 1.1rem;">
                        <i class="fas fa-rocket me-2"></i>Get Started Today
                    </a>
                    <a href="{{ route('courses.index') }}" class="btn-outline" style="padding: 0.75rem 2rem; font-size: 1.1rem;">
                        <i class="fas fa-book me-2"></i>Explore Courses
                    </a>
                @else
                    <a href="{{ route('dashboard') }}" class="btn-primary" style="padding: 0.75rem 2rem; font-size: 1.1rem;">
                        <i class="fas fa-tachometer-alt me-2"></i>Go to Dashboard
                    </a>
                    <a href="{{ route('courses.index') }}" class="btn-outline" style="padding: 0.75rem 2rem; font-size: 1.1rem;">
                        <i class="fas fa-book me-2"></i>Browse Courses
                    </a>
                @endguest
            </div>
        </div>
    </div>
</div>

{{-- Features Section --}}
<div class="container">
    <div class="section-title" style="text-align: center; margin-bottom: 3rem;">
        <h2 style="font-size: 2.5rem; font-weight: 600; margin-bottom: 1rem;">What We Offer</h2>
        <p style="color: var(--cool-gray); font-size: 1.1rem;">Comprehensive resources to accelerate your digital journey</p>
    </div>

    <div class="feature-grid">
        <div class="feature-card">
            <div class="feature-icon">
                <i class="fas fa-graduation-cap"></i>
            </div>
            <h3 style="margin-bottom: 1rem; font-size: 1.5rem;">Expert-Led Courses</h3>
            <p style="color: var(--cool-gray); line-height: 1.6;">Learn from industry professionals with hands-on projects and real-world applications.</p>
            <a href="{{ route('courses.index') }}" class="btn-outline" style="margin-top: 1rem;">View Courses</a>
        </div>

        <div class="feature-card">
            <div class="feature-icon">
                <i class="fas fa-project-diagram"></i>
            </div>
            <h3 style="margin-bottom: 1rem; font-size: 1.5rem;">Real Projects</h3>
            <p style="color: var(--cool-gray); line-height: 1.6;">Build your portfolio with practical projects that showcase your skills to employers.</p>
            <a href="{{ route('projects.index') }}" class="btn-outline" style="margin-top: 1rem;">Explore Projects</a>
        </div>

        <div class="feature-card">
            <div class="feature-icon">
                <i class="fas fa-briefcase"></i>
            </div>
            <h3 style="margin-bottom: 1rem; font-size: 1.5rem;">Job Opportunities</h3>
            <p style="color: var(--cool-gray); line-height: 1.6;">Connect with employers and find your dream job in the tech industry.</p>
            <a href="{{ route('jobs.index') }}" class="btn-outline" style="margin-top: 1rem;">Find Jobs</a>
        </div>

        <div class="feature-card">
            <div class="feature-icon">
                <i class="fas fa-book-open"></i>
            </div>
            <h3 style="margin-bottom: 1rem; font-size: 1.5rem;">Digital Library</h3>
            <p style="color: var(--cool-gray); line-height: 1.6;">Access a vast collection of resources, books, and materials for continuous learning.</p>
            <a href="{{ route('elibrary.index') }}" class="btn-outline" style="margin-top: 1rem;">Browse Library</a>
        </div>
    </div>

    {{-- Stats Section --}}
    <div class="section-title" style="text-align: center; margin: 4rem 0 2rem;">
        <h2 style="font-size: 2rem; font-weight: 600; margin-bottom: 2rem;">Join Our Growing Community</h2>
    </div>

    <div class="stats-grid">
        <div class="stat-card">
            <span class="stat-number">1000+</span>
            <div class="stat-label">Active Students</div>
        </div>
        <div class="stat-card">
            <span class="stat-number">50+</span>
            <div class="stat-label">Expert Courses</div>
        </div>
        <div class="stat-card">
            <span class="stat-number">200+</span>
            <div class="stat-label">Projects Completed</div>
        </div>
        <div class="stat-card">
            <span class="stat-number">95%</span>
            <div class="stat-label">Success Rate</div>
        </div>
    </div>
</div>
@endsection