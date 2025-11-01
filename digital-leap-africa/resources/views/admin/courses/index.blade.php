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

.btn-view {
    background: rgba(16, 185, 129, 0.1);
    color: #10b981;
    border: 1px solid rgba(16, 185, 129, 0.3);
}

.btn-view:hover {
    background: rgba(16, 185, 129, 0.2);
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

[data-theme="light"] .btn-view {
    background: rgba(16, 185, 129, 0.1);
    color: #059669;
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

[data-theme="light"] .data-table td a {
    color: #2563eb !important;
}

[data-theme="light"] td[style*="color: var(--cool-gray)"] {
    color: #6b7280 !important;
}

[data-theme="light"] td i.fas {
    color: #6b7280 !important;
}

.course-info {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.course-image {
    width: 50px;
    height: 50px;
    object-fit: cover;
    border-radius: 6px;
    flex-shrink: 0;
}

.course-placeholder {
    width: 50px;
    height: 50px;
    background: rgba(0, 201, 255, 0.1);
    border-radius: 6px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

[data-theme="light"] .course-placeholder {
    background: rgba(46, 120, 197, 0.1);
}

.course-title {
    font-weight: 600;
    color: var(--diamond-white);
    margin-bottom: 0.25rem;
}

.course-description {
    font-size: 0.85rem;
    color: var(--cool-gray);
    line-height: 1.4;
}

[data-theme="light"] .course-title {
    color: #1a202c !important;
}

[data-theme="light"] .course-description {
    color: #6b7280 !important;
}
</style>
@endpush

@section('admin-content')
<div class="page-header">
    <h1 class="page-title">Manage Courses</h1>
    <div class="page-actions">
        <a href="{{ route('admin.courses.create') }}" class="btn-primary" style="padding: 0.5rem 1rem; font-size: 0.9rem;">
            <i class="fas fa-plus me-2"></i>Add New Course
        </a>
    </div>
</div>

@if($courses->count() > 0)
<div class="table-responsive">
    <table class="data-table">
        <thead>
            <tr>
                <th>Course</th>
                <th>Instructor</th>
                <th>Level</th>
                <th>Status</th>
                <th>Created</th>
                <th style="width: 300px;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($courses as $course)
            <tr>
                <td>
                    <div class="course-info">
                        @if($course->image_url)
                            <img src="{{ $course->image_url }}" alt="{{ $course->title }}" class="course-image">
                        @else
                            <div class="course-placeholder">
                                <i class="fas fa-graduation-cap" style="color: var(--cyan-accent);"></i>
                            </div>
                        @endif
                        <div>
                            <div class="course-title">{{ $course->title }}</div>
                            <div class="course-description">{{ Str::limit($course->description, 50) }}</div>
                        </div>
                    </div>
                </td>
                <td>{{ $course->instructor ?? 'Not assigned' }}</td>
                <td>
                    @if($course->level)
                        <span class="status-badge status-{{ $course->level }}">{{ ucfirst($course->level) }}</span>
                    @endif
                </td>
                <td>
                    <span class="status-badge status-active">Active</span>
                </td>
                <td>{{ $course->created_at->format('M j, Y') }}</td>
                <td>
                    <div class="action-buttons">
                        <a href="{{ route('admin.courses.manage', $course) }}" class="btn-sm btn-view">
                            <i class="fas fa-eye"></i>View
                        </a>
                        <a href="{{ route('admin.courses.enrollments', $course) }}" class="btn-sm btn-edit">
                            <i class="fas fa-users"></i>Enrollments
                        </a>
                        <a href="{{ route('admin.courses.edit', $course) }}" class="btn-sm btn-edit">
                            <i class="fas fa-edit"></i>Edit
                        </a>
                        <form method="POST" action="{{ route('admin.courses.destroy', $course) }}" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-sm btn-delete" 
                                    onclick="return confirm('Are you sure you want to delete this course?')">
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
    <i class="fas fa-graduation-cap" style="font-size: 3rem; color: var(--cool-gray); opacity: 0.5; margin-bottom: 1rem; display: block;"></i>
    <h3 style="color: var(--cool-gray); margin-bottom: 0.75rem; font-size: 1.15rem;">No Courses Yet</h3>
    <p style="color: var(--cool-gray); margin-bottom: 1.5rem; font-size: 0.9rem;">Start building your course catalog by adding your first course.</p>
    <a href="{{ route('admin.courses.create') }}" class="btn-primary" style="padding: 0.6rem 1.5rem; font-size: 0.95rem;">
        <i class="fas fa-plus me-2"></i>Create First Course
    </a>
</div>
@endif
@endsection