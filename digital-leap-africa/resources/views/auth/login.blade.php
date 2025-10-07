@extends('layouts.app')

@push('styles')
<style>
/* Animations */
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

@keyframes pulse {
    0%, 100% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.02);
    }
}

@keyframes shimmer {
    0% {
        background-position: -200px 0;
    }
    100% {
        background-position: calc(200px + 100%) 0;
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
    margin-bottom: 2rem;
    background: linear-gradient(90deg, var(--cyan-accent), var(--purple-accent));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    animation: fadeIn 1s ease-out 0.3s both;
    position: relative;
}

.auth-title::after {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    animation: shimmer 2s infinite;
}

.form-group {
    margin-bottom: 1.5rem;
    animation: fadeIn 0.6s ease-out both;
}

.form-group:nth-child(1) { animation-delay: 0.4s; }
.form-group:nth-child(2) { animation-delay: 0.5s; }
.form-group:nth-child(3) { animation-delay: 0.6s; }

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

.remember-forgot {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin: 1.5rem 0;
    flex-wrap: wrap;
    gap: 1rem;
}

.remember-me {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: var(--cool-gray);
    font-size: 0.9rem;
    cursor: pointer;
}

.remember-me input[type="checkbox"] {
    width: 1rem;
    height: 1rem;
    accent-color: var(--cyan-accent);
}

.auth-link {
    color: var(--cyan-accent);
    text-decoration: none;
    font-size: 0.9rem;
    font-weight: 500;
    transition: color 0.2s;
}

.auth-link:hover {
    color: var(--diamond-white);
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
    animation: fadeIn 0.6s ease-out 0.7s both;
    position: relative;
    overflow: hidden;
}

.auth-button::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s;
}

.auth-button:hover::before {
    left: 100%;
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
    animation: fadeIn 0.6s ease-out 0.8s both;
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
    
    .remember-forgot {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.75rem;
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
        <h1 class="auth-title">Welcome Back</h1>
        
        @if (session('status'))
            <div class="success-message">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <label for="email" class="form-label">Email Address</label>
                <input id="email" type="email" name="email" class="form-control" 
                       value="{{ old('email') }}" required autofocus autocomplete="username"
                       placeholder="Enter your email">
                @error('email')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input id="password" type="password" name="password" class="form-control" 
                       required autocomplete="current-password" placeholder="Enter your password">
                @error('password')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="remember-forgot">
                <label class="remember-me">
                    <input type="checkbox" name="remember" id="remember_me">
                    Remember me
                </label>
                
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="auth-link">
                        Forgot password?
                    </a>
                @endif
            </div>

            <button type="submit" class="auth-button">
                Sign In
            </button>
        </form>

        <div class="auth-footer">
            Don't have an account? 
            <a href="{{ route('register') }}" class="auth-link">Create one here</a>
        </div>
    </div>
</div>
@endsection