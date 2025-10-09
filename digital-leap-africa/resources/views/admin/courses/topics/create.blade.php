@extends('admin.layout')

@section('admin-content')
<div class="page-header">
  <h1 class="page-title">New Topic for: {{ $course->title }}</h1>
  <div class="page-actions">
    <a href="{{ route('admin.courses.topics.index', $course) }}" class="btn-outline">
      <i class="fas fa-arrow-left me-2"></i>Back to Topics
    </a>
  </div>
</div>

<div class="admin-content">
  <div class="card">
    <div class="card-body">
      <form action="{{ route('admin.courses.topics.store', $course) }}" method="POST" class="admin-form">
        @csrf
        <div class="form-group">
          <label class="form-label" for="title">Title</label>
          <input type="text" name="title" id="title" value="{{ old('title') }}" class="form-control" required>
        </div>

        <div class="form-group">
          <label class="form-label" for="description">Description</label>
          <textarea name="description" id="description" rows="3" class="form-control">{{ old('description') }}</textarea>
        </div>

        <div class="d-flex align-items-center gap-2">
          <button type="submit" class="btn-primary">Create Topic</button>
          <a href="{{ route('admin.courses.topics.index', $course) }}" class="btn-outline">Cancel</a>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection