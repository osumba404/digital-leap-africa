

<?php $__env->startPush('styles'); ?>
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
    background: var(--cyan-accent);
}

.auth-title {
    font-size: 2rem;
    font-weight: 700;
    text-align: center;
    margin-bottom: 2rem;
    color: var(--cyan-accent);
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
    background: var(--cyan-accent);
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

.divider {
    display: flex;
    align-items: center;
    text-align: center;
    margin: 1.5rem 0;
    color: var(--cool-gray);
    font-size: 0.9rem;
}

.divider::before,
.divider::after {
    content: '';
    flex: 1;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.divider span {
    padding: 0 1rem;
}

.google-button {
    background: #ffffff;
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 8px;
    padding: 0.75rem 2rem;
    color: #1f2937;
    font-weight: 600;
    font-size: 1rem;
    cursor: pointer;
    transition: all 0.3s;
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.75rem;
    margin-bottom: 1rem;
    text-decoration: none;
}

.google-button:hover {
    background: #f8f9fa;
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
}

.google-button img {
    width: 20px;
    height: 20px;
}

/* Light Mode Styles for Google Button */
[data-theme="light"] .google-button {
    background: #ffffff;
    border: 1px solid rgba(46, 120, 197, 0.2);
    color: #1f2937;
}

[data-theme="light"] .google-button:hover {
    background: #f8f9fa;
    border-color: #2E78C5;
}

[data-theme="light"] .divider::before,
[data-theme="light"] .divider::after {
    border-bottom: 1px solid rgba(46, 120, 197, 0.2);
}

[data-theme="light"] .divider {
    color: #4A5568;
}

.password-wrapper {
    position: relative;
}

.password-toggle {
    position: absolute;
    right: 1rem;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    color: var(--cool-gray);
    cursor: pointer;
    padding: 0.25rem;
    transition: color 0.2s;
    font-size: 1.1rem;
}

.password-toggle:hover {
    color: var(--cyan-accent);
}

.password-wrapper .form-control {
    padding-right: 3rem;
}
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="auth-container">
    <div class="auth-card">
        <h1 class="auth-title">Welcome Back</h1>
        
        <?php if(session('status')): ?>
            <div class="success-message">
                <?php echo e(session('status')); ?>

            </div>
        <?php endif; ?>

        <a href="<?php echo e(route('auth.google')); ?>" class="google-button">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M19.8055 10.2292C19.8055 9.55056 19.7501 8.86667 19.6306 8.19861H10.2002V12.0492H15.6014C15.3773 13.2911 14.6571 14.3898 13.6025 15.0875V17.5866H16.8251C18.7174 15.8449 19.8055 13.2728 19.8055 10.2292Z" fill="#4285F4"/>
                <path d="M10.2002 20C12.9502 20 15.2643 19.1056 16.8296 17.5866L13.607 15.0875C12.7096 15.6979 11.5521 16.0433 10.2046 16.0433C7.54614 16.0433 5.29157 14.2831 4.50228 11.9169H1.17773V14.4927C2.78611 17.6889 6.31598 20 10.2002 20Z" fill="#34A853"/>
                <path d="M4.49781 11.9169C4.07781 10.675 4.07781 9.33056 4.49781 8.08861V5.51279H1.17781C-0.207524 8.24028 -0.207524 11.7653 1.17781 14.4928L4.49781 11.9169Z" fill="#FBBC04"/>
                <path d="M10.2002 3.95667C11.6252 3.93556 13.0014 4.47222 14.0378 5.45889L16.8918 2.60444C15.1766 0.990556 12.9325 0.0822222 10.2002 0.104444C6.31598 0.104444 2.78611 2.41556 1.17773 5.51278L4.49773 8.08861C5.28257 5.71778 7.54159 3.95667 10.2002 3.95667Z" fill="#EA4335"/>
            </svg>
            Continue with Google
        </a>

        <div class="divider">
            <span>OR</span>
        </div>

        <form method="POST" action="<?php echo e(route('login')); ?>">
            <?php echo csrf_field(); ?>

            <div class="form-group">
                <label for="email" class="form-label">Email Address</label>
                <input id="email" type="email" name="email" class="form-control" 
                       value="<?php echo e(old('email')); ?>" required autofocus autocomplete="username"
                       placeholder="Enter your email">
                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="error-message"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <div class="password-wrapper">
                    <input id="password" type="password" name="password" class="form-control" 
                           required autocomplete="current-password" placeholder="Enter your password">
                    <button type="button" class="password-toggle" onclick="togglePassword('password')">
                        <i class="fas fa-eye" id="password-icon"></i>
                    </button>
                </div>
                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="error-message"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="remember-forgot">
                <label class="remember-me">
                    <input type="checkbox" name="remember" id="remember_me">
                    Remember me
                </label>
                
                <?php if(Route::has('password.request')): ?>
                    <a href="<?php echo e(route('password.request')); ?>" class="auth-link">
                        Forgot password?
                    </a>
                <?php endif; ?>
            </div>

            <button type="submit" class="auth-button">
                Sign In
            </button>
        </form>

        <div class="auth-footer">
            Don't have an account? 
            <a href="<?php echo e(route('register')); ?>" class="auth-link">Create one here</a>
        </div>
    </div>
</div>

<script>
function togglePassword(fieldId) {
    const passwordField = document.getElementById(fieldId);
    const icon = document.getElementById(fieldId + '-icon');
    
    if (passwordField.type === 'password') {
        passwordField.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        passwordField.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\digital-leap-africa\digital-leap-africa\resources\views/auth/login.blade.php ENDPATH**/ ?>