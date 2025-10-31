@extends('admin.layout')

@section('admin-content')
<div class="page-header">
    <h1 class="page-title">Create New Badge</h1>
</div>

@if($errors->any())
    <div class="error-message" style="margin-bottom: 1rem;">
        <ul style="margin: 0; padding-left: 1.5rem;">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="form-container">
    <form method="POST" action="{{ route('admin.badges.store') }}" enctype="multipart/form-data">
        @csrf
        @include('admin.badges._form')
    </form>
</div>
@endsection