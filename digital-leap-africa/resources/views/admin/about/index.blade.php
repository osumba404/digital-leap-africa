@extends('admin.layout')

@section('title', 'About Page Management')

@section('admin-content')
    <div class="page-header">
        <h1 class="page-title">About Page Management</h1>
        <div class="page-actions">
            <a href="{{ route('admin.about.sections.create') }}" class="status-badge status-active" title="Add a new about section">Add New Section</a>
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
                        <div class="page-actions">
                            <a href="{{ route('admin.about.sections.edit', $section) }}" class="status-badge">Edit</a>
                            <form action="{{ route('admin.about.sections.destroy', $section) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="status-badge status-draft" onclick="return confirm('Delete this section?')">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">No sections found.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection