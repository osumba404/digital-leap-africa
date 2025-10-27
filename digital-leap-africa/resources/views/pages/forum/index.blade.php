@extends('layouts.app')

@section('content')
<style>
.forum-container {
    max-width: 900px;
    margin: 0 auto;
}

.thread-card {
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: var(--radius);
    padding: 1.5rem;
    margin-bottom: 1rem;
    transition: transform 0.2s, box-shadow 0.2s;
}

.thread-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
}

.thread-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 1rem;
    gap: 1rem;
}

.thread-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: var(--diamond-white);
    text-decoration: none;
    margin-bottom: 0.5rem;
    display: block;
}

.thread-title:hover {
    color: var(--cyan-accent);
}

.thread-meta {
    color: var(--cool-gray);
    font-size: 0.9rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    flex-wrap: wrap;
}

.thread-author {
    color: var(--cyan-accent);
    font-weight: 500;
}

.thread-content {
    color: var(--cool-gray);
    line-height: 1.6;
    margin-bottom: 1rem;
}

.reply-count {
    background: rgba(0, 201, 255, 0.2);
    color: var(--cyan-accent);
    padding: 0.25rem 0.75rem;
    border-radius: 999px;
    font-size: 0.8rem;
    font-weight: 500;
    white-space: nowrap;
}

.forum-stats {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1rem;
    margin-bottom: 2rem;
}

.stat-card {
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: var(--radius);
    padding: 1.5rem;
    text-align: center;
}

.stat-number {
    font-size: 2rem;
    font-weight: 700;
    color: var(--cyan-accent);
    display: block;
}

.stat-label {
    color: var(--cool-gray);
    font-size: 0.9rem;
    margin-top: 0.5rem;
}

@media (max-width: 768px) {
    .thread-header {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .thread-meta {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.25rem;
    }
}
</style>

<div class="container">
    <div class="forum-container">
        <div style="display: flex; align-items: center; justify-content: space-between; gap: 1rem; margin-bottom: 3rem; flex-wrap: wrap;">
            <div style="text-align: left;">
                <h1 style="font-size: 2.5rem; font-weight: 700; margin-bottom: 0.5rem;">Community Forum</h1>
                <p style="color: var(--cool-gray); font-size: 1.1rem; margin: 0;">Connect, discuss, and learn with fellow community members</p>
            </div>
            <div>
                @auth
                    <a href="{{ route('forum.create') }}" class="btn-primary" style="padding: 0.75rem 1.5rem; white-space: nowrap;">
                        <i class="fas fa-plus me-2"></i>Start Discussion
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn-primary" style="padding: 0.75rem 1.5rem; white-space: nowrap;">
                        <i class="fas fa-sign-in-alt me-2"></i>Login to Participate
                    </a>
                @endauth
            </div>
        </div>

        {{-- Forum Stats --}}
        <div class="forum-stats">
            <div class="stat-card">
                <span class="stat-number">{{ $threads->total() ?? $threads->count() }}</span>
                <div class="stat-label">Total Discussions</div>
            </div>
            <div class="stat-card">
                <span class="stat-number">{{ $threads->sum('replies_count') }}</span>
                <div class="stat-label">Total Replies</div>
            </div>
            <div class="stat-card">
                <span class="stat-number">{{ $threads->unique('user_id')->count() }}</span>
                <div class="stat-label">Active Members</div>
            </div>
        </div>

        {{-- Threads List --}}
        @if($threads->count() > 0)
            <div>
                @foreach ($threads as $thread)
                    <div class="thread-card">
                        <div class="thread-header">
                            <div style="flex-grow: 1; display:flex; gap:.75rem; align-items:flex-start;">
                                <div style="flex:0 0 auto;">
                                    @if(optional($thread->user)->profile_photo_url)
                                        <img src="{{ $thread->user->profile_photo_url }}" alt="{{ $thread->user->name }}" style="width:40px;height:40px;border-radius:50%;object-fit:cover;display:block;">
                                    @else
                                        <div style="width:40px;height:40px;border-radius:50%;background: var(--charcoal);color:#fff;display:flex;align-items:center;justify-content:center;font-weight:700;">
                                            {{ strtoupper(substr($thread->user->name, 0, 1)) }}
                                        </div>
                                    @endif
                                </div>
                                <div style="min-width:0;">
                                    <a href="{{ route('forum.show', $thread->id) }}" class="thread-title">
                                        {{ $thread->title }}
                                    </a>
                                    <div class="thread-meta">
                                        <i class="fas fa-user"></i>
                                        <span class="thread-author">{{ $thread->user->name }}</span>
                                        <span>•</span>
                                        <i class="fas fa-clock"></i>
                                        <span>{{ $thread->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="reply-count">
                                <i class="fas fa-comments me-1"></i>{{ $thread->replies_count }}
                            </div>
                        </div>

                        <div class="thread-content">
                            {{ Str::limit($thread->content ?? $thread->body ?? '', 200) }}
                        </div>

                        @if($thread->latestReply)
                            <div style="padding-top: 1rem; border-top: 1px solid rgba(255, 255, 255, 0.1); color: var(--cool-gray); font-size: 0.9rem; display:flex; align-items:center; gap:.5rem;">
                                <i class="fas fa-reply me-1"></i>
                                @php $lrUser = $thread->latestReply->user; @endphp
                                @if(optional($lrUser)->profile_photo_url)
                                    <img src="{{ $lrUser->profile_photo_url }}" alt="{{ $lrUser->name }}" style="width:20px;height:20px;border-radius:50%;object-fit:cover;">
                                @else
                                    <span style="width:20px;height:20px;border-radius:50%;background: var(--charcoal);color:#fff;display:inline-flex;align-items:center;justify-content:center;font-size:.75rem;font-weight:700;">{{ strtoupper(substr($lrUser->name,0,1)) }}</span>
                                @endif
                                <span>Latest reply by <span style="color: var(--cyan-accent);">{{ $lrUser->name }}</span> {{ $thread->latestReply->created_at->diffForHumans() }}</span>
                            </div>
                        @endif

                    </div>
                @endforeach

                {{-- Pagination --}}
                @if(method_exists($threads, 'links'))
                    <div style="margin-top: 2rem; display: flex; justify-content: center;">
                        {{ $threads->links() }}
                    </div>
                @endif
            </div>
        @else
            <div style="text-align: center; padding: 4rem 0;">
                <i class="fas fa-comments" style="font-size: 4rem; color: var(--cool-gray); opacity: 0.5; margin-bottom: 1rem;"></i>
                <h3 style="color: var(--cool-gray); margin-bottom: 1rem;">No Discussions Yet</h3>
                <p style="color: var(--cool-gray); margin-bottom: 2rem;">Be the first to start a conversation in our community forum!</p>
                @auth
                    <a href="{{ route('forum.create') }}" class="btn-primary" style="padding: 0.75rem 1.5rem;">
                        <i class="fas fa-plus me-2"></i>Start Discussion
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn-primary" style="padding: 0.75rem 1.5rem;">
                        <i class="fas fa-sign-in-alt me-2"></i>Login to Participate
                    </a>
                @endauth
            </div>
        @endif
    </div>
</div>
@endsection