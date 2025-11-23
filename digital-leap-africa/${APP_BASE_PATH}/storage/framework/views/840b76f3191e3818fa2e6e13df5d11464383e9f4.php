

<?php $__env->startSection('content'); ?>
<div class="mb-4">
    <h1>Edit Certificate Template</h1>
    <p class="text-muted">Update certificate template: <?php echo e($certificateTemplate->name); ?></p>
</div>

<div class="card">
    <form method="POST" action="<?php echo e(route('admin.certificate-templates.update', $certificateTemplate)); ?>" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        <?php echo $__env->make('admin.certificate-templates._form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\DLA\digital-leap-africa\digital-leap-africa\resources\views\admin\certificate-templates\edit.blade.php ENDPATH**/ ?>