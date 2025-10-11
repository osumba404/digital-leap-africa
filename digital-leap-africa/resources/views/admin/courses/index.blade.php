@extends('admin.layout')

@section('admin-content')
<div class="page-header">
    <h1 class="page-title">Manage Courses</h1>
    <div class="page-actions">
        <a href="{{ route('admin.courses.create') }}" class="btn-primary">
            <i class="fas fa-plus me-2"></i>Add New Course
        </a>
    </div>
</div>

@if($courses->count() > 0)
<table class="data-table">
    <thead>
        <tr>
            <th>Course</th>
            <th>Instructor</th>
            <th>Level</th>
            <th>Status</th>
            <th>Created</th>
            <th>View</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($courses as $course)
        <tr>
            <td>
                <div style="display: flex; align-items: center; gap: 1rem;">
                    @if($course->image_url)
                        <img src="{{ $course->image_url }}" alt="{{ $course->title }}" 
                             style="width: 50px; height: 50px; object-fit: cover; border-radius: 8px;">
                    @else
                        <div style="width: 50px; height: 50px; background: rgba(0, 201, 255, 0.1); border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-graduation-cap" style="color: var(--cyan-accent);"></i>
                        </div>
                    @endif
                    <div>
                        <div style="font-weight: 600;">{{ $course->title }}</div>
                        <div style="font-size: 0.9rem; color: var(--cool-gray);">{{ Str::limit($course->description, 50) }}</div>
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
                <a href="{{ route('admin.courses.manage', $course) }}" class="btn btn-sm btn-primary" style="padding: 0.5rem 1rem;">
                    <i class="fas fa-eye me-1"></i>View
                </a>
            </td>
            <td>
                <div style="display: flex; gap: 0.5rem; flex-wrap: wrap;">
                    <a href="{{ route('admin.courses.edit', $course) }}" class="btn btn-sm btn-outline" style="padding: 0.5rem 1rem;">
                        <i class="fas fa-edit me-1"></i>Edit
                    </a>
                    <form method="POST" action="{{ route('admin.courses.destroy', $course) }}" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm" style="background: #dc3545; color: white; padding: 0.5rem 1rem; border: 1px solid #dc3545;" 
                                onclick="return confirm('Are you sure you want to delete this course?')">
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
    <i class="fas fa-graduation-cap" style="font-size: 4rem; color: var(--cool-gray); opacity: 0.5; margin-bottom: 1rem;"></i>
    <h3 style="color: var(--cool-gray); margin-bottom: 1rem;">No Courses Yet</h3>
    <p style="color: var(--cool-gray); margin-bottom: 2rem;">Start building your course catalog by adding your first course.</p>
    <a href="{{ route('admin.courses.create') }}" class="btn-primary">
        <i class="fas fa-plus me-2"></i>Create First Course
    </a>
</div>
@endif
@endsection