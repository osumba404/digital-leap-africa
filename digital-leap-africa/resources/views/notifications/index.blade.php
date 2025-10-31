@extends('layouts.app')

@section('title', 'Notifications')

@push('styles')
<style>
.notifications-container {
    max-width: 900px;
    margin: 2rem auto;
    padding: 0 1rem;
}

.notifications-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
}

.notifications-title {
    font-size: 2rem;
    font-weight: 700;
    background: linear-gradient(90deg, var(--cyan-accent), var(--purple-accent));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.notification-card {
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 12px;
    padding: 1.5rem;
    margin-bottom: 1rem;
    transition: all 0.3s;
    display: flex;
    gap: 1rem;
}

.notification-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
    border-color: rgba(0, 201, 255, 0.2);
}

.notification-card.unread {
    background: rgba(0, 201, 255, 0.05);
    border-left: 4px solid var(--cyan-accent);
}

/* Light mode */
[data-theme="light"] .notifications-title {
    background: linear-gradient(90deg, #2E78C5, #7c4dff);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

[data-theme="light"] .notification-card {
    background: #FFFFFF;
    border: 1px solid rgba(46, 120, 197, 0.2);
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.05);
}

[data-theme="light"] .notification-card.unread {
    background: rgba(46, 120, 197, 0.05);
    border-left: 4px solid #2E78C5;
}
</style>
@endpush

@section('content')
<div class="notifications-container">
    <div class="notifications-header">
        <h1 class="notifications-title">All Notifications</h1>
        @if($notifications->where('is_read', false)->count() > 0)
            <a href="#" class="btn-outline" onclick="markAllAsRead(event)">Mark all as read</a>
        @endif
    </div>

    @forelse($notifications as $notification)
        <div class="notification-card {{ !$notification->is_read ? 'unread' : '' }}">
            <div class="notification-icon {{ $notification->type }}">
                @if($notification->type === 'course_enrollment')
                    <i class="fas fa-graduation-cap"></i>
                @elseif($notification->type === 'badge_earned')
                    <i class="fas fa-medal"></i>
                @elseif($notification->type === 'testimonial_approved')
                    <i class="fas fa-check-circle"></i>
                @elseif($notification->type === 'forum_reply')
                    <i class="fas fa-comment"></i>
                @elseif($notification->type === 'new_course')
                    <i class="fas fa-book"></i>
                @elseif($notification->type === 'new_article')
                    <i class="fas fa-newspaper"></i>
                @elseif($notification->type === 'lesson_completed')
                    <i class="fas fa-check-circle"></i>
                @elseif($notification->type === 'course_completed')
                    <i class="fas fa-trophy"></i>
                @elseif($notification->type === 'new_event')
                    <i class="fas fa-calendar-alt"></i>
                @elseif($notification->type === 'payment_success')
                    <i class="fas fa-check-circle"></i>
                @endif
            </div>
            <div style="flex: 1;">
                <h3 style="margin-bottom: 0.5rem; color: var(--diamond-white);">{{ $notification->title }}</h3>
                <p style="color: var(--cool-gray); margin-bottom: 0.5rem;">{{ $notification->message }}</p>
                <small style="color: var(--cool-gray);">{{ $notification->created_at->diffForHumans() }}</small>
                @if($notification->url)
                    <a href="{{ $notification->url }}" class="btn-outline btn-sm" style="margin-top: 0.5rem; display: inline-block;">View</a>
                @endif
            </div>
        </div>
    @empty
        <div style="text-align: center; padding: 4rem 2rem; color: var(--cool-gray);">
            <i class="fas fa-bell-slash" style="font-size: 4rem; margin-bottom: 1rem; opacity: 0.3;"></i>
            <p>No notifications yet</p>
        </div>
    @endforelse

    {{ $notifications->links() }}
</div>
@endsection