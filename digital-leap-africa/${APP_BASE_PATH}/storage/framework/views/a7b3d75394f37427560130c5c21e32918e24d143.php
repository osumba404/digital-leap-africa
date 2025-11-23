

<?php $__env->startSection('admin-content'); ?>
<div class="page-header">
    <h1 class="page-title">Edit Badge: <?php echo e($badge->badge_name); ?></h1>
</div>

<?php if($errors->any()): ?>
    <div class="error-message" style="margin-bottom: 1rem;">
        <ul style="margin: 0; padding-left: 1.5rem;">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?>

<div class="form-container">
    <form method="POST" action="<?php echo e(route('admin.badges.update', $badge)); ?>" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        <?php echo $__env->make('admin.badges._form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\DLA\digital-leap-africa\digital-leap-africa\resources\views\admin\badges\edit.blade.php ENDPATH**/ ?>