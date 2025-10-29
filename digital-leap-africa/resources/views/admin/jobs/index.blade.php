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

.job-title {
    font-weight: 600;
    color: var(--diamond-white);
    margin-bottom: 0.25rem;
}

.job-description {
    font-size: 0.85rem;
    color: var(--cool-gray);
    line-height: 1.4;
}

[data-theme="light"] .job-title {
    color: #1a202c !important;
}

[data-theme="light"] .job-description {
    color: #6b7280 !important;
}
</style>
@endpush

@section('admin-content')
<div class="page-header">
    <h1 class="page-title">Manage Jobs</h1>
    <div class="page-actions">
        <a href="{{ route('admin.jobs.create') }}" class="btn-primary" style="padding: 0.5rem 1rem; font-size: 0.9rem;">
            <i class="fas fa-plus me-2"></i>Add New Job
        </a>
    </div>
</div>

@if($jobs->count() > 0)
<div class="table-responsive">
    <table class="data-table">
        <thead>
            <tr>
                <th>Job Title</th>
                <th>Company</th>
                <th>Location</th>
                <th>Type</th>
                <th>Posted</th>
                <th style="width: 180px;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jobs as $job)
            <tr>
                <td>
                    <div>
                        <div class="job-title">{{ $job->title }}</div>
                        <div class="job-description">{{ Str::limit($job->description, 50) }}</div>
                    </div>
                </td>
                <td>{{ $job->company }}</td>
                <td>{{ $job->location ?? 'Remote' }}</td>
                <td>
                    @if($job->job_type)
                        <span class="status-badge status-active">{{ ucfirst($job->job_type) }}</span>
                    @endif
                </td>
                <td>{{ $job->created_at->format('M j, Y') }}</td>
                <td>
                    <div class="action-buttons">
                        <a href="{{ route('admin.jobs.edit', $job) }}" class="btn-sm btn-edit">
                            <i class="fas fa-edit"></i>Edit
                        </a>
                        <form method="POST" action="{{ route('admin.jobs.destroy', $job) }}" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-sm btn-delete" 
                                    onclick="return confirm('Are you sure you want to delete this job?')">
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
    <i class="fas fa-briefcase" style="font-size: 3rem; color: var(--cool-gray); opacity: 0.5; margin-bottom: 1rem; display: block;"></i>
    <h3 style="color: var(--cool-gray); margin-bottom: 0.75rem; font-size: 1.15rem;">No Jobs Posted</h3>
    <p style="color: var(--cool-gray); margin-bottom: 1.5rem; font-size: 0.9rem;">Start building your job board by posting the first opportunity.</p>
    <a href="{{ route('admin.jobs.create') }}" class="btn-primary" style="padding: 0.6rem 1.5rem; font-size: 0.95rem;">
        <i class="fas fa-plus me-2"></i>Post First Job
    </a>
</div>
@endif
@endsection