@extends('admin.layout')

@section('title', 'Articles')

@section('header-actions')
    <a href="{{ route('admin.articles.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> New Article
    </a>
@endsection

@section('admin-content')
<div class="admin-card">
    <div class="admin-card-header">
        <h2>Articles</h2>
    </div>
    <div class="table-responsive">
        <table class="table table-dark table-striped align-middle">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Published</th>
                    <th>Created</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($articles as $article)
                <tr>
                    <td>{{ $article->title }}</td>
                    <td>{{ $article->author->name ?? '—' }}</td>
                    <td>
                        @if($article->published_at)
                            <span class="badge bg-success">{{ $article->published_at->toDateString() }}</span>
                        @else
                            <span class="badge bg-secondary">Draft</span>
                        @endif
                    </td>
                    <td>{{ $article->created_at->toDateString() }}</td>
                    <td class="text-end">
                        <a href="{{ route('admin.articles.edit', $article) }}" class="btn btn-sm btn-outline-info">Edit</a>
                        <form action="{{ route('admin.articles.destroy', $article) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this article?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">No articles yet.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-3">
        {{ $articles->links() }}
    </div>
</div>
@endsection
