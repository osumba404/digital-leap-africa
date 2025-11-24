

<?php $__env->startSection('content'); ?>
<div class="greeting">Outstanding Achievement, <?php echo e($user->name); ?>! 🏆</div>

<div class="message">
    Congratulations! You have successfully completed <strong><?php echo e($course->title); ?></strong>. This is a significant milestone in your learning journey!
</div>

<div class="info-box">
    <strong>🎓 Course Completion Rewards:</strong><br>
    <strong>Bonus Points:</strong> +200 points<br>
    <strong>Certificate:</strong> Available for download<br>
    <strong>Badge:</strong> Course completion badge earned<br>
    <strong>Status:</strong> Course Master
</div>

<a href="<?php echo e(url('/profile')); ?>" class="cta-button">
    View Your Certificate
</a>

<div class="message">
    <strong>What You've Accomplished:</strong><br>
    • Completed all course lessons and topics<br>
    • Demonstrated commitment to learning<br>
    • Earned valuable skills and knowledge<br>
    • Joined the ranks of course graduates
</div>

<div class="message">
    <strong>Next Steps:</strong><br>
    • Share your achievement on social media<br>
    • Explore advanced courses in your field<br>
    • Apply your new skills to real projects<br>
    • Mentor other learners in the community
</div>

<div class="message">
    Your dedication to learning is inspiring! We're proud to have you as part of the Digital Leap Africa community.
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('emails.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\DLA\digital-leap-africa\digital-leap-africa\resources\views/emails/course-completed.blade.php ENDPATH**/ ?>