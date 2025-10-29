@extends('admin.layout')

@section('title', 'About Page Management')

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

[data-theme="light"] .data-table a {
    color: #2563eb;
}

.section-divider {
    margin: 2rem 0 1.5rem;
    padding-top: 2rem;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
}

[data-theme="light"] .section-divider {
    border-top-color: rgba(46, 120, 197, 0.2);
}

/* CRITICAL: Light Mode Text Fixes */
[data-theme="light"] .data-table td,
[data-theme="light"] .data-table td * {
    color: #1a202c !important;
}

[data-theme="light"] .data-table td i {
    color: inherit !important;
}

[data-theme="light"] .data-table td a {
    color: #2563eb !important;
}

[data-theme="light"] td[style*="color: var(--cool-gray)"] {
    color: #6b7280 !important;
}

[data-theme="light"] td i.fas {
    color: #6b7280 !important;
}
</style>
@endpush

@section('admin-content')
    <div class="page-header">
        <h1 class="page-title">About Page Management</h1>
        <div class="page-actions">
            <a href="{{ route('admin.about.sections.create') }}" class="btn-primary" style="padding: 0.5rem 1rem; font-size: 0.9rem;">
                <i class="fas fa-plus me-1"></i>Add New Section
            </a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Subtitle</th>
                    <th style="width: 160px;">Actions</th>
                </tr>
            </thead>
            <tbody>
            @forelse($sections as $section)
                <tr>
                    <td>{{ $section->title }}</td>
                    <td>{{ $section->subtitle }}</td>
                    <td>
                        <div class="action-buttons">
                            <a href="{{ route('admin.about.sections.edit', $section) }}" class="btn-sm btn-edit">
                                <i class="fas fa-edit"></i>Edit
                            </a>
                            <form action="{{ route('admin.about.sections.destroy', $section) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-sm btn-delete" onclick="return confirm('Delete this section?')">
                                    <i class="fas fa-trash"></i>Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" style="text-align: center; padding: 2rem; color: var(--cool-gray);">
                        <i class="fas fa-inbox" style="font-size: 2rem; opacity: 0.5; display: block; margin-bottom: 0.5rem;"></i>
                        No sections found.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="section-divider"></div>

    <div class="page-header">
        <h2 class="page-title" style="font-size: 1.25rem;">Team Members</h2>
        <div class="page-actions">
            <a href="{{ route('admin.about.team.create') }}" class="btn-primary" style="padding: 0.5rem 1rem; font-size: 0.9rem;">
                <i class="fas fa-user-plus me-1"></i>Add Team Member
            </a>
        </div>
    </div>
    <div class="table-responsive">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th style="width: 220px;">Actions</th>
                </tr>
            </thead>
            <tbody>
            @forelse($teamMembers as $member)
                <tr>
                    <td>{{ $member->name }}</td>
                    <td>{{ $member->role }}</td>
                    <td>{{ $member->email }}</td>
                    <td>
                        @if($member->is_active)
                            <span class="status-badge status-active">Active</span>
                        @else
                            <span class="status-badge">Inactive</span>
                        @endif
                    </td>
                    <td>
                        <div class="action-buttons">
                            <a href="{{ route('admin.about.team.edit', $member) }}" class="btn-sm btn-edit">
                                <i class="fas fa-edit"></i>Edit
                            </a>
                            <form action="{{ route('admin.about.team.destroy', $member) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-sm btn-delete" onclick="return confirm('Delete this team member?')">
                                    <i class="fas fa-trash"></i>Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align: center; padding: 2rem; color: var(--cool-gray);">
                        <i class="fas fa-users" style="font-size: 2rem; opacity: 0.5; display: block; margin-bottom: 0.5rem;"></i>
                        No team members found.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="section-divider"></div>

    <div class="page-header">
        <h2 class="page-title" style="font-size: 1.25rem;">Partners</h2>
        <div class="page-actions">
            <a href="{{ route('admin.about.partners.create') }}" class="btn-primary" style="padding: 0.5rem 1rem; font-size: 0.9rem;">
                <i class="fas fa-handshake me-1"></i>Add Partner
            </a>
        </div>
    </div>
    <div class="table-responsive">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Website</th>
                    <th>Status</th>
                    <th style="width: 220px;">Actions</th>
                </tr>
            </thead>
            <tbody>
            @forelse($partners as $partner)
                <tr>
                    <td>{{ $partner->name }}</td>
                    <td>
                        @if($partner->website_url)
                            <a href="{{ $partner->website_url }}" target="_blank">{{ $partner->website_url }}</a>
                        @endif
                    </td>
                    <td>
                        @if($partner->is_active)
                            <span class="status-badge status-active">Active</span>
                        @else
                            <span class="status-badge">Inactive</span>
                        @endif
                    </td>
                    <td>
                        <div class="action-buttons">
                            <a href="{{ route('admin.about.partners.edit', $partner) }}" class="btn-sm btn-edit">
                                <i class="fas fa-edit"></i>Edit
                            </a>
                            <form action="{{ route('admin.about.partners.destroy', $partner) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-sm btn-delete" onclick="return confirm('Delete this partner?')">
                                    <i class="fas fa-trash"></i>Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="text-align: center; padding: 2rem; color: var(--cool-gray);">
                        <i class="fas fa-handshake" style="font-size: 2rem; opacity: 0.5; display: block; margin-bottom: 0.5rem;"></i>
                        No partners found.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection