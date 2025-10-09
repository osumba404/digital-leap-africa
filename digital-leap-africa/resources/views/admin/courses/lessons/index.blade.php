@extends('admin.layout')

@section('admin-content')
<div class="page-header">
  <h1 class="page-title">Lessons for: {{ $topic->title }}</h1>
  <div class="page-actions" style="display:flex;gap:.5rem;">
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
      @forelse($topic->lessons as $item)
        <div class="d-flex justify-content-between align-items-center bg-primary p-3 rounded @if(!$loop->last) mb-2 @endif">
          <div>
            <span class="fw-semibold">{{ $item->title }}</span>
            <span class="ms-3 badge bg-info text-dark text-uppercase">{{ $item->type }}</span>
          </div>
          <div class="d-flex align-items-center gap-3">
            <a href="{{ route('admin.topics.lessons.edit', [$topic, $item]) }}" class="btn btn-sm btn-outline">Edit</a>
            <form method="POST" action="{{ route('admin.topics.lessons.destroy', [$topic, $item]) }}" onsubmit="return confirm('Are you sure?');" class="m-0">
              @csrf @method('DELETE')
              <button type="submit" class="btn btn-sm btn-danger">Delete</button>
            </form>
          </div>
        </div>
      @empty
        <div class="text-muted">No lessons have been added to this topic yet.</div>
      @endforelse
    </div>
  </div>
</div>
@endsection