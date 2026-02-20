

<?php $__env->startSection('admin-content'); ?>
<div class="page-header">
  <h1 class="page-title">Tests: <?php echo e($course->title); ?></h1>
  <div class="page-actions">
    <a href="<?php echo e(route('admin.courses.manage', $course)); ?>" class="btn-outline">
      <i class="fas fa-arrow-left me-2"></i>Back to Course
    </a>
    <a href="<?php echo e(route('admin.exams.create', $course)); ?>?type=pre_course" class="btn btn-primary">
      <i class="fas fa-plus me-2"></i>Add Pre-Course Test
    </a>
    <a href="<?php echo e(route('admin.exams.create', $course)); ?>?type=final" class="btn btn-primary">
      <i class="fas fa-plus me-2"></i>Add Final Test
    </a>
  </div>
</div>

<div class="admin-content">
  <div class="card">
    <div class="card-body">
      <p class="text-muted mb-4">
        Manage tests at the beginning of the course, after each lesson, and at the end. Toggle <strong>Enabled</strong> to show/hide each test from students.
      </p>

      <div class="table-responsive">
        <table class="data-table">
          <thead>
            <tr>
              <th>Type</th>
              <th>Title</th>
              <th>Lesson</th>
              <th>Questions</th>
              <th>Points</th>
              <th>Enabled</th>
              <th>Counts to Grade</th>
              <th style="width: 200px;">Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $exams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $exam): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
              <tr>
                <td>
                  <?php if($exam->type === 'pre_course'): ?>
                    <span class="badge bg-info">Pre-Course</span>
                  <?php elseif($exam->type === 'post_lesson'): ?>
                    <span class="badge bg-secondary">Post-Lesson</span>
                  <?php else: ?>
                    <span class="badge bg-warning text-dark">Final</span>
                  <?php endif; ?>
                </td>
                <td class="fw-semibold"><?php echo e($exam->title); ?></td>
                <td>
                  <?php if($exam->lesson): ?>
                    <?php echo e($exam->lesson->title); ?>

                  <?php else: ?>
                    <span class="text-muted">—</span>
                  <?php endif; ?>
                </td>
                <td><?php echo e($exam->questions->count()); ?></td>
                <td><?php echo e($exam->questions->sum('points')); ?></td>
                <td>
                  <?php if($exam->is_enabled): ?>
                    <span class="badge bg-success">Yes</span>
                  <?php else: ?>
                    <span class="badge bg-secondary">No</span>
                  <?php endif; ?>
                </td>
                <td>
                  <?php if($exam->count_towards_final_grade): ?>
                    <span class="badge bg-success">Yes</span>
                  <?php else: ?>
                    <span class="badge bg-secondary">No</span>
                  <?php endif; ?>
                </td>
                <td>
                  <a href="<?php echo e(route('admin.exams.questions', [$course, $exam])); ?>" class="btn btn-sm btn-outline">
                    <i class="fas fa-list me-1"></i>Questions
                  </a>
                  <a href="<?php echo e(route('admin.exams.edit', [$course, $exam])); ?>" class="btn btn-sm btn-outline">
                    <i class="fas fa-edit me-1"></i>Edit
                  </a>
                  <form method="POST" action="<?php echo e(route('admin.exams.destroy', [$course, $exam])); ?>" class="d-inline-block" onsubmit="return confirm('Delete this test and all its questions?');">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash me-1"></i>Delete</button>
                  </form>
                </td>
              </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
              <tr>
                <td colspan="8" class="text-center text-muted py-4">
                  No tests yet. Add a pre-course, post-lesson, or final test.
                </td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="card mt-4">
    <div class="card-body">
      <h3 class="h5 mb-3">Add Post-Lesson Test</h3>
      <p class="text-muted mb-3">Create a test that appears after a specific lesson.</p>
      <form method="GET" action="<?php echo e(route('admin.exams.create', $course)); ?>" class="d-flex gap-2 flex-wrap align-items-end">
        <input type="hidden" name="type" value="post_lesson">
        <div class="flex-grow-1" style="min-width: 200px;">
          <label class="form-label">Select Lesson</label>
          <select name="lesson_id" class="form-control" required>
            <option value="">Choose a lesson...</option>
            <?php $__currentLoopData = $course->topics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $topic): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php $__currentLoopData = $topic->lessons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lesson): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($lesson->id); ?>"><?php echo e($topic->title); ?> › <?php echo e($lesson->title); ?></option>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </select>
        </div>
        <button type="submit" class="btn btn-primary">
          <i class="fas fa-plus me-2"></i>Add Post-Lesson Test
        </button>
      </form>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\digital-leap-africa\digital-leap-africa\resources\views/admin/exams/index.blade.php ENDPATH**/ ?>