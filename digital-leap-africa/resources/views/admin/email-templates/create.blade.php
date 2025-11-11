@extends('admin.layout')

@section('admin-content')
<div class="card bg-primary-light border-0 shadow-sm rounded">
    <div class="card-header bg-primary-dark text-white">
        <h5 class="m-0">Create Email Template</h5>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.email-templates.store') }}">
            @csrf
            @include('admin.email-templates._form')
        </form>
    </div>
</div>
@endsection