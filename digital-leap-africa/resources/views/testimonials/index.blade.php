@extends('layouts.app')

@push('styles')
<style>
.testimonials-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 2rem 1rem;
}

.page-header {
    text-align: center;
    margin-bottom: 3rem;
}

.page-title {
    font-size: 2.5rem;
    font-weight: 700;
    background: linear-gradient(90deg, var(--cyan-accent), var(--purple-accent));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin-bottom: 0.5rem;
}

.page-subtitle {
    color: var(--cool-gray);
    font-size: 1.1rem;
}

.filters-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 1rem;
    margin-bottom: 2rem;
    flex-wrap: wrap;
}

.filter-group {
    display: flex;
    gap: 0.5rem;
    align-items: center;
}

.filter-btn {
    padding: 0.5rem 1rem;
    border-radius: 8px;
    border: 1px solid rgba(255, 255, 255, 0.1);
    background: rgba(255, 255, 255, 0.03);
    color: var(--diamond-white);
    cursor: pointer;
    transition: all 0.3s ease;
    text-decoration: none;
    font-size: 0.9rem;
}

.filter-btn:hover {
    background: rgba(255, 255, 255, 0.08);
    border-color: rgba(0, 201, 255, 0.3);
}

.filter-btn.active {
    background: rgba(0, 201, 255, 0.15);
    border-color: rgba(0, 201, 255, 0.4);
    color: var(--cyan-accent);
}

.testimonials-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.testimonial-card {
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 12px;
    padding: 1.5rem;
    transition: all 0.3s ease;
}

.testimonial-card:hover {
    background: rgba(255, 255, 255, 0.05);
    border-color: rgba(0, 201, 255, 0.3);
    transform: translateY(-2px);
}

.testimonial-header {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1rem;
}

.testimonial-avatar {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid rgba(0, 201, 255, 0.3);
}

.testimonial-avatar-placeholder {
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

.testimonial-info {
    flex: 1;
}

.testimonial-name {
    font-weight: 600;
    color: var(--diamond-white);
    margin-bottom: 0.25rem;
}

.testimonial-date {
    font-size: 0.85rem;
    color: var(--cool-gray);
}

.testimonial-quote {
    color: var(--diamond-white);
    line-height: 1.6;
    font-style: italic;
    position: relative;
    padding-left: 1rem;
    border-left: 3px solid rgba(0, 201, 255, 0.3);
}

.testimonial-status {
    display: inline-block;
    padding: 0.25rem 0.75rem;
    border-radius: 999px;
    font-size: 0.75rem;
    font-weight: 500;
    margin-top: 0.75rem;
}

.status-approved {
    background: rgba(34, 197, 94, 0.2);
    color: #22c55e;
    border: 1px solid rgba(34, 197, 94, 0.3);
}

.status-pending {
    background: rgba(251, 191, 36, 0.2);
    color: #fbbf24;
    border: 1px solid rgba(251, 191, 36, 0.3);
}

.empty-state {
    text-align: center;
    padding: 3rem 1rem;
    color: var(--cool-gray);
}

.empty-state i {
    font-size: 3rem;
    color: var(--cyan-accent);
    margin-bottom: 1rem;
}

@media (max-width: 768px) {
    .testimonials-container {
        padding: 1.5rem 0.75rem;
    }

    .testimonials-grid {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    
    .page-header {
        margin-bottom: 2rem;
    }
    
    .page-title {
        font-size: 2rem;
    }
    
    .page-subtitle {
        font-size: 1rem;
    }
    
    .filters-bar {
        flex-direction: column;
        align-items: stretch;
        gap: 0.75rem;
    }
    
    .filter-group {
        justify-content: center;
        flex-wrap: wrap;
    }
    
    .filter-btn {
        font-size: 0.85rem;
        padding: 0.5rem 0.75rem;
    }
    
    .testimonial-card {
        padding: 1.25rem;
    }
    
    .testimonial-header {
        gap: 0.75rem;
    }
    
    .testimonial-avatar,
    .testimonial-avatar-placeholder {
        width: 45px;
        height: 45px;
        font-size: 1rem;
    }
    
    .testimonial-name {
        font-size: 0.95rem;
    }
    
    .testimonial-date {
        font-size: 0.8rem;
    }
    
    .testimonial-quote {
        font-size: 0.95rem;
        padding-left: 0.75rem;
    }
}

@media (max-width: 480px) {
    .testimonials-container {
        padding: 1rem 0.5rem;
    }
    
    .page-title {
        font-size: 1.75rem;
    }
    
    .page-subtitle {
        font-size: 0.9rem;
    }
    
    .filter-btn {
        font-size: 0.8rem;
        padding: 0.4rem 0.6rem;
    }
    
    .testimonial-card {
        padding: 1rem;
    }
    
    .testimonial-quote {
        font-size: 0.9rem;
    }
}
</style>
@endpush

@section('content')
<div class="testimonials-container">
    <div class="page-header">
        <h1 class="page-title">Testimonials</h1>
        <p class="page-subtitle">Hear what our community members have to say</p>
        @auth
        <div style="margin-top: 1.5rem;">
            <a href="{{ route('testimonials.create') }}" class="btn-primary" style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.75rem 1.5rem; text-decoration: none;">
                <i class="fas fa-plus"></i>
                <span>Share Your Testimonial</span>
            </a>
        </div>
        @endauth
    </div>

    <div class="filters-bar">
        <div class="filter-group">
            <span style="color: var(--cool-gray); font-size: 0.9rem;">Filter:</span>
            <a href="{{ route('testimonials.index', ['sort' => $sort, 'filter' => 'all']) }}" 
               class="filter-btn {{ $filter === 'all' ? 'active' : '' }}">
                <i class="fas fa-globe me-1"></i>All Testimonials
            </a>
            @auth
            <a href="{{ route('testimonials.index', ['sort' => $sort, 'filter' => 'mine']) }}" 
               class="filter-btn {{ $filter === 'mine' ? 'active' : '' }}">
                <i class="fas fa-user me-1"></i>My Testimonials
            </a>
            @endauth
        </div>

        <div class="filter-group">
            <span style="color: var(--cool-gray); font-size: 0.9rem;">Sort:</span>
            <a href="{{ route('testimonials.index', ['sort' => 'latest', 'filter' => $filter]) }}" 
               class="filter-btn {{ $sort === 'latest' ? 'active' : '' }}">
                <i class="fas fa-arrow-down me-1"></i>Latest
            </a>
            <a href="{{ route('testimonials.index', ['sort' => 'oldest', 'filter' => $filter]) }}" 
               class="filter-btn {{ $sort === 'oldest' ? 'active' : '' }}">
                <i class="fas fa-arrow-up me-1"></i>Oldest
            </a>
        </div>
    </div>

    @if($testimonials->count())
    <div class="testimonials-grid">
        @foreach($testimonials as $testimonial)
        <div class="testimonial-card">
            <div class="testimonial-header">
                @if($testimonial->user && $testimonial->user->profile_photo)
                    <img src="{{ route('me.photo') }}?user_id={{ $testimonial->user_id }}" 
                         alt="{{ $testimonial->name }}" 
                         class="testimonial-avatar"
                         onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                    <div class="testimonial-avatar-placeholder" style="display:none;">
                        {{ strtoupper(substr($testimonial->name ?? 'U', 0, 1)) }}
                    </div>
                @elseif($testimonial->avatar_path)
                    <img src="{{ Storage::url($testimonial->avatar_path) }}" 
                         alt="{{ $testimonial->name }}" 
                         class="testimonial-avatar"
                         onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                    <div class="testimonial-avatar-placeholder" style="display:none;">
                        {{ strtoupper(substr($testimonial->name ?? 'U', 0, 1)) }}
                    </div>
                @else
                    <div class="testimonial-avatar-placeholder">
                        {{ strtoupper(substr($testimonial->name ?? 'U', 0, 1)) }}
                    </div>
                @endif
                <div class="testimonial-info">
                    <div class="testimonial-name">{{ $testimonial->name ?? 'Anonymous' }}</div>
                    <div class="testimonial-date">
                        <i class="far fa-calendar me-1"></i>
                        {{ $testimonial->created_at?->format('M d, Y') }}
                    </div>
                </div>
            </div>
            <div class="testimonial-quote">
                {{ $testimonial->quote }}
            </div>
            @if($filter === 'mine')
                <span class="testimonial-status {{ $testimonial->is_active ? 'status-approved' : 'status-pending' }}">
                    {{ $testimonial->is_active ? 'Approved' : 'Pending Review' }}
                </span>
            @endif
        </div>
        @endforeach
    </div>

    <div style="margin-top: 2rem;">
        {{ $testimonials->links() }}
    </div>
    @else
    <div class="empty-state">
        <i class="fas fa-quote-left"></i>
        <h3>No testimonials found</h3>
        <p>{{ $filter === 'mine' ? 'You haven\'t submitted any testimonials yet.' : 'Be the first to share your experience!' }}</p>
        @auth
        <a href="{{ route('testimonials.create') }}" class="btn-primary" style="margin-top: 1rem;">
            <i class="fas fa-plus me-1"></i>Share Your Testimonial
        </a>
        @endauth
    </div>
    @endif
</div>
@endsection