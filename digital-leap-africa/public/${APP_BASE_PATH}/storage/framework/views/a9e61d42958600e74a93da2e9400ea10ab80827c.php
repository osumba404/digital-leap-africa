
<?php $__env->startSection('title', 'Event Management'); ?>

<?php $__env->startSection('admin-content'); ?>
<div class="page-header">
    <h1 class="page-title">Edit Event</h1>
</div>
<div class="py-5">
  <div class="container" style="max-width: 48rem;">
    <div class="bg-primary-light shadow-sm rounded">
      <div class="p-4 text-gray-200">
        <form method="POST" action="<?php echo e(route('admin.events.update', $event)); ?>" enctype="multipart/form-data">
          <?php echo method_field('PATCH'); ?>
          <?php echo $__env->make('admin.events._form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </form>
      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\DLA\digital-leap-africa\digital-leap-africa\resources\views/admin/events/edit.blade.php ENDPATH**/ ?>