

<?php $__env->startSection('content'); ?>
<div class="greeting">Well Done, <?php echo e($user->name); ?>! 🎯</div>

<div class="message">
    You've successfully completed the lesson: <strong><?php echo e($lesson->title); ?></strong>
</div>

<div class="info-box">
    <strong>🏆 Achievement Unlocked!</strong><br>
    <strong>Points Earned:</strong> +50 points<br>
    <strong>Course:</strong> <?php echo e($lesson->topic->course->title ?? 'Course'); ?><br>
    <strong>Progress:</strong> Keep up the momentum!
</div>

<a href="<?php echo e(url('/courses/' . ($lesson->topic->course->id ?? '#'))); ?>" class="cta-button">
    Continue Learning
</a>

<div class="message">
    <strong>Your Learning Stats:</strong><br>
    • Lesson completed: <?php echo e($lesson->title); ?><br>
    • Points earned today: 50<br>
    • Keep going to unlock more achievements!
</div>

<div class="message">
    Every lesson completed brings you closer to mastering new skills. Stay consistent and keep building your expertise!
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('emails.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\DLA\digital-leap-africa\digital-leap-africa\resources\views\emails\lesson-completed.blade.php ENDPATH**/ ?>