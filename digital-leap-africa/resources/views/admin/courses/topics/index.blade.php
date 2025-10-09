@extends('admin.layout')

@section('admin-content')
<div class="page-header">
    <h1 class="page-title">Topics for: {{ $course->title }}</h1>
    <div class="page-actions" style="display:flex;gap:.5rem;">
        <a href="{{ route('admin.courses.manage', $course) }}" class="btn-outline">
            <i class="fas fa-arrow-left me-2"></i>Back to Manage
        </a>
        <a href="{{ route('admin.courses.topics.create', $course) }}" class="btn-primary">
            <i class="fas fa-plus me-2"></i>New Topic
        </a>
    </div>
</div>

<div class="admin-content">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(isset($topics) && $topics->count())
        <ul class="list-unstyled" style="margin:0;padding:0;display:flex;flex-direction:column;gap:.75rem;">
            @foreach($topics as $topic)
                <li class="d-flex align-items-start justify-content-between"
                    style="padding:.75rem 1rem;border:1px solid rgba(255,255,255,.08);border-radius:10px;background:rgba(255,255,255,.02);">
                    <div class="flex-grow-1">
                        <div class="d-flex align-items-center gap-2">
                            <strong>{{ $topic->title }}</strong>
                            @if(!empty($topic->type))
                                <span class="badge bg-info" style="font-size:.7rem;">{{ $topic->type }}</span>
                            @endif
                        </div>
                        @if(!empty($topic->description))
                            <p class="text-muted mb-1" style="max-width:60ch;">
                                {{ \Illuminate\Support\Str::limit($topic->description, 180) }}
                            </p>
                        @endif
                        <div class="text-muted small">
                            Created {{ optional($topic->created_at)->diffForHumans() }}
                        </div>
                    </div>

                    <div class="d-flex align-items-center gap-2 ms-3">
                        <a href="{{ route('admin.topics.lessons.index', $topic) }}" class="btn btn-sm btn-edit">
                            <i class="fas fa-book-open me-1"></i>Lessons
                        </a>
                        <a href="{{ route('admin.courses.topics.edit', [$course, $topic]) }}" class="btn btn-sm btn-outline">
                            <i class="fas fa-pen me-1"></i>Edit
                        </a>
                        <form action="{{ route('admin.courses.topics.destroy', [$course, $topic]) }}"
                              method="POST"
                              onsubmit="return confirm('Delete this topic? This action cannot be undone.');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="fas fa-trash me-1"></i>Delete
                            </button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>

        @if(method_exists($topics, 'links'))
            <div class="mt-3">
                {{ $topics->links() }}
            </div>
        @endif
    @else
        <div class="text-muted">No topics yet. Create your first topic.</div>
    @endif
</div>
@endsection