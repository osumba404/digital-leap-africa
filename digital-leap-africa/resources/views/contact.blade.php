@extends('layouts.app')
@section('title','Contact')
@section('content')

<style>
    .contact-hero {
        text-align: center;
        margin-bottom: 3rem;
        padding: 2rem 0;
    }
    
    .contact-hero h1 {
        font-size: 2.5rem;
        margin-bottom: 1rem;
        background: linear-gradient(135deg, var(--cyan-accent), var(--purple-accent));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    .contact-hero p {
        font-size: 1.1rem;
        color: var(--cool-gray);
        max-width: 600px;
        margin: 0 auto;
    }
    
    .contact-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
        margin-bottom: 3rem;
    }
    
    .contact-card {
        background: rgba(255, 255, 255, 0.02);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 12px;
        padding: 2rem;
        text-align: center;
        transition: all 0.3s ease;
    }
    
    .contact-card:hover {
        transform: translateY(-5px);
        border-color: var(--cyan-accent);
        box-shadow: 0 10px 30px rgba(0, 201, 255, 0.2);
    }
    
    .contact-icon {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, var(--cyan-accent), var(--purple-accent));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        font-size: 1.5rem;
        color: var(--navy-bg);
    }
    
    .contact-card h3 {
        font-size: 1.3rem;
        margin-bottom: 0.75rem;
        color: var(--diamond-white);
    }
    
    .contact-card p {
        color: var(--cool-gray);
        margin-bottom: 1rem;
        font-size: 0.95rem;
    }
    
    .contact-link {
        color: var(--cyan-accent);
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s ease;
        display: inline-block;
    }
    
    .contact-link:hover {
        color: var(--purple-accent);
        transform: translateX(5px);
    }
    
    .social-section {
        background: rgba(255, 255, 255, 0.02);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 12px;
        padding: 2.5rem;
        text-align: center;
        margin-bottom: 3rem;
    }
    
    .social-section h2 {
        font-size: 1.8rem;
        margin-bottom: 1rem;
        color: var(--diamond-white);
    }
    
    .social-section p {
        color: var(--cool-gray);
        margin-bottom: 2rem;
    }
    
    .social-links-grid {
        display: flex;
        justify-content: center;
        gap: 1.5rem;
        flex-wrap: wrap;
    }
    
    .social-link-large {
        width: 60px;
        height: 60px;
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--cool-gray);
        font-size: 1.5rem;
        text-decoration: none;
        transition: all 0.3s ease;
    }
    
    .social-link-large:hover {
        transform: translateY(-5px) scale(1.1);
        box-shadow: 0 10px 25px rgba(0, 201, 255, 0.3);
    }
    
    .social-link-large.twitter:hover {
        background: #1da1f2;
        color: white;
        border-color: #1da1f2;
    }
    
    .social-link-large.linkedin:hover {
        background: #0077b5;
        color: white;
        border-color: #0077b5;
    }
    
    .social-link-large.facebook:hover {
        background: #1877f2;
        color: white;
        border-color: #1877f2;
    }
    
    .social-link-large.instagram:hover {
        background: linear-gradient(135deg, #833ab4, #fd1d1d, #fcb045);
        color: white;
        border-color: #833ab4;
    }
    
    .social-link-large.youtube:hover {
        background: #ff0000;
        color: white;
        border-color: #ff0000;
    }
    
    .social-link-large.tiktok:hover {
        background: #000000;
        color: white;
        border-color: #000000;
    }
    
    .support-section {
        background: linear-gradient(135deg, rgba(0, 201, 255, 0.1), rgba(122, 95, 255, 0.1));
        border: 2px solid rgba(0, 201, 255, 0.3);
        border-radius: 12px;
        padding: 3rem;
        text-align: center;
    }
    
    .support-section h2 {
        font-size: 2rem;
        margin-bottom: 1rem;
        color: var(--diamond-white);
    }
    
    .support-section p {
        color: var(--cool-gray);
        margin-bottom: 2rem;
        font-size: 1.05rem;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
    }
    
    .btn-donate {
        background: linear-gradient(90deg, var(--cyan-accent), var(--purple-accent));
        color: var(--navy-bg);
        padding: 1rem 3rem;
        border-radius: 999px;
        font-weight: 700;
        font-size: 1.1rem;
        border: none;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
        transition: all 0.3s ease;
        box-shadow: 0 8px 20px rgba(0, 201, 255, 0.3);
    }
    
    .btn-donate:hover {
    }
</style>

<div class="container">
    <!-- Hero Section -->
    <div class="contact-hero">
        <h1>Get In Touch</h1>
        <p>Have questions or want to connect? We're here to help and would love to hear from you!</p>
    </div>

    <!-- Contact Information Grid -->
    <div class="contact-grid">
        @if(!empty($siteSettings['contact_email']))
        <div class="contact-card">
            <div class="contact-icon">
                <i class="fas fa-envelope"></i>
            </div>
            <h3>Email Us</h3>
            <p>Send us an email and we'll respond as soon as possible</p>
            <a href="mailto:{{ $siteSettings['contact_email'] }}" class="contact-link">
                {{ $siteSettings['contact_email'] }} <i class="fas fa-arrow-right" style="font-size: 0.85rem; margin-left: 0.25rem;"></i>
            </a>
        </div>
        @endif

        @if(!empty($siteSettings['contact_phone']))
        <div class="contact-card">
            <div class="contact-icon">
                <i class="fas fa-phone"></i>
            </div>
            <h3>Call Us</h3>
            <p>Give us a call during business hours</p>
            <a href="tel:{{ $siteSettings['contact_phone'] }}" class="contact-link">
                {{ $siteSettings['contact_phone'] }} <i class="fas fa-arrow-right" style="font-size: 0.85rem; margin-left: 0.25rem;"></i>
            </a>
        </div>
        @endif

        <div class="contact-card">
            <div class="contact-icon">
                <i class="fas fa-map-marker-alt"></i>
            </div>
            <h3>Visit Us</h3>
            <p>Come visit our office or workspace</p>
            <span class="contact-link" style="cursor: default;">
                Nairobi, Kenya <i class="fas fa-location-dot" style="color: #ff6b6b; font-size: 0.85rem; margin-left: 0.25rem;"></i>
            </span>
        </div>
    </div>

    <!-- Social Media Section -->
    @if(!empty($siteSettings['twitter_url']) || !empty($siteSettings['linkedin_url']) || !empty($siteSettings['facebook_url']) || !empty($siteSettings['instagram_url']) || !empty($siteSettings['youtube_url']) || !empty($siteSettings['tiktok_url']))
    <div class="social-section">
        <h2>Connect With Us</h2>
        <p>Follow us on social media to stay updated with our latest news and activities</p>
        
        <div class="social-links-grid">
            @if(!empty($siteSettings['twitter_url']))
                <a href="{{ $siteSettings['twitter_url'] }}" class="social-link-large twitter" title="Twitter/X" target="_blank" rel="noopener">
                    <i class="fa-brands fa-x-twitter"></i>
                </a>
            @endif
            
            @if(!empty($siteSettings['linkedin_url']))
                <a href="{{ $siteSettings['linkedin_url'] }}" class="social-link-large linkedin" title="LinkedIn" target="_blank" rel="noopener">
                    <i class="fa-brands fa-linkedin-in"></i>
                </a>
            @endif
            
            @if(!empty($siteSettings['facebook_url']))
                <a href="{{ $siteSettings['facebook_url'] }}" class="social-link-large facebook" title="Facebook" target="_blank" rel="noopener">
                    <i class="fa-brands fa-facebook-f"></i>
                </a>
            @endif
            
            @if(!empty($siteSettings['instagram_url']))
                <a href="{{ $siteSettings['instagram_url'] }}" class="social-link-large instagram" title="Instagram" target="_blank" rel="noopener">
                    <i class="fa-brands fa-instagram"></i>
                </a>
            @endif
            
            @if(!empty($siteSettings['youtube_url']))
                <a href="{{ $siteSettings['youtube_url'] }}" class="social-link-large youtube" title="YouTube" target="_blank" rel="noopener">
                    <i class="fa-brands fa-youtube"></i>
                </a>
            @endif
            
            @if(!empty($siteSettings['tiktok_url']))
                <a href="{{ $siteSettings['tiktok_url'] }}" class="social-link-large tiktok" title="TikTok" target="_blank" rel="noopener">
                    <i class="fa-brands fa-tiktok"></i>
                </a>
            @endif
        </div>
    </div>
    @endif

    <!-- Support Section -->
    <div class="support-section">
        <h2>Support Our Mission</h2>
        <p>Help us empower more people across Africa with digital skills and opportunities. Your contribution makes a real difference in our community.</p>
        <a href="{{ route('donate') }}" class="btn-donate">
            <i class="fas fa-heart"></i>
            Support The Community
        </a>
    </div>
</div>

@endsection