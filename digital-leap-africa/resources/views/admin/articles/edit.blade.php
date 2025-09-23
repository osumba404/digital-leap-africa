@extends('admin.layout')

@section('title', 'Edit Article')

@section('admin-content')
<div class="admin-card">
    <div class="admin-card-header d-flex justify-content-between align-items-center">
        <h2>Edit Article</h2>
        <a href="{{ route('admin.articles.index') }}" class="btn btn-outline-secondary">Back</a>
    </div>
    <form method="POST" action="{{ route('admin.articles.update', $article) }}" class="p-3">
        @method('PUT')
        @include('admin.articles._form')
    </form>
</div>
@endsection
