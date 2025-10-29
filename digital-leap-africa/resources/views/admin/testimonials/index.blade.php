@extends('admin.layout')

@section('admin-content')
<div class="admin-layout">
  <div class="admin-container">
    <div class="admin-shell">
      <div class="admin-content" style="width:100%">
        <div class="page-header">
          <h2 class="page-title">Testimonials Moderation</h2>
          <div class="page-actions">
            <a href="{{ route('admin.testimonials.index', ['status' => 'pending']) }}" class="btn-outline">Pending</a>
            <a href="{{ route('admin.testimonials.index', ['status' => 'approved']) }}" class="btn-outline">Approved</a>
            <a href="{{ route('admin.testimonials.index', ['status' => 'all']) }}" class="btn-outline">All</a>
          </div>
        </div>

        @if(session('success'))
          <div class="success-message">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">
          <table class="data-table">
            <thead>
              <tr>
                <th>User</th>
                <th>Quote</th>
                <th>Status</th>
                <th>Submitted</th>
                <th style="width:220px">Actions</th>
              </tr>
            </thead>
            <tbody>
              @forelse($testimonials as $t)
              <tr>
                <td>{{ $t->name ?? ($t->user->name ?? 'User') }}</td>
                <td>{{ \Illuminate\Support\Str::limit($t->quote, 120) }}</td>
                <td>
                  @if($t->is_active)
                    <span class="status-badge status-active">Approved</span>
                  @else
                    <span class="status-badge status-draft">Pending</span>
                  @endif
                </td>
                <td>{{ $t->created_at?->format('M d, Y') }}</td>
                <td>
                  <form method="POST" action="{{ route('admin.testimonials.update', $t) }}" style="display:inline-block;">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="quote" value="{{ $t->quote }}">
                    <button class="btn-outline" type="submit">Save</button>
                  </form>

                  @if(!$t->is_active)
                  <form method="POST" action="{{ route('admin.testimonials.approve', $t) }}" style="display:inline-block;">
                    @csrf
                    @method('PATCH')
                    <button class="btn-primary" type="submit">Approve</button>
                  </form>
                  @else
                  <form method="POST" action="{{ route('admin.testimonials.unpublish', $t) }}" style="display:inline-block;">
                    @csrf
                    @method('PATCH')
                    <button class="btn-outline" type="submit">Unpublish</button>
                  </form>
                  @endif

                  <form method="POST" action="{{ route('admin.testimonials.destroy', $t) }}" style="display:inline-block;" onsubmit="return confirm('Delete this testimonial?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn-danger" type="submit">Delete</button>
                  </form>
                </td>
              </tr>
              @empty
              <tr><td colspan="5">No testimonials found.</td></tr>
              @endforelse
            </tbody>
          </table>
        </div>

        <div style="margin-top:1rem;">
          {{ $testimonials->links() }}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
