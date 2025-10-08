@extends('admin.layout')
@section('title', 'Project Management')

@section('admin-content')
<div class="page-header">
    <h1 class="page-title">Edit Project</h1>
</div>

<div class="py-5">
  <div class="container" style="max-width: 48rem;">
    <div class="bg-primary-light shadow-sm rounded">
      <div class="p-4 text-gray-200">
        {{-- The form tag now lives here and points to the update route --}}
        <form method="POST" action="{{ route('admin.projects.update', $project) }}" enctype="multipart/form-data">
          @method('PATCH')
          @csrf
          @include('admin.projects._form')
        </form>
      </div>
    </div>
  </div>
</div>
@endsection