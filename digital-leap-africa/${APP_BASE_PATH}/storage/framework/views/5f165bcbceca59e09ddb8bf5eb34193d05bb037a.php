

<?php $__env->startSection('admin-content'); ?>

<div class="page-header">
  <h1 class="page-title">Edit Lesson: <span class="text-accent"><?php echo e($lesson->title); ?></span></h1>
  <div class="page-actions">
    <a href="<?php echo e(route('admin.topics.lessons.index', [$topic->course, $topic])); ?>" class="btn-outline">
      <i class="fas fa-arrow-left me-2"></i>Back to Lessons
    </a>
  </div>
</div>

<div class="admin-content">
  <div class="card">
    <div class="card-body">
      <form method="POST" action="<?php echo e(route('admin.topics.lessons.update', [$topic, $lesson])); ?>" enctype="multipart/form-data">
        <?php echo method_field('PATCH'); ?>
        <?php echo csrf_field(); ?>
        <?php echo $__env->make('admin.courses.lessons._form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      </form>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\DLA\digital-leap-africa\digital-leap-africa\resources\views\admin\courses\lessons\edit.blade.php ENDPATH**/ ?>