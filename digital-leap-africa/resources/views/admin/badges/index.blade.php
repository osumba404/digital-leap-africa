@extends('admin.layout')

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

.btn-primary {
    background: rgba(59, 130, 246, 0.1);
    color: #3b82f6;
    border: 1px solid rgba(59, 130, 246, 0.3);
}

.btn-primary:hover {
    background: rgba(59, 130, 246, 0.2);
}

.btn-assign {
    background: rgba(139, 92, 246, 0.1);
    color: #8b5cf6;
    border: 1px solid rgba(139, 92, 246, 0.3);
}

.btn-assign:hover {
    background: rgba(139, 92, 246, 0.2);
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

.badge-image {
    width: 40px;
    height: 40px;
    object-fit: cover;
    border-radius: 8px;
    border: 2px solid rgba(0, 201, 255, 0.3);
}

.badge-placeholder {
    width: 40px;
    height: 40px;
    border-radius: 8px;
    background: linear-gradient(135deg, rgba(0, 201, 255, 0.2), rgba(138, 43, 226, 0.2));
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--cyan-accent);
    font-size: 1.2rem;
}

.user-count {
    display: inline-flex;
    align-items: center;
    gap: 0.25rem;
    padding: 0.25rem 0.5rem;
    background: rgba(0, 201, 255, 0.1);
    border: 1px solid rgba(0, 201, 255, 0.3);
    border-radius: 4px;
    font-size: 0.85rem;
    color: var(--cyan-accent);
}

[data-theme="light"] .btn-primary,
[data-theme="light"] .btn-edit {
    background: rgba(59, 130, 246, 0.1);
    color: #2563eb;
}

[data-theme="light"] .btn-assign {
    background: rgba(139, 92, 246, 0.1);
    color: #7c3aed;
}

[data-theme="light"] .btn-delete {
    background: rgba(239, 68, 68, 0.1);
    color: #dc2626;
}

[data-theme="light"] .data-table td,
[data-theme="light"] .data-table td * {
    color: #1a202c !important;
}

[data-theme="light"] .badge-image {
    border-color: rgba(46, 120, 197, 0.3);
}

[data-theme="light"] .badge-placeholder {
    background: linear-gradient(135deg, rgba(46, 120, 197, 0.2), rgba(139, 92, 246, 0.2));
    color: #2563eb;
}

[data-theme="light"] .user-count {
    background: rgba(46, 120, 197, 0.1);
    border-color: rgba(46, 120, 197, 0.3);
    color: #2563eb;
}
</style>
@endpush

@section('admin-content')
<div class="page-header">
    <h1 class="page-title">Badges Management</h1>
    <div class="page-actions">
        <a href="{{ route('admin.badges.create') }}" class="btn-primary">
            <i class="fas fa-plus"></i> Create Badge
        </a>
    </div>
</div>

@if(session('success'))
    <div class="success-message">{{ session('success') }}</div>
@endif

<div class="table-responsive">
    <table class="data-table">
        <thead>
            <tr>
                <th style="width:60px">Image</th>
                <th>Badge Name</th>
                <th>Description</th>
                <th style="width:120px">Users</th>
                <th style="width:280px">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($badges as $badge)
            <tr>
                <td>
                    @if($badge->img_url)
                        <img src="{{ $badge->img_url }}" alt="{{ $badge->badge_name }}" class="badge-image">
                    @else
                        <div class="badge-placeholder">
                            <i class="fas fa-medal"></i>
                        </div>
                    @endif
                </td>
                <td><strong>{{ $badge->badge_name }}</strong></td>
                <td>{{ \Illuminate\Support\Str::limit($badge->description ?? 'No description', 80) }}</td>
                <td>
                    <span class="user-count">
                        <i class="fas fa-users"></i>
                        {{ $badge->users_count ?? 0 }}
                    </span>
                </td>
                <td>
                    <div class="action-buttons">
                        <a href="{{ route('admin.badges.assign', $badge) }}" class="btn-sm btn-assign">
                            <i class="fas fa-user-plus"></i>Assign
                        </a>
                        <a href="{{ route('admin.badges.edit', $badge) }}" class="btn-sm btn-edit">
                            <i class="fas fa-edit"></i>Edit
                        </a>
                        <form method="POST" action="{{ route('admin.badges.destroy', $badge) }}" style="display:inline;" onsubmit="return confirm('Delete this badge? This will remove it from all users.')">
                            @csrf
                            @method('DELETE')
                            <button class="btn-sm btn-delete" type="submit">
                                <i class="fas fa-trash"></i>Delete
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align: center; padding: 2rem; color: var(--cool-gray);">
                    <i class="fas fa-medal" style="font-size: 2rem; opacity: 0.5; display: block; margin-bottom: 0.5rem;"></i>
                    No badges found. Create your first badge!
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div style="margin-top:1rem;">
    {{ $badges->links() }}
</div>
@endsection