

<?php $__env->startSection('admin-content'); ?>
<div class="page-header">
  <h1 class="page-title">
    
    New Topic for: <?php echo e($course->title); ?>

    
    Edit Topic: <?php echo e($topic->title); ?>

  </h1>
  <div class="page-actions">
    <a href="<?php echo e(route('admin.courses.topics.index', $course)); ?>" class="btn-outline">
      <i class="fas fa-arrow-left me-2"></i>Back to Topics
    </a>
  </div>
</div>

<div class="admin-content">
  <div class="card">
    <div class="card-body">
    

      
      <form method="POST" action="<?php echo e(route('admin.courses.topics.update', [$course, $topic])); ?>">
        <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
        <div class="form-group">
          <label class="form-label">Title</label>
          <input type="text" name="title" class="form-control" value="<?php echo e(old('title', $topic->title)); ?>" required>
        </div>
        <!-- <div class="form-group">
          <label class="form-label">Description</label>
          <textarea name="description" class="form-control" rows="3"><?php echo e(old('description', $topic->description)); ?></textarea>
        </div> -->
        <button class="btn-primary">Save Changes</button>
      </form>
    
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\DLA\digital-leap-africa\digital-leap-africa\resources\views\admin\courses\topics\edit.blade.php ENDPATH**/ ?>