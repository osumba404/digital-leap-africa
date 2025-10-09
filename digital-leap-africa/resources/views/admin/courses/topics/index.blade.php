@extends('admin.layout')

@section('admin-content')

<div class="page-header">
  <h1 class="page-title">Topics for: {{ $course->title }}</h1>
  <div class="page-actions" style="display:flex;gap:.5rem;">
    <a href="{{ route('admin.courses.manage', $course) }}" class="btn-outline">
      <i class="fas fa-arrow-left me-2"></i>Back to Manage
    </a>
    <a href="{{ route('admin.courses.topics.create', $course) }}" class="btn btn-primary btn-sm">New Topic</a>
  </div>
</div>

<div class="admin-content">
  <div class="card">
    <div class="card-body">
      <h3 class="h5">Topics</h3>
      @if(isset($topics) && $topics->count())
        @foreach($topics as $topic)
          <div class="d-flex justify-content-between align-items-center bg-primary p-3 rounded @if(!$loop->last) mb-2 @endif">
            <div>
              <span class="fw-semibold">{{ $topic->title }}</span>
              @if(!empty($topic->type))
                <span class="ms-3 badge bg-info text-dark text-uppercase">{{ $topic->type }}</span>
              @endif
              @if(!empty($topic->description))
                <div class="text-muted small">{{ \Illuminate\Support\Str::limit($topic->description, 140) }}</div>
              @endif
              <div class="text-muted small">Created {{ optional($topic->created_at)->diffForHumans() }}</div>
            </div>
            <div class="d-flex align-items-center gap-3">
              <a href="{{ route('admin.courses.lessons.index', $course) }}" class="btn btn-sm btn-edit">
                <i class="fas fa-book-open me-1"></i>Manage Lessons
              </a>
              <a href="{{ route('admin.courses.topics.edit', [$course, $topic]) }}" class="btn btn-sm btn-outline">Edit</a>
              <form method="POST" action="{{ route('admin.courses.topics.destroy', [$course, $topic]) }}" onsubmit="return confirm('Are you sure?');" class="m-0">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
              </form>
            </div>
          </div>
        @endforeach
      @else
        <div class="text-muted">No topics yet. Create your first topic.</div>
      @endif

      @if(isset($topics) && method_exists($topics, 'links'))
        <div class="mt-3">
          {{ $topics->links() }}
        </div>
      @endif
    </div>
  </div>
</div>
@endsection