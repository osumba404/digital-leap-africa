

<?php $__env->startSection('admin-content'); ?>
<div class="page-header">
  <h1 class="page-title">Lessons for: <?php echo e($topic->title); ?></h1>
  <div class="page-actions" style="display:flex;gap:.5rem;flex-wrap:wrap;">
    <a href="<?php echo e(route('admin.courses.topics.index', $topic->course)); ?>" class="btn-outline">
      <i class="fas fa-arrow-left me-2"></i>Back to Topics
    </a>
  </div>
</div>

<div class="admin-content">
  <div class="card">
    <div class="card-body">
      <h3 class="h5 m-0">Add New Lesson</h3>
      <form method="POST" action="<?php echo e(route('admin.topics.lessons.store', $topic)); ?>" class="mt-3" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <?php echo $__env->make('admin.courses.lessons._form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      </form>
    </div>
  </div>

  <div class="card mt-3">
    <div class="card-body">
      <h3 class="h5">Existing Lessons</h3>
      <p class="text-muted small mb-3">
        <i class="fas fa-clipboard-check me-1"></i>
        Use the <strong>Lesson test</strong> column to add or manage the test at the end of each lesson. Click <strong>Add test</strong> to create one, then add questions.
      </p>
      <?php $course = $course ?? $topic->course; $lessonExams = $lessonExams ?? collect(); ?>
      <?php if($topic->lessons->count()): ?>
        <div class="table-responsive">
          <table class="table table-striped align-middle data-table">
            <thead>
              <tr>
                <th style="width:50px;">#</th>
                <th>Title</th>
                <th style="width:120px;">Type</th>
                <th style="width:220px;">Lesson test</th>
                <th style="width:140px;">Updated</th>
                <th style="width:240px;" class="text-end">Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php $__currentLoopData = $topic->lessons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                  $lessonExam = $lessonExams[$item->id] ?? null;
                ?>
                <tr>
                  <td><?php echo e($loop->iteration); ?></td>
                  <td class="fw-semibold"><?php echo e($item->title); ?></td>
                  <td><span class="badge bg-info text-dark text-uppercase"><?php echo e($item->type); ?></span></td>
                  <td class="align-middle">
                    <?php if($lessonExam): ?>
                      <span class="badge <?php echo e($lessonExam->is_enabled ? 'bg-success' : 'bg-secondary'); ?> me-1"><?php echo e($lessonExam->is_enabled ? 'On' : 'Off'); ?></span>
                      <a href="<?php echo e(route('admin.exams.questions', [$course, $lessonExam])); ?>" class="btn btn-sm btn-outline" title="Manage questions"><i class="fas fa-list me-1"></i>Questions</a>
                      <a href="<?php echo e(route('admin.exams.edit', [$course, $lessonExam])); ?>" class="btn btn-sm btn-outline" title="Edit test">Edit</a>
                    <?php else: ?>
                      <a href="<?php echo e(route('admin.exams.create', $course)); ?>?type=post_lesson&lesson_id=<?php echo e($item->id); ?>" class="btn btn-sm btn-primary"><i class="fas fa-plus me-1"></i>Add test</a>
                    <?php endif; ?>
                  </td>
                  <td class="text-muted"><?php echo e(optional($item->updated_at)->format('Y-m-d H:i')); ?></td>
                  <td class="text-end">
                    <a href="<?php echo e(route('admin.topics.lessons.edit', [$topic, $item])); ?>" class="btn btn-sm btn-outline">Edit</a>
                    <form method="POST" action="<?php echo e(route('admin.topics.lessons.destroy', [$topic, $item])); ?>" onsubmit="return confirm('Are you sure?');" class="d-inline-block m-0">
                      <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                      <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                  </td>
                </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
          </table>
        </div>
      <?php else: ?>
        <div class="text-muted">No lessons have been added to this topic yet. Add a lesson above; then you can add a test for each lesson in the <strong>Lesson test</strong> column.</div>
      <?php endif; ?>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\digital-leap-africa\digital-leap-africa\resources\views/admin/courses/lessons/index.blade.php ENDPATH**/ ?>