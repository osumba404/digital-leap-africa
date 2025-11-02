@extends('layouts.app')

@section('title', 'My Testimonials')

@push('styles')
<style>
/* Hero Section */
.testimonials-hero {
  background: linear-gradient(135deg, var(--navy-bg) 0%, var(--charcoal) 100%);
  padding: 4rem 0 3rem;
  position: relative;
  overflow: hidden;
}

.testimonials-hero::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M 10 0 L 0 0 0 10" fill="none" stroke="rgba(100,181,246,0.1)" stroke-width="0.5"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
  opacity: 0.3;
}

.hero-content {
  position: relative;
  z-index: 2;
  text-align: center;
}

.hero-title {
  font-size: 3rem;
  font-weight: 800;
  background: linear-gradient(135deg, #64b5f6, #00d4ff, #7c3aed);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  margin-bottom: 1rem;
  line-height: 1.1;
}

.hero-subtitle {
  font-size: 1.2rem;
  color: var(--cool-gray);
  margin-bottom: 3rem;
  max-width: 600px;
  margin-left: auto;
  margin-right: auto;
}

/* Stats Cards */
.stats-container {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
  gap: 2rem;
  margin-bottom: 3rem;
  max-width: 800px;
  margin-left: auto;
  margin-right: auto;
}

.stat-card {
  background: rgba(255, 255, 255, 0.05);
  backdrop-filter: blur(10px);
  border: 1px solid rgba(100, 181, 246, 0.2);
  border-radius: 20px;
  padding: 2rem;
  text-align: center;
  transition: all 0.3s ease;
}

.stat-card:hover {
  transform: translateY(-5px);
  border-color: rgba(100, 181, 246, 0.4);
  box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
}

.stat-number {
  font-size: 2.5rem;
  font-weight: 800;
  background: linear-gradient(135deg, #64b5f6, #00d4ff);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  display: block;
  margin-bottom: 0.5rem;
}

.stat-label {
  color: var(--cool-gray);
  font-size: 1rem;
  font-weight: 500;
}

/* Action Buttons */
.hero-actions {
  display: flex;
  gap: 1rem;
  justify-content: center;
  flex-wrap: wrap;
}

.btn-hero {
  padding: 1rem 2rem;
  border-radius: 50px;
  font-weight: 600;
  font-size: 1rem;
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
  transition: all 0.3s ease;
  border: none;
  cursor: pointer;
}

.btn-primary-hero {
  background: linear-gradient(135deg, #64b5f6, #00d4ff);
  color: var(--navy-bg);
}

.btn-primary-hero:hover {
  transform: translateY(-3px);
  box-shadow: 0 15px 30px rgba(100, 181, 246, 0.4);
}

.btn-outline-hero {
  background: transparent;
  color: #64b5f6;
  border: 2px solid #64b5f6;
}

.btn-outline-hero:hover {
  background: rgba(100, 181, 246, 0.1);
  transform: translateY(-3px);
}

/* Main Content */
.testimonials-section {
  padding: 4rem 0;
  background: var(--navy-bg);
}

.section-header {
  text-align: center;
  margin-bottom: 3rem;
}

.section-title {
  font-size: 2rem;
  font-weight: 700;
  color: var(--diamond-white);
  margin-bottom: 1rem;
}

.section-subtitle {
  color: var(--cool-gray);
  font-size: 1.1rem;
}

/* Testimonials Grid */
.testimonials-container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 2rem;
}

.testimonials-grid {
  display: grid;
  gap: 2rem;
}

.testimonial-item {
  background: linear-gradient(135deg, rgba(255, 255, 255, 0.05), rgba(100, 181, 246, 0.02));
  backdrop-filter: blur(10px);
  border: 1px solid rgba(100, 181, 246, 0.15);
  border-radius: 24px;
  padding: 2rem;
  position: relative;
  transition: all 0.4s ease;
  overflow: hidden;
}

.testimonial-item::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 4px;
  height: 100%;
  background: linear-gradient(135deg, #64b5f6, #00d4ff);
}

.testimonial-item:hover {
  transform: translateY(-8px);
  border-color: rgba(100, 181, 246, 0.3);
  box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
}

/* Testimonial Header */
.testimonial-header {
  display: flex;
  align-items: center;
  gap: 1rem;
  margin-bottom: 1.5rem;
}

.user-avatar {
  width: 60px;
  height: 60px;
  border-radius: 50%;
  background: linear-gradient(135deg, #64b5f6, #00d4ff);
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: 800;
  font-size: 1.5rem;
  color: var(--navy-bg);
  flex-shrink: 0;
  border: 3px solid rgba(100, 181, 246, 0.3);
}

.user-avatar img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  border-radius: 50%;
}

.user-info {
  flex: 1;
}

.user-name {
  font-size: 1.2rem;
  font-weight: 700;
  color: var(--diamond-white);
  margin: 0 0 0.25rem 0;
  word-wrap: break-word;
}

.testimonial-date {
  color: var(--cool-gray);
  font-size: 0.9rem;
  display: flex;
  align-items: center;
  gap: 0.5rem;
}

/* Testimonial Content */
.testimonial-text {
  color: var(--cool-gray);
  font-size: 1.1rem;
  line-height: 1.7;
  margin-bottom: 1.5rem;
  position: relative;
  padding-left: 1rem;
  word-wrap: break-word;
  word-break: break-word;
  overflow-wrap: break-word;
  hyphens: auto;
}

.testimonial-text::before {
  content: '"';
  position: absolute;
  left: -0.5rem;
  top: -1rem;
  font-size: 4rem;
  color: rgba(100, 181, 246, 0.2);
  font-family: serif;
  line-height: 1;
}

/* Status Badge */
.testimonial-footer {
  display: flex;
  justify-content: flex-end;
}

.status-badge {
  padding: 0.5rem 1.2rem;
  border-radius: 25px;
  font-size: 0.85rem;
  font-weight: 600;
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
}

.status-published {
  background: rgba(34, 197, 94, 0.15);
  color: #22c55e;
  border: 1px solid rgba(34, 197, 94, 0.3);
}

.status-pending {
  background: rgba(251, 191, 36, 0.15);
  color: #fbbf24;
  border: 1px solid rgba(251, 191, 36, 0.3);
}

/* Empty State */
.empty-testimonials {
  text-align: center;
  padding: 6rem 2rem;
  background: rgba(255, 255, 255, 0.02);
  border-radius: 24px;
  border: 1px solid rgba(100, 181, 246, 0.1);
}

.empty-icon {
  font-size: 5rem;
  color: rgba(100, 181, 246, 0.3);
  margin-bottom: 2rem;
}

.empty-title {
  font-size: 1.8rem;
  font-weight: 700;
  color: var(--diamond-white);
  margin-bottom: 1rem;
}

.empty-text {
  color: var(--cool-gray);
  font-size: 1.1rem;
  margin-bottom: 2rem;
  max-width: 400px;
  margin-left: auto;
  margin-right: auto;
}

/* Mobile Responsiveness */
@media (max-width: 768px) {
  .testimonials-hero {
    padding: 3rem 0 2rem;
  }
  
  .hero-title {
    font-size: 2.2rem;
  }
  
  .hero-subtitle {
    font-size: 1rem;
    padding: 0 1rem;
  }
  
  .stats-container {
    grid-template-columns: 1fr;
    gap: 1rem;
    padding: 0 1rem;
  }
  
  .stat-card {
    padding: 1.5rem;
  }
  
  .stat-number {
    font-size: 2rem;
  }
  
  .hero-actions {
    flex-direction: column;
    align-items: center;
    gap: 0.75rem;
    padding: 0 1rem;
  }
  
  .btn-hero {
    width: 100%;
    max-width: 300px;
    justify-content: center;
  }
  
  .testimonials-container {
    padding: 0 1rem;
  }
  
  .testimonial-item {
    padding: 1.5rem;
  }
  
  .testimonial-header {
    flex-direction: column;
    text-align: center;
    gap: 1rem;
  }
  
  .user-avatar {
    width: 50px;
    height: 50px;
    font-size: 1.2rem;
  }
  
  .user-name {
    font-size: 1.1rem;
  }
  
  .testimonial-text {
    font-size: 1rem;
    padding-left: 0.5rem;
  }
  
  .testimonial-text::before {
    font-size: 3rem;
    left: -0.25rem;
    top: -0.75rem;
  }
  
  .testimonial-footer {
    justify-content: center;
  }
}

@media (max-width: 480px) {
  .testimonials-hero {
    padding: 2rem 0 1.5rem;
  }
  
  .hero-title {
    font-size: 1.8rem;
  }
  
  .hero-subtitle {
    font-size: 0.9rem;
  }
  
  .stat-card {
    padding: 1rem;
  }
  
  .stat-number {
    font-size: 1.8rem;
  }
  
  .btn-hero {
    padding: 0.875rem 1.5rem;
    font-size: 0.9rem;
  }
  
  .testimonials-container {
    padding: 0 0.75rem;
  }
  
  .testimonial-item {
    padding: 1.25rem;
    border-radius: 16px;
  }
  
  .user-avatar {
    width: 45px;
    height: 45px;
    font-size: 1rem;
  }
  
  .user-name {
    font-size: 1rem;
  }
  
  .testimonial-text {
    font-size: 0.95rem;
  }
  
  .empty-testimonials {
    padding: 4rem 1rem;
  }
  
  .empty-icon {
    font-size: 4rem;
  }
  
  .empty-title {
    font-size: 1.5rem;
  }
}

/* Light Mode */
[data-theme="light"] .testimonials-hero {
  background: linear-gradient(135deg, #E6F2FF 0%, #F8FAFC 100%);
}

[data-theme="light"] .hero-title {
  background: linear-gradient(135deg, var(--primary-blue), var(--cyan-accent), #7c3aed);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}

[data-theme="light"] .testimonials-section {
  background: #F8FAFC;
}

[data-theme="light"] .section-title {
  color: var(--primary-blue);
}

[data-theme="light"] .testimonial-item {
  background: linear-gradient(135deg, #FFFFFF, rgba(46, 120, 197, 0.02));
  border-color: rgba(46, 120, 197, 0.15);
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
}

[data-theme="light"] .testimonial-item:hover {
  box-shadow: 0 25px 50px rgba(0, 0, 0, 0.1);
}

[data-theme="light"] .user-name {
  color: var(--primary-blue);
}

[data-theme="light"] .btn-primary-hero {
  background: linear-gradient(135deg, var(--primary-blue), var(--cyan-accent));
  color: #FFFFFF;
}

[data-theme="light"] .btn-outline-hero {
  color: var(--primary-blue);
  border-color: var(--primary-blue);
}

[data-theme="light"] .empty-title {
  color: var(--primary-blue);
}
</style>
@endpush

@section('content')
<!-- Hero Section -->
<section class="testimonials-hero">
  <div class="container">
    <div class="hero-content">
      <h1 class="hero-title">💬 My Testimonials</h1>
      <p class="hero-subtitle">Share your journey and inspire others in the Digital Leap Africa community</p>
      
      <div class="stats-container">
        <div class="stat-card">
          <span class="stat-number">{{ $testimonials->count() }}</span>
          <span class="stat-label">Total Shared</span>
        </div>
        <div class="stat-card">
          <span class="stat-number">{{ $testimonials->where('is_active', true)->count() }}</span>
          <span class="stat-label">Published</span>
        </div>
      </div>
      
      <div class="hero-actions">
        <a href="{{ route('testimonials.create') }}" class="btn-hero btn-primary-hero">
          <i class="fas fa-plus"></i> Share New Testimonial
        </a>
        <a href="{{ route('testimonials.index') }}" class="btn-hero btn-outline-hero">
          <i class="fas fa-eye"></i> View All Testimonials
        </a>
      </div>
    </div>
  </div>
</section>

<!-- Testimonials Section -->
<section class="testimonials-section">
  <div class="testimonials-container">
    @if($testimonials->count())
      <div class="section-header">
        <h2 class="section-title">Your Shared Experiences</h2>
        <p class="section-subtitle">Track and manage your testimonials</p>
      </div>
      
      <div class="testimonials-grid">
        @foreach($testimonials as $testimonial)
          <div class="testimonial-item">
            <div class="testimonial-header">
              <div class="user-avatar">
                @if(!empty($testimonial->avatar_url))
                  <img src="{{ $testimonial->avatar_url }}" alt="{{ $testimonial->name ?? ($testimonial->user->name ?? 'User') }}">
                @else
                  {{ strtoupper(mb_substr($testimonial->name ?? ($testimonial->user->name ?? 'U'), 0, 1)) }}
                @endif
              </div>
              <div class="user-info">
                <h3 class="user-name">{{ $testimonial->name ?? ($testimonial->user->name ?? 'Anonymous Learner') }}</h3>
                <div class="testimonial-date">
                  <i class="fas fa-calendar-alt"></i>
                  Shared {{ $testimonial->created_at?->format('M d, Y') }}
                </div>
              </div>
            </div>
            
            <div class="testimonial-text">
              {{ $testimonial->quote }}
            </div>
            
            <div class="testimonial-footer">
              @if($testimonial->is_active)
                <span class="status-badge status-published">
                  <i class="fas fa-check-circle"></i> Published
                </span>
              @else
                <span class="status-badge status-pending">
                  <i class="fas fa-clock"></i> Pending Review
                </span>
              @endif
            </div>
          </div>
        @endforeach
      </div>
    @else
      <div class="empty-testimonials">
        <div class="empty-icon">
          <i class="fas fa-comment-dots"></i>
        </div>
        <h3 class="empty-title">No Testimonials Yet</h3>
        <p class="empty-text">You haven't shared any testimonials yet. Share your experience with Digital Leap Africa and inspire others!</p>
        <a href="{{ route('testimonials.create') }}" class="btn-hero btn-primary-hero">
          <i class="fas fa-plus"></i> Share Your First Testimonial
        </a>
      </div>
    @endif
  </div>
</section>
@endsection