@extends('admin.layout')

@section('admin-content')
<div class="page-header">
    <h1 class="page-title">Manage Events</h1>
    <div class="page-actions">
        <a href="{{ route('admin.events.create') }}" class="btn-primary">
            <i class="fas fa-plus me-2"></i>Add New Event
        </a>
    </div>
</div>

@if($events->count() > 0)
<table class="data-table">
    <thead>
        <tr>
            <th>Event</th>
            <th>Date & Time</th>
            <th>Location</th>
            <th>Status</th>
            <th>Created</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($events as $event)
        <tr>
            <td>
                <div>
                    <div style="font-weight: 600;">{{ $event->title }}</div>
                    <div style="font-size: 0.9rem; color: var(--cool-gray);">{{ Str::limit($event->description ?? '', 50) }}</div>
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
                <div style="display: flex; gap: 0.5rem; flex-wrap: wrap;">
                    <a href="{{ route('admin.events.edit', $event) }}" class="btn btn-sm btn-outline" style="padding: 0.5rem 1rem;">
                        <i class="fas fa-edit me-1"></i>Edit
                    </a>
                    <form method="POST" action="{{ route('admin.events.destroy', $event) }}" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm" style="background: #dc3545; color: white; padding: 0.5rem 1rem; border: 1px solid #dc3545;" 
                                onclick="return confirm('Are you sure you want to delete this event?')">
                            <i class="fas fa-trash me-1"></i>Delete
                        </button>
                    </form>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@else
<div style="text-align: center; padding: 4rem 0;">
    <i class="fas fa-calendar-alt" style="font-size: 4rem; color: var(--cool-gray); opacity: 0.5; margin-bottom: 1rem;"></i>
    <h3 style="color: var(--cool-gray); margin-bottom: 1rem;">No Events Yet</h3>
    <p style="color: var(--cool-gray); margin-bottom: 2rem;">Start building your events calendar by creating the first event.</p>
    <a href="{{ route('admin.events.create') }}" class="btn-primary">
        <i class="fas fa-plus me-2"></i>Create First Event
    </a>
</div>
@endif
@endsection