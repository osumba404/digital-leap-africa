@extends('emails.base')

@section('content')
<div class="greeting">Hello {{ $user->name }},</div>

<div class="message">
    <p>A new article has been published on Digital Leap Africa.</p>
</div>

<div class="info-box">
    <h3>{{ $article->title }}</h3>
    @if(!empty($article->excerpt))
        <p style="margin: 0;">{{ Str::limit(strip_tags($article->excerpt), 220) }}</p>
    @endif
</div>

<div style="text-align: center; margin: 24px 0;">
    <a href="{{ route('blog.show', $article->slug) }}" class="cta-button">Read Article</a>
</div>

<div class="message">
    <p>Stay informed with the latest insights and updates from our community.</p>
</div>
@endsection
