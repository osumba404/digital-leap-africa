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

/* Mobile Responsiveness */
@media (max-width: 768px) {
    .payment-status-container {
        margin: 2rem auto;
        padding: 1rem;
    }
    
    .status-card {
        padding: 2rem 1.5rem;
    }
    
    .status-icon {
        font-size: 3rem;
        margin-bottom: 1rem;
    }
    
    h2 {
        font-size: 1.5rem !important;
    }
    
    h3 {
        font-size: 1.2rem !important;
    }
}

@media (max-width: 480px) {
    .payment-status-container {
        margin: 1rem auto;
        padding: 0.5rem;
    }
    
    .status-card {
        padding: 1.5rem 1rem;
    }
    
    .status-icon {
        font-size: 2.5rem;
    }
    
    h2 {
        font-size: 1.3rem !important;
    }
    
    div[style*="display: flex"] {
        flex-direction: column !important;
        align-items: center !important;
    }
    
    .btn-primary, .btn-outline {
        width: 100% !important;
        max-width: 250px !important;
        justify-content: center !important;
    }
}

/* Light Mode */
[data-theme="light"] .status-card {
    background: #FFFFFF;
    border: 1px solid rgba(46, 120, 197, 0.2);
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.05);
}

[data-theme="light"] h2,
[data-theme="light"] h3 {
    color: var(--primary-blue) !important;
}

[data-theme="light"] .status-icon.completed {
    color: #059669 !important;
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
            <h2 style="color: #10b981; margin-bottom: 1rem;">🎉 Payment Successful!</h2>
            <p style="color: var(--cool-gray); margin-bottom: 1rem;">
                Congratulations! You have been successfully enrolled in
            </p>
            <h3 style="color: var(--diamond-white); margin-bottom: 1rem; font-size: 1.3rem;">
                {{ $payment->course->title }}
            </h3>
            <p style="color: var(--cool-gray); margin-bottom: 2rem; font-size: 0.95rem;">
                You've earned <strong style="color: #10b981;">120 points</strong> for this purchase! 
                Start learning now and unlock your potential.
            </p>
            <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                <a href="{{ route('courses.show', $payment->course) }}" class="btn-primary" style="padding: 0.75rem 2rem; display: inline-flex; align-items: center; gap: 0.5rem;">
                    <i class="fas fa-play"></i>Start Learning Now
                </a>
                <a href="{{ route('dashboard') }}" class="btn-outline" style="padding: 0.75rem 2rem; display: inline-flex; align-items: center; gap: 0.5rem;">
                    <i class="fas fa-tachometer-alt"></i>Go to Dashboard
                </a>
            </div>
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