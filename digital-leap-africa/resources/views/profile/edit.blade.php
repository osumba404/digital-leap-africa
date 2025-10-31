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

/* Badge Card Styles */
.badge-card {
    display: grid;
    grid-template-columns: auto 1fr;
    gap: 1rem;
    padding: 1rem;
    background: rgba(0, 201, 255, 0.05);
    border: 1px solid rgba(0, 201, 255, 0.2);
    border-radius: 12px;
    margin-bottom: 1rem;
    transition: all 0.3s ease;
}

.badge-card:hover {
    background: rgba(0, 201, 255, 0.08);
    border-color: rgba(0, 201, 255, 0.3);
    transform: translateX(4px);
}

.badge-image {
    width: 60px;
    height: 60px;
    object-fit: cover;
    border-radius: 8px;
    border: 2px solid rgba(0, 201, 255, 0.4);
}

.badge-placeholder {
    width: 60px;
    height: 60px;
    border-radius: 8px;
    background: linear-gradient(135deg, rgba(0, 201, 255, 0.3), rgba(138, 43, 226, 0.3));
    display: flex;
    align-items: center;
    justify-content: center;
    border: 2px solid rgba(0, 201, 255, 0.4);
}

.badge-name {
    margin: 0 0 0.5rem 0;
    font-size: 1.1rem;
    font-weight: 700;
    color: var(--cyan-accent);
}

.badge-description {
    margin: 0;
    color: var(--cool-gray);
    font-size: 0.9rem;
    line-height: 1.5;
}

.badge-date {
    margin: 0.5rem 0 0 0;
    font-size: 0.8rem;
    color: var(--cool-gray);
    opacity: 0.8;
}

.badge-empty {
    text-align: center;
    padding: 2rem;
    color: var(--cool-gray);
}

/* Light Mode Badge Styles */
[data-theme="light"] .badge-card {
    background: rgba(46, 120, 197, 0.05);
    border-color: rgba(46, 120, 197, 0.2);
}

[data-theme="light"] .badge-card:hover {
    background: rgba(46, 120, 197, 0.1);
    border-color: rgba(46, 120, 197, 0.3);
}

[data-theme="light"] .badge-image {
    border-color: rgba(46, 120, 197, 0.4);
}

[data-theme="light"] .badge-placeholder {
    background: linear-gradient(135deg, rgba(46, 120, 197, 0.3), rgba(139, 92, 246, 0.3));
    border-color: rgba(46, 120, 197, 0.4);
}

[data-theme="light"] .badge-placeholder i {
    color: #2563eb;
}

[data-theme="light"] .badge-name {
    color: #2563eb;
}

[data-theme="light"] .badge-description {
    color: #4a5568;
}

[data-theme="light"] .badge-date {
    color: #64748b;
}

[data-theme="light"] .badge-empty {
    color: #64748b;
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

/* Light Mode Styles */
[data-theme="light"] .profile-title {
    background: linear-gradient(90deg, #2E78C5, #7c4dff);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

[data-theme="light"] .profile-subtitle {
    color: #4A5568;
}

[data-theme="light"] .profile-section {
    background: #FFFFFF;
    border: 1px solid rgba(46, 120, 197, 0.2);
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.05);
}

[data-theme="light"] .profile-section:hover {
    border-color: #2E78C5;
    box-shadow: 0 8px 24px rgba(46, 120, 197, 0.2);
}

[data-theme="light"] .section-title {
    color: #1A202C;
}

[data-theme="light"] .section-icon {
    color: #2E78C5;
}

[data-theme="light"] .section-description {
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
    box-shadow: 0 0 0 0.2rem rgba(46, 120, 197, 0.25);
}

[data-theme="light"] .form-control::placeholder {
    color: #94a3b8;
}

[data-theme="light"] .gamification-card {
    background: linear-gradient(135deg, rgba(46, 120, 197, 0.05), rgba(124, 77, 255, 0.05));
    border: 2px solid rgba(46, 120, 197, 0.2);
}

[data-theme="light"] .points-display {
    color: #2E78C5;
}

[data-theme="light"] .level-text {
    color: #1A202C;
}

[data-theme="light"] .progress-bar-container {
    background: rgba(46, 120, 197, 0.1);
}

[data-theme="light"] .progress-bar-fill {
    background: linear-gradient(90deg, #2E78C5, #7c4dff);
}

[data-theme="light"] .badge-item {
    background: #FFFFFF;
    border: 1px solid rgba(46, 120, 197, 0.2);
}

[data-theme="light"] .badge-icon {
    color: #2E78C5;
}

[data-theme="light"] .badge-name {
    color: #1A202C;
}

[data-theme="light"] .badge-description {
    color: #4A5568;
}

[data-theme="light"] .course-item {
    background: #FFFFFF;
    border: 1px solid rgba(46, 120, 197, 0.2);
}

[data-theme="light"] .course-item:hover {
    border-color: #2E78C5;
    box-shadow: 0 4px 12px rgba(46, 120, 197, 0.15);
}

[data-theme="light"] .course-title {
    color: #2E78C5;
}

[data-theme="light"] .course-progress {
    color: #4A5568;
}

[data-theme="light"] .danger-section {
    background: rgba(239, 68, 68, 0.05);
    border-color: rgba(239, 68, 68, 0.2);
}

[data-theme="light"] .password-toggle {
    color: #4A5568;
}

[data-theme="light"] .password-toggle:hover {
    color: #2E78C5;
}
</style>
@endpush

@section('content')
<div class="profile-container">
    <div class="profile-header">
        <h1 class="profile-title">My Profile</h1>
    </div>

    @if(session('google_signup'))
        <div style="background: linear-gradient(135deg, rgba(255, 193, 7, 0.15), rgba(255, 152, 0, 0.15)); border: 2px solid #ffc107; border-radius: 12px; padding: 1.5rem; margin-bottom: 2rem; animation: pulse 2s infinite;">
            <div style="display: flex; align-items: start; gap: 1rem;">
                <div style="flex-shrink: 0;">
                    <i class="fas fa-exclamation-triangle" style="font-size: 2rem; color: #ffc107;"></i>
                </div>
                <div style="flex: 1;">
                    <h3 style="margin: 0 0 0.5rem 0; color: #ffc107; font-size: 1.25rem; font-weight: 700;">
                        <i class="fas fa-key" style="margin-right: 0.5rem;"></i>Important: Change Your Password
                    </h3>
                    <p style="margin: 0 0 1rem 0; color: var(--diamond-white); font-size: 1rem; line-height: 1.6;">
                        {!! session('google_signup') !!}
                    </p>
                    <button onclick="document.getElementById('changePasswordModal').style.display='flex'" style="background: #ffc107; color: #000; border: none; padding: 0.75rem 1.5rem; border-radius: 8px; font-weight: 600; cursor: pointer; transition: all 0.3s; display: inline-flex; align-items: center; gap: 0.5rem;">
                        <i class="fas fa-lock"></i> Change Password Now
                    </button>
                </div>
            </div>
        </div>
    @endif

{{-- Gamification Stats --}}
    <div class="profile-section gamification-card">
      
        <div style="display: grid; grid-template-columns: 120px 1fr; gap: 1.25rem; align-items: center;">
            <div>

    <img src="{{ route('me.photo') }}" alt="{{ $user->name }}" style="width:120px;height:120px;object-fit:cover;border-radius:50%;border:3px solid rgba(0,201,255,0.4);" />        

    </div>
    <div>
                <div style="font-size: 1.25rem; font-weight: 600;">{{ $user->name }}</div>
                <div style="color: var(--cool-gray);">{{ $user->email }}</div>
                <div style="margin-top: 0.5rem; display:flex; gap:0.75rem; flex-wrap: wrap;">
                    <span class="reply-count"><i class="fas fa-user-tag" style="margin-right:6px;"></i>{{ $user->role ?? 'user' }}</span>
                    <span class="reply-count"><i class="fas fa-calendar-alt" style="margin-right:6px;"></i>Joined {{ $user->created_at?->format('M d, Y') }}</span>
                    <span class="reply-count"><i class="fas fa-check" style="margin-right:6px;"></i>{{ $user->email_verified_at ? 'Verified' : 'Not verified' }}</span>
                    <span class="reply-count"><i class="fas fa-book" style="margin-right:6px;"></i>{{ $user->lessons()->count() }} lessons completed</span>
                </div>
            </div>
        </div>
        <div class="points-display">
            {{ $totalPoints ?? 0 }}
            <span class="points-label">Points</span>
        </div>
        <div style="display:flex; gap:0.75rem; flex-wrap:wrap; justify-content:flex-end; margin-top: 0.5rem;">
            <button type="button" class="btn-primary" style="padding: 0.6rem 1rem;" onclick="document.getElementById('updateProfileModal').style.display='flex'">
                <i class="fas fa-user-edit" style="margin-right:8px;"></i>Update Profile
            </button>
            <button type="button" class="btn-outline" style="padding: 0.6rem 1rem;" onclick="document.getElementById('changePasswordModal').style.display='flex'">
                <i class="fas fa-key" style="margin-right:8px;"></i>Change Password
            </button>
            <a href="{{ route('testimonials.create') }}" class="btn-outline" style="padding: 0.6rem 1rem; text-decoration:none; display:inline-flex; align-items:center;">
                <i class="fas fa-quote-left" style="margin-right:8px;"></i>Share a Testimonial
            </a>
            <a href="{{ route('testimonials.index') }}" class="btn-outline" style="padding: 0.6rem 1rem; text-decoration:none; display:inline-flex; align-items:center;">
                <i class="fas fa-comments" style="margin-right:8px;"></i>View Testimonials
            </a>
        </div>
        <p class="section-description">
            Keep participating in courses, completing projects, and engaging with the community to earn more points and unlock exclusive badges!
        </p>
    </div>

    <div class="profile-section">
        <h2 class="section-title">
            <i class="fas fa-user section-icon"></i>
            Profile Information
        </h2>
        <div class="section-description">
            <div style="display:grid; grid-template-columns: 1fr 1fr; gap:1rem;">
                <div>
                    <div style="color: var(--cool-gray);">Full name</div>
                    <div style="font-weight:600;">{{ $user->name }}</div>
                </div>
                <div>
                    <div style="color: var(--cool-gray);">Email</div>
                    <div style="font-weight:600;">{{ $user->email }}</div>
                </div>
                <div>
                    <div style="color: var(--cool-gray);">Role</div>
                    <div style="font-weight:600;">{{ $user->role ?? 'user' }}</div>
                </div>
                <div>
                    <div style="color: var(--cool-gray);">Member since</div>
                    <div style="font-weight:600;">{{ $user->created_at?->format('M d, Y') }}</div>
                </div>
            </div>
        </div>
        @if (session('status') === 'profile-updated')
            <div class="success-message">
                <i class="fas fa-check-circle me-2"></i>Profile updated successfully!
            </div>
        @endif
        <div style="display:flex; justify-content:flex-end;">
            <button type="button" class="btn-primary" onclick="document.getElementById('updateProfileModal').style.display='flex'">
                <i class="fas fa-user-edit" style="margin-right:8px;"></i>Update Profile
            </button>
        </div>
    </div>

    <div class="profile-section">
        <h2 class="section-title">
            <i class="fas fa-lock section-icon"></i>
            Security
        </h2>
        <div class="section-description">Manage your password and account security.</div>
        @if (session('status') === 'password-updated')
            <div class="success-message">
                <i class="fas fa-check-circle me-2"></i>Password updated successfully!
            </div>
        @endif
        <div style="display:flex; justify-content:flex-end;">
            <button type="button" class="btn-outline" onclick="document.getElementById('changePasswordModal').style.display='flex'">
                <i class="fas fa-key" style="margin-right:8px;"></i>Change Password
            </button>
        </div>
    </div>


    <div class="profile-section">
        <h2 class="section-title">
            <i class="fas fa-medal section-icon"></i>
            Badges and Honours
        </h2>
        <div class="section-description">
            @forelse($user->badges as $badge)
                <div style="display:grid; grid-template-columns: auto 1fr; gap:1rem; padding:1rem; background: rgba(0, 201, 255, 0.05); border: 1px solid rgba(0, 201, 255, 0.2); border-radius: 12px; margin-bottom: 1rem;">
                    <div>
                        @if($badge->img_url)
                            <img src="{{ $badge->img_url }}" alt="{{ $badge->badge_name }}" style="width: 60px; height: 60px; object-fit: cover; border-radius: 8px; border: 2px solid rgba(0, 201, 255, 0.4);">
                        @else
                            <div style="width: 60px; height: 60px; border-radius: 8px; background: linear-gradient(135deg, rgba(0, 201, 255, 0.3), rgba(138, 43, 226, 0.3)); display: flex; align-items: center; justify-content: center; border: 2px solid rgba(0, 201, 255, 0.4);">
                                <i class="fas fa-medal" style="font-size: 1.5rem; color: var(--cyan-accent);"></i>
                            </div>
                        @endif
                    </div>
                    <div>
                        <h3 style="margin: 0 0 0.5rem 0; font-size: 1.1rem; font-weight: 700; color: var(--cyan-accent);">
                            <i class="fas fa-medal" style="margin-right: 0.5rem; font-size: 0.9rem;"></i>{{ $badge->badge_name }}
                        </h3>
                        <p style="margin: 0; color: var(--cool-gray); font-size: 0.9rem; line-height: 1.5;">
                            {{ $badge->description ?? 'No description available.' }}
                        </p>
                        @if($badge->pivot && $badge->pivot->awarded_at)
                            <p style="margin: 0.5rem 0 0 0; font-size: 0.8rem; color: var(--cool-gray); opacity: 0.8;">
                                <i class="fas fa-calendar" style="margin-right: 0.25rem;"></i>Awarded on {{ \Carbon\Carbon::parse($badge->pivot->awarded_at)->format('M d, Y') }}
                            </p>
                        @endif
                    </div>
                </div>
            @empty
                <div style="text-align: center; padding: 2rem; color: var(--cool-gray);">
                    <i class="fas fa-medal" style="font-size: 2.5rem; opacity: 0.3; display: block; margin-bottom: 0.75rem;"></i>
                    <p style="margin: 0; font-size: 1rem;">No badges earned yet.</p>
                    <p style="margin: 0.5rem 0 0 0; font-size: 0.85rem; opacity: 0.8;">Keep learning and participating to earn badges!</p>
                </div>
            @endforelse
        </div>
    </div>

    <div class="profile-section">
        <h2 class="section-title">
            <i class="fas fa-book-open section-icon"></i>
            Enrolled Courses
        </h2>
        <div class="section-description">
            @if($user->courses->count())
                <div class="table" style="border-spacing:0;">
                    <div style="display:grid; grid-template-columns: 2fr 1fr 1fr; gap:0.5rem; padding:0.75rem 0; color: var(--cool-gray); border-bottom:1px solid rgba(255,255,255,0.1);">
                        <div>Course</div>
                        <div>Status</div>
                        <div>Enrolled</div>
                    </div>
                    @foreach($user->courses as $course)
                        <div style="display:grid; grid-template-columns: 2fr 1fr 1fr; gap:0.5rem; padding:0.9rem 0; border-bottom:1px solid rgba(255,255,255,0.05);">
                            <div style="font-weight:600;">{{ $course->title ?? $course->name ?? 'Course' }}</div>
                            <div><span class="reply-count">{{ ucfirst($course->pivot->status ?? 'enrolled') }}</span></div>
                            <div>{{ optional($course->pivot->enrolled_at)->format('M d, Y') }}</div>
                        </div>
                    @endforeach
                </div>
            @else
                <div style="color: var(--cool-gray);">No enrollments yet.</div>
            @endif
        </div>
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

<div id="updateProfileModal" style="display:none; position: fixed; top:0; left:0; width:100%; height:100%; background: rgba(0,0,0,0.8); z-index: 1000; align-items: center; justify-content: center;">
    <div style="background: var(--charcoal); padding: 2rem; border-radius: var(--radius); max-width: 640px; width: 92%;">
        <h3 style="margin-top:0; margin-bottom:1rem;">Update Profile</h3>
        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div class="form-group">
                <label for="name" class="form-label">Name</label>
                <input id="name" name="name" type="text" class="form-control" value="{{ old('name', $user->name) }}" required>
                @error('name')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input id="email" name="email" type="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                @error('email')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="profile_photo" class="form-label">Profile Photo</label>
                <input id="profile_photo" name="profile_photo" type="file" class="form-control" accept="image/*">
                @error('profile_photo')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <div style="display:flex; gap: 0.75rem; justify-content:flex-end; margin-top:1rem;">
                <button type="button" class="btn-outline" onclick="document.getElementById('updateProfileModal').style.display='none'">Cancel</button>
                <button type="submit" class="btn-save">Save Changes</button>
            </div>
        </form>
    </div>
</div>

<div id="changePasswordModal" style="display:none; position: fixed; top:0; left:0; width:100%; height:100%; background: rgba(0,0,0,0.8); z-index: 1000; align-items: center; justify-content: center;">
    <div style="background: var(--charcoal); padding: 2rem; border-radius: var(--radius); max-width: 640px; width: 92%;">
        <h3 style="margin-top:0; margin-bottom:1rem;">Change Password</h3>
        
        @if(auth()->user()->google_id)
            <div style="background: rgba(255, 193, 7, 0.1); border: 1px solid rgba(255, 193, 7, 0.3); border-radius: 8px; padding: 0.75rem; margin-bottom: 1rem; font-size: 0.9rem; color: #ffc107;">
                <i class="fas fa-info-circle" style="margin-right: 0.5rem;"></i>
                <strong>Note:</strong> If you signed up with Google, your default password is: <strong>@africa1</strong>
            </div>
        @endif
        
        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            @method('put')
            <div class="form-group">
                <label for="current_password" class="form-label">Current Password</label>
                <div class="password-wrapper">
                    <input id="current_password" name="current_password" type="password" class="form-control" required>
                    <button type="button" class="password-toggle" onclick="togglePasswordModal('current_password')">
                        <i class="fas fa-eye" id="current_password-icon"></i>
                    </button>
                </div>
                @error('current_password')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="password" class="form-label">New Password</label>
                <div class="password-wrapper">
                    <input id="password" name="password" type="password" class="form-control" required>
                    <button type="button" class="password-toggle" onclick="togglePasswordModal('password')">
                        <i class="fas fa-eye" id="password-icon"></i>
                    </button>
                </div>
                @error('password')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <div class="password-wrapper">
                    <input id="password_confirmation" name="password_confirmation" type="password" class="form-control" required>
                    <button type="button" class="password-toggle" onclick="togglePasswordModal('password_confirmation')">
                        <i class="fas fa-eye" id="password_confirmation-icon"></i>
                    </button>
                </div>
                @error('password_confirmation')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <div style="display:flex; gap: 0.75rem; justify-content:flex-end; margin-top:1rem;">
                <button type="button" class="btn-outline" onclick="document.getElementById('changePasswordModal').style.display='none'">Cancel</button>
                <button type="submit" class="btn-save">Update Password</button>
            </div>
        </form>
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
var up = document.getElementById('updateProfileModal');
if (up) up.addEventListener('click', function(e){ if (e.target === this) this.style.display='none'; });
var cp = document.getElementById('changePasswordModal');
if (cp) cp.addEventListener('click', function(e){ if (e.target === this) this.style.display='none'; });
var dm = document.getElementById('deleteModal');
if (dm) dm.addEventListener('click', function(e){ if (e.target === this) this.style.display='none'; });

// Password visibility toggle for change password modal
function togglePasswordModal(fieldId) {
    const passwordField = document.getElementById(fieldId);
    const icon = document.getElementById(fieldId + '-icon');
    
    if (passwordField && icon) {
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
}

// Auto-open change password modal if hash is present
if (window.location.hash === '#changePassword') {
    var modal = document.getElementById('changePasswordModal');
    if (modal) {
        modal.style.display = 'flex';
        // Remove hash from URL
        history.replaceState(null, null, ' ');
    }
}
</script>
@endsection