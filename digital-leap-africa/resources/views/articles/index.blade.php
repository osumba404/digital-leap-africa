@extends('layouts.app')

@section('content')
<div class="py-5">
    <div class="container">
        <h1 class="mb-4">Blog</h1>

        @if($articles->count() === 0)
            <div class="alert alert-info">No articles published yet.</div>
        @else
            <div class="row g-4">
                @foreach($articles as $article)
                <div class="col-md-4">
                    <div class="card h-100 bg-primary-light border-dark-subtle">
                        @if($article->cover_image)
                            <img src="{{ $article->cover_image }}" class="card-img-top" alt="{{ $article->title }}">
                        @endif
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $article->title }}</h5>
                            <p class="card-text text-muted">{{ $article->excerpt ?? Str::limit(strip_tags($article->content), 120) }}</p>
                            <div class="mt-auto d-flex justify-content-between align-items-center">
                                <small class="text-secondary">{{ optional($article->published_at)->diffForHumans() }}</small>
                                <a href="{{ route('blog.show', $article) }}" class="btn btn-outline-primary btn-sm">Read</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="mt-4">
                {{ $articles->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
