

<?php $__env->startSection('content'); ?>
<div class="greeting">Hello <?php echo e($user->name); ?>! 📧</div>

<div class="message">
    <?php echo e($message ?? 'You have a new notification from Digital Leap Africa.'); ?>

</div>

<?php if(isset($title)): ?>
<div class="info-box">
    <strong><?php echo e($title); ?></strong>
</div>
<?php endif; ?>

<?php if(isset($actionUrl) && isset($actionText)): ?>
<a href="<?php echo e($actionUrl); ?>" class="cta-button">
    <?php echo e($actionText); ?>

</a>
<?php endif; ?>

<div class="message">
    Stay connected with Digital Leap Africa for the latest updates, courses, and opportunities to advance your tech skills.
</div>

<div class="message">
    <strong>Quick Links:</strong><br>
    • <a href="<?php echo e(url('/dashboard')); ?>" style="color: #2E78C5;">Your Dashboard</a><br>
    • <a href="<?php echo e(url('/courses')); ?>" style="color: #2E78C5;">Browse Courses</a><br>
    • <a href="<?php echo e(url('/forum')); ?>" style="color: #2E78C5;">Community Forum</a><br>
    • <a href="<?php echo e(url('/profile')); ?>" style="color: #2E78C5;">Your Profile</a>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('emails.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\DLA\digital-leap-africa\digital-leap-africa\resources\views/emails/general-notification.blade.php ENDPATH**/ ?>