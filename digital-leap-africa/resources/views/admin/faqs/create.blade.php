@extends('admin.layout')

@section('admin-content')
<div class="page-header">
  <h2 class="page-title">Add FAQ</h2>
</div>

@if($errors->any())
  <div class="error-message">Please fix the errors below.</div>
@endif

<form method="POST" action="{{ route('admin.faqs.store') }}" class="admin-form">
  @csrf
  <div class="form-section">
    <div class="form-section-title">Question</div>
    <input type="text" name="question" class="form-control" value="{{ old('question') }}" required>
    @error('question')<div class="error-message">{{ $message }}</div>@enderror
  </div>

  <div class="form-section">
    <div class="form-section-title">Answer</div>
    <textarea name="answer" rows="6" class="form-control" required>{{ old('answer') }}</textarea>
    @error('answer')<div class="error-message">{{ $message }}</div>@enderror
  </div>

  <div class="form-section">
    <label style="display:flex; align-items:center; gap:.5rem;">
      <input type="checkbox" name="is_active" value="1" {{ old('is_active') ? 'checked' : '' }}> Active
    </label>
  </div>

  <div class="page-actions">
    <a href="{{ route('admin.faqs.index') }}" class="btn-outline">Cancel</a>
    <button type="submit" class="btn-primary">Create FAQ</button>
  </div>
</form>
@endsection
