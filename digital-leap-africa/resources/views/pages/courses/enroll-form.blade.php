@extends('layouts.app')

@section('title', 'Confirm Details - ' . $course->title . ' | Digital Leap Africa')

@section('content')
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-lg-6">
      <div class="lesson-header" style="background: rgba(255, 255, 255, 0.03); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 12px; padding: 2rem; margin-bottom: 2rem;">
        <div class="breadcrumb mb-2">
          <a href="{{ route('courses.show', $course) }}">{{ $course->title }}</a>
          <span class="mx-2">›</span>
          <span>Confirm your details</span>
        </div>
        <h1 style="font-size: 1.5rem; font-weight: 700; color: var(--diamond-white); margin-bottom: 0.5rem;">
          Confirm your details
        </h1>
        <p style="color: var(--cool-gray); margin-bottom: 0;">
          Please confirm your name and email before enrolling in <strong>{{ $course->title }}</strong>.
        </p>
      </div>

      @if($preCourseTest)
        <div style="background: rgba(0, 201, 255, 0.08); border: 1px solid rgba(0, 201, 255, 0.25); border-radius: 12px; padding: 1.25rem; margin-bottom: 2rem;">
          <p style="color: var(--diamond-white); margin: 0; font-size: 0.95rem;">
            <i class="fas fa-clipboard-check me-2" style="color: var(--cyan-accent);"></i>
            After you confirm, you will take a short <strong>pre-course test</strong> before your enrollment is activated. It does not count toward your final grade.
          </p>
        </div>
      @endif

      <div class="lesson-content" style="background: rgba(255, 255, 255, 0.03); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 12px; padding: 2rem;">
        <form method="POST" action="{{ route('courses.confirm-enroll', $course) }}">
          @csrf
          <div class="mb-4">
            <label for="name" class="form-label" style="color: var(--diamond-white); font-weight: 600;">Full name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" required
                   style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); color: var(--diamond-white); padding: 0.75rem;">
            @error('name')
              <p class="text-danger small mt-1">{{ $message }}</p>
            @enderror
          </div>
          <div class="mb-4">
            <label for="email" class="form-label" style="color: var(--diamond-white); font-weight: 600;">Email address</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" required
                   style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); color: var(--diamond-white); padding: 0.75rem;">
            @error('email')
              <p class="text-danger small mt-1">{{ $message }}</p>
            @enderror
          </div>
          <div class="d-flex gap-2 flex-wrap">
            <button type="submit" class="btn-primary" style="padding: 0.75rem 2rem; font-size: 1.05rem;">
              @if($preCourseTest)
                <i class="fas fa-arrow-right me-2"></i>Confirm &amp; take pre-course test
              @else
                <i class="fas fa-check me-2"></i>Confirm &amp; enroll
              @endif
            </button>
            <a href="{{ route('courses.show', $course) }}" class="btn-outline" style="padding: 0.75rem 1.5rem;">Cancel</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
