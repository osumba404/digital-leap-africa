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
        <table class="data-table">
          <thead>
            <tr>
              <th style="width:30%">Title</th>
              <th style="width:12%">Type</th>
              <th>Description</th>
              <th style="width:15%">Created</th>
              <th style="width:25%; text-align:right;">Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($topics as $topic)
              <tr>
                <td style="font-weight:600;">{{ $topic->title }}</td>
                <td>
                  @if(!empty($topic->type))
                    <span class="status-badge">{{ strtoupper($topic->type) }}</span>
                  @else
                    <span class="muted">—</span>
                  @endif
                </td>
                <td class="muted">{{ \Illuminate\Support\Str::limit($topic->description ?? '', 140) }}</td>
                <td class="muted">{{ optional($topic->created_at)->diffForHumans() }}</td>
                <td style="text-align:right;">
                  <div style="display:inline-flex;gap:0.5rem;">
                    <a href="{{ route('admin.courses.lessons.index', $course) }}" class="btn btn-edit" style="font-size:0.85rem;padding:0.5rem 0.75rem;">
                      <i class="fas fa-book-open me-1"></i>Lessons
                    </a>
                    <a href="{{ route('admin.courses.topics.edit', [$course, $topic]) }}" class="btn-outline" style="font-size:0.85rem;padding:0.5rem 0.75rem;">Edit</a>
                    <form method="POST" action="{{ route('admin.courses.topics.destroy', [$course, $topic]) }}" onsubmit="return confirm('Are you sure?');" style="margin:0;display:inline;">
                      @csrf @method('DELETE')
                      <button type="submit" class="btn btn-danger" style="font-size:0.85rem;padding:0.5rem 0.75rem;">Delete</button>
                    </form>
                  </div>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      @else
        <div class="muted" style="padding:1rem 0;">No topics yet. Create your first topic.</div>
      @endif

      @if(isset($topics) && method_exists($topics, 'links'))
        <div style="margin-top:1.5rem;">
          {{ $topics->links() }}
        </div>
      @endif
    </div>
  </div>
</div>
@endsection