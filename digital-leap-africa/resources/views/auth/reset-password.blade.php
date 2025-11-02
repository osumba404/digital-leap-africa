@extends('layouts.app')

@push('styles')
<style>
/* Same styles as forgot-password.blade.php */
@keyframes slideInUp {
    from {
        opacity: 0;
        transform: translateY(50px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

.auth-container {
    min-height: calc(100vh - var(--header-height));
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, var(--navy-bg) 0%, var(--charcoal) 100%);
    padding: 2rem 1rem;
}

.auth-card {
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: var(--radius);
    padding: 3rem;
    width: 100%;
    max-width: 450px;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.4);
    backdrop-filter: blur(10px);
    position: relative;
    overflow: hidden;
    animation: slideInUp 0.8s ease-out;
}

.auth-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, var(--cyan-accent), var(--purple-accent));
}

.auth-title {
    font-size: 2rem;
    font-weight: 700;
    text-align: center;
    margin-bottom: 1rem;
    background: linear-gradient(90deg, var(--cyan-accent), var(--purple-accent));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    animation: fadeIn 1s ease-out 0.3s both;
}

.auth-description {
    text-align: center;
    color: var(--cool-gray);
    font-size: 0.95rem;
    margin-bottom: 2rem;
    line-height: 1.6;
    animation: fadeIn 0.6s ease-out 0.4s both;
}

.form-group {
    margin-bottom: 1.5rem;
    animation: fadeIn 0.6s ease-out 0.5s both;
}

.form-label {
    color: var(--diamond-white);
    font-weight: 500;
    margin-bottom: 0.5rem;
    display: block;
}

.form-control {
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 8px;
    padding: 0.75rem 1rem;
    color: var(--diamond-white);
    font-size: 1rem;
    transition: all 0.3s;
    width: 100%;
}

.form-control:focus {
    background: rgba(255, 255, 255, 0.08);
    border-color: var(--cyan-accent);
    box-shadow: 0 0 0 3px rgba(0, 201, 255, 0.1);
    outline: none;
}

.form-control::placeholder {
    color: var(--cool-gray);
}

.auth-button {
    background: linear-gradient(90deg, var(--cyan-accent), var(--purple-accent));
    border: none;
    border-radius: 8px;
    padding: 0.75rem 2rem;
    color: white;
    font-weight: 600;
    font-size: 1rem;
    cursor: pointer;
    transition: all 0.3s;
    width: 100%;
    margin-top: 1rem;
    animation: fadeIn 0.6s ease-out 0.6s both;
}

.auth-button:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(0, 201, 255, 0.3);
}

.auth-footer {
    text-align: center;
    margin-top: 2rem;
    padding-top: 1.5rem;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
    color: var(--cool-gray);
    font-size: 0.9rem;
    animation: fadeIn 0.6s ease-out 0.7s both;
}

.auth-link {
    color: var(--cyan-accent);
    text-decoration: none;
    font-weight: 500;
    transition: color 0.2s;
}

.auth-link:hover {
    color: var(--diamond-white);
}

.error-message {
    color: #ff6b6b;
    font-size: 0.85rem;
    margin-top: 0.5rem;
}

.success-message {
    background: rgba(34, 197, 94, 0.1);
    border: 1px solid rgba(34, 197, 94, 0.3);
    color: #22c55e;
    padding: 0.75rem 1rem;
    border-radius: 8px;
    margin-bottom: 1.5rem;
    font-size: 0.9rem;
    animation: fadeIn 0.6s ease-out 0.4s both;
}

/* Light Mode Styles */
[data-theme="light"] .auth-container {
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
}

[data-theme="light"] .auth-card {
    background: #FFFFFF;
    border: 1px solid rgba(46, 120, 197, 0.2);
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
}

[data-theme="light"] .auth-title {
    background: linear-gradient(90deg, #2E78C5, #7c4dff);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

[data-theme="light"] .auth-description {
    color: #4A5568;
}

[data-theme="light"] .form-label {
    color: #1A202C;
}

[data-theme="light"] .form-control {
    background: #F8FAFC;
    border: 1px solid rgba(46, 120, 197, 0.2);
    color: #1A202C;
}

[data-theme="light"] .form-control:focus {
    background: #FFFFFF;
    border-color: #2E78C5;
    box-shadow: 0 0 0 3px rgba(46, 120, 197, 0.1);
}

[data-theme="light"] .form-control::placeholder {
    color: #94a3b8;
}

[data-theme="light"] .auth-footer {
    border-top: 1px solid rgba(46, 120, 197, 0.2);
    color: #4A5568;
}

@media (max-width: 768px) {
    .auth-container {
        padding: 1rem;
    }
    
    .auth-card {
        padding: 2rem 1.5rem;
        margin: 0.5rem;
        max-width: 100%;
    }
    
    .auth-title {
        font-size: 1.75rem;
    }
}

@media (max-width: 480px) {
    .auth-card {
        padding: 1.5rem 1rem;
    }
    
    .auth-title {
        font-size: 1.5rem;
    }
    
    .form-control {
        padding: 0.6rem 0.8rem;
        font-size: 0.9rem;
    }
    
    .auth-button {
        padding: 0.6rem 1.5rem;
        font-size: 0.9rem;
    }
}
</style>
@endpush

@section('content')
<div class="auth-container">
    <div class="auth-card">
        <h1 class="auth-title">Reset Password</h1>
        
        <p class="auth-description">
            Enter your new password below to complete the reset process.
        </p>
        
        @if (session('status'))
            <div class="success-message">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="/reset-password">
            @csrf

            <input type="hidden" name="token" value="{{ request()->route('token') }}">
            <input type="hidden" name="email" value="{{ request()->get('email') }}">

            <div class="form-group">
                <label for="email" class="form-label">Email Address</label>
                <input id="email" type="email" class="form-control" 
                       value="{{ request()->get('email') }}" readonly>
            </div>

            <div class="form-group">
                <label for="password" class="form-label">New Password</label>
                <input id="password" type="password" name="password" class="form-control" 
                       required autofocus placeholder="Enter new password">
                @error('password')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" 
                       class="form-control" required placeholder="Confirm new password">
            </div>

            <button type="submit" class="auth-button">
                Reset Password
            </button>
        </form>

        <div class="auth-footer">
            Remember your password? 
            <a href="{{ route('login') }}" class="auth-link">Sign in here</a>
        </div>
    </div>
</div>
@endsection