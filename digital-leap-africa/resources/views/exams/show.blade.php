@extends('layouts.app')

@section('title', $exam->title . ' - Test | Digital Leap Africa')

@section('content')
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-lg-8">
      <div class="lesson-header" style="background: rgba(255, 255, 255, 0.03); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 12px; padding: 2rem; margin-bottom: 2rem;">
        <div class="breadcrumb mb-2">
          <a href="{{ route('courses.show', $exam->course) }}">{{ $exam->course->title }}</a>
          <span class="mx-2">›</span>
          <span>{{ $exam->title }}</span>
        </div>
        <h1 style="font-size: 1.75rem; font-weight: 700; color: var(--diamond-white); margin-bottom: 0.5rem;">
          {{ $exam->title }}
        </h1>
        @if($exam->description)
          <p style="color: var(--cool-gray); margin-bottom: 1rem;">{{ $exam->description }}</p>
        @endif
        <div style="display: flex; gap: 1rem; flex-wrap: wrap; color: var(--cool-gray); font-size: 0.9rem;">
          <span><i class="fas fa-question-circle me-1"></i>{{ $exam->questions->count() }} questions</span>
          <span><i class="fas fa-star me-1"></i>{{ $totalPoints }} points total</span>
          @if($exam->time_limit_minutes)
            <span><i class="fas fa-clock me-1"></i>{{ $exam->time_limit_minutes }} min limit</span>
          @endif
          @if($exam->count_towards_final_grade)
            <span class="text-success"><i class="fas fa-check me-1"></i>Counts toward final grade</span>
          @endif
        </div>
      </div>

      @if($existingAttempt)
        <div class="lesson-content" style="background: rgba(255, 255, 255, 0.03); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 12px; padding: 2rem; margin-bottom: 2rem;">
          <h3 style="color: var(--diamond-white); margin-bottom: 1rem;">
            <i class="fas fa-check-circle text-success me-2"></i>You've already completed this test
          </h3>
          <p style="color: var(--cool-gray); margin-bottom: 1.5rem;">
            Score: {{ $existingAttempt->total_points_earned }}/{{ $existingAttempt->total_points_possible }} ({{ $existingAttempt->percentage }}%)
          </p>
          <a href="{{ route('exams.result', $existingAttempt) }}" class="btn-primary" style="padding: 0.75rem 1.5rem;">
            <i class="fas fa-chart-bar me-2"></i>View Results
          </a>
        </div>
      @else
        <div class="lesson-content" style="background: rgba(255, 255, 255, 0.03); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 12px; padding: 2rem; margin-bottom: 2rem;">
          <p style="color: var(--cool-gray); margin-bottom: 1.5rem;">
            Answer all questions to complete this test. Your score will count toward your final grade.
          </p>
          <form method="POST" action="{{ route('exams.start', $exam) }}">
            @csrf
            <button type="submit" class="btn-primary" style="padding: 0.75rem 2rem; font-size: 1.1rem;">
              <i class="fas fa-play me-2"></i>Start Test
            </button>
          </form>
        </div>
      @endif

      <a href="{{ route('courses.show', $exam->course) }}" class="btn-outline" style="padding: 0.75rem 1.5rem;">
        <i class="fas fa-arrow-left me-2"></i>Back to Course
      </a>
    </div>
  </div>
</div>
@endsection
