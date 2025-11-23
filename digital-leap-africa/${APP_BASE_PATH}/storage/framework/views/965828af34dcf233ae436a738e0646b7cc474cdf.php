

<?php $__env->startSection('admin-content'); ?>
<div class="page-header">
  <h2 class="page-title">Edit FAQ</h2>
</div>

<?php if($errors->any()): ?>
  <div class="error-message">Please fix the errors below.</div>
<?php endif; ?>

<form method="POST" action="<?php echo e(route('admin.faqs.update', $faq)); ?>" class="admin-form">
  <?php echo csrf_field(); ?>
  <?php echo method_field('PUT'); ?>
  <div class="form-section">
    <div class="form-section-title">Question</div>
    <input type="text" name="question" class="form-control" value="<?php echo e(old('question', $faq->question)); ?>" required>
    <?php $__errorArgs = ['question'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="error-message"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
  </div>

  <div class="form-section">
    <div class="form-section-title">Answer</div>
    <textarea name="answer" rows="6" class="form-control" required><?php echo e(old('answer', $faq->answer)); ?></textarea>
    <?php $__errorArgs = ['answer'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="error-message"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
  </div>

  <div class="form-section">
    <label style="display:flex; align-items:center; gap:.5rem;">
      <input type="checkbox" name="is_active" value="1" <?php echo e(old('is_active', $faq->is_active) ? 'checked' : ''); ?>> Active
    </label>
  </div>

  <div class="page-actions">
    <a href="<?php echo e(route('admin.faqs.index')); ?>" class="btn-outline">Cancel</a>
    <button type="submit" class="btn-primary">Update FAQ</button>
  </div>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\DLA\digital-leap-africa\digital-leap-africa\resources\views\admin\faqs\edit.blade.php ENDPATH**/ ?>