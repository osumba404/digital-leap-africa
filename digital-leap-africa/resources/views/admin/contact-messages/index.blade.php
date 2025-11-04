@extends('admin.layout')

@section('title', 'Contact Messages')

@section('admin-content')
<div class="admin-header">
    <h1>Contact Messages</h1>
    <div class="admin-stats">
        <span class="stat-badge">{{ $messages->total() }} Total</span>
        <span class="stat-badge unread">{{ $messages->where('is_read', false)->count() }} Unread</span>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="admin-card">
    <div class="table-responsive">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Subject</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($messages as $message)
                    <tr class="{{ !$message->is_read ? 'unread-row' : '' }}">
                        <td>
                            <div class="user-info">
                                <strong>{{ $message->name }}</strong>
                                @if(!$message->is_read)
                                    <span class="new-badge">NEW</span>
                                @endif
                            </div>
                        </td>
                        <td>{{ $message->email }}</td>
                        <td>{{ Str::limit($message->subject, 40) }}</td>
                        <td>{{ $message->created_at->format('M j, Y') }}</td>
                        <td>
                            @if($message->admin_reply)
                                <span class="status-badge replied">Replied</span>
                            @elseif($message->is_read)
                                <span class="status-badge read">Read</span>
                            @else
                                <span class="status-badge unread">Unread</span>
                            @endif
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('admin.contact-messages.show', $message) }}" class="btn-sm btn-primary">
                                    <i class="fas fa-eye"></i> View
                                </a>
                                <form action="{{ route('admin.contact-messages.destroy', $message) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No messages found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $messages->links() }}
</div>

<style>
.admin-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
}

.admin-stats {
    display: flex;
    gap: 1rem;
}

.stat-badge {
    background: rgba(59, 130, 246, 0.1);
    color: #3b82f6;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.875rem;
    font-weight: 600;
}

.stat-badge.unread {
    background: rgba(239, 68, 68, 0.1);
    color: #ef4444;
}

.unread-row {
    background: rgba(59, 130, 246, 0.05);
}

.user-info {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.new-badge {
    background: #ef4444;
    color: white;
    padding: 0.125rem 0.5rem;
    border-radius: 10px;
    font-size: 0.75rem;
    font-weight: 600;
}

.status-badge {
    padding: 0.25rem 0.75rem;
    border-radius: 12px;
    font-size: 0.75rem;
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

.action-buttons {
    display: flex;
    gap: 0.5rem;
}

.btn-sm {
    padding: 0.375rem 0.75rem;
    font-size: 0.875rem;
    border-radius: 6px;
    text-decoration: none;
    border: none;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 0.25rem;
}

.btn-primary {
    background: #3b82f6;
    color: white;
}

.btn-danger {
    background: #ef4444;
    color: white;
}
</style>
@endsection