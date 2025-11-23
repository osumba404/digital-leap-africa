

<?php $__env->startSection('admin-content'); ?>
<div class="page-header">
  <h1 class="page-title">Lessons for: <?php echo e($topic->title); ?></h1>
  <div class="page-actions" style="display:flex;gap:.5rem;">
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
      <?php if($topic->lessons->count()): ?>
        <div class="table-responsive">
          <table class="table table-striped align-middle">
            <thead>
              <tr>
                <th style="width:60px;">#</th>
                <th>Title</th>
                <th style="width:140px;">Type</th>
                <th style="width:200px;">Updated</th>
                <th style="width:180px;" class="text-end">Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php $__currentLoopData = $topic->lessons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                  <td><?php echo e($loop->iteration); ?></td>
                  <td class="fw-semibold"><?php echo e($item->title); ?></td>
                  <td><span class="badge bg-info text-dark text-uppercase"><?php echo e($item->type); ?></span></td>
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
        <div class="text-muted">No lessons have been added to this topic yet.</div>
      <?php endif; ?>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\DLA\digital-leap-africa\digital-leap-africa\resources\views\admin\courses\lessons\index.blade.php ENDPATH**/ ?>