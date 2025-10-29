@extends('layouts.app')

@section('title', 'Become a Partner')

@section('content')
<section class="section" style="padding:2rem 0;">
  <div class="container">
    <div class="text-center mb-3" style="text-align:center !important; color: #64b5f6; font-size: 22px">
      <h1 class="m-0">Become a Partner</h1>
      <p class="text-muted" style="margin-top:.5rem;color:#94a3b8">Submit your organization details. Applications are reviewed by our admins.</p>
    </div>

    <div class="card" style="background:#112240;border-radius:12px;border:1px solid rgba(136,146,176,0.2);max-width:720px;margin:0 auto;">
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
