@extends('layouts.app')

@section('title', 'Digital Leap Africa - Premier Tech Education Platform in Africa | Programming Courses & Career Development')
@section('meta_description', 'Transform your tech career with Digital Leap Africa. Expert-led programming courses, web development training, and career opportunities across Kenya, Nigeria, Ghana, and all of Africa. Join 10,000+ successful graduates.')
@section('meta_keywords', 'programming courses Africa, web development Kenya, tech education Nigeria, coding bootcamp Ghana, software development training, digital skills Africa, tech careers Kenya, programming jobs Nigeria, web developer course, full stack development Africa')
@section('canonical', route('home'))

@push('structured-data')
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "WebSite",
    "name": "Digital Leap Africa",
    "url": "https://digitalleap.africa",
    "description": "Premier tech education platform in Africa offering programming courses, career development, and job opportunities",
    "potentialAction": {
        "@type": "SearchAction",
        "target": {
            "@type": "EntryPoint",
            "urlTemplate": "https://digitalleap.africa/courses?search={search_term_string}"
        },
        "query-input": "required name=search_term_string"
    }
}
</script>
@endpush

@section('content')
<div class="hero-section">
    <h1>Empowering African Tech Talent</h1>
    <p>Transform your career with expert-led programming courses, real-world projects, and job opportunities across Africa.</p>
    <div class="hero-actions">
        <a href="{{ route('courses.index') }}" class="btn-primary">Browse Courses</a>
        <a href="{{ route('about') }}" class="btn-outline">Learn More</a>
    </div>
</div>

<div class="features-section">
    <h2>Why Choose Digital Leap Africa?</h2>
    <div class="features-grid">
        <div class="feature-card">
            <i class="fas fa-graduation-cap"></i>
            <h3>Expert-Led Courses</h3>
            <p>Learn from industry professionals with real-world experience in top tech companies.</p>
        </div>
        <div class="feature-card">
            <i class="fas fa-briefcase"></i>
            <h3>Career Opportunities</h3>
            <p>Access exclusive job opportunities and connect with top employers across Africa.</p>
        </div>
        <div class="feature-card">
            <i class="fas fa-users"></i>
            <h3>Community Support</h3>
            <p>Join a vibrant community of learners and professionals supporting each other's growth.</p>
        </div>
    </div>
</div>
@endsection

<style>
.hero-section {
    text-align: center;
    padding: 4rem 0;
    background: linear-gradient(135deg, var(--navy-bg), var(--charcoal));
    margin: -2rem -5% 3rem;
    border-radius: 0 0 20px 20px;
}

.hero-section h1 {
    font-size: 3rem;
    font-weight: 700;
    margin-bottom: 1rem;
    background: linear-gradient(135deg, var(--cyan-accent), var(--purple-accent));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.hero-section p {
    font-size: 1.2rem;
    color: var(--cool-gray);
    margin-bottom: 2rem;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
}

.hero-actions {
    display: flex;
    gap: 1rem;
    justify-content: center;
    flex-wrap: wrap;
}

.features-section {
    padding: 3rem 0;
}

.features-section h2 {
    text-align: center;
    font-size: 2.5rem;
    margin-bottom: 3rem;
    color: var(--diamond-white);
}

.features-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
}

.feature-card {
    background: rgba(255, 255, 255, 0.02);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 12px;
    padding: 2rem;
    text-align: center;
    transition: transform 0.3s ease;
}

.feature-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0, 201, 255, 0.2);
}

.feature-card i {
    font-size: 3rem;
    color: var(--cyan-accent);
    margin-bottom: 1rem;
}

.feature-card h3 {
    font-size: 1.5rem;
    margin-bottom: 1rem;
    color: var(--diamond-white);
}

.feature-card p {
    color: var(--cool-gray);
    line-height: 1.6;
}

@media (max-width: 768px) {
    .hero-section h1 {
        font-size: 2rem;
    }
    
    .hero-section p {
        font-size: 1rem;
    }
    
    .features-section h2 {
        font-size: 2rem;
    }
    
    .features-grid {
        grid-template-columns: 1fr;
    }
}
</style>
@endsection