@extends('admin.layout')

@section('admin-content')
<div class="page-header">
  <h1 class="page-title">{{ $exam->type === 'post_lesson' ? 'Edit Lesson Test' : 'Edit Test' }}: {{ $exam->title }}</h1>
  <div class="page-actions">
    <a href="{{ route('admin.exams.questions', [$course, $exam]) }}" class="btn btn-primary">
      <i class="fas fa-list me-2"></i>Manage Questions
    </a>
    @if($exam->type === 'post_lesson' && $exam->lesson)
      <a href="{{ route('admin.topics.lessons.index', [$course, $exam->lesson->topic]) }}" class="btn-outline">
        <i class="fas fa-arrow-left me-2"></i>Back to Lessons
      </a>
    @else
      <a href="{{ route('admin.exams.index', $course) }}" class="btn-outline">
        <i class="fas fa-arrow-left me-2"></i>Back to Tests
      </a>
    @endif
  </div>
</div>

<div class="admin-content">
  <div class="card">
    <div class="card-body">
      <form method="POST" action="{{ route('admin.exams.update', [$course, $exam]) }}">
        @csrf
        @method('PUT')
        <input type="hidden" name="type" value="{{ $exam->type }}">

        @if($exam->type === 'post_lesson')
          <div class="form-group mb-3">
            <label class="form-label">Lesson</label>
            <select name="lesson_id" class="form-control">
              <option value="">Select lesson...</option>
              @foreach($lessons as $l)
                <option value="{{ $l->id }}" {{ $exam->lesson_id == $l->id ? 'selected' : '' }}>
                  {{ $l->topic->title }} › {{ $l->title }}
                </option>
              @endforeach
            </select>
          </div>
        @endif

        <div class="form-group mb-3">
          <label class="form-label">Title</label>
          <input type="text" name="title" class="form-control" value="{{ old('title', $exam->title) }}" required>
        </div>

        <div class="form-group mb-3">
          <label class="form-label">Description (optional)</label>
          <textarea name="description" class="form-control" rows="3">{{ old('description', $exam->description) }}</textarea>
        </div>

        <div class="form-group mb-3">
          <label class="form-label">Time Limit (minutes, optional)</label>
          <input type="number" name="time_limit_minutes" class="form-control" value="{{ old('time_limit_minutes', $exam->time_limit_minutes) }}" min="1" max="480">
        </div>

        <div class="form-group mb-4">
          <div class="form-check">
            <input type="checkbox" name="is_enabled" id="is_enabled" value="1" class="form-check-input" {{ $exam->is_enabled ? 'checked' : '' }}>
            <label class="form-check-label" for="is_enabled">Enabled (show test to students)</label>
          </div>
        </div>

        <div class="d-flex gap-2">
          <button type="submit" class="btn btn-primary">Update Test</button>
          @if($exam->type === 'post_lesson' && $exam->lesson)
            <a href="{{ route('admin.topics.lessons.index', [$course, $exam->lesson->topic]) }}" class="btn-outline">Cancel</a>
          @else
            <a href="{{ route('admin.exams.index', $course) }}" class="btn-outline">Cancel</a>
          @endif
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
