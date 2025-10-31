@extends('layouts.admin')

@section('content')
<div class="admin-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1>{{ $thread->title }}</h1>
            <p>By {{ $thread->user->name }} • {{ $thread->created_at->format('M j, Y g:i A') }}</p>
        </div>
        <a href="{{ route('admin.forum.index') }}" class="btn btn-outline">← Back to Forum</a>
    </div>
</div>

<div class="card mb-4">
    <div class="card-body">
        <div class="mb-3">
            <strong>Original Post:</strong>
        </div>
        <div class="content">
            {!! nl2br(e($thread->content)) !!}
        </div>
    </div>
</div>

@if($thread->replies->count() > 0)
    <div class="card">
        <div class="card-header">
            <h3>Replies ({{ $thread->replies->count() }})</h3>
        </div>
        <div class="card-body">
            @foreach($thread->replies as $reply)
                <div class="reply-item mb-4 pb-3 border-bottom">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div>
                            <strong>{{ $reply->user->name }}</strong>
                            <small class="text-muted">{{ $reply->created_at->format('M j, Y g:i A') }}</small>
                        </div>
                        <form method="POST" action="{{ route('admin.forum.replies.destroy', $reply) }}" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" 
                                    onclick="return confirm('Delete this reply?')">Delete</button>
                        </form>
                    </div>
                    <div class="content">
                        {!! nl2br(e($reply->content)) !!}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@else
    <div class="card">
        <div class="card-body text-center text-muted">
            No replies yet.
        </div>
    </div>
@endif
@endsection