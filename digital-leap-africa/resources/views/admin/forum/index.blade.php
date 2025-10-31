@extends('layouts.admin')

@section('content')
<div class="admin-header">
    <h1>Forum Management</h1>
    <p>Manage forum threads and discussions</p>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Replies</th>
                    <th>Created</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($threads as $thread)
                    <tr>
                        <td>
                            <a href="{{ route('admin.forum.show', $thread) }}" class="text-decoration-none">
                                {{ $thread->title }}
                            </a>
                        </td>
                        <td>{{ $thread->user->name }}</td>
                        <td>{{ $thread->replies_count }}</td>
                        <td>{{ $thread->created_at->format('M j, Y') }}</td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.forum.show', $thread) }}" class="btn btn-sm btn-edit">View</a>
                                <form method="POST" action="{{ route('admin.forum.destroy', $thread) }}" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" 
                                            onclick="return confirm('Delete this thread?')">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">No threads found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($threads->hasPages())
        <div class="mt-4">
            {{ $threads->links() }}
        </div>
    @endif
</div>
@endsection