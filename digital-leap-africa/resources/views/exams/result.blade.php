@extends('layouts.app')

@section('title', 'Test Result - ' . $attempt->exam->title . ' | Digital Leap Africa')

@section('content')
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-lg-8">
      <div class="lesson-header text-center" style="background: rgba(255, 255, 255, 0.03); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 12px; padding: 2rem; margin-bottom: 2rem;">
        <h1 style="font-size: 1.75rem; font-weight: 700; color: var(--diamond-white); margin-bottom: 0.5rem;">
          {{ $attempt->exam->title }}
        </h1>
        <p style="color: var(--cool-gray); margin-bottom: 1.5rem;">Test Result</p>
        <div style="font-size: 3rem; font-weight: 700; color: var(--cyan-accent); margin-bottom: 0.5rem;">
          {{ $attempt->percentage }}%
        </div>
        <p style="color: var(--cool-gray);">
          {{ $attempt->total_points_earned }} / {{ $attempt->total_points_possible }} points
        </p>
      </div>

      <div class="lesson-content mb-4" style="background: rgba(255, 255, 255, 0.03); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 12px; padding: 1.5rem;">
        <h3 style="color: var(--diamond-white); margin-bottom: 1rem;">Review Answers</h3>
        @foreach($attempt->exam->questions as $index => $question)
          @php
            $answer = $attempt->answers->firstWhere('exam_question_id', $question->id);
            $pointsEarned = $answer ? $answer->points_earned : 0;
            $isCorrect = $pointsEarned >= $question->points;
          @endphp
          <div class="mb-4 pb-4" style="border-bottom: 1px solid rgba(255,255,255,0.08);">
            <p class="fw-semibold mb-2" style="color: var(--diamond-white);">
              {{ $index + 1 }}. {{ $question->question_text }}
              <span class="badge {{ $isCorrect ? 'bg-success' : 'bg-danger' }} ms-2">
                {{ $pointsEarned }}/{{ $question->points }} pts
              </span>
            </p>
            @if($question->question_type === 'text' && $answer && $answer->text_answer)
              <p style="color: var(--cool-gray);"><strong>Your answer:</strong> {{ $answer->text_answer }}</p>
            @elseif($answer && $answer->selected_option_ids)
              @php $selectedOpts = $question->options->whereIn('id', $answer->selected_option_ids); @endphp
              <p style="color: var(--cool-gray);"><strong>Your answer:</strong> {{ $selectedOpts->pluck('option_text')->join(', ') }}</p>
            @endif
          </div>
        @endforeach
      </div>

      <div class="d-flex gap-2">
        <a href="{{ route('courses.show', $attempt->exam->course) }}" class="btn-primary" style="padding: 0.75rem 1.5rem;">
          <i class="fas fa-arrow-left me-2"></i>Back to Course
        </a>
        @if($attempt->exam->lesson)
          <a href="{{ route('lessons.show', $attempt->exam->lesson) }}" class="btn-outline" style="padding: 0.75rem 1.5rem;">
            Back to Lesson
          </a>
        @endif
      </div>
    </div>
  </div>
</div>
@endsection
