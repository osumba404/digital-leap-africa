@extends('admin.layout')

@php
$hideAdminNav = true;
@endphp

@section('admin-content')
<div class="page-header">
    <h1 class="page-title">Create New Course</h1>
    <div class="page-actions">
        <a href="{{ route('admin.courses.index') }}" class="btn-outline">
            <i class="fas fa-arrow-left me-2"></i>Back to Courses
        </a>
    </div>
</div>

<form method="POST" action="{{ route('admin.courses.store') }}">
    @csrf
    @include('admin.courses._form')
</form>
@endsection