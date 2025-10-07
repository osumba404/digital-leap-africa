@extends('admin.layout')

@section('admin-content')
<div class="page-header">
    <h1 class="page-title">Manage Jobs</h1>
    <div class="page-actions">
        <a href="{{ route('admin.jobs.create') }}" class="btn-primary">
            <i class="fas fa-plus me-2"></i>Add New Job
        </a>
    </div>
</div>

@if($jobs->count() > 0)
<table class="data-table">
    <thead>
        <tr>
            <th>Job Title</th>
            <th>Company</th>
            <th>Location</th>
            <th>Type</th>
            <th>Posted</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($jobs as $job)
        <tr>
            <td>
                <div>
                    <div style="font-weight: 600;">{{ $job->title }}</div>
                    <div style="font-size: 0.9rem; color: var(--cool-gray);">{{ Str::limit($job->description, 50) }}</div>
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
                <div style="display: flex; gap: 0.5rem; flex-wrap: wrap;">
                    <a href="{{ route('admin.jobs.edit', $job) }}" class="btn btn-sm btn-outline" style="padding: 0.5rem 1rem;">
                        <i class="fas fa-edit me-1"></i>Edit
                    </a>
                    <form method="POST" action="{{ route('admin.jobs.destroy', $job) }}" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm" style="background: #dc3545; color: white; padding: 0.5rem 1rem; border: 1px solid #dc3545;" 
                                onclick="return confirm('Are you sure you want to delete this job?')">
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
    <i class="fas fa-briefcase" style="font-size: 4rem; color: var(--cool-gray); opacity: 0.5; margin-bottom: 1rem;"></i>
    <h3 style="color: var(--cool-gray); margin-bottom: 1rem;">No Jobs Posted</h3>
    <p style="color: var(--cool-gray); margin-bottom: 2rem;">Start building your job board by posting the first opportunity.</p>
    <a href="{{ route('admin.jobs.create') }}" class="btn-primary">
        <i class="fas fa-plus me-2"></i>Post First Job
    </a>
</div>
@endif
@endsection