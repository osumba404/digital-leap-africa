

<?php $__env->startSection('admin-content'); ?>

<div class="page-header">
  <h1 class="page-title">Topics for: <?php echo e($course->title); ?></h1>
  <div class="page-actions" style="display:flex;gap:.5rem;">
    <a href="<?php echo e(route('admin.courses.manage', $course)); ?>" class="btn-outline">
      <i class="fas fa-arrow-left me-2"></i>Back to Manage
    </a>
    <a href="<?php echo e(route('admin.courses.topics.create', $course)); ?>" class="btn btn-primary btn-sm">New Topic</a>
  </div>
</div>

<div class="admin-content">
  <div class="card">
    <div class="card-body">
      <h3 class="h5 mb-3">Topics</h3>

      <?php if(isset($topics) && $topics->count()): ?>
        <table class="data-table">
          <thead>
            <tr>
              <th style="width:30%">Title</th>
              <th style="width:12%">Type</th>
              <th>Description</th>
              <th style="width:15%">Created</th>
              <th style="width:25%; text-align:right;">Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php $__currentLoopData = $topics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $topic): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <td style="font-weight:600;"><?php echo e($topic->title); ?></td>
                <td>
                  <?php if(!empty($topic->type)): ?>
                    <span class="status-badge"><?php echo e(strtoupper($topic->type)); ?></span>
                  <?php else: ?>
                    <span class="muted">—</span>
                  <?php endif; ?>
                </td>
                <td class="muted"><?php echo e(\Illuminate\Support\Str::limit($topic->description ?? '', 140)); ?></td>
                <td class="muted"><?php echo e(optional($topic->created_at)->diffForHumans()); ?></td>
                <td style="text-align:right;">
                  <div style="display:inline-flex;gap:0.5rem;">
                    <a href="<?php echo e(route('admin.topics.lessons.index', [$course, $topic])); ?>" class="btn btn-edit" style="font-size:0.85rem;padding:0.5rem 0.75rem;">
                      <i class="fas fa-book-open me-1"></i>Lessons
                    </a>
                    <a href="<?php echo e(route('admin.courses.topics.edit', [$course, $topic])); ?>" class="btn-outline" style="font-size:0.85rem;padding:0.5rem 0.75rem;">Edit</a>
                    <form method="POST" action="<?php echo e(route('admin.courses.topics.destroy', [$course, $topic])); ?>" onsubmit="return confirm('Are you sure?');" style="margin:0;display:inline;">
                      <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                      <button type="submit" class="btn btn-danger" style="font-size:0.85rem;padding:0.5rem 0.75rem;">Delete</button>
                    </form>
                  </div>
                </td>
              </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </tbody>
        </table>
      <?php else: ?>
        <div class="muted" style="padding:1rem 0;">No topics yet. Create your first topic.</div>
      <?php endif; ?>

      <?php if(isset($topics) && method_exists($topics, 'links')): ?>
        <div style="margin-top:1.5rem;">
          <?php echo e($topics->links()); ?>

        </div>
      <?php endif; ?>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\digital-leap-africa\digital-leap-africa\resources\views/admin/courses/topics/index.blade.php ENDPATH**/ ?>