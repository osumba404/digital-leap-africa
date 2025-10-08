@extends('admin.layout')

@section('title', 'New Article')

@section('admin-content')
<div class="admin-card">
    <div class="admin-card-header d-flex justify-content-between align-items-center">
        <h2>Create Article</h2>
        <a href="{{ route('admin.articles.index') }}" class="btn btn-outline-secondary">Back</a>
    </div>
    <form method="POST" action="{{ route('admin.articles.store') }}" enctype="multipart/form-data" class="p-3">
        @csrf
        @method('POST')
        @include('admin.articles._form')
    </form>
</div>
@endsection
