

<?php $__env->startSection('content'); ?>
<div class="greeting">Congratulations, <?php echo e($user->name); ?>! 🥇</div>

<div class="message">
    Your account has been <strong style="color: #00C9FF;">verified</strong>! You now have access to premium features and exclusive content.
</div>

<div class="info-box">
    <strong>🌟 Verified Member Benefits:</strong><br>
    • Gold verification badge on your profile<br>
    • Priority access to new courses<br>
    • Exclusive community features<br>
    • Enhanced profile visibility<br>
    • Special member-only content
</div>

<a href="<?php echo e(url('/profile')); ?>" class="cta-button">
    View Your Profile
</a>

<div class="message">
    <strong>What's New for You:</strong><br>
    • Your profile now displays a gold verification badge<br>
    • Access to verified member discussions<br>
    • Priority support from our team<br>
    • Exclusive webinars and events
</div>

<div class="message">
    Thank you for being a valued member of the Digital Leap Africa community. Your verified status reflects your commitment to learning and growth!
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('emails.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\DLA\digital-leap-africa\digital-leap-africa\resources\views\emails\account-verified.blade.php ENDPATH**/ ?>