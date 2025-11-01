@extends('layouts.app')

@push('styles')
<style>
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
}

.auth-description {
    text-align: center;
    color: var(--cool-gray);
    font-size: 0.95rem;
    margin-bottom: 2rem;
    line-height: 1.6;
}

.form-group {
    margin-bottom: 1.5rem;
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
}

.warning-box {
    background: rgba(255, 193, 7, 0.1);
    border: 1px solid rgba(255, 193, 7, 0.3);
    color: #ffc107;
    padding: 1rem;
    border-radius: 8px;
    margin-bottom: 1.5rem;
    font-size: 0.9rem;
}
</style>
@endpush

@section('content')
<div class="auth-container">
    <div class="auth-card">
        <h1 class="auth-title">Reset Password</h1>
        
        <div class="warning-box">
            <i class="fas fa-info-circle me-2"></i>
            <strong>Note:</strong> Since email is not configured, you can directly reset your password here by entering your email and new password.
        </div>

        <form method="POST" action="{{ route('password.simple-reset') }}">
            @csrf

            <div class="form-group">
                <label for="email" class="form-label">Email Address</label>
                <input id="email" type="email" name="email" class="form-control" 
                       value="{{ old('email') }}" required autofocus
                       placeholder="Enter your email">
                @error('email')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password" class="form-label">New Password</label>
                <input id="password" type="password" name="password" class="form-control" 
                       required placeholder="Enter new password">
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