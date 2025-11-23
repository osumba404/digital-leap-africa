

<?php $__env->startSection('content'); ?>
<div class="greeting">Great News, <?php echo e($user->name); ?>! ✅</div>

<div class="message">
    Your enrollment for <strong><?php echo e($course->title); ?></strong> has been <strong style="color: #00C9FF;">approved</strong>!
</div>

<div class="info-box">
    <strong>🎓 Course Access Granted</strong><br>
    You now have full access to all course materials, lessons, and resources. Start learning at your own pace!
</div>

<a href="<?php echo e(url('/courses/' . $course->id)); ?>" class="cta-button">
    Access Your Course
</a>

<div class="message">
    <strong>Your Learning Journey Starts Now:</strong><br>
    • Complete lessons to earn 50 points each<br>
    • Finish the entire course for 200 bonus points<br>
    • Participate in discussions and forums<br>
    • Earn your completion certificate
</div>

<div class="message">
    Need help? Our support team is here to assist you every step of the way. Happy learning!
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('emails.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\DLA\digital-leap-africa\digital-leap-africa\resources\views\emails\course-approved.blade.php ENDPATH**/ ?>