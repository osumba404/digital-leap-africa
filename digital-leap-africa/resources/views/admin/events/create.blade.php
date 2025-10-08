@extends('admin.layout')
@section('title', 'Event Management')

@section('admin-content')
<div class="page-header">
    <h1 class="page-title">Add New Event</h1>
</div>
<div class="py-5">
  <div class="container" style="max-width: 48rem;">
    <div class="bg-primary-light shadow-sm rounded">
      <div class="p-4 text-gray-200">
        <form method="POST" action="{{ route('admin.events.store') }}">
          @include('admin.events._form')
        </form>
      </div>
    </div>
  </div>
</div>
@endsection