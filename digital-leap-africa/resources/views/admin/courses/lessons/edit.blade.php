@extends('admin.layout')

@section('admin-content')

<div class="page-header">
  <h1 class="page-title">Edit Lesson: <span class="text-accent">{{ $lesson->title }}</span></h1>
  <div class="page-actions">
    <a href="{{ route('admin.topics.lessons.index', [$topic->course, $topic]) }}" class="btn-outline">
      <i class="fas fa-arrow-left me-2"></i>Back to Lessons
    </a>
  </div>
</div>

<div class="admin-content">
  <div class="card">
    <div class="card-body">
      <form method="POST" action="{{ route('admin.topics.lessons.update', [$topic, $lesson]) }}" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
        @include('admin.courses.lessons._form')
      </form>
    </div>
  </div>
</div>
@endsection