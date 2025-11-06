@extends('layouts.app')

@section('title', 'Contact Us')

@section('content')
<section class="section">
    <div class="container">
        <div class="section-title">
            <h1 style="font-size: 2.5rem;">Contact Us</h1>
            <p>Get in touch with us. We'd love to hear from you!</p>
        </div>

        <div class="contact-grid">
            <!-- Contact Form -->
            <div class="contact-form-card">
                <h2>Send us a Message</h2>
                
                @if(session('success'))
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i>
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('contact.store') }}" method="POST" class="contact-form">
                    @csrf
                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required>
                        @error('name')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                        @error('email')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="subject">Subject</label>
                        <input type="text" id="subject" name="subject" value="{{ old('subject') }}" required>
                        @error('subject')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea id="message" name="message" rows="6" required>{{ old('message') }}</textarea>
                        @error('message')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="btn-primary">
                        <i class="fas fa-paper-plane"></i>
                        Send Message
                    </button>
                </form>
            </div>

            <!-- Contact Info -->
            <div class="contact-info-card">
                <h2>Get in Touch</h2>
                <div class="contact-info">
                    <div class="contact-item">
                        <i class="fas fa-envelope"></i>
                        <div>
                            <h3>Email</h3>
                            <p>{{ \App\Helpers\SettingsHelper::get('contact_email', 'info@digitaleapafrica.com') }}</p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-phone"></i>
                        <div>
                            <h3>Phone</h3>
                            <p>{{ \App\Helpers\SettingsHelper::get('phone_number', '+254 700 000 000') }}</p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <div>
                            <h3>Address</h3>
                            <p>{{ \App\Helpers\SettingsHelper::get('address', 'Nairobi, Kenya') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.section-title {
    text-align: center;
    margin-bottom: 3rem;
}

.section-title h1 {
    font-weight: 700;
    color: #64b5f6;
    margin-bottom: 0.5rem;
}

.section-title p {
    color: var(--cool-gray);
    font-size: 1.1rem;
}

.contact-grid {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 3rem;
    max-width: 1200px;
    margin: 0 auto;
}

.contact-form-card,
.contact-info-card {
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 16px;
    padding: 2rem;
}

.contact-form-card h2,
.contact-info-card h2 {
    color: var(--diamond-white);
    margin-bottom: 1.5rem;
    font-size: 1.5rem;
}

.alert {
    padding: 1rem;
    border-radius: 8px;
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.alert-success {
    background: rgba(16, 185, 129, 0.1);
    border: 1px solid rgba(16, 185, 129, 0.3);
    color: #10b981;
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-group label {
    display: block;
    margin-bottom: 0.5rem;
    color: var(--diamond-white);
    font-weight: 600;
}

.form-group input,
.form-group textarea {
    width: 100%;
    padding: 0.75rem;
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 8px;
    background: rgba(255, 255, 255, 0.05);
    color: var(--diamond-white);
    font-size: 1rem;
}

.form-group input:focus,
.form-group textarea:focus {
    outline: none;
    border-color: var(--cyan-accent);
    box-shadow: 0 0 0 2px rgba(0, 201, 255, 0.2);
}

.error {
    color: #ef4444;
    font-size: 0.875rem;
    margin-top: 0.25rem;
    display: block;
}

.btn-primary {
    background: linear-gradient(135deg, var(--cyan-accent), var(--primary-blue));
    color: white;
    border: none;
    padding: 0.875rem 2rem;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(0, 201, 255, 0.3);
}

.contact-info {
    display: flex;
    flex-direction: column;
    gap: 2rem;
}

.contact-item {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
}

.contact-item i {
    color: var(--cyan-accent);
    font-size: 1.5rem;
    margin-top: 0.25rem;
}

.contact-item h3 {
    color: var(--diamond-white);
    margin-bottom: 0.25rem;
    font-size: 1.1rem;
}

.contact-item p {
    color: var(--cool-gray);
    margin: 0;
}

/* Light Mode */
[data-theme="light"] .contact-form-card,
[data-theme="light"] .contact-info-card {
    background: #FFFFFF;
    border: 1px solid rgba(46, 120, 197, 0.2);
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
}

[data-theme="light"] .contact-form-card h2,
[data-theme="light"] .contact-info-card h2,
[data-theme="light"] .form-group label,
[data-theme="light"] .contact-item h3 {
    color: var(--charcoal);
}

[data-theme="light"] .form-group input,
[data-theme="light"] .form-group textarea {
    background: #FFFFFF;
    border-color: rgba(46, 120, 197, 0.2);
    color: var(--charcoal);
}

[data-theme="light"] .contact-item i {
    color: var(--primary-blue);
}

[data-theme="light"] .section-title h1 {
    color: var(--primary-blue);
}

/* Mobile Responsive */
@media (max-width: 768px) {
    .contact-grid {
        grid-template-columns: 1fr;
        gap: 2rem;
    }
    
    .contact-form-card,
    .contact-info-card {
        padding: 1.5rem;
    }
}
</style>
@endsection