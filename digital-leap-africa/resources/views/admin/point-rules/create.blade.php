@extends('admin.layout')

@section('admin-content')
<div class="card bg-primary-light border-0 shadow-sm rounded">
    <div class="card-header bg-primary-dark text-white">
        <h5 class="m-0">Create Point Rule</h5>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.point-rules.store') }}">
            @csrf
            @include('admin.point-rules._form')
        </form>
    </div>
</div>
@endsection