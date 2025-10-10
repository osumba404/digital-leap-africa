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
      <h3 class="h5 mb-3">Topics</h3>

      @if(isset($topics) && $topics->count())
        <div class="table-responsive">
          <table class="table table-striped align-middle">
            <thead>
              <tr>
                <th style="width:30%">Title</th>
                <th style="width:12%">Type</th>
                <th>Description</th>
                <th style="width:15%">Created</th>
                <th style="width:25%" class="text-end">Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($topics as $topic)
                <tr>
                  <td class="fw-semibold">{{ $topic->title }}</td>
                  <td>
                    @if(!empty($topic->type))
                      <span class="badge bg-info text-dark text-uppercase">{{ $topic->type }}</span>
                    @else
                      <span class="text-muted">—</span>
                    @endif
                  </td>
                  <td class="text-muted">{{ \Illuminate\Support\Str::limit($topic->description ?? '', 140) }}</td>
                  <td class="text-muted">{{ optional($topic->created_at)->diffForHumans() }}</td>
                  <td class="text-end">
                    <div class="d-inline-flex gap-2">
                      <a href="{{ route('admin.courses.lessons.index', $course) }}" class="btn btn-sm btn-edit">
                        <i class="fas fa-book-open me-1"></i>Lessons
                      </a>
                      <a href="{{ route('admin.courses.topics.edit', [$course, $topic]) }}" class="btn btn-sm btn-outline">Edit</a>
                      <form method="POST" action="{{ route('admin.courses.topics.destroy', [$course, $topic]) }}" onsubmit="return confirm('Are you sure?');" class="m-0">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                      </form>
                    </div>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
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