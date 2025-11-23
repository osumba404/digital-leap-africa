

<?php $__env->startSection('admin-content'); ?>

<?php
$hideAdminNav = true;
?>

<?php $__env->startSection('admin-content'); ?>
<div class="page-header">
    <h1 class="page-title">Create New Course</h1>
    <div class="page-actions">
        <a href="<?php echo e(route('admin.courses.index')); ?>" class="btn-outline">
            <i class="fas fa-arrow-left me-2"></i>Back to Courses
        </a>
    </div>
</div>

<form method="POST" action="<?php echo e(route('admin.courses.store')); ?>" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <?php echo $__env->make('admin.courses._form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\DLA\digital-leap-africa\digital-leap-africa\resources\views\admin\courses\create.blade.php ENDPATH**/ ?>