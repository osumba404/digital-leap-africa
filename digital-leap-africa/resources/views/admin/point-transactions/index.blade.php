@extends('admin.layout')

@section('admin-content')
<div class="page-header">
    <h1 class="page-title">Point Transactions</h1>
    <div class="page-actions">
        <a href="{{ route('admin.point-transactions.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Add Points
        </a>
    </div>
</div>

<div class="card bg-primary-light border-0 shadow-sm rounded mb-4">
    <form method="GET" class="p-3">
        <div class="row">
            <div class="col-md-4">
                <select name="user_id" class="form-control">
                    <option value="">All Users</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                            {{ $user->name }} ({{ $user->email }})
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select name="type" class="form-control">
                    <option value="">All Types</option>
                    <option value="earned" {{ request('type') == 'earned' ? 'selected' : '' }}>Earned</option>
                    <option value="spent" {{ request('type') == 'spent' ? 'selected' : '' }}>Spent</option>
                    <option value="bonus" {{ request('type') == 'bonus' ? 'selected' : '' }}>Bonus</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
        </div>
    </form>
</div>

<div class="card bg-primary-light border-0 shadow-sm rounded">
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Points</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Description</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transactions as $transaction)
                <tr>
                    <td>
                        <div>{{ $transaction->user->name }}</div>
                        <small class="text-muted">{{ $transaction->user->email }}</small>
                    </td>
                    <td>
                        <span class="badge {{ $transaction->points > 0 ? 'bg-success' : 'bg-danger' }}">
                            {{ $transaction->points > 0 ? '+' : '' }}{{ $transaction->points }}
                        </span>
                    </td>
                    <td>
                        <span class="badge bg-secondary">{{ ucfirst($transaction->type) }}</span>
                    </td>
                    <td>
                        @if($transaction->active)
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-warning">Inactive</span>
                        @endif
                    </td>
                    <td>{{ $transaction->description }}</td>
                    <td>{{ $transaction->created_at->format('M d, Y H:i') }}</td>
                    <td>
                        <a href="{{ route('admin.point-transactions.show', $transaction) }}" class="btn btn-sm btn-outline-info">
                            <i class="fas fa-eye"></i>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-4 text-muted">
                        No point transactions found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($transactions->hasPages())
        <div class="mt-4">
            {{ $transactions->appends(request()->query())->links() }}
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
.bg-secondary { background-color: #6c757d !important; }
.form-control {
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.2);
    color: var(--diamond-white);
    border-radius: 8px;
}
.form-control:focus {
    background: rgba(255, 255, 255, 0.08);
    border-color: var(--cyan-accent);
    box-shadow: 0 0 0 0.2rem rgba(0, 201, 255, 0.25);
    color: var(--diamond-white);
}
.btn-primary {
    background: linear-gradient(135deg, var(--primary-blue), var(--cyan-accent));
    border: none;
    color: white;
}
.btn-outline-info {
    color: var(--cyan-accent);
    border-color: var(--cyan-accent);
}
.btn-outline-info:hover {
    background-color: var(--cyan-accent);
    color: white;
}
</style>
@endsection