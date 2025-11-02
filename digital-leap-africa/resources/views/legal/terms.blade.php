@extends('layouts.app')

@section('title', 'Terms of Service')

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
      <h1 class="legal-title">Terms of Service</h1>
      <p class="legal-subtitle">Last updated: {{ date('F j, Y') }}</p>
    </div>
    
    <div class="legal-content">
      <h2>Acceptance of Terms</h2>
      <p>By accessing and using Digital Leap Africa's services, you accept and agree to be bound by the terms and provision of this agreement.</p>

      <h2>Use License</h2>
      <p>Permission is granted to temporarily access the materials on Digital Leap Africa for personal, non-commercial transitory viewing only. This is the grant of a license, not a transfer of title, and under this license you may not:</p>
      
      <ul>
        <li>Modify or copy the materials</li>
        <li>Use the materials for any commercial purpose or for any public display</li>
        <li>Attempt to reverse engineer any software contained on the website</li>
        <li>Remove any copyright or other proprietary notations from the materials</li>
      </ul>

      <h2>Course Enrollment</h2>
      <p>When you enroll in our courses:</p>
      
      <ul>
        <li>Free courses provide immediate access upon enrollment</li>
        <li>Premium courses require admin approval before access is granted</li>
        <li>You are responsible for maintaining the confidentiality of your account</li>
        <li>Course materials are for personal use only</li>
      </ul>

      <h2>User Conduct</h2>
      <p>You agree not to use the service to:</p>
      
      <ul>
        <li>Upload or share inappropriate, offensive, or illegal content</li>
        <li>Harass, abuse, or harm other users</li>
        <li>Violate any applicable laws or regulations</li>
        <li>Interfere with the proper functioning of the platform</li>
      </ul>

      <h2>Intellectual Property</h2>
      <p>All course materials, content, and resources are the intellectual property of Digital Leap Africa or its content creators. Unauthorized use is prohibited.</p>

      <h2>Limitation of Liability</h2>
      <p>Digital Leap Africa shall not be liable for any damages arising from the use or inability to use the materials on its website.</p>

      <h2>Termination</h2>
      <p>We may terminate or suspend your account and access to our services at our sole discretion, without prior notice, for conduct that we believe violates these Terms of Service.</p>

      <h2>Contact Information</h2>
      <p>If you have any questions about these Terms of Service, please contact us at:</p>
      <p><strong>Email:</strong> legal@digitaleapafrica.com</p>
    </div>
  </div>
</div>
@endsection