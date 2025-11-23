

<?php $__env->startPush('styles'); ?>
<style>
.action-buttons {
    display: flex;
    gap: 0.5rem;
    flex-wrap: wrap;
}

.btn-sm {
    padding: 0.4rem 0.75rem;
    font-size: 0.8rem;
    border-radius: 6px;
    text-decoration: none;
    border: none;
    cursor: pointer;
    transition: all 0.2s;
    display: inline-flex;
    align-items: center;
    gap: 0.25rem;
    white-space: nowrap;
}

.btn-edit {
    background: rgba(59, 130, 246, 0.1);
    color: #3b82f6;
    border: 1px solid rgba(59, 130, 246, 0.3);
}

.btn-edit:hover {
    background: rgba(59, 130, 246, 0.2);
}

.btn-delete {
    background: rgba(239, 68, 68, 0.1);
    color: #ef4444;
    border: 1px solid rgba(239, 68, 68, 0.3);
}

.btn-delete:hover {
    background: rgba(239, 68, 68, 0.2);
}

[data-theme="light"] .btn-edit {
    background: rgba(59, 130, 246, 0.1);
    color: #2563eb;
}

[data-theme="light"] .btn-delete {
    background: rgba(239, 68, 68, 0.1);
    color: #dc2626;
}

/* CRITICAL: Light Mode Text Fixes */
[data-theme="light"] .data-table td,
[data-theme="light"] .data-table td * {
    color: #1a202c !important;
}

[data-theme="light"] .data-table td i {
    color: inherit !important;
}
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('admin-content'); ?>
<div class="page-header">
    <h1 class="page-title">FAQs</h1>
    <div class="page-actions">
        <a href="<?php echo e(route('admin.faqs.create')); ?>" class="btn-primary" style="padding: 0.5rem 1rem; font-size: 0.9rem;">
            <i class="fas fa-plus me-2"></i>Add FAQ
        </a>
    </div>
</div>

<?php if(session('success')): ?>
  <div class="success-message"><?php echo e(session('success')); ?></div>
<?php endif; ?>

<div class="table-responsive">
  <table class="data-table">
    <thead>
      <tr>
        <th>Question</th>
        <th>Status</th>
        <th>Updated</th>
        <th style="width:160px">Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php $__empty_1 = true; $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
      <tr>
        <td><?php echo e($faq->question); ?></td>
        <td>
          <?php if($faq->is_active): ?>
            <span class="status-badge status-active">Active</span>
          <?php else: ?>
            <span class="status-badge status-inactive">Inactive</span>
          <?php endif; ?>
        </td>
        <td><?php echo e($faq->updated_at?->format('M d, Y')); ?></td>
        <td>
          <div class="action-buttons">
            <a href="<?php echo e(route('admin.faqs.edit', $faq)); ?>" class="btn-sm btn-edit">
              <i class="fas fa-edit"></i>Edit
            </a>
            <form method="POST" action="<?php echo e(route('admin.faqs.destroy', $faq)); ?>" style="display:inline" onsubmit="return confirm('Delete FAQ?')">
              <?php echo csrf_field(); ?>
              <?php echo method_field('DELETE'); ?>
              <button type="submit" class="btn-sm btn-delete">
                <i class="fas fa-trash"></i>Delete
              </button>
            </form>
          </div>
        </td>
      </tr>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
      <tr>
        <td colspan="4" style="text-align: center; padding: 2rem; color: var(--cool-gray);">
          <i class="fas fa-question-circle" style="font-size: 2rem; opacity: 0.5; display: block; margin-bottom: 0.5rem;"></i>
          No FAQs found.
        </td>
      </tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>

<div style="margin-top:1rem;">
  <?php echo e($faqs->links()); ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\DLA\digital-leap-africa\digital-leap-africa\resources\views\admin\faqs\index.blade.php ENDPATH**/ ?>