@extends('admin.layout')
@section('title', 'eLibrary Management')

@section('admin-content')
<div class="page-header">
    <h1 class="page-title">Edit eLibrary Resource</h1>
</div>
<div class="py-5">
  <div class="container" style="max-width: 64rem;">
    <div class="bg-primary-light shadow-sm rounded">
      <div class="p-4 text-gray-200">
        <form method="POST" action="{{ route('admin.elibrary-resources.update', $item) }}" enctype="multipart/form-data">
          @method('PATCH')
          @csrf
          @include('admin.elibrary._form')
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
