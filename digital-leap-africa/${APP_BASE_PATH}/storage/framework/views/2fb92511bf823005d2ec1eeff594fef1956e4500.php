

<?php $__env->startSection('content'); ?>
<div class="greeting">Hello <?php echo e($user->name); ?>,</div>

<div class="message">
    You recently requested to reset your password for your Digital Leap Africa account. Click the button below to reset it.
</div>

<div class="info-box">
    <strong>🔐 Security Notice:</strong><br>
    This password reset link will expire in 60 minutes for your security. If you didn't request this reset, please ignore this email.
</div>

<a href="<?php echo e($resetUrl); ?>" class="cta-button">
    Reset Your Password
</a>

<div class="message">
    <strong>For Your Security:</strong><br>
    • This link expires in 1 hour<br>
    • Only use this link if you requested the reset<br>
    • Choose a strong, unique password<br>
    • Never share your password with anyone
</div>

<div class="message">
    If you're having trouble clicking the button, copy and paste the URL below into your web browser:<br>
    <a href="<?php echo e($resetUrl); ?>" style="color: #2E78C5; word-break: break-all;"><?php echo e($resetUrl); ?></a>
</div>

<div class="message">
    If you didn't request this password reset, please ignore this email. Your password will remain unchanged.
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('emails.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\DLA\digital-leap-africa\digital-leap-africa\resources\views\emails\password-reset.blade.php ENDPATH**/ ?>