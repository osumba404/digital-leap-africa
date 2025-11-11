@extends('layouts.admin')

@section('content')
<div class="mb-4">
    <h1>Edit Email Template</h1>
    <p class="text-muted">Update email template: {{ $emailTemplate->name }}</p>
</div>

<div class="card">
    <form method="POST" action="{{ route('admin.email-templates.update', $emailTemplate) }}">
        @csrf
        @method('PUT')
        @include('admin.email-templates._form')
    </form>
</div>
@endsection