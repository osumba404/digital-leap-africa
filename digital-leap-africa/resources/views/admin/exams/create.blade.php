@extends('admin.layout')

@section('admin-content')
<div class="page-header">
  <h1 class="page-title">{{ $exam->type === 'post_lesson' ? 'Create Lesson Test' : 'Create Test' }}</h1>
  <div class="page-actions">
    @if($exam->type === 'post_lesson' && isset($lesson) && $lesson)
      <a href="{{ route('admin.topics.lessons.index', [$course, $lesson->topic]) }}" class="btn-outline">
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
      <form method="POST" action="{{ route('admin.exams.store', $course) }}">
        @csrf
        <input type="hidden" name="type" value="{{ $exam->type }}">

        @if($exam->type === 'post_lesson')
          <div class="form-group mb-3">
            <label class="form-label">Lesson</label>
            <select name="lesson_id" class="form-control" required>
              <option value="">Select lesson...</option>
              @foreach($lessons as $l)
                <option value="{{ $l->id }}" {{ ($lesson && $lesson->id === $l->id) || old('lesson_id') == $l->id ? 'selected' : '' }}>
                  {{ $l->topic->title }} › {{ $l->title }}
                </option>
              @endforeach
            </select>
          </div>
        @endif

        <div class="form-group mb-3">
          <label class="form-label">Title</label>
          <input type="text" name="title" class="form-control" value="{{ old('title', $exam->title ?? '') }}" required placeholder="e.g. Course Readiness Assessment">
        </div>

        <div class="form-group mb-3">
          <label class="form-label">Description (optional)</label>
          <textarea name="description" class="form-control" rows="3">{{ old('description', $exam->description ?? '') }}</textarea>
        </div>

        <div class="form-group mb-3">
          <label class="form-label">Time Limit (minutes, optional)</label>
          <input type="number" name="time_limit_minutes" class="form-control" value="{{ old('time_limit_minutes', $exam->time_limit_minutes ?? '') }}" min="1" max="480" placeholder="Leave empty for no limit">
        </div>

        <div class="form-group mb-4">
          <div class="form-check">
            <input type="checkbox" name="is_enabled" id="is_enabled" value="1" class="form-check-input" {{ old('is_enabled', $exam->is_enabled ?? true) ? 'checked' : '' }}>
            <label class="form-check-label" for="is_enabled">Enabled (show test to students)</label>
          </div>
        </div>

        <div class="d-flex gap-2">
          <button type="submit" class="btn btn-primary">Create Test</button>
          @if($exam->type === 'post_lesson' && isset($lesson) && $lesson)
            <a href="{{ route('admin.topics.lessons.index', [$course, $lesson->topic]) }}" class="btn-outline">Cancel</a>
          @else
            <a href="{{ route('admin.exams.index', $course) }}" class="btn-outline">Cancel</a>
          @endif
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
