@extends('layouts.app')

@section('content')
<div class="py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-8">
                <article class="bg-primary-light border border-dark-subtle rounded p-4">
                    <h1 class="mb-2">{{ $article->title }}</h1>
                    <div class="text-muted mb-3">
                        <small>
                            By {{ $article->author->name ?? 'Unknown' }}
                            @if($article->published_at)
                                - {{ $article->published_at->toFormattedDateString() }}
                            @endif
                        </small>
                    </div>

                    @if($article->featured_image_url)
                        <img class="img-fluid rounded mb-3" src="{{ $article->featured_image_url }}" alt="{{ $article->title }}">
                    @endif

                    <div class="article-content">
                        {!! nl2br(e($article->content)) !!}
                    </div>
                </article>

                <section class="mt-5">
                    <h2 class="h5 mb-3">Comments ({{ $article->comments->count() }})</h2>

                    @forelse($article->comments as $comment)
                        <div class="border-top border-dark-subtle py-3 d-flex gap-3">
                            <div class="flex-shrink-0">
                                <div class="rounded-circle bg-secondary" style="width:40px;height:40px;"></div>
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between align-items-center">
                                    <strong>{{ $comment->user->name ?? 'User' }}</strong>
                                    <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                                </div>
                                <p class="mb-0">{{ $comment->content }}</p>
                            </div>
                        </div>
                    @empty
                        <p class="text-muted">No comments yet.</p>
                    @endforelse

                    @auth
                        <div class="mt-4">
                            <form method="POST" action="{{ route('blog.comments.store', $article) }}">
                                @csrf
                                <div class="mb-3">
                                    <label for="comment" class="form-label">Add a comment</label>
                                    <textarea id="comment" name="content" rows="3" class="form-control @error('content') is-invalid @enderror" placeholder="Write your comment..."></textarea>
                                    @error('content')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <x-primary-button type="submit">Post Comment</x-primary-button>
                            </form>
                        </div>
                    @else
                        <div class="alert alert-info mt-3">
                            Please <a href="{{ route('login') }}" class="alert-link">log in</a> to post a comment.
                        </div>
                    @endauth
                </section>
            </div>

            <div class="col-lg-4">
                <aside>
                    <div class="bg-primary-light border border-dark-subtle rounded p-3">
                        <h3 class="h6">Related Articles</h3>
                        <ul class="list-unstyled mb-0">
                            @forelse($related as $r)
                                <li class="py-2 border-bottom border-dark-subtle">
                                    <a href="{{ route('blog.show', $r) }}" class="text-decoration-none">{{ $r->title }}</a>
                                </li>
                            @empty
                                <li class="py-2 text-muted">No related articles.</li>
                            @endforelse
                        </ul>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</div>
@endsection