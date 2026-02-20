@extends('admin.layout')

@section('admin-content')
<div class="page-header">
  <h1 class="page-title">Manage: {{ $course->title }}</h1>
</div>

<div class="admin-content">
  <div class="quick-actions" style="display:grid;grid-template-columns:repeat(4,1fr);gap:1rem;">
    <a class="btn btn-edit" href="{{ route('admin.courses.topics.index', $course) }}">
      <i class="fas fa-list me-2"></i>Topics
    </a>
    <a class="btn btn-edit" href="{{ route('admin.exams.index', $course) }}">
      <i class="fas fa-file-alt me-2"></i>Tests
    </a>
    <a class="btn btn-edit" href="{{ route('admin.courses.topics.index', $course) }}">
      <i class="fas fa-book-open me-2"></i>Lessons & Materials
    </a>
    <a class="btn btn-primary" href="{{ route('admin.courses.enrollments', $course) }}">
      <i class="fas fa-users me-2"></i>Manage Enrollments
    </a>
    <a class="btn btn-edit" href="{{ route('admin.courses.edit', $course) }}">
      <i class="fas fa-edit me-2"></i>Edit Course
    </a>
  </div>

  <div class="card" style="margin-top:1.25rem;">
    <div class="card-header" style="display:flex;align-items:center;justify-content:space-between;">
      <h3 class="card-title">Enrolled Students & Progress</h3>
      <div class="muted">Total lessons: {{ $totalLessons ?? 0 }}</div>
    </div>
    <div class="card-body">
      @if(isset($enrollments) && $enrollments->count())
        <table class="data-table">
          <thead>
            <tr>
              <th>Student</th>
              <th>Email</th>
              <th>Status</th>
              <th>Enrolled</th>
              <th>Completed Lessons</th>
              <th>Progress</th>
            </tr>
          </thead>
          <tbody>
            @foreach($enrollments as $en)
              @php
                $completed = 0;
                if (($totalLessons ?? 0) > 0) {
                  // Count user's completed lessons that belong to this course
                  $completed = $en->user->lessons()
                    ->whereHas('topic.course', function($q) use ($course) { $q->where('id', $course->id); })
                    ->count();
                }
                $progress = ($totalLessons ?? 0) > 0 ? round(($completed / $totalLessons) * 100) : 0;
              @endphp
              <tr>
                <td>{{ $en->user->name }}</td>
                <td class="muted">{{ $en->user->email }}</td>
                <td><span class="status-badge">{{ ucfirst($en->status ?? 'enrolled') }}</span></td>
                <td>{{ optional($en->enrolled_at)->format('M j, Y') }}</td>
                <td>{{ $completed }} / {{ $totalLessons ?? 0 }}</td>
                <td>
                  <div style="display:flex;align-items:center;gap:.5rem;min-width:180px;">
                    <div style="flex:1;height:8px;background:rgba(255,255,255,0.08);border-radius:999px;overflow:hidden;">
                      <div style="width: {{ $progress }}%;height:100%;background:linear-gradient(90deg,#00c9ff,#7a5cff);"></div>
                    </div>
                    <div style="width:3rem;text-align:right;">{{ $progress }}%</div>
                  </div>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      @else
        <div class="muted" style="padding:1rem 0;">No enrollments yet.</div>
      @endif
    </div>
  </div>
</div>
@endsection