@extends('admin.layout')

@section('admin-content')
<div class="page-header">
    <h1 class="page-title">Manage eLibrary</h1>
    <div class="page-actions">
        <a href="{{ route('admin.elibrary-resources.create') }}" class="btn-primary">
            <i class="fas fa-plus me-2"></i>Add New Resource
        </a>
    </div>
</div>

@if($elibraryItems->count() > 0)
<table class="data-table">
    <thead>
        <tr>
            <th>Resource</th>
            <th>Type</th>
            <th>Category</th>
            <th>Status</th>
            <th>Created</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($elibraryItems as $item)
        <tr>
            <td>
                <div>
                    <div style="font-weight: 600;">{{ $item->title }}</div>
                    <div style="font-size: 0.9rem; color: var(--cool-gray);">{{ Str::limit($item->description ?? '', 50) }}</div>
                </div>
            </td>
            <td>
                <span class="status-badge status-active">{{ ucfirst($item->type ?? 'Resource') }}</span>
            </td>
            <td>{{ $item->category ?? 'General' }}</td>
            <td>
                <span class="status-badge status-active">Active</span>
            </td>
            <td>{{ $item->created_at->format('M j, Y') }}</td>
            <td>
                <div style="display: flex; gap: 0.5rem; flex-wrap: wrap;">
                    <a href="{{ route('admin.elibrary-resources.edit', $item) }}" class="btn btn-sm btn-outline" style="padding: 0.5rem 1rem;">
                        <i class="fas fa-edit me-1"></i>Edit
                    </a>
                    <form method="POST" action="{{ route('admin.elibrary-resources.destroy', $item) }}" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm" style="background: #dc3545; color: white; padding: 0.5rem 1rem; border: 1px solid #dc3545;" 
                                onclick="return confirm('Are you sure you want to delete this resource?')">
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
    <i class="fas fa-book-reader" style="font-size: 4rem; color: var(--cool-gray); opacity: 0.5; margin-bottom: 1rem;"></i>
    <h3 style="color: var(--cool-gray); margin-bottom: 1rem;">No Resources Yet</h3>
    <p style="color: var(--cool-gray); margin-bottom: 2rem;">Start building your digital library by adding the first resource.</p>
    <a href="{{ route('admin.elibrary-resources.create') }}" class="btn-primary">
        <i class="fas fa-plus me-2"></i>Add First Resource
    </a>
</div>
@endif
@endsection