@extends('admin.layout')

@section('admin-content')
<div class="page-header">
  <h1 class="page-title">Lessons for: {{ $topic->title }}</h1>
  <div class="page-actions" style="display:flex;gap:.5rem;flex-wrap:wrap;">
    <a href="{{ route('admin.courses.topics.index', $topic->course) }}" class="btn-outline">
      <i class="fas fa-arrow-left me-2"></i>Back to Topics
    </a>
  </div>
</div>

<div class="admin-content">
  <div class="card">
    <div class="card-body">
      <h3 class="h5 m-0">Add New Lesson</h3>
      <form method="POST" action="{{ route('admin.topics.lessons.store', $topic) }}" class="mt-3" enctype="multipart/form-data">
        @csrf
        @include('admin.courses.lessons._form')
      </form>
    </div>
  </div>

  <div class="card mt-3">
    <div class="card-body">
      <h3 class="h5">Existing Lessons</h3>
      <p class="text-muted small mb-3">
        <i class="fas fa-clipboard-check me-1"></i>
        Use the <strong>Lesson test</strong> column to add or manage the test at the end of each lesson. Click <strong>Add test</strong> to create one, then add questions.
      </p>
      @php $course = $course ?? $topic->course; $lessonExams = $lessonExams ?? collect(); @endphp
      @if($topic->lessons->count())
        <div class="table-responsive">
          <table class="table table-striped align-middle data-table">
            <thead>
              <tr>
                <th style="width:50px;">#</th>
                <th>Title</th>
                <th style="width:120px;">Type</th>
                <th style="width:220px;">Lesson test</th>
                <th style="width:140px;">Updated</th>
                <th style="width:240px;" class="text-end">Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($topic->lessons as $item)
                @php
                  $lessonExam = $lessonExams[$item->id] ?? null;
                @endphp
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td class="fw-semibold">{{ $item->title }}</td>
                  <td><span class="badge bg-info text-dark text-uppercase">{{ $item->type }}</span></td>
                  <td class="align-middle">
                    @if($lessonExam)
                      <span class="badge {{ $lessonExam->is_enabled ? 'bg-success' : 'bg-secondary' }} me-1">{{ $lessonExam->is_enabled ? 'On' : 'Off' }}</span>
                      <a href="{{ route('admin.exams.questions', [$course, $lessonExam]) }}" class="btn btn-sm btn-outline" title="Manage questions"><i class="fas fa-list me-1"></i>Questions</a>
                      <a href="{{ route('admin.exams.edit', [$course, $lessonExam]) }}" class="btn btn-sm btn-outline" title="Edit test">Edit</a>
                    @else
                      <a href="{{ route('admin.exams.create', $course) }}?type=post_lesson&lesson_id={{ $item->id }}" class="btn btn-sm btn-primary"><i class="fas fa-plus me-1"></i>Add test</a>
                    @endif
                  </td>
                  <td class="text-muted">{{ optional($item->updated_at)->format('Y-m-d H:i') }}</td>
                  <td class="text-end">
                    <a href="{{ route('admin.topics.lessons.edit', [$topic, $item]) }}" class="btn btn-sm btn-outline">Edit</a>
                    <form method="POST" action="{{ route('admin.topics.lessons.destroy', [$topic, $item]) }}" onsubmit="return confirm('Are you sure?');" class="d-inline-block m-0">
                      @csrf @method('DELETE')
                      <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      @else
        <div class="text-muted">No lessons have been added to this topic yet. Add a lesson above; then you can add a test for each lesson in the <strong>Lesson test</strong> column.</div>
      @endif
    </div>
  </div>
</div>
@endsection