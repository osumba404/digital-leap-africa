

<?php $__env->startSection('content'); ?>
<div class="mb-4">
    <h1>Edit Email Template</h1>
    <p class="text-muted">Update email template: <?php echo e($emailTemplate->name); ?></p>
</div>

<div class="card">
    <form method="POST" action="<?php echo e(route('admin.email-templates.update', $emailTemplate)); ?>">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        <?php echo $__env->make('admin.email-templates._form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\DLA\digital-leap-africa\digital-leap-africa\resources\views\admin\email-templates\edit.blade.php ENDPATH**/ ?>