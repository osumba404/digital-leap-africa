@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1>Email Log Details</h1>
        <p class="text-muted">Email delivery information</p>
    </div>
    <a href="{{ route('admin.email-logs.index') }}" class="btn btn-outline">Back to Logs</a>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5>Email Content</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <strong>Subject:</strong> {{ $emailLog->subject }}
                </div>
                <div class="mb-3">
                    <strong>Body:</strong>
                    <div class="mt-2 p-3" style="background: rgba(255,255,255,0.02); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; max-height: 400px; overflow-y: auto;">
                        {!! $emailLog->body !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5>Delivery Info</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <strong>To Email:</strong> {{ $emailLog->to_email }}
                </div>
                <div class="mb-3">
                    <strong>Status:</strong>
                    @if($emailLog->status == 'sent')
                        <span class="badge bg-success">Sent</span>
                    @elseif($emailLog->status == 'failed')
                        <span class="badge bg-danger">Failed</span>
                    @else
                        <span class="badge bg-warning">Pending</span>
                    @endif
                </div>
                <div class="mb-3">
                    <strong>Created:</strong> {{ $emailLog->created_at->format('M d, Y H:i:s') }}
                </div>
                @if($emailLog->sent_at)
                <div class="mb-3">
                    <strong>Sent At:</strong> {{ $emailLog->sent_at->format('M d, Y H:i:s') }}
                </div>
                @endif
                
                @if($emailLog->error_message)
                <div class="mb-3">
                    <strong>Error Message:</strong>
                    <div class="small text-danger mt-1 p-2" style="background: rgba(220, 53, 69, 0.1); border: 1px solid rgba(220, 53, 69, 0.3); border-radius: 4px;">
                        {{ $emailLog->error_message }}
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
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
.card {
    background: rgba(255, 255, 255, 0.02);
    border: 1px solid rgba(255, 255, 255, 0.1);
}
.card-header {
    background: rgba(255, 255, 255, 0.05);
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    color: var(--diamond-white);
}
</style>
@endsection