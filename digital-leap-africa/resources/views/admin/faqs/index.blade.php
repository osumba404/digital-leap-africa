@extends('admin.layout')

@section('admin-content')
<div class="page-header">
  <h2 class="page-title">FAQs</h2>
  <div class="page-actions">
    <a href="{{ route('admin.faqs.create') }}" class="btn-primary"><i class="fas fa-plus me-1"></i>Add FAQ</a>
  </div>
</div>

@if(session('success'))
  <div class="success-message">{{ session('success') }}</div>
@endif

<div class="table-responsive">
  <table class="data-table">
    <thead>
      <tr>
        <th>Question</th>
        <th>Status</th>
        <th>Updated</th>
        <th style="width:160px">Actions</th>
      </tr>
    </thead>
    <tbody>
      @forelse($faqs as $faq)
      <tr>
        <td>{{ $faq->question }}</td>
        <td>
          @if($faq->is_active)
            <span class="status-badge status-active">Active</span>
          @else
            <span class="status-badge status-inactive">Inactive</span>
          @endif
        </td>
        <td>{{ $faq->updated_at?->format('M d, Y') }}</td>
        <td>
          <a href="{{ route('admin.faqs.edit', $faq) }}" class="btn-outline">Edit</a>
          <form method="POST" action="{{ route('admin.faqs.destroy', $faq) }}" style="display:inline-block" onsubmit="return confirm('Delete FAQ?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn-danger">Delete</button>
          </form>
        </td>
      </tr>
      @empty
      <tr><td colspan="4">No FAQs found.</td></tr>
      @endforelse
    </tbody>
  </table>
</div>

<div style="margin-top:1rem;">
  {{ $faqs->links() }}
</div>
@endsection
