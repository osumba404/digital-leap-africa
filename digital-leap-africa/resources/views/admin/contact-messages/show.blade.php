@extends('admin.layout')

@section('title', 'Contact Message')

@section('admin-content')
<div class="admin-header">
    <h1>Contact Message</h1>
    <a href="{{ route('admin.contact-messages.index') }}" class="btn-outline">
        <i class="fas fa-arrow-left"></i> Back to Messages
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="message-grid">
    <!-- Message Details -->
    <div class="admin-card">
        <div class="message-header">
            <div class="sender-info">
                <h2>{{ $contactMessage->name }}</h2>
                <p>{{ $contactMessage->email }}</p>
                <span class="message-date">{{ $contactMessage->created_at->format('M j, Y \a\t g:i A') }}</span>
            </div>
            <div class="message-status">
                @if($contactMessage->admin_reply)
                    <span class="status-badge replied">Replied</span>
                @elseif($contactMessage->is_read)
                    <span class="status-badge read">Read</span>
                @else
                    <span class="status-badge unread">Unread</span>
                @endif
            </div>
        </div>

        <div class="message-subject">
            <h3>{{ $contactMessage->subject }}</h3>
        </div>

        <div class="message-content">
            <h4>Message:</h4>
            <div class="message-text">
                {!! nl2br(e($contactMessage->message)) !!}
            </div>
        </div>

        @if($contactMessage->admin_reply)
            <div class="admin-reply-display">
                <h4>Your Reply:</h4>
                <div class="reply-text">
                    {!! nl2br(e($contactMessage->admin_reply)) !!}
                </div>
                <small class="reply-date">Replied on {{ $contactMessage->replied_at->format('M j, Y \a\t g:i A') }}</small>
            </div>
        @endif
    </div>

    <!-- Reply Form -->
    <div class="admin-card">
        <h3>{{ $contactMessage->admin_reply ? 'Update Reply' : 'Send Reply' }}</h3>
        
        <form action="{{ route('admin.contact-messages.reply', $contactMessage) }}" method="POST" class="reply-form">
            @csrf
            <div class="form-group">
                <label for="admin_reply">Reply Message</label>
                <textarea id="admin_reply" name="admin_reply" rows="8" placeholder="Type your reply here..." required>{{ old('admin_reply', $contactMessage->admin_reply) }}</textarea>
                @error('admin_reply')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-primary">
                    <i class="fas fa-reply"></i>
                    {{ $contactMessage->admin_reply ? 'Update Reply' : 'Send Reply' }}
                </button>
            </div>
        </form>
    </div>
</div>

<style>
.admin-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
}

.message-grid {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 2rem;
}

.message-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 1.5rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.sender-info h2 {
    margin: 0 0 0.25rem 0;
    color: var(--diamond-white);
}

.sender-info p {
    margin: 0 0 0.5rem 0;
    color: var(--cyan-accent);
}

.message-date {
    color: var(--cool-gray);
    font-size: 0.875rem;
}

.status-badge {
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.875rem;
    font-weight: 600;
}

.status-badge.unread {
    background: rgba(239, 68, 68, 0.1);
    color: #ef4444;
}

.status-badge.read {
    background: rgba(59, 130, 246, 0.1);
    color: #3b82f6;
}

.status-badge.replied {
    background: rgba(16, 185, 129, 0.1);
    color: #10b981;
}

.message-subject {
    margin-bottom: 1.5rem;
}

.message-subject h3 {
    color: var(--diamond-white);
    margin: 0;
    font-size: 1.25rem;
}

.message-content h4,
.admin-reply-display h4 {
    color: var(--diamond-white);
    margin: 0 0 0.75rem 0;
    font-size: 1rem;
}

.message-text,
.reply-text {
    background: rgba(255, 255, 255, 0.05);
    padding: 1rem;
    border-radius: 8px;
    color: var(--cool-gray);
    line-height: 1.6;
    margin-bottom: 0.5rem;
}

.admin-reply-display {
    margin-top: 2rem;
    padding-top: 1.5rem;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
}

.reply-date {
    color: var(--cool-gray);
    font-size: 0.875rem;
}

.reply-form .form-group {
    margin-bottom: 1.5rem;
}

.reply-form label {
    display: block;
    margin-bottom: 0.5rem;
    color: var(--diamond-white);
    font-weight: 600;
}

.reply-form textarea {
    width: 100%;
    padding: 0.75rem;
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 8px;
    background: rgba(255, 255, 255, 0.05);
    color: var(--diamond-white);
    font-size: 1rem;
    resize: vertical;
}

.reply-form textarea:focus {
    outline: none;
    border-color: var(--cyan-accent);
    box-shadow: 0 0 0 2px rgba(0, 201, 255, 0.2);
}

.error {
    color: #ef4444;
    font-size: 0.875rem;
    margin-top: 0.25rem;
    display: block;
}

.btn-primary {
    background: linear-gradient(135deg, var(--cyan-accent), var(--primary-blue));
    color: white;
    border: none;
    padding: 0.875rem 1.5rem;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(0, 201, 255, 0.3);
}

/* Light Mode */
[data-theme="light"] .message-header {
    border-bottom-color: rgba(46, 120, 197, 0.2);
}

[data-theme="light"] .sender-info h2,
[data-theme="light"] .message-subject h3,
[data-theme="light"] .message-content h4,
[data-theme="light"] .admin-reply-display h4,
[data-theme="light"] .reply-form label {
    color: var(--charcoal);
}

[data-theme="light"] .sender-info p {
    color: var(--primary-blue);
}

[data-theme="light"] .message-text,
[data-theme="light"] .reply-text {
    background: rgba(46, 120, 197, 0.05);
    color: var(--cool-gray);
}

[data-theme="light"] .reply-form textarea {
    background: #FFFFFF;
    border-color: rgba(46, 120, 197, 0.2);
    color: var(--charcoal);
}

[data-theme="light"] .admin-reply-display {
    border-top-color: rgba(46, 120, 197, 0.2);
}

/* Mobile Responsive */
@media (max-width: 768px) {
    .message-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }
    
    .message-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 1rem;
    }
    
    .admin-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 1rem;
    }
}
</style>
@endsection