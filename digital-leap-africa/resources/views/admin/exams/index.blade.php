@extends('admin.layout')

@section('admin-content')
<div class="page-header">
  <h1 class="page-title">Tests: {{ $course->title }}</h1>
  <div class="page-actions">
    <a href="{{ route('admin.courses.manage', $course) }}" class="btn-outline">
      <i class="fas fa-arrow-left me-2"></i>Back to Course
    </a>
    <a href="{{ route('admin.exams.create', $course) }}?type=pre_course" class="btn btn-primary">
      <i class="fas fa-plus me-2"></i>Add Pre-Course Test
    </a>
    <a href="{{ route('admin.exams.create', $course) }}?type=final" class="btn btn-primary">
      <i class="fas fa-plus me-2"></i>Add Final Test
    </a>
  </div>
</div>

<div class="admin-content">
  <div class="card">
    <div class="card-body">
      <p class="text-muted mb-4">
        Manage pre-course and final tests here. <strong>Lesson tests</strong> are added and edited from each topic’s <strong>Lessons</strong> page (open a topic, then use the Lesson test column).
      </p>

      <div class="table-responsive">
        <table class="data-table">
          <thead>
            <tr>
              <th>Type</th>
              <th>Title</th>
              <th>Lesson</th>
              <th>Questions</th>
              <th>Points</th>
              <th>Enabled</th>
              <th>Counts to Grade</th>
              <th style="width: 200px;">Actions</th>
            </tr>
          </thead>
          <tbody>
            @forelse($exams as $exam)
              <tr>
                <td>
                  @if($exam->type === 'pre_course')
                    <span class="badge bg-info">Pre-Course</span>
                  @elseif($exam->type === 'post_lesson')
                    <span class="badge bg-secondary">Post-Lesson</span>
                  @else
                    <span class="badge bg-warning text-dark">Final</span>
                  @endif
                </td>
                <td class="fw-semibold">{{ $exam->title }}</td>
                <td>
                  @if($exam->lesson)
                    {{ $exam->lesson->title }}
                  @else
                    <span class="text-muted">—</span>
                  @endif
                </td>
                <td>{{ $exam->questions->count() }}</td>
                <td>{{ $exam->questions->sum('points') }}</td>
                <td>
                  @if($exam->is_enabled)
                    <span class="badge bg-success">Yes</span>
                  @else
                    <span class="badge bg-secondary">No</span>
                  @endif
                </td>
                <td>
                  @if($exam->count_towards_final_grade)
                    <span class="badge bg-success">Yes</span>
                  @else
                    <span class="badge bg-secondary">No</span>
                  @endif
                </td>
                <td>
                  @if($exam->type === 'post_lesson' && $exam->lesson)
                    <a href="{{ route('admin.topics.lessons.index', [$course, $exam->lesson->topic]) }}" class="btn btn-sm btn-primary" title="Manage this lesson test from the Lessons page">
                      <i class="fas fa-book-open me-1"></i>Manage from Lessons
                    </a>
                  @endif
                  <a href="{{ route('admin.exams.questions', [$course, $exam]) }}" class="btn btn-sm btn-outline">
                    <i class="fas fa-list me-1"></i>Questions
                  </a>
                  <a href="{{ route('admin.exams.edit', [$course, $exam]) }}" class="btn btn-sm btn-outline">
                    <i class="fas fa-edit me-1"></i>Edit
                  </a>
                  <form method="POST" action="{{ route('admin.exams.destroy', [$course, $exam]) }}" class="d-inline-block" onsubmit="return confirm('Delete this test and all its questions?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash me-1"></i>Delete</button>
                  </form>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="8" class="text-center text-muted py-4">
                  No tests yet. Add a pre-course, post-lesson, or final test.
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="card mt-4">
    <div class="card-body">
      <h3 class="h5 mb-3">Lesson tests</h3>
      <p class="text-muted mb-3">Add and edit lesson tests from the <strong>Lessons</strong> page for each topic. Go to <a href="{{ route('admin.courses.topics.index', $course) }}">Topics</a>, open a topic, then use the <strong>Lesson test</strong> column to add or manage tests.</p>
      <a href="{{ route('admin.courses.topics.index', $course) }}" class="btn btn-outline">
        <i class="fas fa-book-open me-2"></i>Go to Topics &amp; Lessons
      </a>
      <hr class="my-3">
      <p class="text-muted small mb-2">Or create a lesson test by selecting a lesson below (you will be redirected to the lessons page after creating it):</p>
      <form method="GET" action="{{ route('admin.exams.create', $course) }}" class="d-flex gap-2 flex-wrap align-items-end">
        <input type="hidden" name="type" value="post_lesson">
        <div class="flex-grow-1" style="min-width: 200px;">
          <label class="form-label">Select Lesson</label>
          <select name="lesson_id" class="form-control" required>
            <option value="">Choose a lesson...</option>
            @foreach($course->topics as $topic)
              @foreach($topic->lessons as $lesson)
                <option value="{{ $lesson->id }}">{{ $topic->title }} › {{ $lesson->title }}</option>
              @endforeach
            @endforeach
          </select>
        </div>
        <button type="submit" class="btn btn-primary">
          <i class="fas fa-plus me-2"></i>Add Post-Lesson Test
        </button>
      </form>
    </div>
  </div>
</div>
@endsection
