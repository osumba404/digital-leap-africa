@extends('admin.layout')

@section('title', 'Event Management')

@push('styles')
<style>
.action-buttons {
    display: flex;
    gap: 0.5rem;
    flex-wrap: wrap;
}

.btn-sm {
    padding: 0.4rem 0.75rem;
    font-size: 0.8rem;
    border-radius: 6px;
    text-decoration: none;
    border: none;
    cursor: pointer;
    transition: all 0.2s;
    display: inline-flex;
    align-items: center;
    gap: 0.25rem;
    white-space: nowrap;
}

.btn-edit {
    background: rgba(59, 130, 246, 0.1);
    color: #3b82f6;
    border: 1px solid rgba(59, 130, 246, 0.3);
}

.btn-edit:hover {
    background: rgba(59, 130, 246, 0.2);
}

.btn-delete {
    background: rgba(239, 68, 68, 0.1);
    color: #ef4444;
    border: 1px solid rgba(239, 68, 68, 0.3);
}

.btn-delete:hover {
    background: rgba(239, 68, 68, 0.2);
}

[data-theme="light"] .btn-edit {
    background: rgba(59, 130, 246, 0.1);
    color: #2563eb;
}

[data-theme="light"] .btn-delete {
    background: rgba(239, 68, 68, 0.1);
    color: #dc2626;
}

/* CRITICAL: Light Mode Text Fixes */
[data-theme="light"] .data-table td,
[data-theme="light"] .data-table td * {
    color: #1a202c !important;
}

[data-theme="light"] .data-table td i {
    color: inherit !important;
}

.event-title {
    font-weight: 600;
    color: var(--diamond-white);
    margin-bottom: 0.25rem;
}

.event-description {
    font-size: 0.85rem;
    color: var(--cool-gray);
    line-height: 1.4;
}

[data-theme="light"] .event-title {
    color: #1a202c !important;
}

[data-theme="light"] .event-description {
    color: #6b7280 !important;
}
</style>
@endpush

@section('admin-content')
<div class="page-header">
    <h1 class="page-title">Manage Events</h1>
    <div class="page-actions">
        <a href="{{ route('admin.events.create') }}" class="btn-primary" style="padding: 0.5rem 1rem; font-size: 0.9rem;">
            <i class="fas fa-plus me-2"></i>Add New Event
        </a>
    </div>
</div>

@if($events->count() > 0)
<div class="table-responsive">
    <table class="data-table">
        <thead>
            <tr>
                <th>Event</th>
                <th>Date & Time</th>
                <th>Location</th>
                <th>Status</th>
                <th>Created</th>
                <th style="width: 180px;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($events as $event)
            <tr>
                <td>
                    <div>
                        <div class="event-title">{{ $event->title }}</div>
                        <div class="event-description">{{ Str::limit($event->description ?? '', 50) }}</div>
                    </div>
                </td>
                <td>
                    @if($event->date)
                        {{ is_string($event->date) ? \Carbon\Carbon::parse($event->date)->format('M j, Y H:i') : $event->date->format('M j, Y H:i') }}
                    @else
                        —
                    @endif
                </td>
                <td>{{ $event->location ?? 'TBD' }}</td>
                <td>
                    <span class="status-badge status-active">Active</span>
                </td>
                <td>{{ $event->created_at->format('M j, Y') }}</td>
                <td>
                    <div class="action-buttons">
                        <a href="{{ route('admin.events.edit', $event) }}" class="btn-sm btn-edit">
                            <i class="fas fa-edit"></i>Edit
                        </a>
                        <form method="POST" action="{{ route('admin.events.destroy', $event) }}" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-sm btn-delete" 
                                    onclick="return confirm('Are you sure you want to delete this event?')">
                                <i class="fas fa-trash"></i>Delete
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@else
<div style="text-align: center; padding: 3rem 0;">
    <i class="fas fa-calendar-alt" style="font-size: 3rem; color: var(--cool-gray); opacity: 0.5; margin-bottom: 1rem; display: block;"></i>
    <h3 style="color: var(--cool-gray); margin-bottom: 0.75rem; font-size: 1.15rem;">No Events Yet</h3>
    <p style="color: var(--cool-gray); margin-bottom: 1.5rem; font-size: 0.9rem;">Start building your events calendar by creating the first event.</p>
    <a href="{{ route('admin.events.create') }}" class="btn-primary" style="padding: 0.6rem 1.5rem; font-size: 0.95rem;">
        <i class="fas fa-plus me-2"></i>Create First Event
    </a>
</div>
@endif
@endsection