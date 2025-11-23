

<?php $__env->startSection('admin-content'); ?>
<div class="page-header">
  <h1 class="page-title">Manage: <?php echo e($course->title); ?></h1>
</div>

<div class="admin-content">
  <div class="quick-actions" style="display:grid;grid-template-columns:repeat(4,1fr);gap:1rem;">
    <a class="btn btn-edit" href="<?php echo e(route('admin.courses.topics.index', $course)); ?>">
      <i class="fas fa-list me-2"></i>Topics
    </a>
    <a class="btn btn-edit" href="<?php echo e(route('admin.courses.topics.index', $course)); ?>">
      <i class="fas fa-book-open me-2"></i>Lessons & Materials
    </a>
    <a class="btn btn-primary" href="<?php echo e(route('admin.courses.enrollments', $course)); ?>">
      <i class="fas fa-users me-2"></i>Manage Enrollments
    </a>
    <a class="btn btn-edit" href="<?php echo e(route('admin.courses.edit', $course)); ?>">
      <i class="fas fa-edit me-2"></i>Edit Course
    </a>
  </div>

  <div class="card" style="margin-top:1.25rem;">
    <div class="card-header" style="display:flex;align-items:center;justify-content:space-between;">
      <h3 class="card-title">Enrolled Students & Progress</h3>
      <div class="muted">Total lessons: <?php echo e($totalLessons ?? 0); ?></div>
    </div>
    <div class="card-body">
      <?php if(isset($enrollments) && $enrollments->count()): ?>
        <table class="data-table">
          <thead>
            <tr>
              <th>Student</th>
              <th>Email</th>
              <th>Status</th>
              <th>Enrolled</th>
              <th>Completed Lessons</th>
              <th>Progress</th>
            </tr>
          </thead>
          <tbody>
            <?php $__currentLoopData = $enrollments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $en): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php
                $completed = 0;
                if (($totalLessons ?? 0) > 0) {
                  // Count user's completed lessons that belong to this course
                  $completed = $en->user->lessons()
                    ->whereHas('topic.course', function($q) use ($course) { $q->where('id', $course->id); })
                    ->count();
                }
                $progress = ($totalLessons ?? 0) > 0 ? round(($completed / $totalLessons) * 100) : 0;
              ?>
              <tr>
                <td><?php echo e($en->user->name); ?></td>
                <td class="muted"><?php echo e($en->user->email); ?></td>
                <td><span class="status-badge"><?php echo e(ucfirst($en->status ?? 'enrolled')); ?></span></td>
                <td><?php echo e(optional($en->enrolled_at)->format('M j, Y')); ?></td>
                <td><?php echo e($completed); ?> / <?php echo e($totalLessons ?? 0); ?></td>
                <td>
                  <div style="display:flex;align-items:center;gap:.5rem;min-width:180px;">
                    <div style="flex:1;height:8px;background:rgba(255,255,255,0.08);border-radius:999px;overflow:hidden;">
                      <div style="width: <?php echo e($progress); ?>%;height:100%;background:linear-gradient(90deg,#00c9ff,#7a5cff);"></div>
                    </div>
                    <div style="width:3rem;text-align:right;"><?php echo e($progress); ?>%</div>
                  </div>
                </td>
              </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </tbody>
        </table>
      <?php else: ?>
        <div class="muted" style="padding:1rem 0;">No enrollments yet.</div>
      <?php endif; ?>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\DLA\digital-leap-africa\digital-leap-africa\resources\views\admin\courses\manage.blade.php ENDPATH**/ ?>