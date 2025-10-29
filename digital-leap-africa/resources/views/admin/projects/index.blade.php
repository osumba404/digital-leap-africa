@extends('admin.layout')
@section('title', 'Project Management')

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

.project-title {
    font-weight: 600;
    color: var(--diamond-white);
}

[data-theme="light"] .project-title {
    color: #1a202c !important;
}
</style>
@endpush

@section('admin-content')
<div class="page-header">
    <h1 class="page-title">Manage Projects</h1>
    <div class="page-actions">
        <a href="{{ route('admin.projects.create') }}" class="btn-primary" style="padding: 0.5rem 1rem; font-size: 0.9rem;">
            <i class="fas fa-plus me-2"></i>Add New Project
        </a>
    </div>
</div>

@if($projects->count() > 0)
<div class="table-responsive">
    <table class="data-table">
        <thead>
            <tr>
                <th>Project Title</th>
                <th style="width: 180px;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($projects as $project)
            <tr>
                <td>
                    <div class="project-title">{{ $project->title }}</div>
                </td>
                <td>
                    <div class="action-buttons">
                        <a href="{{ route('admin.projects.edit', $project) }}" class="btn-sm btn-edit">
                            <i class="fas fa-edit"></i>Edit
                        </a>
                        <form method="POST" action="{{ route('admin.projects.destroy', $project) }}" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-sm btn-delete" 
                                    onclick="return confirm('Are you sure you want to delete this project?')">
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
    <i class="fas fa-project-diagram" style="font-size: 3rem; color: var(--cool-gray); opacity: 0.5; margin-bottom: 1rem; display: block;"></i>
    <h3 style="color: var(--cool-gray); margin-bottom: 0.75rem; font-size: 1.15rem;">No Projects Yet</h3>
    <p style="color: var(--cool-gray); margin-bottom: 1.5rem; font-size: 0.9rem;">Start showcasing your work by adding your first project.</p>
    <a href="{{ route('admin.projects.create') }}" class="btn-primary" style="padding: 0.6rem 1.5rem; font-size: 0.95rem;">
        <i class="fas fa-plus me-2"></i>Add First Project
    </a>
</div>
@endif
@endsection