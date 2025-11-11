@extends('admin.layout')

@section('admin-content')
<div class="page-header">
    <h1 class="page-title">Point Rules</h1>
    <div class="page-actions">
        <a href="{{ route('admin.point-rules.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Create Rule
        </a>
    </div>
</div>

<div class="card bg-primary-light border-0 shadow-sm rounded">
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Action</th>
                    <th>Points</th>
                    <th>Status</th>
                    <th>Created</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($rules as $rule)
                <tr>
                    <td>{{ $rule->name }}</td>
                    <td>{{ $rule->action }}</td>
                    <td>
                        <span class="badge {{ $rule->points > 0 ? 'bg-success' : 'bg-danger' }}">
                            {{ $rule->points > 0 ? '+' : '' }}{{ $rule->points }}
                        </span>
                    </td>
                    <td>
                        @if($rule->active)
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-warning">Inactive</span>
                        @endif
                    </td>
                    <td>{{ $rule->created_at->format('M d, Y') }}</td>
                    <td>
                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.point-rules.edit', $rule) }}" class="btn btn-sm btn-edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form method="POST" action="{{ route('admin.point-rules.destroy', $rule) }}" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this rule?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-4 text-muted">
                        No point rules found. <a href="{{ route('admin.point-rules.create') }}">Create one</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($rules->hasPages())
        <div class="mt-4">
            {{ $rules->links() }}
        </div>
    @endif
</div>

<style>
.badge {
    padding: 0.35em 0.65em;
    font-size: 0.75em;
    border-radius: 0.375rem;
}
.bg-success { background-color: #198754 !important; }
.bg-danger { background-color: #dc3545 !important; }
.bg-warning { background-color: #ffc107 !important; color: #000; }
</style>
@endsection