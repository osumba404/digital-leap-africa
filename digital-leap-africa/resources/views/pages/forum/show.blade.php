@extends('layouts.app')

@section('content')
<style>
.thread-container {
    max-width: 900px;
    margin: 0 auto;
}

.thread-post {
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: var(--radius);
    padding: 2rem;
    margin-bottom: 2rem;
}

.reply-post {
    background: rgba(255, 255, 255, 0.02);
    border: 1px solid rgba(255, 255, 255, 0.05);
    border-radius: var(--radius);
    padding: 1.5rem;
    margin-bottom: 1rem;
    margin-left: 2rem;
    position: relative;
}

.reply-post::before {
    content: '';
    position: absolute;
    left: -2rem;
    top: 1.5rem;
    width: 1rem;
    height: 2px;
    background: var(--cool-gray);
    opacity: 0.3;
}

.post-header {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1rem;
    flex-wrap: wrap;
}

.user-avatar {
    width: 40px;
    height: 40px;
    background: var(--primary-blue);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    color: var(--diamond-white);
    flex-shrink: 0;
}

.post-meta {
    flex-grow: 1;
}

.post-author {
    color: var(--cyan-accent);
    font-weight: 600;
    font-size: 1.1rem;
    margin-bottom: 0.25rem;
}

.post-time {
    color: var(--cool-gray);
    font-size: 0.9rem;
}

.post-content {
    color: var(--cool-gray);
    line-height: 1.7;
    font-size: 1.05rem;
}

.reply-form {
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: var(--radius);
    padding: 2rem;
    margin-top: 2rem;
}

.breadcrumb {
    color: var(--cool-gray);
    margin-bottom: 2rem;
    font-size: 0.9rem;
}

.breadcrumb a {
    color: var(--cyan-accent);
    text-decoration: none;
}

.breadcrumb a:hover {
    text-decoration: underline;
}

.thread-stats {
    display: flex;
    gap: 2rem;
    margin-bottom: 1rem;
    color: var(--cool-gray);
    font-size: 0.9rem;
}

.stat-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

@media (max-width: 768px) {
    .reply-post {
        margin-left: 1rem;
    }
    
    .reply-post::before {
        left: -1rem;
        width: 0.5rem;
    }
    
    .post-header {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .thread-stats {
        flex-direction: column;
        gap: 0.5rem;
    }
}
</style>

<div class="container">
    <div class="thread-container">
        {{-- Breadcrumb --}}
        <div class="breadcrumb">
            <a href="{{ route('forum.index') }}">Community Forum</a>
            <span class="mx-2">›</span>
            <span>{{ $thread->title }}</span>
        </div>

        {{-- Original Thread Post --}}
        <div class="thread-post">
            <div class="post-header">
                <div class="user-avatar">
                    {{ strtoupper(substr($thread->user->name, 0, 1)) }}
                </div>
                <div class="post-meta">
                    <div class="post-author">{{ $thread->user->name }}</div>
                    <div class="post-time">
                        <i class="fas fa-clock me-1"></i>{{ $thread->created_at->format('M j, Y \a\t g:i A') }}
                    </div>
                </div>
                <div class="thread-stats">
                    <div class="stat-item">
                        <i class="fas fa-comments"></i>
                        <span>{{ $thread->replies->count() }} replies</span>
                    </div>
                </div>
            </div>
            
            <h1 style="font-size: 1.75rem; font-weight: 600; color: var(--diamond-white); margin-bottom: 1.5rem;">
                {{ $thread->title }}
            </h1>
            
            <div class="post-content">
                {!! nl2br(e($thread->content ?? $thread->body ?? '')) !!}
            </div>
        </div>

        {{-- Replies --}}
        @if($thread->replies->count() > 0)
            <div style="margin-bottom: 2rem;">
                <h3 style="color: var(--diamond-white); font-size: 1.25rem; margin-bottom: 1.5rem;">
                    <i class="fas fa-comments me-2"></i>Replies ({{ $thread->replies->count() }})
                </h3>
                
                @foreach ($thread->replies as $reply)
                    <div class="reply-post">
                        <div class="post-header">
                            <div class="user-avatar">
                                {{ strtoupper(substr($reply->user->name, 0, 1)) }}
                            </div>
                            <div class="post-meta">
                                <div class="post-author">{{ $reply->user->name }}</div>
                                <div class="post-time">
                                    <i class="fas fa-clock me-1"></i>{{ $reply->created_at->format('M j, Y \a\t g:i A') }}
                                </div>
                            </div>
                        </div>
                        
                        <div class="post-content">
                            {!! nl2br(e($reply->content ?? $reply->body ?? '')) !!}
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        {{-- Reply Form --}}
        @auth
            <div class="reply-form">
                <h3 style="color: var(--diamond-white); font-size: 1.25rem; margin-bottom: 1.5rem;">
                    <i class="fas fa-reply me-2"></i>Post a Reply
                </h3>
                
                <form method="POST" action="{{ route('forum.reply', $thread) }}">
                    @csrf
                    <div class="form-group">
                        <textarea 
                            name="content" 
                            class="form-control" 
                            rows="5" 
                            placeholder="Write your reply here..."
                            required
                        >{{ old('content') }}</textarea>
                    </div>
                    
                    <div style="display: flex; gap: 1rem; justify-content: flex-end;">
                        <button type="submit" class="btn-primary" style="padding: 0.75rem 1.5rem;">
                            <i class="fas fa-paper-plane me-2"></i>Post Reply
                        </button>
                    </div>
                </form>
            </div>
        @else
            <div class="reply-form">
                <div style="text-align: center;">
                    <h3 style="color: var(--diamond-white); margin-bottom: 1rem;">Join the Discussion</h3>
                    <p style="color: var(--cool-gray); margin-bottom: 2rem;">Log in to reply to this thread and engage with the community.</p>
                    <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                        <a href="{{ route('login') }}" class="btn-primary" style="padding: 0.75rem 1.5rem;">
                            <i class="fas fa-sign-in-alt me-2"></i>Log In
                        </a>
                        <a href="{{ route('register') }}" class="btn-outline" style="padding: 0.75rem 1.5rem;">
                            <i class="fas fa-user-plus me-2"></i>Sign Up
                        </a>
                    </div>
                </div>
            </div>
        @endauth

        {{-- Navigation --}}
        <div style="margin-top: 2rem; text-align: center;">
            <a href="{{ route('forum.index') }}" class="btn-outline" style="padding: 0.75rem 1.5rem;">
                <i class="fas fa-arrow-left me-2"></i>Back to Forum
            </a>
        </div>
    </div>
</div>
@endsection