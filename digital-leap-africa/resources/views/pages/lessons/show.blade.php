@extends('layouts.app')

@section('content')
<style>
.lesson-container {
    max-width: 900px;
    margin: 0 auto;
}

.lesson-header {
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: var(--radius);
    padding: 2rem;
    margin-bottom: 2rem;
}

.lesson-content {
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: var(--radius);
    padding: 2rem;
    margin-bottom: 2rem;
}

.video-container {
    position: relative;
    width: 100%;
    height: 0;
    padding-bottom: 56.25%; /* 16:9 aspect ratio */
    margin-bottom: 2rem;
    border-radius: var(--radius);
    overflow: hidden;
}

.video-container iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border: none;
}

.lesson-text {
    color: var(--cool-gray);
    line-height: 1.8;
    font-size: 1.1rem;
}

.lesson-text h1, .lesson-text h2, .lesson-text h3 {
    color: var(--diamond-white);
    margin-top: 2rem;
    margin-bottom: 1rem;
}

.lesson-text h1 { font-size: 2rem; }
.lesson-text h2 { font-size: 1.5rem; }
.lesson-text h3 { font-size: 1.25rem; }

.lesson-text p {
    margin-bottom: 1.5rem;
}

.lesson-text ul, .lesson-text ol {
    margin-bottom: 1.5rem;
    padding-left: 2rem;
}

.lesson-text li {
    margin-bottom: 0.5rem;
}

.completion-section {
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: var(--radius);
    padding: 2rem;
    text-align: center;
}

.completed-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    background: rgba(16, 185, 129, 0.2);
    color: #10b981;
    padding: 1rem 2rem;
    border-radius: var(--radius);
    font-weight: 600;
    font-size: 1.1rem;
}

.breadcrumb {
    color: var(--cool-gray);
    margin-bottom: 1rem;
    font-size: 0.9rem;
}

.breadcrumb a {
    color: var(--cyan-accent);
    text-decoration: none;
}

.breadcrumb a:hover {
    text-decoration: underline;
}
</style>

<div class="container">
    <div class="lesson-container">
        {{-- Breadcrumb --}}
        <div class="breadcrumb">
            <a href="{{ route('courses.show', $lesson->topic->course) }}">{{ $lesson->topic->course->title }}</a>
            <span class="mx-2">›</span>
            <span>{{ $lesson->topic->title }}</span>
            <span class="mx-2">›</span>
            <span>{{ $lesson->title }}</span>
        </div>

        {{-- Lesson Header --}}
        <div class="lesson-header">
            <h1 style="font-size: 2rem; font-weight: 700; color: var(--diamond-white); margin-bottom: 0.5rem;">
                {{ $lesson->title }}
            </h1>
            <p style="color: var(--cyan-accent); font-weight: 500; margin: 0;">
                <i class="fas fa-folder me-2"></i>{{ $lesson->topic->title }}
            </p>
        </div>

        {{-- Video Content --}}
        @if($lesson->type === 'video' && $lesson->video_url)
            <div class="lesson-content">
                <div class="video-container">
                    @php
                        // Extract YouTube video ID from various URL formats
                        $videoId = null;
                        if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $lesson->video_url, $matches)) {
                            $videoId = $matches[1];
                        }
                    @endphp
                    
                    @if($videoId)
                        <iframe src="https://www.youtube.com/embed/{{ $videoId }}" 
                                title="{{ $lesson->title }}" 
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                allowfullscreen>
                        </iframe>
                    @else
                        <div style="background: var(--charcoal); display: flex; align-items: center; justify-content: center; height: 100%; color: var(--cool-gray);">
                            <div style="text-align: center;">
                                <i class="fas fa-video" style="font-size: 3rem; margin-bottom: 1rem;"></i>
                                <p>Video content not available</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @endif

        {{-- Text Content --}}
        @if($lesson->content)
            <div class="lesson-content">
                <div class="lesson-text">
                    {!! nl2br(e($lesson->content)) !!}
                </div>
            </div>
        @endif

        {{-- Code Snippets --}}
        @php $snippets = (array) ($lesson->code_snippet ?? []); @endphp
        @if(!empty($snippets))
            <div class="lesson-content">
                <h3 style="color: var(--diamond-white); margin-bottom: 1rem;">Code Snippets</h3>
                <div class="d-flex flex-column gap-3">
                    @foreach($snippets as $i => $snippet)
                        @if(filled($snippet))
                            <div>
                                <div style="color: var(--cool-gray); font-weight: 600; margin-bottom: .5rem;">Snippet {{ $i+1 }}</div>
                                <pre style="background: #0b1220; color: #cbd5e1; padding: 1rem; border-radius: 8px; overflow:auto;"><code>{{ $snippet }}</code></pre>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        @endif

        {{-- Resource Files --}}
        @php $resources = (array) ($lesson->resource_url ?? []); @endphp
        @if(!empty($resources))
            <div class="lesson-content">
                <h3 style="color: var(--diamond-white); margin-bottom: 1rem;">Resources</h3>
                <ul style="list-style: disc; padding-left: 1.25rem; color: var(--cool-gray);">
                    @foreach($resources as $url)
                        @if(filled($url))
                            <li>
                                <a href="{{ $url }}" target="_blank" rel="noopener" class="lesson-link">
                                    <i class="fas fa-file-arrow-down me-2"></i>{{ basename(parse_url($url, PHP_URL_PATH) ?? $url) }}
                                </a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Attachments (Images) --}}
        @php $attachments = (array) ($lesson->attachment_path ?? []); @endphp
        @if(!empty($attachments))
            <div class="lesson-content">
                <h3 style="color: var(--diamond-white); margin-bottom: 1rem;">Attachments</h3>
                <div style="display:flex; flex-wrap: wrap; gap: .75rem;">
                    @foreach($attachments as $img)
                        @if(filled($img))
                            <a href="{{ $img }}" target="_blank" rel="noopener">
                                <img src="{{ $img }}" alt="Attachment" style="height:120px; border-radius: 8px;">
                            </a>
                        @endif
                    @endforeach
                </div>
            </div>
        @endif

        {{-- Completion Section --}}
        <div class="completion-section">
            @if(Auth::check() && Auth::user()->lessons()->where('lesson_id', $lesson->id)->exists())
                <div class="completed-badge">
                    <i class="fas fa-check-circle"></i>
                    <span>Lesson Completed!</span>
                </div>
                <p style="color: var(--cool-gray); margin-top: 1rem; margin-bottom: 0;">Great job! You've successfully completed this lesson.</p>
            @else
                <h3 style="color: var(--diamond-white); margin-bottom: 1rem;">Ready to mark this lesson as complete?</h3>
                <p style="color: var(--cool-gray); margin-bottom: 2rem;">Once you've finished reviewing the content, mark it as complete to track your progress.</p>
                @auth
                    <form method="POST" action="{{ route('lessons.complete', $lesson) }}" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn-primary" style="padding: 0.75rem 2rem; font-size: 1.1rem;">
                            <i class="fas fa-check me-2"></i>Mark as Complete
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn-primary" style="padding: 0.75rem 2rem; font-size: 1.1rem;">
                        <i class="fas fa-sign-in-alt me-2"></i>Log in to mark complete
                    </a>
                @endauth
            @endif
            
            <div style="margin-top: 2rem; padding-top: 2rem; border-top: 1px solid rgba(255, 255, 255, 0.1);">
                <a href="{{ route('courses.show', $lesson->topic->course) }}" class="btn-outline" style="padding: 0.75rem 1.5rem;">
                    <i class="fas fa-arrow-left me-2"></i>Back to Course
                </a>
            </div>
        </div>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div style="background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.3); color: #10b981; padding: 1rem; border-radius: var(--radius); margin: 1rem 0; text-align: center;">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        </div>
    @endif
</div>
@endsection