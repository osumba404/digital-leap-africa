

<?php $__env->startSection('admin-content'); ?>
<div class="page-header">
  <h1 class="page-title">New Topic for: <?php echo e($course->title); ?></h1>
  <div class="page-actions">
    <a href="<?php echo e(route('admin.courses.topics.index', $course)); ?>" class="btn-outline">
      <i class="fas fa-arrow-left me-2"></i>Back to Topics
    </a>
  </div>
</div>

<div class="admin-content">
  <div class="card">
    <div class="card-body">
      <form action="<?php echo e(route('admin.courses.topics.store', $course)); ?>" method="POST" class="admin-form">
        <?php echo csrf_field(); ?>
        <div class="form-group">
          <label class="form-label" for="title">Title</label>
          <input type="text" name="title" id="title" value="<?php echo e(old('title')); ?>" class="form-control" required>
        </div>

        <!-- <div class="form-group">
          <label class="form-label" for="description">Description</label>
          <textarea name="description" id="description" rows="3" class="form-control"><?php echo e(old('description')); ?></textarea>
        </div> -->

        <div class="d-flex align-items-center gap-2">
          <button type="submit" class="btn-primary">Create Topic</button>
          <a href="<?php echo e(route('admin.courses.topics.index', $course)); ?>" class="btn-outline">Cancel</a>
        </div>
      </form>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\DLA\digital-leap-africa\digital-leap-africa\resources\views\admin\courses\topics\create.blade.php ENDPATH**/ ?>