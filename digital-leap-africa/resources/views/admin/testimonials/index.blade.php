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

.btn-approve {
    background: rgba(16, 185, 129, 0.1);
    color: #10b981;
    border: 1px solid rgba(16, 185, 129, 0.3);
}

.btn-approve:hover {
    background: rgba(16, 185, 129, 0.2);
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

[data-theme="light"] .btn-approve {
    background: rgba(16, 185, 129, 0.1);
    color: #059669;
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

.filter-buttons {
    display: flex;
    gap: 0.5rem;
}

.filter-buttons .btn-outline {
    padding: 0.4rem 0.75rem;
    font-size: 0.85rem;
}
</style>
@endpush

@section('admin-content')
<div class="page-header">
    <h1 class="page-title">Testimonials Moderation</h1>
    <div class="page-actions filter-buttons">
        <a href="{{ route('admin.testimonials.index', ['status' => 'pending']) }}" class="btn-outline">Pending</a>
        <a href="{{ route('admin.testimonials.index', ['status' => 'approved']) }}" class="btn-outline">Approved</a>
        <a href="{{ route('admin.testimonials.index', ['status' => 'all']) }}" class="btn-outline">All</a>
    </div>
</div>

@if(session('success'))
    <div class="success-message">{{ session('success') }}</div>
@endif

<div class="table-responsive">
    <table class="data-table">
        <thead>
            <tr>
                <th>User</th>
                <th>Quote</th>
                <th>Status</th>
                <th>Submitted</th>
                <th style="width:280px">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($testimonials as $t)
            <tr>
                <td>{{ $t->name ?? ($t->user->name ?? 'User') }}</td>
                <td>{{ \Illuminate\Support\Str::limit($t->quote, 100) }}</td>
                <td>
                    @if($t->is_active)
                        <span class="status-badge status-active">Approved</span>
                    @else
                        <span class="status-badge status-draft">Pending</span>
                    @endif
                </td>
                <td>{{ $t->created_at?->format('M d, Y') }}</td>
                <td>
                    <div class="action-buttons">
                        @if(!$t->is_active)
                        <form method="POST" action="{{ route('admin.testimonials.approve', $t) }}" style="display:inline;">
                            @csrf
                            @method('PATCH')
                            <button class="btn-sm btn-approve" type="submit">
                                <i class="fas fa-check"></i>Approve
                            </button>
                        </form>
                        @else
                        <form method="POST" action="{{ route('admin.testimonials.unpublish', $t) }}" style="display:inline;">
                            @csrf
                            @method('PATCH')
                            <button class="btn-sm btn-edit" type="submit">
                                <i class="fas fa-eye-slash"></i>Unpublish
                            </button>
                        </form>
                        @endif
                        <form method="POST" action="{{ route('admin.testimonials.destroy', $t) }}" style="display:inline;" onsubmit="return confirm('Delete this testimonial?')">
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
                    <i class="fas fa-quote-left" style="font-size: 2rem; opacity: 0.5; display: block; margin-bottom: 0.5rem;"></i>
                    No testimonials found.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div style="margin-top:1rem;">
    {{ $testimonials->links() }}
</div>
@endsection
