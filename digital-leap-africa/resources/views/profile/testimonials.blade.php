@extends('layouts.app')

@section('title', 'My Testimonials')

@section('content')
<section class="section" style="padding:2rem 0;">
  <div class="container">
    <div class="text-center mb-3" style="text-align:center !important; color: #64b5f6; font-size: 22px">
      <h1 class="m-0">My Testimonials</h1>
      <p class="text-muted" style="margin-top:.5rem;color:#94a3b8">View your submitted testimonials and their review status.</p>
    </div>

    <div style="display:flex; gap:.75rem; justify-content:center; margin-bottom:1rem;">
      <a href="{{ route('testimonials.create') }}" class="btn btn-primary btn-wide">Share a Testimonial</a>
    </div>

    @if($testimonials->count())
      <div class="t-list" style="display:grid; gap:1rem; max-width:900px; margin:0 auto;">
        @foreach($testimonials as $t)
          <div class="t-row" style="background:#112240; border:1px solid rgba(136,146,176,0.2); border-radius:12px; padding:1rem; display:grid; grid-template-columns: 72px 1fr auto; gap:1rem; align-items:center;">
            <div class="t-avatar" style="width:56px; height:56px; border-radius:50%; overflow:hidden; background:#0f1a2f; display:flex; align-items:center; justify-content:center; border:1px solid rgba(136,146,176,0.25);">
              @if(!empty($t->avatar_url))
                <img src="{{ $t->avatar_url }}" alt="{{ $t->name ?? ($t->user->name ?? 'User') }}" style="width:100%;height:100%;object-fit:cover;">
              @else
                <div style="color:#64b5f6;font-weight:800;">{{ strtoupper(mb_substr($t->name ?? ($t->user->name ?? 'U'), 0, 1)) }}</div>
              @endif
            </div>
            <div>
              <div style="color:#e6f1ff; font-weight:600; margin-bottom:.25rem;">{{ $t->name ?? ($t->user->name ?? 'Learner') }}</div>
              <div style="color:#94a3b8;">“{{ $t->quote }}”</div>
              <div style="color:#94a3b8; font-size:.875rem; margin-top:.25rem;">Submitted {{ $t->created_at?->format('M d, Y') }}</div>
            </div>
            <div style="text-align:right;">
              @if($t->is_active)
                <span class="reply-count" style="display:inline-block;">Approved</span>
              @else
                <span class="reply-count" style="display:inline-block;">Pending</span>
              @endif
            </div>
          </div>
        @endforeach
      </div>
    @else
      <div class="text-muted" style="text-align:center">You haven't submitted any testimonials yet.</div>
    @endif
  </div>
</section>
@endsection
