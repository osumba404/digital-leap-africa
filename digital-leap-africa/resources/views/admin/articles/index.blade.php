@extends('admin.layout')

@section('admin-content')
<div class="page-header">
    <h1 class="page-title">Manage Articles</h1>
    <div class="page-actions">
        <a href="{{ route('admin.articles.create') }}" class="btn-primary">
            <i class="fas fa-plus me-2"></i>Add New Article
        </a>
    </div>
</div>

@if($articles->count() > 0)
<table class="data-table">
    <thead>
        <tr>
            <th>Article</th>
            <th>Author</th>
            <th>Status</th>
            <th>Published</th>
            <th>Created</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($articles as $article)
        <tr>
            <td>
                <div>
                    <div style="font-weight: 600;">{{ $article->title }}</div>
                    <div style="font-size: 0.9rem; color: var(--cool-gray);">{{ Str::limit($article->excerpt ?? $article->content, 50) }}</div>
                </div>
            </td>
            <td>{{ $article->author->name ?? 'Unknown' }}</td>
            <td>
                @if($article->published_at)
                    <span class="status-badge status-active">Published</span>
                @else
                    <span class="status-badge status-draft">Draft</span>
                @endif
            </td>
            <td>{{ $article->published_at ? $article->published_at->format('M j, Y') : '—' }}</td>
            <td>{{ $article->created_at->format('M j, Y') }}</td>
            <td>
                <div style="display: flex; gap: 0.5rem; flex-wrap: wrap;">
                    <a href="{{ route('admin.articles.edit', $article) }}" class="btn btn-sm btn-outline" style="padding: 0.5rem 1rem;">
                        <i class="fas fa-edit me-1"></i>Edit
                    </a>
                    <form method="POST" action="{{ route('admin.articles.destroy', $article) }}" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm" style="background: #dc3545; color: white; padding: 0.5rem 1rem; border: 1px solid #dc3545;" 
                                onclick="return confirm('Are you sure you want to delete this article?')">
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
    <i class="fas fa-newspaper" style="font-size: 4rem; color: var(--cool-gray); opacity: 0.5; margin-bottom: 1rem;"></i>
    <h3 style="color: var(--cool-gray); margin-bottom: 1rem;">No Articles Yet</h3>
    <p style="color: var(--cool-gray); margin-bottom: 2rem;">Start building your blog by creating the first article.</p>
    <a href="{{ route('admin.articles.create') }}" class="btn-primary">
        <i class="fas fa-plus me-2"></i>Write First Article
    </a>
</div>
@endif
@endsection