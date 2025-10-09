@extends('admin.layout')

@section('admin-content')
<div class="page-header">
  <h1 class="page-title">
    {{-- For create --}}
    New Topic for: {{ $course->title }}
    {{-- For edit --}}
    Edit Topic: {{ $topic->title }}
  </h1>
  <div class="page-actions">
    <a href="{{ route('admin.courses.topics.index', $course) }}" class="btn-outline">
      <i class="fas fa-arrow-left me-2"></i>Back to Topics
    </a>
  </div>
</div>

<div class="admin-content">
  <div class="card">
    <div class="card-body">
    

      
      <form method="POST" action="{{ route('admin.courses.topics.update', [$course, $topic]) }}">
        @csrf @method('PUT')
        <div class="form-group">
          <label class="form-label">Title</label>
          <input type="text" name="title" class="form-control" value="{{ old('title', $topic->title) }}" required>
        </div>
        <!-- <div class="form-group">
          <label class="form-label">Description</label>
          <textarea name="description" class="form-control" rows="3">{{ old('description', $topic->description) }}</textarea>
        </div> -->
        <button class="btn-primary">Save Changes</button>
      </form>
    
    </div>
  </div>
</div>
@endsection