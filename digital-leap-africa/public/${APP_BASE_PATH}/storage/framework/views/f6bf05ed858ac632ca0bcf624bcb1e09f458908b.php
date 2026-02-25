<?php $__env->startSection('content'); ?>
<div class="greeting">
    <span class="icon icon-success"></span>Hello <?php echo e($user->name); ?>!
</div>

<div class="message">
    <p>You have been unenrolled from <strong><?php echo e($course->title); ?></strong>.</p>
</div>

<div class="info-box">
    <h3 style="margin-bottom: 10px; color: #252A32;">Course Details:</h3>
    <ul style="list-style: none; padding: 0;">
        <li style="margin-bottom: 5px;"><strong>Course:</strong> <?php echo e($course->title); ?></li>
        <li style="margin-bottom: 5px;"><strong>Status:</strong> Unenrolled</li>
    </ul>
</div>

<div style="text-align: center; margin: 30px 0;">
    <a href="<?php echo e(url('/courses')); ?>" class="cta-button">Browse Courses</a>
</div>

<div class="message">
    <p>Thank you for being part of our learning community.</p>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('emails.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\digital-leap-africa\digital-leap-africa\resources\views/emails/course-unenrolled-simple.blade.php ENDPATH**/ ?>