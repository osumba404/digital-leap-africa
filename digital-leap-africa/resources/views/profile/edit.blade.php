@extends('layouts.app')

@push('styles')
<style>
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes slideInLeft {
    from {
        opacity: 0;
        transform: translateX(-30px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
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

.profile-container {
    max-width: 900px;
    margin: 0 auto;
    padding: 2rem 1rem;
}

.profile-header {
    text-align: center;
    margin-bottom: 3rem;
    animation: fadeInUp 0.8s ease-out;
}

.profile-title {
    font-size: 2.5rem;
    font-weight: 700;
    background: linear-gradient(90deg, var(--cyan-accent), var(--purple-accent));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin-bottom: 0.5rem;
}

.profile-subtitle {
    color: var(--cool-gray);
    font-size: 1.1rem;
}

.profile-section {
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: var(--radius);
    padding: 2rem;
    margin-bottom: 2rem;
    animation: fadeInUp 0.8s ease-out both;
    transition: all 0.3s ease;
}

.profile-section:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
    border-color: rgba(0, 201, 255, 0.2);
}

.profile-section:nth-child(1) { animation-delay: 0.1s; }
.profile-section:nth-child(2) { animation-delay: 0.2s; }
.profile-section:nth-child(3) { animation-delay: 0.3s; }
.profile-section:nth-child(4) { animation-delay: 0.4s; }

.section-title {
    font-size: 1.5rem;
    font-weight: 600;
    color: var(--diamond-white);
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.section-icon {
    color: var(--cyan-accent);
    font-size: 1.25rem;
}

.gamification-card {
    background: linear-gradient(135deg, rgba(0, 201, 255, 0.1) 0%, rgba(122, 95, 255, 0.1) 100%);
    border: 1px solid rgba(0, 201, 255, 0.2);
    position: relative;
    overflow: hidden;
}

.gamification-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: linear-gradient(90deg, var(--cyan-accent), var(--purple-accent));
}

.points-display {
    font-size: 3rem;
    font-weight: 700;
    color: var(--cyan-accent);
    margin: 1rem 0;
    animation: pulse 2s infinite;
}

.points-label {
    font-size: 1rem;
    color: var(--cool-gray);
    margin-left: 0.5rem;
}

.form-section {
    margin-bottom: 1.5rem;
}

.form-section:last-child {
    margin-bottom: 0;
}

.section-description {
    color: var(--cool-gray);
    margin-bottom: 1.5rem;
    line-height: 1.6;
}

.form-group {
    margin-bottom: 1.25rem;
}

.form-label {
    display: block;
    margin-bottom: 0.5rem;
    font-weight: 500;
    color: var(--diamond-white);
}

.form-control {
    width: 100%;
    padding: 0.75rem 1rem;
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 8px;
    color: var(--diamond-white);
    font-size: 1rem;
    transition: all 0.3s ease;
}

.form-control:focus {
    outline: none;
    border-color: var(--cyan-accent);
    box-shadow: 0 0 0 3px rgba(0, 201, 255, 0.1);
    background: rgba(255, 255, 255, 0.08);
}

.btn-save {
    background: linear-gradient(90deg, var(--cyan-accent), var(--purple-accent));
    color: white;
    border: none;
    padding: 0.75rem 2rem;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-save:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(0, 201, 255, 0.3);
}

.btn-danger {
    background: #dc3545;
    color: white;
    border: none;
    padding: 0.75rem 2rem;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-danger:hover {
    background: #c82333;
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(220, 53, 69, 0.3);
}

.danger-section {
    border-color: rgba(220, 53, 69, 0.3);
    background: rgba(220, 53, 69, 0.05);
}

.danger-section .section-title {
    color: #ff6b6b;
}

.danger-section .section-icon {
    color: #ff6b6b;
}

.success-message {
    background: rgba(34, 197, 94, 0.1);
    border: 1px solid rgba(34, 197, 94, 0.3);
    color: #22c55e;
    padding: 0.75rem 1rem;
    border-radius: 8px;
    margin-bottom: 1rem;
    animation: slideInLeft 0.5s ease-out;
}

.error-message {
    color: #ff6b6b;
    font-size: 0.85rem;
    margin-top: 0.5rem;
}

@media (max-width: 768px) {
    .profile-container {
        padding: 1rem 0.5rem;
    }
    
    .profile-title {
        font-size: 2rem;
    }
    
    .profile-section {
        padding: 1.5rem;
    }
    
    .points-display {
        font-size: 2.5rem;
    }
    
    .section-title {
        font-size: 1.25rem;
    }
}

@media (max-width: 480px) {
    .profile-section {
        padding: 1rem;
    }
    
    .points-display {
        font-size: 2rem;
    }
    
    .btn-save,
    .btn-danger {
        width: 100%;
        margin-top: 1rem;
    }
}
</style>
@endpush

@section('content')
<div class="profile-container">
    <div class="profile-header">
        <h1 class="profile-title">My Profile</h1>
        <p class="profile-subtitle">Manage your account settings and preferences</p>
    </div>

    {{-- Gamification Stats --}}
    <div class="profile-section gamification-card">
        <h2 class="section-title">
            <i class="fas fa-trophy section-icon"></i>
            Your Progress
        </h2>
        <div class="points-display">
            {{ Auth::user()->getTotalPoints() ?? 0 }}
            <span class="points-label">Points</span>
        </div>
        <p class="section-description">
            Keep participating in courses, completing projects, and engaging with the community to earn more points and unlock exclusive badges!
        </p>
    </div>

    {{-- Profile Information --}}
    <div class="profile-section">
        <h2 class="section-title">
            <i class="fas fa-user section-icon"></i>
            Profile Information
        </h2>
        <p class="section-description">
            Update your account's profile information and email address.
        </p>

        @if (session('status') === 'profile-updated')
            <div class="success-message">
                <i class="fas fa-check-circle me-2"></i>Profile updated successfully!
            </div>
        @endif

        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('patch')

            <div class="form-group">
                <label for="name" class="form-label">Name</label>
                <input id="name" name="name" type="text" class="form-control" 
                       value="{{ old('name', $user->name) }}" required autofocus>
                @error('name')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input id="email" name="email" type="email" class="form-control" 
                       value="{{ old('email', $user->email) }}" required>
                @error('email')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn-save">
                <i class="fas fa-save me-2"></i>Save Changes
            </button>
        </form>
    </div>

    {{-- Update Password --}}
    <div class="profile-section">
        <h2 class="section-title">
            <i class="fas fa-lock section-icon"></i>
            Update Password
        </h2>
        <p class="section-description">
            Ensure your account is using a long, random password to stay secure.
        </p>

        @if (session('status') === 'password-updated')
            <div class="success-message">
                <i class="fas fa-check-circle me-2"></i>Password updated successfully!
            </div>
        @endif

        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            @method('put')

            <div class="form-group">
                <label for="current_password" class="form-label">Current Password</label>
                <input id="current_password" name="current_password" type="password" class="form-control" required>
                @error('current_password')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password" class="form-label">New Password</label>
                <input id="password" name="password" type="password" class="form-control" required>
                @error('password')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input id="password_confirmation" name="password_confirmation" type="password" class="form-control" required>
                @error('password_confirmation')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn-save">
                <i class="fas fa-key me-2"></i>Update Password
            </button>
        </form>
    </div>

    {{-- Delete Account --}}
    <div class="profile-section danger-section">
        <h2 class="section-title">
            <i class="fas fa-exclamation-triangle section-icon"></i>
            Delete Account
        </h2>
        <p class="section-description">
            Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.
        </p>

        <button type="button" class="btn-danger" onclick="document.getElementById('deleteModal').style.display='block'">
            <i class="fas fa-trash me-2"></i>Delete Account
        </button>
    </div>
</div>

{{-- Delete Confirmation Modal --}}
<div id="deleteModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.8); z-index: 1000; align-items: center; justify-content: center;">
    <div style="background: var(--charcoal); padding: 2rem; border-radius: var(--radius); max-width: 500px; margin: 1rem;">
        <h3 style="color: #ff6b6b; margin-bottom: 1rem;">Are you sure?</h3>
        <p style="color: var(--cool-gray); margin-bottom: 2rem;">
            Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm.
        </p>
        
        <form method="POST" action="{{ route('profile.destroy') }}">
            @csrf
            @method('delete')
            
            <div class="form-group">
                <label for="delete_password" class="form-label">Password</label>
                <input id="delete_password" name="password" type="password" class="form-control" required>
            </div>
            
            <div style="display: flex; gap: 1rem; margin-top: 1.5rem;">
                <button type="button" class="btn-outline" onclick="document.getElementById('deleteModal').style.display='none'">
                    Cancel
                </button>
                <button type="submit" class="btn-danger">
                    Delete Account
                </button>
            </div>
        </form>
    </div>
</div>

<script>
// Close modal when clicking outside
document.getElementById('deleteModal').addEventListener('click', function(e) {
    if (e.target === this) {
        this.style.display = 'none';
    }
});
</script>
@endsection