@extends('layouts.app')

@section('title', 'Privacy Policy')

@push('styles')
<style>
.legal-page {
  padding: 4rem 0;
  background: var(--navy-bg);
}

.legal-container {
  max-width: 800px;
  margin: 0 auto;
  padding: 0 2rem;
}

.legal-header {
  text-align: center;
  margin-bottom: 3rem;
}

.legal-title {
  font-size: 2.5rem;
  font-weight: 700;
  background: linear-gradient(135deg, #64b5f6, #00d4ff);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  margin-bottom: 1rem;
}

.legal-subtitle {
  color: var(--cool-gray);
  font-size: 1.1rem;
}

.legal-content {
  background: rgba(255, 255, 255, 0.03);
  border: 1px solid rgba(100, 181, 246, 0.15);
  border-radius: 16px;
  padding: 2rem;
  color: var(--cool-gray);
  line-height: 1.7;
}

.legal-content h2 {
  color: var(--diamond-white);
  font-size: 1.5rem;
  margin: 2rem 0 1rem 0;
  font-weight: 600;
}

.legal-content h2:first-child {
  margin-top: 0;
}

.legal-content p {
  margin-bottom: 1rem;
}

.legal-content ul {
  margin: 1rem 0;
  padding-left: 2rem;
}

.legal-content li {
  margin-bottom: 0.5rem;
}

@media (max-width: 768px) {
  .legal-page {
    padding: 2rem 0;
  }
  
  .legal-container {
    padding: 0 1rem;
  }
  
  .legal-title {
    font-size: 2rem;
  }
  
  .legal-content {
    padding: 1.5rem;
  }
}

[data-theme="light"] .legal-page {
  background: #F8FAFC;
}

[data-theme="light"] .legal-title {
  background: linear-gradient(135deg, var(--primary-blue), var(--cyan-accent));
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}

[data-theme="light"] .legal-content {
  background: #FFFFFF;
  border-color: rgba(46, 120, 197, 0.15);
  color: #4A5568;
}

[data-theme="light"] .legal-content h2 {
  color: var(--primary-blue);
}
</style>
@endpush

@section('content')
<div class="legal-page">
  <div class="legal-container">
    <div class="legal-header">
      <h1 class="legal-title">Privacy Policy</h1>
      <p class="legal-subtitle">Last updated: {{ date('F j, Y') }}</p>
    </div>
    
    <div class="legal-content">
      <h2>Information We Collect</h2>
      <p>We collect information you provide directly to us, such as when you create an account, enroll in courses, or contact us for support.</p>
      
      <ul>
        <li>Personal information (name, email address, profile photo)</li>
        <li>Course progress and learning data</li>
        <li>Communication preferences</li>
        <li>Device and usage information</li>
      </ul>

      <h2>How We Use Your Information</h2>
      <p>We use the information we collect to:</p>
      
      <ul>
        <li>Provide and improve our educational services</li>
        <li>Track your learning progress and achievements</li>
        <li>Send you course updates and notifications</li>
        <li>Respond to your questions and support requests</li>
        <li>Analyze usage patterns to enhance user experience</li>
      </ul>

      <h2>Information Sharing</h2>
      <p>We do not sell, trade, or otherwise transfer your personal information to third parties without your consent, except as described in this policy.</p>

      <h2>Data Security</h2>
      <p>We implement appropriate security measures to protect your personal information against unauthorized access, alteration, disclosure, or destruction.</p>

      <h2>Your Rights</h2>
      <p>You have the right to:</p>
      
      <ul>
        <li>Access and update your personal information</li>
        <li>Delete your account and associated data</li>
        <li>Opt out of marketing communications</li>
        <li>Request a copy of your data</li>
      </ul>

      <h2>Contact Us</h2>
      <p>If you have any questions about this Privacy Policy, please contact us at:</p>
      <p><strong>Email:</strong> privacy@digitaleapafrica.com</p>
    </div>
  </div>
</div>
@endsection