@extends('admin.layout')
@section('title', 'Job Management')

@section('admin-content')
<div class="page-header">
    <h1 class="page-title">Edit Job Listing</h1>
</div>

<div class="py-5">
  <div class="container" style="max-width: 48rem;">
    <div class="bg-primary-light shadow-sm rounded">
      <div class="p-4 text-gray-200">
        <form method="POST" action="{{ route('admin.jobs.update', $job) }}">
          @method('PATCH')
          @include('admin.jobs._form')
        </form>
      </div>
    </div>
  </div>
</div>
@endsection