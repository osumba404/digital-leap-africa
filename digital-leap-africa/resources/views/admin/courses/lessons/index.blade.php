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
      @if($topic->lessons->count())
        <div class="table-responsive">
          <table class="table table-striped align-middle">
            <thead>
              <tr>
                <th style="width:60px;">#</th>
                <th>Title</th>
                <th style="width:140px;">Type</th>
                <th style="width:200px;">Updated</th>
                <th style="width:180px;" class="text-end">Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($topic->lessons as $item)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td class="fw-semibold">{{ $item->title }}</td>
                  <td><span class="badge bg-info text-dark text-uppercase">{{ $item->type }}</span></td>
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
        <div class="text-muted">No lessons have been added to this topic yet.</div>
      @endif
    </div>
  </div>
</div>
@endsection