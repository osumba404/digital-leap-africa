@extends('admin.layout')

@section('admin-content')
<div class="page-header">
  <h1 class="page-title">Manage: {{ $course->title }}</h1>
</div>

<div class="admin-content">
  <div class="quick-actions" style="display:grid;grid-template-columns:repeat(3,1fr);gap:1rem;">
    <a class="btn btn-edit" href="{{ route('admin.courses.topics.index', $course) }}">
      <i class="fas fa-list me-2"></i>Topics
    </a>
    <a class="btn btn-edit" href="{{ route('admin.courses.topics.index', $course) }}">
      <i class="fas fa-book-open me-2"></i>Lessons & Materials
    </a>
  
    <!-- <a class="btn btn-edit" href="{{ route('admin.courses.assignments.index', $course) }}">
      <i class="fas fa-tasks me-2"></i>Assignments
    </a> -->
    
  </div>
</div>
@endsection