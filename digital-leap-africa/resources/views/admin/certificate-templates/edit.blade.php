@extends('layouts.admin')

@section('content')
<div class="mb-4">
    <h1>Edit Certificate Template</h1>
    <p class="text-muted">Update certificate template: {{ $certificateTemplate->name }}</p>
</div>

<div class="card">
    <form method="POST" action="{{ route('admin.certificate-templates.update', $certificateTemplate) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admin.certificate-templates._form')
    </form>
</div>
@endsection