

<?php $__env->startSection('content'); ?>
<div class="greeting">Hello <?php echo e($user->name); ?>! 🎉</div>

<div class="message">
    Congratulations! You have successfully enrolled in <strong><?php echo e($course->title); ?></strong>.
</div>

<div class="info-box">
    <strong>Course Details:</strong><br>
    <strong>Title:</strong> <?php echo e($course->title); ?><br>
    <strong>Duration:</strong> <?php echo e($course->duration ?? 'Self-paced'); ?><br>
    <strong>Level:</strong> <?php echo e(ucfirst($course->level ?? 'Beginner')); ?><br>
    <?php if($course->price > 0): ?>
    <strong>Type:</strong> Premium Course<br>
    <?php else: ?>
    <strong>Type:</strong> Free Course<br>
    <?php endif; ?>
</div>

<div class="message">
    <?php if($course->price > 0): ?>
    Your enrollment is currently <strong>pending approval</strong>. You'll receive another email once your enrollment is approved by our team.
    <?php else: ?>
    You can start learning immediately! Access your course content and begin your learning journey.
    <?php endif; ?>
</div>

<a href="<?php echo e(url('/courses/' . $course->id)); ?>" class="cta-button">
    <?php if($course->price > 0): ?>
    View Course Details
    <?php else: ?>
    Start Learning Now
    <?php endif; ?>
</a>

<div class="message">
    <strong>What's Next?</strong><br>
    • Complete lessons to earn points<br>
    • Engage with the community forum<br>
    • Track your progress on your dashboard<br>
    • Earn badges and certificates
</div>

<div class="message">
    Welcome to the Digital Leap Africa community! We're excited to support your learning journey.
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('emails.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\DLA\digital-leap-africa\digital-leap-africa\resources\views/emails/course-enrollment.blade.php ENDPATH**/ ?>