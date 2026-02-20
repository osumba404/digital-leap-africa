

<?php $__env->startSection('title', 'Test Result - ' . $attempt->exam->title . ' | Digital Leap Africa'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-lg-8">
      <div class="lesson-header text-center" style="background: rgba(255, 255, 255, 0.03); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 12px; padding: 2rem; margin-bottom: 2rem;">
        <h1 style="font-size: 1.75rem; font-weight: 700; color: var(--diamond-white); margin-bottom: 0.5rem;">
          <?php echo e($attempt->exam->title); ?>

        </h1>
        <p style="color: var(--cool-gray); margin-bottom: 1.5rem;">Test Result</p>
        <div style="font-size: 3rem; font-weight: 700; color: var(--cyan-accent); margin-bottom: 0.5rem;">
          <?php echo e($attempt->percentage); ?>%
        </div>
        <p style="color: var(--cool-gray);">
          <?php echo e($attempt->total_points_earned); ?> / <?php echo e($attempt->total_points_possible); ?> points
        </p>
      </div>

      <div class="lesson-content mb-4" style="background: rgba(255, 255, 255, 0.03); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 12px; padding: 1.5rem;">
        <h3 style="color: var(--diamond-white); margin-bottom: 1rem;">Review Answers</h3>
        <?php $__currentLoopData = $attempt->exam->questions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <?php
            $answer = $attempt->answers->firstWhere('exam_question_id', $question->id);
            $pointsEarned = $answer ? $answer->points_earned : 0;
            $isCorrect = $pointsEarned >= $question->points;
          ?>
          <div class="mb-4 pb-4" style="border-bottom: 1px solid rgba(255,255,255,0.08);">
            <p class="fw-semibold mb-2" style="color: var(--diamond-white);">
              <?php echo e($index + 1); ?>. <?php echo e($question->question_text); ?>

              <span class="badge <?php echo e($isCorrect ? 'bg-success' : 'bg-danger'); ?> ms-2">
                <?php echo e($pointsEarned); ?>/<?php echo e($question->points); ?> pts
              </span>
            </p>
            <?php if($question->question_type === 'text' && $answer && $answer->text_answer): ?>
              <p style="color: var(--cool-gray);"><strong>Your answer:</strong> <?php echo e($answer->text_answer); ?></p>
            <?php elseif($answer && $answer->selected_option_ids): ?>
              <?php $selectedOpts = $question->options->whereIn('id', $answer->selected_option_ids); ?>
              <p style="color: var(--cool-gray);"><strong>Your answer:</strong> <?php echo e($selectedOpts->pluck('option_text')->join(', ')); ?></p>
            <?php endif; ?>
          </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>

      <div class="d-flex gap-2">
        <a href="<?php echo e(route('courses.show', $attempt->exam->course)); ?>" class="btn-primary" style="padding: 0.75rem 1.5rem;">
          <i class="fas fa-arrow-left me-2"></i>Back to Course
        </a>
        <?php if($attempt->exam->lesson): ?>
          <a href="<?php echo e(route('lessons.show', $attempt->exam->lesson)); ?>" class="btn-outline" style="padding: 0.75rem 1.5rem;">
            Back to Lesson
          </a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\digital-leap-africa\digital-leap-africa\resources\views/exams/result.blade.php ENDPATH**/ ?>