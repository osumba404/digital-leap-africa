

<?php $__env->startSection('admin-content'); ?>
<div class="page-header">
  <h1 class="page-title">Edit Test: <?php echo e($exam->title); ?></h1>
  <div class="page-actions">
    <a href="<?php echo e(route('admin.exams.questions', [$course, $exam])); ?>" class="btn btn-primary">
      <i class="fas fa-list me-2"></i>Manage Questions
    </a>
    <a href="<?php echo e(route('admin.exams.index', $course)); ?>" class="btn-outline">
      <i class="fas fa-arrow-left me-2"></i>Back to Tests
    </a>
  </div>
</div>

<div class="admin-content">
  <div class="card">
    <div class="card-body">
      <form method="POST" action="<?php echo e(route('admin.exams.update', [$course, $exam])); ?>">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        <input type="hidden" name="type" value="<?php echo e($exam->type); ?>">

        <?php if($exam->type === 'post_lesson'): ?>
          <div class="form-group mb-3">
            <label class="form-label">Lesson</label>
            <select name="lesson_id" class="form-control">
              <option value="">Select lesson...</option>
              <?php $__currentLoopData = $lessons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $l): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($l->id); ?>" <?php echo e($exam->lesson_id == $l->id ? 'selected' : ''); ?>>
                  <?php echo e($l->topic->title); ?> › <?php echo e($l->title); ?>

                </option>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
          </div>
        <?php endif; ?>

        <div class="form-group mb-3">
          <label class="form-label">Title</label>
          <input type="text" name="title" class="form-control" value="<?php echo e(old('title', $exam->title)); ?>" required>
        </div>

        <div class="form-group mb-3">
          <label class="form-label">Description (optional)</label>
          <textarea name="description" class="form-control" rows="3"><?php echo e(old('description', $exam->description)); ?></textarea>
        </div>

        <div class="form-group mb-3">
          <label class="form-label">Time Limit (minutes, optional)</label>
          <input type="number" name="time_limit_minutes" class="form-control" value="<?php echo e(old('time_limit_minutes', $exam->time_limit_minutes)); ?>" min="1" max="480">
        </div>

        <div class="form-group mb-4">
          <div class="form-check">
            <input type="checkbox" name="is_enabled" id="is_enabled" value="1" class="form-check-input" <?php echo e($exam->is_enabled ? 'checked' : ''); ?>>
            <label class="form-check-label" for="is_enabled">Enabled (show test to students)</label>
          </div>
        </div>

        <div class="d-flex gap-2">
          <button type="submit" class="btn btn-primary">Update Test</button>
          <a href="<?php echo e(route('admin.exams.index', $course)); ?>" class="btn-outline">Cancel</a>
        </div>
      </form>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\digital-leap-africa\digital-leap-africa\resources\views/admin/exams/edit.blade.php ENDPATH**/ ?>