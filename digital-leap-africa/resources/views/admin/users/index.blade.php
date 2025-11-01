@extends('admin.layout')

@section('admin-content')
<div class="page-header">
    <h1 class="page-title">User Management</h1>
</div>

@if($users->count() > 0)
<div class="table-responsive">
    <table class="data-table">
        <thead>
            <tr>
                <th>User</th>
                <th>Email</th>
                <th>Role</th>
                <th>Verification Status</th>
                <th>Joined</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>
                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                        <div style="width: 40px; height: 40px; border-radius: 50%; background: rgba(0, 201, 255, 0.1); display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-user" style="color: var(--cyan-accent);"></i>
                        </div>
                        <div>
                            <div style="font-weight: 600; color: var(--diamond-white);">{{ $user->name }}</div>
                        </div>
                    </div>
                </td>
                <td>{{ $user->email }}</td>
                <td>
                    <span class="status-badge status-{{ $user->role }}">{{ ucfirst($user->role) }}</span>
                </td>
                <td>
                    @if($user->email_verified_at)
                        <span class="status-badge status-active">
                            <i class="fas fa-check-circle me-1"></i>Verified
                        </span>
                    @else
                        <span class="status-badge status-pending">
                            <i class="fas fa-clock me-1"></i>Unverified
                        </span>
                    @endif
                </td>
                <td>{{ $user->created_at->format('M j, Y') }}</td>
                <td>
                    <div style="display: flex; gap: 0.5rem;">
                        @if($user->email_verified_at)
                            <form method="POST" action="{{ route('admin.users.unverify', $user) }}" style="display: inline;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn-sm" style="background: rgba(239, 68, 68, 0.1); color: #ef4444; border: 1px solid rgba(239, 68, 68, 0.3);" onclick="return confirm('Remove verification for this user?')">
                                    <i class="fas fa-times"></i> Unverify
                                </button>
                            </form>
                        @else
                            <form method="POST" action="{{ route('admin.users.verify', $user) }}" style="display: inline;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn-sm" style="background: rgba(16, 185, 129, 0.1); color: #10b981; border: 1px solid rgba(16, 185, 129, 0.3);">
                                    <i class="fas fa-check"></i> Verify
                                </button>
                            </form>
                        @endif
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div style="margin-top: 2rem;">
    {{ $users->links() }}
</div>

@else
<div style="text-align: center; padding: 3rem 0;">
    <i class="fas fa-users" style="font-size: 3rem; color: var(--cool-gray); opacity: 0.5; margin-bottom: 1rem; display: block;"></i>
    <h3 style="color: var(--cool-gray); margin-bottom: 0.75rem;">No Users Found</h3>
    <p style="color: var(--cool-gray);">Users will appear here once they register.</p>
</div>
@endif
@endsection