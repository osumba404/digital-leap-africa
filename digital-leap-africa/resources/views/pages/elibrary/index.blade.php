@extends('layouts.app')

@section('content')
<style>
.library-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
    gap: 2rem;
    margin: 2rem 0;
}

.resource-card {
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: var(--radius);
    overflow: hidden;
    transition: transform 0.3s, box-shadow 0.3s;
    display: flex;
    flex-direction: column;
}

.resource-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
}

.resource-image {
    width: 100%;
    height: 200px;
    object-fit: cover;
    background: linear-gradient(135deg, var(--primary-blue), var(--deep-blue));
}

.resource-content {
    padding: 1.5rem;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
}

.resource-type {
    background: rgba(122, 95, 255, 0.2);
    color: var(--purple-accent);
    padding: 0.25rem 0.75rem;
    border-radius: 999px;
    font-size: 0.8rem;
    font-weight: 500;
    text-transform: uppercase;
    width: fit-content;
    margin-bottom: 1rem;
}

.resource-title {
    font-size: 1.25rem;
    font-weight: 600;
    margin-bottom: 1rem;
    color: var(--diamond-white);
}

.resource-description {
    color: var(--cool-gray);
    line-height: 1.6;
    margin-bottom: 1.5rem;
    flex-grow: 1;
}

.resource-meta {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: auto;
    padding-top: 1rem;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
}

.filter-tabs {
    display: flex;
    gap: 1rem;
    margin-bottom: 2rem;
    flex-wrap: wrap;
    justify-content: center;
}

.filter-tab {
    padding: 0.5rem 1rem;
    border-radius: 999px;
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.1);
    color: var(--cool-gray);
    text-decoration: none;
    transition: all 0.2s;
    font-weight: 500;
}

.filter-tab:hover,
.filter-tab.active {
    background: var(--cyan-accent);
    color: var(--navy-bg);
    border-color: var(--cyan-accent);
}

/* Light Mode Styles */
[data-theme="light"] .resource-card {
    background: #FFFFFF;
    border: 1px solid rgba(46, 120, 197, 0.2);
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.05);
}

[data-theme="light"] .resource-card:hover {
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
}

[data-theme="light"] .resource-title {
    color: #1A202C;
}

[data-theme="light"] .resource-description {
    color: #4A5568;
}

[data-theme="light"] .resource-meta {
    border-top-color: rgba(46, 120, 197, 0.1);
}

[data-theme="light"] .resource-meta span {
    color: #4A5568 !important;
}

[data-theme="light"] .filter-tab {
    background: #FFFFFF;
    border: 1px solid rgba(46, 120, 197, 0.2);
    color: #1A202C;
}

[data-theme="light"] .filter-tab:hover {
    background: rgba(46, 120, 197, 0.1);
    border-color: rgba(46, 120, 197, 0.4);
}

[data-theme="light"] .filter-tab.active {
    background: #2E78C5;
    color: #FFFFFF;
    border-color: #2E78C5;
}

[data-theme="light"] h1 {
    color: #1A202C;
}

[data-theme="light"] .container > div > p {
    color: #4A5568 !important;
}

[data-theme="light"] .resource-image {
    background: linear-gradient(135deg, #E8F4F8, #D6EAF8);
}
</style>

<div class="container">
    <div style="text-align: center; margin-bottom: 3rem;">
        <h1 style="font-size: 2.5rem; font-weight: 700; margin-bottom: 1rem;">Digital Library</h1>
        <p style="color: var(--cool-gray); font-size: 1.1rem;">Access a vast collection of learning resources, books, and materials</p>
    </div>

    {{-- Filter Tabs --}}
    <div class="filter-tabs">
        <a href="?type=all" class="filter-tab {{ request('type', 'all') === 'all' ? 'active' : '' }}">
            <i class="fas fa-th me-2"></i>All Resources
        </a>
        <a href="?type=book" class="filter-tab {{ request('type') === 'book' ? 'active' : '' }}">
            <i class="fas fa-book me-2"></i>Books
        </a>
        <a href="?type=video" class="filter-tab {{ request('type') === 'video' ? 'active' : '' }}">
            <i class="fas fa-video me-2"></i>Videos
        </a>
        <!-- <a href="?type=article" class="filter-tab {{ request('type') === 'article' ? 'active' : '' }}">
            <i class="fas fa-newspaper me-2"></i>Articles
        </a> -->
        <a href="?type=tutorial" class="filter-tab {{ request('type') === 'tutorial' ? 'active' : '' }}">
            <i class="fas fa-chalkboard-teacher me-2"></i>Tutorials
        </a>
    </div>

    @if($elibraryItems->count() > 0)
        <div class="library-grid">
            @foreach ($elibraryItems as $item)
                <div class="resource-card">
                    @if($item->image_url)
                        <img src="{{ $item->image_url }}" alt="{{ $item->title }}" class="resource-image">
                    @else
                        <div class="resource-image" style="display: flex; align-items: center; justify-content: center;">
                            @switch($item->type)
                                @case('book')
                                    <i class="fas fa-book" style="font-size: 3rem; color: var(--diamond-white); opacity: 0.3;"></i>
                                    @break
                                @case('video')
                                    <i class="fas fa-video" style="font-size: 3rem; color: var(--diamond-white); opacity: 0.3;"></i>
                                    @break
                                @case('article')
                                    <i class="fas fa-newspaper" style="font-size: 3rem; color: var(--diamond-white); opacity: 0.3;"></i>
                                    @break
                                @default
                                    <i class="fas fa-file-alt" style="font-size: 3rem; color: var(--diamond-white); opacity: 0.3;"></i>
                            @endswitch
                        </div>
                    @endif
                    
                    <div class="resource-content">
                        @if($item->type)
                            <span class="resource-type">{{ $item->type }}</span>
                        @endif
                        
                        <h3 class="resource-title">{{ $item->title }}</h3>
                        
                        <p class="resource-description">
                            {{ Str::limit($item->description, 120) }}
                        </p>
                        
                        <div class="resource-meta">
                            @if($item->author)
                                <span style="color: var(--cool-gray); font-size: 0.9rem;">
                                    <i class="fas fa-user me-1"></i>{{ $item->author }}
                                </span>
                            @endif
                            
                            @if($item->file_url)
                                <a href="{{ $item->file_url }}" target="_blank" class="btn-primary" style="padding: 0.5rem 1rem;">
                                    <i class="fas fa-external-link-alt me-2"></i>Access
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div style="text-align: center; padding: 4rem 0;">
            <i class="fas fa-book-open" style="font-size: 4rem; color: var(--cool-gray); opacity: 0.5; margin-bottom: 1rem;"></i>
            <h3 style="color: var(--cool-gray); margin-bottom: 1rem;">No Resources Available</h3>
            <p style="color: var(--cool-gray); margin-bottom: 2rem;">We're working on adding more resources to our library. Check back soon!</p>
            <a href="{{ route('courses.index') }}" class="btn-primary" style="padding: 0.75rem 1.5rem;">
                <i class="fas fa-graduation-cap me-2"></i>Explore Courses
            </a>
        </div>
    @endif
</div>
@endsection