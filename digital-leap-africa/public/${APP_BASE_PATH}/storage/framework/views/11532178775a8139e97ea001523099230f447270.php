

<?php $__env->startSection('title', $attempt->exam->title . ' - Take Test | Digital Leap Africa'); ?>

<?php $__env->startSection('content'); ?>
<div class="exam-take-page">
  
  <header class="exam-take-header">
    <div class="exam-take-header-inner">
      <a href="<?php echo e($attempt->exam->lesson ? route('lessons.show', $attempt->exam->lesson) : route('courses.show', $attempt->exam->course)); ?>" class="exam-take-back">
        <i class="fas fa-arrow-left"></i>
        <span><?php echo e($attempt->exam->lesson ? 'Back to lesson' : 'Back to course'); ?></span>
      </a>
      <h1 class="exam-take-title"><?php echo e($attempt->exam->title); ?></h1>
      <div class="exam-take-meta">
        <span class="exam-take-count"><?php echo e($attempt->exam->questions->count()); ?> question<?php echo e($attempt->exam->questions->count() !== 1 ? 's' : ''); ?></span>
        <?php if($attempt->exam->time_limit_minutes): ?>
          <div class="exam-take-timer" id="timer" role="timer" aria-live="polite">
            <i class="fas fa-clock"></i>
            <span id="timer-display"><?php echo e($attempt->exam->time_limit_minutes); ?>:00</span>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </header>

  <div class="exam-take-body">
    <form method="POST" action="<?php echo e(route('exams.submit', $attempt)); ?>" id="exam-form" class="exam-take-form">
      <?php echo csrf_field(); ?>

      <?php $__currentLoopData = $attempt->exam->questions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <section class="exam-question-card" data-question="<?php echo e($index + 1); ?>">
          <div class="exam-question-header">
            <span class="exam-question-num">Question <?php echo e($index + 1); ?> of <?php echo e($attempt->exam->questions->count()); ?></span>
            <span class="exam-question-points"><?php echo e($question->points); ?> pt<?php echo e($question->points !== 1 ? 's' : ''); ?></span>
          </div>
          <p class="exam-question-text"><?php echo e($question->question_text); ?></p>

          <?php if($question->question_type === 'single_choice'): ?>
            <div class="exam-options exam-options--single" role="radiogroup" aria-label="Choose one answer">
              <?php $__currentLoopData = $question->options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $opt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <label class="exam-option" for="opt_<?php echo e($question->id); ?>_<?php echo e($opt->id); ?>">
                  <input type="radio" name="answer_<?php echo e($question->id); ?>" id="opt_<?php echo e($question->id); ?>_<?php echo e($opt->id); ?>" value="<?php echo e($opt->id); ?>" class="exam-option-input">
                  <span class="exam-option-marker"></span>
                  <span class="exam-option-text"><?php echo e($opt->option_text); ?></span>
                </label>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
          <?php elseif($question->question_type === 'multiple_choice'): ?>
            <div class="exam-options exam-options--multiple" role="group" aria-label="Choose all that apply">
              <?php $__currentLoopData = $question->options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $opt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <label class="exam-option" for="opt_<?php echo e($question->id); ?>_<?php echo e($opt->id); ?>">
                  <input type="checkbox" name="answer_<?php echo e($question->id); ?>[]" id="opt_<?php echo e($question->id); ?>_<?php echo e($opt->id); ?>" value="<?php echo e($opt->id); ?>" class="exam-option-input">
                  <span class="exam-option-marker exam-option-marker--checkbox"></span>
                  <span class="exam-option-text"><?php echo e($opt->option_text); ?></span>
                </label>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
          <?php else: ?>
            <div class="exam-answer-text-wrap">
              <textarea name="answer_<?php echo e($question->id); ?>" class="exam-answer-textarea" rows="4" placeholder="Type your answer here..."></textarea>
            </div>
          <?php endif; ?>
        </section>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

      <div class="exam-take-actions">
        <button type="submit" class="exam-submit-btn" id="exam-submit-btn">
          <i class="fas fa-paper-plane"></i>
          <span>Submit test</span>
        </button>
        <a href="<?php echo e(route('courses.show', $attempt->exam->course)); ?>" class="exam-cancel-link">Cancel</a>
      </div>
    </form>
  </div>
</div>

<?php if($attempt->exam->time_limit_minutes): ?>
<?php $__env->startPush('scripts'); ?>
<script>
(function() {
  var form = document.getElementById('exam-form');
  var minutes = <?php echo e($attempt->exam->time_limit_minutes); ?>;
  var secondsLeft = minutes * 60;
  var display = document.getElementById('timer-display');
  var timerEl = document.getElementById('timer');

  function pad(n) { return n < 10 ? '0' + n : n; }

  function tick() {
    if (secondsLeft <= 0) {
      form.submit();
      return;
    }
    var m = Math.floor(secondsLeft / 60);
    var s = secondsLeft % 60;
    display.textContent = pad(m) + ':' + pad(s);
    if (timerEl) {
      timerEl.classList.remove('exam-take-timer--warn', 'exam-take-timer--urgent');
      if (secondsLeft <= 60) timerEl.classList.add('exam-take-timer--urgent');
      else if (secondsLeft <= 5 * 60) timerEl.classList.add('exam-take-timer--warn');
    }
    secondsLeft--;
  }

  tick();
  setInterval(tick, 1000);
})();

document.getElementById('exam-form').addEventListener('submit', function(e) {
  if (!confirm('Submit your test? You cannot change answers after submitting.')) e.preventDefault();
});
</script>
<?php $__env->stopPush(); ?>
<?php else: ?>
<?php $__env->startPush('scripts'); ?>
<script>
document.getElementById('exam-form').addEventListener('submit', function(e) {
  if (!confirm('Submit your test? You cannot change answers after submitting.')) e.preventDefault();
});
</script>
<?php $__env->stopPush(); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<style>
.exam-take-page {
  max-width: 720px;
  margin: 0 auto;
  padding: 1.5rem 1rem 4rem;
}

.exam-take-header {
  margin-bottom: 2rem;
}
.exam-take-header-inner {
  display: flex;
  flex-direction: column;
  gap: 0.75rem;
}
.exam-take-back {
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
  color: var(--cyan-accent, #00c9ff);
  text-decoration: none;
  font-size: 0.9rem;
}
.exam-take-back:hover { text-decoration: underline; opacity: 0.9; }
.exam-take-title {
  font-size: 1.5rem;
  font-weight: 700;
  color: var(--diamond-white);
  margin: 0;
  line-height: 1.3;
}
.exam-take-meta {
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  gap: 1rem;
}
.exam-take-count {
  font-size: 0.9rem;
  color: var(--cool-gray);
}
.exam-take-timer {
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
  padding: 0.5rem 1rem;
  background: rgba(239, 68, 68, 0.15);
  color: #f87171;
  border-radius: 10px;
  font-weight: 600;
  font-variant-numeric: tabular-nums;
}
.exam-take-timer--warn { background: rgba(251, 191, 36, 0.2); color: #fbbf24; }
.exam-take-timer--urgent { background: rgba(239, 68, 68, 0.25); color: #ef4444; animation: pulse 1s ease-in-out infinite; }
@keyframes pulse { 50% { opacity: 0.85; } }

.exam-take-form { display: flex; flex-direction: column; gap: 1.75rem; }

.exam-question-card {
  background: rgba(255, 255, 255, 0.04);
  border: 1px solid rgba(255, 255, 255, 0.1);
  border-radius: 14px;
  padding: 1.5rem;
  transition: border-color 0.2s, background 0.2s;
}
.exam-question-card:hover {
  background: rgba(255, 255, 255, 0.06);
  border-color: rgba(255, 255, 255, 0.15);
}
.exam-question-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 0.75rem;
}
.exam-question-num {
  font-size: 0.8rem;
  font-weight: 600;
  color: var(--cool-gray);
  text-transform: uppercase;
  letter-spacing: 0.03em;
}
.exam-question-points {
  font-size: 0.8rem;
  padding: 0.2rem 0.6rem;
  background: rgba(34, 197, 94, 0.2);
  color: #22c55e;
  border-radius: 6px;
  font-weight: 600;
}
.exam-question-text {
  font-size: 1.05rem;
  line-height: 1.55;
  color: var(--diamond-white);
  margin: 0 0 1.25rem 0;
}

.exam-options { display: flex; flex-direction: column; gap: 0.5rem; }
.exam-option {
  display: flex;
  align-items: flex-start;
  gap: 0.75rem;
  padding: 0.9rem 1rem;
  background: rgba(255, 255, 255, 0.05);
  border: 2px solid rgba(255, 255, 255, 0.1);
  border-radius: 10px;
  cursor: pointer;
  transition: background 0.2s, border-color 0.2s;
}
.exam-option:hover {
  background: rgba(255, 255, 255, 0.08);
  border-color: rgba(255, 255, 255, 0.2);
}
.exam-option-input { position: absolute; opacity: 0; pointer-events: none; }
.exam-option-input:focus + .exam-option-marker { box-shadow: 0 0 0 2px var(--cyan-accent, #00c9ff); }
.exam-option-input:checked + .exam-option-marker { border-color: var(--cyan-accent); background: rgba(0, 201, 255, 0.15); }
.exam-option-input:checked + .exam-option-marker::after { opacity: 1; }
.exam-option-input:checked ~ .exam-option-text { color: var(--diamond-white); font-weight: 500; }
.exam-option:has(.exam-option-input:checked) {
  background: rgba(0, 201, 255, 0.08);
  border-color: rgba(0, 201, 255, 0.35);
}
.exam-option-marker {
  flex-shrink: 0;
  width: 22px;
  height: 22px;
  border: 2px solid rgba(255, 255, 255, 0.35);
  border-radius: 50%;
  position: relative;
  transition: border-color 0.2s, background 0.2s;
}
.exam-option-marker::after {
  content: '';
  position: absolute;
  inset: 4px;
  background: var(--cyan-accent);
  border-radius: 50%;
  opacity: 0;
  transition: opacity 0.2s;
}
.exam-option-marker--checkbox { border-radius: 6px; }
.exam-option-marker--checkbox::after { border-radius: 3px; }
.exam-option-input:checked + .exam-option-marker--checkbox::after { opacity: 1; }
.exam-option-text {
  flex: 1;
  font-size: 0.98rem;
  line-height: 1.45;
  color: var(--cool-gray);
  transition: color 0.2s;
}

.exam-answer-text-wrap { margin-top: 0.25rem; }
.exam-answer-textarea {
  width: 100%;
  padding: 1rem;
  background: rgba(255, 255, 255, 0.05);
  border: 1px solid rgba(255, 255, 255, 0.12);
  border-radius: 10px;
  color: var(--diamond-white);
  font-size: 1rem;
  line-height: 1.5;
  resize: vertical;
  min-height: 120px;
}
.exam-answer-textarea::placeholder { color: var(--cool-gray); opacity: 0.8; }
.exam-answer-textarea:focus {
  outline: none;
  border-color: rgba(0, 201, 255, 0.5);
  background: rgba(255, 255, 255, 0.06);
}

.exam-take-actions {
  margin-top: 1rem;
  padding-top: 1.5rem;
  border-top: 1px solid rgba(255, 255, 255, 0.1);
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  gap: 1rem;
}
.exam-submit-btn {
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
  padding: 0.85rem 1.75rem;
  background: linear-gradient(135deg, var(--cyan-accent, #00c9ff), #0ea5e9);
  color: #fff;
  border: none;
  border-radius: 10px;
  font-size: 1.05rem;
  font-weight: 600;
  cursor: pointer;
  transition: transform 0.2s, box-shadow 0.2s;
}
.exam-submit-btn:hover {
  transform: translateY(-1px);
  box-shadow: 0 4px 14px rgba(0, 201, 255, 0.4);
}
.exam-submit-btn:active { transform: translateY(0); }
.exam-cancel-link {
  color: var(--cool-gray);
  text-decoration: none;
  font-size: 0.95rem;
}
.exam-cancel-link:hover { color: var(--diamond-white); text-decoration: underline; }

[data-theme="light"] .exam-question-card {
  background: #f8fafc;
  border-color: rgba(0, 0, 0, 0.08);
}
[data-theme="light"] .exam-question-card:hover {
  background: #f1f5f9;
  border-color: rgba(0, 0, 0, 0.12);
}
[data-theme="light"] .exam-option {
  background: #f1f5f9;
  border-color: rgba(0, 0, 0, 0.08);
}
[data-theme="light"] .exam-option:hover {
  background: #e2e8f0;
  border-color: rgba(0, 0, 0, 0.12);
}
[data-theme="light"] .exam-option:has(.exam-option-input:checked) {
  background: rgba(46, 120, 197, 0.1);
  border-color: rgba(46, 120, 197, 0.35);
}
[data-theme="light"] .exam-answer-textarea {
  background: #fff;
  border-color: rgba(0, 0, 0, 0.12);
  color: #1e293b;
}
[data-theme="light"] .exam-take-timer { background: rgba(239, 68, 68, 0.12); color: #dc2626; }
[data-theme="light"] .exam-take-timer--warn { background: rgba(245, 158, 11, 0.2); color: #d97706; }
[data-theme="light"] .exam-take-timer--urgent { background: rgba(239, 68, 68, 0.2); color: #b91c1c; }
</style>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\digital-leap-africa\digital-leap-africa\resources\views/exams/take.blade.php ENDPATH**/ ?>