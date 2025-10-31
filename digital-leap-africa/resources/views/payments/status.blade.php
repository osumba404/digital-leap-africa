@extends('layouts.app')

@section('content')
<style>
.payment-status-container {
    max-width: 600px;
    margin: 3rem auto;
    padding: 2rem;
}

.status-card {
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 16px;
    padding: 3rem 2rem;
    text-align: center;
}

.status-icon {
    font-size: 4rem;
    margin-bottom: 1.5rem;
}

.status-icon.pending {
    color: #f59e0b;
    animation: pulse 2s infinite;
}

.status-icon.completed {
    color: #10b981;
}

.status-icon.failed {
    color: #ef4444;
}

@keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.5; }
}

.spinner {
    border: 4px solid rgba(255, 255, 255, 0.1);
    border-top: 4px solid var(--cyan-accent);
    border-radius: 50%;
    width: 50px;
    height: 50px;
    animation: spin 1s linear infinite;
    margin: 2rem auto;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* Light Mode */
[data-theme="light"] .status-card {
    background: #FFFFFF;
    border: 1px solid rgba(46, 120, 197, 0.2);
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.05);
}
</style>

<div class="payment-status-container">
    <div class="status-card">
        @if($payment->status === 'pending')
            <div class="status-icon pending">
                <i class="fas fa-clock"></i>
            </div>
            <h2 style="color: var(--diamond-white); margin-bottom: 1rem;">Waiting for Payment</h2>
            <p style="color: var(--cool-gray); margin-bottom: 2rem;">
                Please check your phone and enter your M-Pesa PIN to complete the payment.
            </p>
            <div class="spinner"></div>
            <p style="color: var(--cool-gray); font-size: 0.9rem; margin-top: 2rem;">
                This page will automatically update once payment is confirmed...
            </p>
        @elseif($payment->status === 'completed')
            <div class="status-icon completed">
                <i class="fas fa-check-circle"></i>
            </div>
            <h2 style="color: #10b981; margin-bottom: 1rem;">Payment Successful!</h2>
            <p style="color: var(--cool-gray); margin-bottom: 2rem;">
                You have been successfully enrolled in <strong>{{ $payment->course->title }}</strong>
            </p>
            <a href="{{ route('courses.show', $payment->course) }}" class="btn-primary" style="padding: 0.75rem 2rem;">
                <i class="fas fa-play me-2"></i>Start Learning
            </a>
        @elseif($payment->status === 'failed')
            <div class="status-icon failed">
                <i class="fas fa-times-circle"></i>
            </div>
            <h2 style="color: #ef4444; margin-bottom: 1rem;">Payment Failed</h2>
            <p style="color: var(--cool-gray); margin-bottom: 2rem;">
                Your payment could not be processed. Please try again.
            </p>
            <a href="{{ route('courses.show', $payment->course) }}" class="btn-primary" style="padding: 0.75rem 2rem;">
                <i class="fas fa-redo me-2"></i>Try Again
            </a>
        @endif

        <div style="margin-top: 2rem; padding-top: 2rem; border-top: 1px solid rgba(255, 255, 255, 0.1);">
            <p style="color: var(--cool-gray); font-size: 0.85rem; margin-bottom: 0.5rem;">
                <strong>Course:</strong> {{ $payment->course->title }}
            </p>
            <p style="color: var(--cool-gray); font-size: 0.85rem; margin-bottom: 0.5rem;">
                <strong>Amount:</strong> KES {{ number_format($payment->amount, 2) }}
            </p>
            <p style="color: var(--cool-gray); font-size: 0.85rem; margin-bottom: 0;">
                <strong>Phone:</strong> {{ $payment->phone_number }}
            </p>
        </div>
    </div>
</div>

@if($payment->status === 'pending')
<script>
// Poll for payment status every 3 seconds
let pollInterval = setInterval(function() {
    fetch('{{ route('payment.poll', $payment) }}')
        .then(response => response.json())
        .then(data => {
            if (data.status === 'completed') {
                clearInterval(pollInterval);
                window.location.reload();
            } else if (data.status === 'failed') {
                clearInterval(pollInterval);
                window.location.reload();
            }
        })
        .catch(error => {
            console.error('Error polling payment status:', error);
        });
}, 3000);

// Stop polling after 5 minutes
setTimeout(function() {
    clearInterval(pollInterval);
}, 300000);
</script>
@endif
@endsection