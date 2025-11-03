@extends('layouts.app')

@section('title', 'Become a Partner')

@push('styles')
<style>
/* Light Mode Styles for Partner Application Form */
[data-theme="light"] .partner-apply-title {
    color: #2E78C5 !important;
}

[data-theme="light"] .partner-apply-subtitle {
    color: #4A5568 !important;
}

[data-theme="light"] .partner-apply-card {
    background: #FFFFFF !important;
    border: 1px solid rgba(46, 120, 197, 0.2) !important;
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.05) !important;
}

[data-theme="light"] .partner-apply-card .form-label {
    color: #1A202C !important;
}

[data-theme="light"] .partner-apply-card .form-control {
    background: #F8FAFC !important;
    border: 1px solid rgba(46, 120, 197, 0.2) !important;
    color: #1A202C !important;
}

[data-theme="light"] .partner-apply-card .form-control:focus {
    background: #FFFFFF !important;
    border-color: #2E78C5 !important;
    box-shadow: 0 0 0 0.2rem rgba(46, 120, 197, 0.25) !important;
}

[data-theme="light"] .partner-apply-card .form-control::placeholder {
    color: #94a3b8 !important;
}
</style>
@endpush

@section('content')
<section class="section" style="padding:2rem 0;">
  <div class="container">
    <div class="text-center mb-3" style="text-align:center !important;">
      <h1 class="m-0 partner-apply-title" style="color: #64b5f6; font-size: 22px">Become a Partner</h1>
      <p class="partner-apply-subtitle" style="margin-top:.5rem;color:#94a3b8">Submit your organization details. Applications are reviewed by our admins.</p>
    </div>

    <div class="card partner-apply-card" style="background:#112240;border-radius:12px;border:1px solid rgba(136,146,176,0.2);max-width:720px;margin:0 auto;">
      <div class="card-body" style="padding:1.25rem 1.25rem;">
        <form method="POST" action="{{ route('partners.store') }}" enctype="multipart/form-data">
          @csrf

          <div class="mb-3">
            <label class="form-label">Organization Name</label>
            <input type="text" name="name" value="{{ old('name') }}" class="form-control" required>
            @error('name')
              <div class="text-danger" style="margin-top:.25rem;">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-3">
            <label class="form-label">Contact Person</label>
            <input type="text" name="contact_person" value="{{ old('contact_person') }}" class="form-control" required>
            @error('contact_person')
              <div class="text-danger" style="margin-top:.25rem;">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-3">
            <label class="form-label">Email Address</label>
            <input type="email" name="email" value="{{ old('email') }}" class="form-control" required>
            @error('email')
              <div class="text-danger" style="margin-top:.25rem;">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-3">
            <label class="form-label">Phone Number (optional)</label>
            <input type="tel" name="phone" value="{{ old('phone') }}" class="form-control" placeholder="+254 700 000 000">
            @error('phone')
              <div class="text-danger" style="margin-top:.25rem;">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-3">
            <label class="form-label">Website URL (optional)</label>
            <input type="url" name="website_url" value="{{ old('website_url') }}" class="form-control" placeholder="https://example.org">
            @error('website_url')
              <div class="text-danger" style="margin-top:.25rem;">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-3">
            <label class="form-label">Logo Image</label>
            <input type="file" name="logo" accept="image/*" class="form-control" required>
            @error('logo')
              <div class="text-danger" style="margin-top:.25rem;">{{ $message }}</div>
            @enderror
          </div>

          <div class="d-grid">
            <button type="submit" class="btn btn-primary btn-wide">Submit Application</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
@endsection
