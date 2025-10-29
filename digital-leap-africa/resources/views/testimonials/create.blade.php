@extends('layouts.app')

@section('title', 'Share a Testimonial')

@section('content')
<section class="section" style="padding:2rem 0;">
  <div class="container">
    <div class="text-center mb-3" style="text-align:center !important; color: #64b5f6; font-size: 22px">
      <h1 class="m-0">Share a Testimonial</h1>
      <p class="text-muted" style="margin-top:.5rem;color:#94a3b8">Tell others about your learning experience. Submissions are reviewed before publishing.</p>
    </div>

    <div class="card" style="background:#112240;border-radius:12px;border:1px solid rgba(136,146,176,0.2);max-width:760px;margin:0 auto;">
      <div class="card-body" style="padding:1.25rem 1.25rem;">
        <form method="POST" action="{{ route('testimonials.store') }}" enctype="multipart/form-data">
          @csrf

          <div class="mb-3">
            <label class="form-label">Your Testimonial</label>
            <textarea name="quote" rows="5" class="form-control" placeholder="Share how Digital Leap Africa helped you..." required>{{ old('quote') }}</textarea>
            @error('quote')
              <div class="text-danger" style="margin-top:.25rem;">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-3">
            <label class="form-label">Avatar (optional)</label>
            <input type="file" name="avatar" accept="image/*" class="form-control">
            @error('avatar')
              <div class="text-danger" style="margin-top:.25rem;">{{ $message }}</div>
            @enderror
          </div>

          <div class="d-grid" style="display:grid; gap:.75rem; grid-template-columns: 1fr;">
            <button type="submit" class="btn btn-primary btn-wide">Submit Testimonial</button>
            <a href="{{ route('profile.testimonials') }}" class="btn btn-outline-secondary btn-wide">View My Testimonials</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
@endsection
