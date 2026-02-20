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
    /* border-radius: var(--radius); */
    border-radius: 3px;
    padding: 2rem;
    margin-bottom: 1rem;
}

.lesson-content {
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.1);
    /* border-radius: var(--radius); */
    border-radius: 3px;
    padding: 1.4rem;
    margin-bottom: 2rem;
}

/* Light mode support */
[data-theme="light"] .lesson-header,
[data-theme="light"] .lesson-content,
[data-theme="light"] .completion-section {
    background: #ffffff;
    border: 1px solid rgba(46, 120, 197, 0.2);
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.05);
}

[data-theme="light"] .breadcrumb {
    color: #64748b;
}

[data-theme="light"] .breadcrumb a {
    color: #2e78c5;
}

[data-theme="light"] .lesson-header h1 {
    color: #1e293b !important;
}

[data-theme="light"] .lesson-header p {
    color: #2e78c5 !important;
}

[data-theme="light"] .lesson-content h3 {
    color: #1e293b !important;
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

/* Content styling for Quill editor output */
.lesson-content-body {
    color: var(--diamond-white);
    line-height: 1.6;
    font-size: 1rem;
}

.lesson-content-body h1,
.lesson-content-body h2,
.lesson-content-body h3 {
    color: var(--diamond-white);
    margin-top: 1.4rem;
    margin-bottom: 0.5rem;
    font-weight: 600;
    line-height: 1;
}

.lesson-content-body h1:first-child,
.lesson-content-body h2:first-child,
.lesson-content-body h3:first-child {
    margin-top: 0;
}

.lesson-content-body h1 { font-size: 1.875rem; }
.lesson-content-body h2 { font-size: 1.5rem; }
.lesson-content-body h3 { font-size: 1.25rem; }

.lesson-content-body p {
    margin-bottom: 0.8rem;
    color: var(--cool-gray);
    line-height: 1.4;
    font-size: 0.8rem;
}

.lesson-content-body p:empty {
    margin-bottom: 0.5rem;
}

.lesson-content-body ul,
.lesson-content-body ol {
    margin-bottom: 1rem;
    padding-left: 1.5rem;
    color: var(--cool-gray);
    line-height: 1;
    font-size: 0.8rem;
}

.lesson-content-body ol {
    list-style-type: decimal;
}

.lesson-content-body ul {
    list-style-type: disc;
}

.lesson-content-body ol ol {
    list-style-type: lower-alpha;
}

.lesson-content-body ol ol ol {
    list-style-type: lower-roman;
}

.lesson-content-body ul ul {
    list-style-type: circle;
}

.lesson-content-body ul ul ul {
    list-style-type: square;
}

.lesson-content-body li {
    margin-bottom: 0.25rem;
    line-height: 1.6;
    font-size: 0.8rem;
}

.lesson-content-body li p {
    margin-bottom: 0.5rem;
}

.lesson-content-body li:last-child {
    margin-bottom: 0;
}

/* Handle excessive line breaks */
.lesson-content-body br {
    line-height: 0.5;
}

.lesson-content-body br + br {
    display: none;
}

.lesson-content-body p br:last-child {
    display: none;
}

.lesson-content-body blockquote {
    border-left: 4px solid var(--cyan-accent);
    padding-left: 1rem;
    margin: 1rem 0;
    color: var(--cool-gray);
    font-style: italic;
    font-size: 0.8rem;
}

.lesson-content-body a {
    color: var(--cyan-accent);
    text-decoration: underline;
}

.lesson-content-body a:hover {
    color: var(--purple-accent);
}

/* Images in content - prevent overflow */
.lesson-content-body img {
    max-width: 100%;
    height: auto;
    border-radius: 4px;
    border: 1px solid rgba(255, 255, 255, 0.1);
    margin: 1rem 0;
    display: block;
}

/* Video containers in content */
.lesson-content-body .video-container {
    position: relative;
    width: 100%;
    height: 0;
    padding-bottom: 56.25%; /* 16:9 aspect ratio */
    margin: 1.5rem 0;
    border-radius: 8px;
    overflow: hidden;
    background: #000;
}

.lesson-content-body .video-container iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border: none;
}

.lesson-content-body video {
    width: 100%;
    max-height: 400px;
    border-radius: 8px;
    background: #000;
    margin: 1.5rem 0;
}

/* Inline code */
code {
    background: rgba(0, 0, 0, 0.35);
    padding: 0.2rem 0.4rem;
    border-radius: 0.2rem;
    font-family: 'Courier New', monospace;   
    font-size: 0.8rem !important;
}

/* Code blocks inside code-wrap don't get inline styling */
.code-wrap code {
    background: transparent;
    padding: 0;
}

/* Light mode for content */
[data-theme="light"] .lesson-content-body {
    color: #1e293b;
}

[data-theme="light"] .lesson-content-body h1,
[data-theme="light"] .lesson-content-body h2,
[data-theme="light"] .lesson-content-body h3 {
    color: #1e293b;
}

[data-theme="light"] .lesson-content-body p,
[data-theme="light"] .lesson-content-body li,
[data-theme="light"] .lesson-content-body blockquote {
    color: #475569;
}

[data-theme="light"] .lesson-content-body ul,
[data-theme="light"] .lesson-content-body ol {
    color: #475569;
}

[data-theme="light"] .lesson-content-body img {
    border: 1px solid rgba(46, 120, 197, 0.2);
}

[data-theme="light"] .lesson-content-body .video-container {
    border: 1px solid rgba(46, 120, 197, 0.2);
}

[data-theme="light"] .lesson-content-body video {
    border: 1px solid rgba(46, 120, 197, 0.2);
}

[data-theme="light"] .lesson-content-body pre {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    color: #1e293b;
}

[data-theme="light"] code {
    background: #e2e8f0;
    color: #1e293b;
}

[data-theme="light"] .code-wrap code {
    background: transparent;
}

[data-theme="light"] .lesson-content-body blockquote {
    border-left-color: #2e78c5;
}

[data-theme="light"] .lesson-content-body a {
    color: #2e78c5;
}

[data-theme="light"] .lesson-content-body a:hover {
    color: #7c4dff;
}

/* Light mode tables */
[data-theme="light"] .lesson-content-body table {
    border: 1px solid rgba(46, 120, 197, 0.3);
}

[data-theme="light"] .lesson-content-body table td,
[data-theme="light"] .lesson-content-body table th {
    border: 1px solid rgba(46, 120, 197, 0.3);
}

[data-theme="light"] .lesson-content-body table th {
    background: rgba(46, 120, 197, 0.1);
    color: #1e293b;
}

[data-theme="light"] .lesson-content-body table tr:nth-child(even) {
    background: rgba(46, 120, 197, 0.05);
}

.completion-section {
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: var(--radius);
    padding: 2rem;
    text-align: center;
    font-size: 0.8rem;
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
}

.breadcrumb a:hover {
    text-decoration: underline;
}

/* Code editor vibes for code snippets section */
.code-wrap {
    position: relative;
    border: 1px solid rgba(255,255,255,.12);
    border-radius: 12px;
    overflow: hidden;
    background: #0b1220;
}

.code-topbar {
    display: flex;
    align-items: center;
    gap: .5rem;
    justify-content: space-between;
    padding: .5rem .75rem;
    background: linear-gradient(180deg,rgba(15,23,42,.85),rgba(2,6,23,.85));
    border-bottom: 1px solid rgba(148,163,184,.12);
}

.code-dots {
    display: flex;
    gap: .35rem;
}

.code-dot {
    width: .65rem;
    height: .65rem;
    border-radius: 50%;
}

.code-dot.red { background: #ff5f56; }
.code-dot.yellow { background: #ffbd2e; }
.code-dot.green { background: #27c93f; }

.code-badge {
    font-size: .8rem;
    background: rgba(99,102,241,.18);
    color: #a5b4fc;
    border: 1px solid rgba(99,102,241,.35);
    padding: .2rem .5rem;
    border-radius: .35rem;
}

.code-actions {
    display: flex;
    align-items: center;
    gap: .35rem;
    margin-left: auto;
}

.code-btn {
    appearance: none;
    border: 1px solid rgba(148,163,184,.25);
    background: rgba(148,163,184,.1);
    color: #e5e7eb;
    border-radius: .35rem;
    padding: .3rem .5rem;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: .35rem;
}

.code-btn:hover {
    background: rgba(148,163,184,.18);
}

.code-wrap pre {
    margin: 0;
    padding: 1rem;
    overflow: auto;
    font-size: 0.9rem;
    line-height: 1.5;
}

/* Light mode for code blocks */
[data-theme="light"] .code-wrap {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
}

[data-theme="light"] .code-topbar {
    background: linear-gradient(180deg, #e2e8f0, #cbd5e1);
    border-bottom: 1px solid #94a3b8;
}

[data-theme="light"] .code-badge {
    background: rgba(59, 130, 246, 0.1);
    color: #3b82f6;
    border: 1px solid rgba(59, 130, 246, 0.3);
}

[data-theme="light"] .code-btn {
    border: 1px solid #cbd5e1;
    background: #f1f5f9;
    color: #475569;
}

[data-theme="light"] .code-btn:hover {
    background: #e2e8f0;
}

[data-theme="light"] .code-wrap pre {
    background: #ffffff;
    color: #1e293b;
}

[data-theme="light"] .code-wrap pre code {
    color: #1e293b;
}

/* Resources */
.res-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill,minmax(260px,1fr));
    gap: 1rem;
}

.res-card {
    display: flex;
    flex-direction: column;
    border: 1px solid rgba(255,255,255,.1);
    border-radius: 10px;
    overflow: hidden;
    background: rgba(255,255,255,.03);
}

.res-preview {
    height: 180px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #0b1220;
}

.res-preview iframe {
    width: 100%;
    height: 100%;
    border: 0;
    background: #fff;
}

.res-icon {
    font-size: 2rem;
    color: #9ca3af;
}

.res-info {
    padding: .75rem;
}

.res-name {
    color: var(--diamond-white);
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    margin-bottom: .5rem;
}

.res-actions {
    display: flex;
    gap: .5rem;
}

/* Light mode for resources */
[data-theme="light"] .res-card {
    background: #ffffff;
    border: 1px solid rgba(46, 120, 197, 0.2);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
}

[data-theme="light"] .res-preview {
    background: #f8fafc;
}

[data-theme="light"] .res-name {
    color: #1e293b;
}

[data-theme="light"] .res-icon {
    color: #64748b;
}

[data-theme="light"] .completed-badge {
    background: rgba(16, 185, 129, 0.1);
    color: #059669;
}

[data-theme="light"] .completion-section h3 {
    color: #1e293b !important;
}

[data-theme="light"] .completion-section p {
    color: #64748b !important;
}

[data-theme="light"] .completion-section {
    border-top-color: #e2e8f0 !important;
}

/* Table styling */
.lesson-content-body table {
    border-collapse: collapse;
    width: calc(100% - 0rem);
    margin: 2.5rem 0;
    border: 1px solid rgba(255, 255, 255, 0.3);
    table-layout: fixed;
}

.lesson-content-body p + table,
.lesson-content-body ol + table,
.lesson-content-body ul + table,
.lesson-content-body h1 + table,
.lesson-content-body h2 + table,
.lesson-content-body h3 + table {
    margin-top: 3rem;
}

.lesson-content-body table td,
.lesson-content-body table th {
    border: 1px solid rgba(255, 255, 255, 0.3);
    padding: 12px 16px;
    text-align: left;
    vertical-align: top;
    word-wrap: break-word;
    word-break: break-word;
    white-space: normal;
    overflow-wrap: break-word;
    line-height: 1.5;
}

.lesson-content-body table th {
    background: rgba(255, 255, 255, 0.1);
    font-weight: 600;
    color: var(--diamond-white);
}

.lesson-content-body table tr:nth-child(even) {
    background: rgba(255, 255, 255, 0.05);
}

/* Mobile responsive */
@media (max-width: 768px) {
    .lesson-header,
    .lesson-content,
    .completion-section {
        padding: 1.25rem;
    }
    
    .lesson-header h1 {
        font-size: 1.5rem !important;
    }
    
    .lesson-content-body {
        font-size: 0.95rem;
    }
    
    .lesson-content-body table {
        font-size: 0.9rem;
    }
    
    .res-grid {
        grid-template-columns: 1fr;
    }
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


        
        {{-- Video File Content --}}
        @if($lesson->video_file_path)
            <div class="lesson-content">
                <video controls style="width: 100%; height: 500px; border-radius: 8px; background: #000; margin: 1.5rem 0;">
                    <source src="{{ $lesson->video_file_path }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>
        @endif

        {{-- Text Content --}}
        @if($lesson->content)
            <div class="lesson-content">
                <div class="lesson-content-body">
                    {!! $lesson->content !!}                    
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
                            <div class="code-wrap">
                                <div class="code-topbar">
                                    <div class="code-dots">
                                        <span class="code-dot red"></span>
                                        <span class="code-dot yellow"></span>
                                        <span class="code-dot green"></span>
                                    </div>
                                    <div class="code-actions">
                                        <button class="code-btn code-copy" type="button" title="Copy">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path></svg>
                                            <span class="d-none d-sm-inline">Copy</span>
                                        </button>
                                    </div>
                                </div>
                                <pre><code class="hljs">{{ $snippet }}</code></pre>
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
                <div class="res-grid">
                    @foreach($resources as $url)
                        @php
                            $path = parse_url($url, PHP_URL_PATH) ?? $url;
                            $name = basename($path);
                            $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
                        @endphp
                        @if(filled($url))
                            <div class="res-card">
                                <div class="res-preview">
                                    @if($ext === 'pdf')
                                        <iframe src="{{ $url }}#page=1&view=FitH" title="Preview {{ $name }}" loading="lazy"></iframe>
                                    @else
                                        <div class="res-icon"><i class="fas fa-file"></i></div>
                                    @endif
                                </div>
                                <div class="res-info">
                                    <div class="res-name" title="{{ $name }}">{{ $name }}</div>
                                    <div class="res-actions">
                                        <a class="btn-outline btn-sm" href="{{ $url }}" target="_blank" rel="noopener">View</a>
                                        <a class="btn-primary btn-sm" href="{{ $url }}" download>Download</a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
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

        {{-- Post-Lesson Test --}}
        @php
            $lessonExam = $lesson->exam;
            $lessonExamAttempt = null;
            if (!isset($enrollment)) {
                $enrollment = Auth::check() ? \App\Models\Enrollment::where('user_id', Auth::id())->where('course_id', $lesson->topic->course_id)->first() : null;
            }
            if ($lessonExam && $enrollment) {
                $lessonExamAttempt = \App\Models\ExamAttempt::where('exam_id', $lessonExam->id)->where('enrollment_id', $enrollment->id)->where('status', 'completed')->first();
            }
            $canMarkComplete = !$lessonExam || $lessonExamAttempt;
            $isFullyCompleted = $enrollment && $enrollment->hasCompletedLesson($lesson);
        @endphp
        @if($lessonExam && Auth::check())
            <div class="lesson-content" style="margin-bottom: 2rem;">
                <h3 style="color: var(--diamond-white); margin-bottom: 1rem;">
                    <i class="fas fa-file-alt me-2"></i>Lesson Quiz
                </h3>
                @if($lessonExamAttempt)
                    <p style="color: var(--cool-gray); margin-bottom: 1rem;">You've completed this lesson quiz. Score: {{ $lessonExamAttempt->total_points_earned }}/{{ $lessonExamAttempt->total_points_possible }} ({{ $lessonExamAttempt->percentage }}%)</p>
                    <a href="{{ route('exams.result', $lessonExamAttempt) }}" class="btn-outline" style="padding: 0.75rem 1.5rem;">
                        <i class="fas fa-chart-bar me-2"></i>View Results
                    </a>
                @else
                    <p style="color: var(--cool-gray); margin-bottom: 1rem;">{{ $lessonExam->description ?? 'Test your understanding of this lesson.' }}</p>
                    <a href="{{ route('exams.show', $lessonExam) }}" class="btn-primary" style="padding: 0.75rem 1.5rem;">
                        <i class="fas fa-play me-2"></i>Take Lesson Quiz
                    </a>
                @endif
            </div>
        @endif

        {{-- Completion Section --}}
        @php
            $topic = $lesson->topic;
            $topicLessons = $topic->lessons()->orderBy('created_at')->get();
            $currentIndex = $topicLessons->search(fn($l) => $l->id === $lesson->id);
            $previousLesson = $currentIndex !== false && $currentIndex > 0 
                ? $topicLessons[$currentIndex - 1] 
                : null;
            $nextLesson = $currentIndex !== false && $currentIndex < $topicLessons->count() - 1 
                ? $topicLessons[$currentIndex + 1] 
                : null;
        @endphp
        
        <div class="completion-section">
            @if($isFullyCompleted)
                <div class="completed-badge">
                    <i class="fas fa-check-circle"></i>
                    <span>Lesson Completed!</span>
                </div>
                <p style="color: var(--cool-gray); margin-top: 1rem; margin-bottom: 0;">Great job! You've successfully completed this lesson.</p>
            @else
                <h3 style="color: var(--diamond-white); margin-bottom: 1rem;">Ready to mark this lesson as complete?</h3>
                @if($lessonExam && !$lessonExamAttempt)
                    <p style="color: var(--cool-gray); margin-bottom: 1rem;">Complete the lesson quiz above before you can mark this lesson as complete.</p>
                @else
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
            @endif

            {{-- Navigation: Next only when current lesson is fully completed --}}
            @if($previousLesson || ($nextLesson && $isFullyCompleted))
                <div style="margin-top: 2rem; padding-top: 2rem; border-top: 1px solid rgba(255, 255, 255, 0.1); display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                    @if($previousLesson)
                        <a href="{{ route('lessons.show', $previousLesson) }}" class="btn-outline" style="padding: 0.75rem 1.5rem;">
                            <i class="fas fa-arrow-left me-2"></i>Previous Lesson
                        </a>
                    @endif
                    @if($nextLesson && $isFullyCompleted)
                        <a href="{{ route('lessons.show', $nextLesson) }}" class="btn-primary" style="padding: 0.75rem 1.5rem;">
                            Next Lesson<i class="fas fa-arrow-right ms-2"></i>
                        </a>
                    @elseif($nextLesson)
                        <span class="btn-outline" style="padding: 0.75rem 1.5rem; opacity: 0.7; cursor: not-allowed;" title="Complete this lesson and its quiz to unlock the next lesson.">
                            Next Lesson<i class="fas fa-lock ms-2"></i>
                        </span>
                    @endif
                </div>
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

{{-- Highlight.js CDN and copy handlers --}}
@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/github-dark.min.css" integrity="sha512-1N6zQ+VtP6b/nf3g5Gf3Oa1zO1mQP0R1d4nqQFtg0y3PqP6RrY+7s9Hf8WJYfMR1X6Q2yC5WQDXvByozKa1q9w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js" integrity="sha512-0o9k3J3A6YzT0m0yJtXQk3RkH2F8Xh3gGup6c2yQ2gP1y2XoNf2CkqXv0l2pZ7XbXKXzv7N5wfmqJbYxq4mKbw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
  document.addEventListener('DOMContentLoaded', function(){
    function prettyLang(code){
      if(!code) return 'Plain text';
      const map = {
        // JavaScript & TypeScript
        'js':'JavaScript','javascript':'JavaScript','ts':'TypeScript','typescript':'TypeScript','jsx':'React JSX','tsx':'React TSX',
        // Python
        'py':'Python','python':'Python',
        // Web
        'html':'HTML','xml':'XML','css':'CSS','scss':'SCSS','sass':'Sass','less':'Less',
        // Databases
        'sql':'SQL','mysql':'MySQL','postgresql':'PostgreSQL','postgres':'PostgreSQL','plsql':'PL/SQL','tsql':'T-SQL',
        // Backend
        'php':'PHP','rb':'Ruby','ruby':'Ruby','java':'Java','kotlin':'Kotlin','scala':'Scala',
        'go':'Go','golang':'Go','rs':'Rust','rust':'Rust',
        // C Family
        'c':'C','cpp':'C++','c++':'C++','cs':'C#','csharp':'C#','objc':'Objective-C',
        // Mobile
        'swift':'Swift','dart':'Dart','kotlin':'Kotlin',
        // Shell
        'bash':'Bash','sh':'Bash','shell':'Bash','powershell':'PowerShell','ps1':'PowerShell',
        // Data
        'json':'JSON','yaml':'YAML','yml':'YAML','toml':'TOML','ini':'INI','xml':'XML',
        // Other
        'markdown':'Markdown','md':'Markdown','latex':'LaTeX','r':'R','matlab':'MATLAB',
        'perl':'Perl','lua':'Lua','vim':'Vim Script','dockerfile':'Dockerfile','makefile':'Makefile'
      };
      return map[code.toLowerCase()] || code.charAt(0).toUpperCase() + code.slice(1);
    }

    // First, highlight ALL code blocks
    document.querySelectorAll('pre code').forEach(function(block){
      try {
        // Get the original text content
        const codeText = block.textContent;
        
        // Use highlightAuto to detect language and get highlighted HTML
        const result = hljs.highlightAuto(codeText);
        
        console.log('Detection result:', result.language, 'for code:', codeText.substring(0, 50));
        
        // Apply the highlighted HTML
        block.innerHTML = result.value;
        
        // Add classes
        block.classList.add('hljs');
        if (result.language) {
          block.classList.add(result.language);
          block.setAttribute('data-language', result.language);
        }
      } catch(e) {
        console.error('Error highlighting code:', e);
      }
    });

    // Then wrap ALL pre elements (content and snippets) with code-wrap structure
    document.querySelectorAll('pre').forEach(function(pre){
      // Skip if already inside a code-wrap
      if (pre.closest('.code-wrap')) return;
      
      // Create wrapper
      const wrapper = document.createElement('div');
      wrapper.className = 'code-wrap';
      
      // Create topbar
      const topbar = document.createElement('div');
      topbar.className = 'code-topbar';
      
      // Create dots
      const dots = document.createElement('div');
      dots.className = 'code-dots';
      dots.innerHTML = '<span class="code-dot red"></span><span class="code-dot yellow"></span><span class="code-dot green"></span>';
      
      // Create language badge
      const badge = document.createElement('span');
      badge.className = 'code-badge';
      const codeBlock = pre.querySelector('code');
      const detectedLang = codeBlock ? codeBlock.getAttribute('data-language') : null;
      badge.textContent = prettyLang(detectedLang);
      
      // Create actions
      const actions = document.createElement('div');
      actions.className = 'code-actions';
      
      // Create copy button
      const btn = document.createElement('button');
      btn.className = 'code-btn code-copy';
      btn.type = 'button';
      btn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path></svg> <span class="d-none d-sm-inline">Copy</span>';
      
      // Add click handler
      btn.addEventListener('click', function(){
        const code = pre.querySelector('code') || pre;
        const text = code.textContent;
        navigator.clipboard.writeText(text).then(function(){
          const originalHTML = btn.innerHTML;
          btn.style.transform = 'scale(1.1)';
          btn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg> <span class="d-none d-sm-inline">Copied!</span>';
          setTimeout(function(){
            btn.style.transform = 'scale(1)';
            btn.innerHTML = originalHTML;
          }, 1500);
        });
      });
      
      // Assemble structure
      actions.appendChild(btn);
      topbar.appendChild(dots);
      topbar.appendChild(badge);
      topbar.appendChild(actions);
      
      // Wrap the pre element
      pre.parentNode.insertBefore(wrapper, pre);
      wrapper.appendChild(topbar);
      wrapper.appendChild(pre);
    });

    // Finally, update ALL language badges (both existing and newly wrapped)
    document.querySelectorAll('.code-wrap').forEach(function(wrap){
      const pre = wrap.querySelector('pre');
      const codeBlock = pre ? pre.querySelector('code') : null;
      const detectedLang = codeBlock ? codeBlock.getAttribute('data-language') : null;
      
      console.log('Updating badge - detected language:', detectedLang);
      console.log('Code block classes:', codeBlock ? codeBlock.className : 'no code block');
      
      // Find or create badge
      let badge = wrap.querySelector('.code-badge');
      if (!badge) {
        badge = document.createElement('span');
        badge.className = 'code-badge';
        const topbar = wrap.querySelector('.code-topbar');
        const actions = topbar ? topbar.querySelector('.code-actions') : null;
        if (topbar && actions) {
          topbar.insertBefore(badge, actions);
        }
      }
      
      const displayText = prettyLang(detectedLang);
      console.log('Setting badge text to:', displayText);
      badge.textContent = displayText;
    });

    // Copy buttons for code snippets section
    document.querySelectorAll('.code-wrap .code-copy').forEach(function(btn){
      btn.addEventListener('click', function(){
        const pre = btn.closest('.code-wrap').querySelector('pre code');
        const text = pre.textContent;
        navigator.clipboard.writeText(text).then(function(){
          const originalHTML = btn.innerHTML;
          btn.style.transform = 'scale(1.1)';
          btn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg> <span class="d-none d-sm-inline">Copied!</span>';
          setTimeout(function(){
            btn.style.transform = 'scale(1)';
            btn.innerHTML = originalHTML;
          }, 1500);
        });
      });
    });

    // Process video placeholders in lesson content
    function processVideoContent() {
      const contentBody = document.querySelector('.lesson-content-body');
      if (!contentBody) return;

      let html = contentBody.innerHTML;
      console.log('Original HTML:', html);

      // Process YouTube embeds: [YOUTUBE:VIDEO_ID] or [YOUTUBE:https://youtube.com/watch?v=VIDEO_ID]
      html = html.replace(/\[YOUTUBE:([^\]]+)\]/gi, function(match, content) {
        console.log('Found YouTube placeholder:', match, content);
        let videoId = content;
        
        // Extract video ID from full YouTube URL if provided
        const youtubeMatch = content.match(/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/);
        if (youtubeMatch) {
          videoId = youtubeMatch[1];
        }
        
        console.log('Video ID:', videoId);
        return `<div class="video-container" style="position: relative; width: 100%; height: 0; padding-bottom: 56.25%; margin: 1.5rem 0; border-radius: 8px; overflow: hidden; background: #000;">
          <iframe src="https://www.youtube.com/embed/${videoId}" 
                  style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: none;" 
                  allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                  allowfullscreen>
          </iframe>
        </div>`;
      });

      // Process video file placeholders: [VIDEO:filename.mp4]
      html = html.replace(/\[VIDEO:([^\]]+)\]/gi, function(match, filename) {
        console.log('Found video placeholder:', match, filename);
        return `<div style="margin: 1.5rem 0;">
          <video controls style="width: 100%; max-height: 400px; border-radius: 8px; background: #000;">
            <source src="/storage/videos/${filename}" type="video/mp4">
            <source src="/storage/videos/${filename}" type="video/webm">
            Your browser does not support the video tag.
          </video>
        </div>`;
      });

      // Process image placeholders: [IMAGE:filename.jpg]
      html = html.replace(/\[IMAGE:([^\]]+)\]/gi, function(match, filename) {
        console.log('Found image placeholder:', match, filename);
        return `<img src="/storage/images/${filename}" alt="${filename}" style="max-width: 100%; height: auto; border-radius: 8px; margin: 1rem 0; display: block;">`;
      });

      console.log('Processed HTML:', html);
      contentBody.innerHTML = html;
    }

    // Process video content after DOM is ready
    processVideoContent();
    
    // Also process after a short delay to ensure all content is loaded
    setTimeout(processVideoContent, 500);
  });
</script>
@endpush
@endsection