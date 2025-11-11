@extends('layouts.app')

@section('content')
<style>
.thread-container {
    max-width: 1000px;
    margin: 0 auto;
}

.thread-post {
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 16px;
    padding: 2.5rem;
    margin-bottom: 2.5rem;
    transition: all 0.3s ease;
}

[data-theme="light"] .thread-post {
    background: #FFFFFF;
    border: 1px solid rgba(46, 120, 197, 0.2);
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.05);
}

.reply-post {
    background: rgba(255, 255, 255, 0.02);
    border: 1px solid rgba(255, 255, 255, 0.08);
    border-radius: 12px;
    padding: 1.75rem;
    margin-bottom: 1.25rem;
    margin-left: 3rem;
    position: relative;
    transition: all 0.3s ease;
}

[data-theme="light"] .reply-post {
    background: #F8FAFC;
    border: 1px solid rgba(46, 120, 197, 0.15);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.03);
}

.reply-post:hover {
    background: rgba(255, 255, 255, 0.04);
    border-color: rgba(0, 201, 255, 0.2);
}

[data-theme="light"] .reply-post:hover {
    background: #FFFFFF;
    border-color: rgba(46, 120, 197, 0.3);
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
    width: 50px;
    height: 50px;
    background: linear-gradient(135deg, var(--cyan-accent), var(--purple-accent));
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 1.2rem;
    color: #ffffff;
    flex-shrink: 0;
    border: 2px solid rgba(0, 201, 255, 0.3);
}

[data-theme="light"] .user-avatar {
    background: linear-gradient(135deg, var(--primary-blue), #6B46C1);
    border-color: rgba(46, 120, 197, 0.3);
}

.user-avatar img {
    width: 100%;
    height: 100%;
    border-radius: 50%;
    object-fit: cover;
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

[data-theme="light"] .post-author {
    color: var(--primary-blue);
}

.post-time {
    color: var(--cool-gray);
    font-size: 0.9rem;
}

.post-content {
    color: var(--cool-gray);
    line-height: 1.8;
    font-size: 1.05rem;
}

[data-theme="light"] .post-content {
    color: #4A5568;
}

.reply-form {
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 16px;
    padding: 2rem;
    margin-top: 2rem;
}

[data-theme="light"] .reply-form {
    background: #FFFFFF;
    border: 1px solid rgba(46, 120, 197, 0.2);
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.05);
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

[data-theme="light"] .breadcrumb {
    color: #4A5568;
}

[data-theme="light"] .breadcrumb a {
    color: var(--primary-blue);
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
                    @if($thread->user && $thread->user->profile_photo)
                        <img src="{{ route('me.photo', ['user_id' => $thread->user->id]) }}" alt="{{ $thread->user->name }}">
                    @else
                        {{ strtoupper(substr($thread->user->name ?? 'U', 0, 1)) }}
                    @endif
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
            
            <h1 style="font-size: 2rem; font-weight: 700; color: var(--diamond-white); margin-bottom: 1.5rem; line-height: 1.3;">
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
                                @if($reply->user && $reply->user->profile_photo)
                                    <img src="{{ route('me.photo', ['user_id' => $reply->user->id]) }}" alt="{{ $reply->user->name }}">
                                @else
                                    {{ strtoupper(substr($reply->user->name ?? 'U', 0, 1)) }}
                                @endif
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