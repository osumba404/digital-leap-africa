

<?php $__env->startSection('title', 'Become a Partner'); ?>

<?php $__env->startPush('styles'); ?>
<style>
/* Light Mode Styles for Partner Application Form */
[data-theme="light"] .partner-apply-title {
    color: #2E78C5 !important;
}

[data-theme="light"] .partner-apply-subtitle {
    color: #4A5568 !important;
}

[data-theme="light"] .partner-apply-card {
    background: #FFFFFF !important;
    border: 1px solid rgba(46, 120, 197, 0.2) !important;
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.05) !important;
}

[data-theme="light"] .partner-apply-card .form-label {
    color: #1A202C !important;
}

[data-theme="light"] .partner-apply-card .form-control {
    background: #F8FAFC !important;
    border: 1px solid rgba(46, 120, 197, 0.2) !important;
    color: #1A202C !important;
}

[data-theme="light"] .partner-apply-card .form-control:focus {
    background: #FFFFFF !important;
    border-color: #2E78C5 !important;
    box-shadow: 0 0 0 0.2rem rgba(46, 120, 197, 0.25) !important;
}

[data-theme="light"] .partner-apply-card .form-control::placeholder {
    color: #94a3b8 !important;
}
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<section class="section" style="padding:2rem 0;">
  <div class="container">
    <div class="text-center mb-3" style="text-align:center !important;">
      <h1 class="m-0 partner-apply-title" style="color: #64b5f6; font-size: 22px">Become a Partner</h1>
      <p class="partner-apply-subtitle" style="margin-top:.5rem;color:#94a3b8">Submit your organization details. Applications are reviewed by our admins.</p>
    </div>

    <div class="card partner-apply-card" style="background:#112240;border-radius:12px;border:1px solid rgba(136,146,176,0.2);max-width:720px;margin:0 auto;">
      <div class="card-body" style="padding:1.25rem 1.25rem;">
        <form method="POST" action="<?php echo e(route('partners.store')); ?>" enctype="multipart/form-data">
          <?php echo csrf_field(); ?>

          <div class="mb-3">
            <label class="form-label">Organization Name</label>
            <input type="text" name="name" value="<?php echo e(old('name')); ?>" class="form-control" required>
            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
              <div class="text-danger" style="margin-top:.25rem;"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
          </div>

          <div class="mb-3">
            <label class="form-label">Contact Person</label>
            <input type="text" name="contact_person" value="<?php echo e(old('contact_person')); ?>" class="form-control" required>
            <?php $__errorArgs = ['contact_person'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
              <div class="text-danger" style="margin-top:.25rem;"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
          </div>

          <div class="mb-3">
            <label class="form-label">Email Address</label>
            <input type="email" name="email" value="<?php echo e(old('email')); ?>" class="form-control" required>
            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
              <div class="text-danger" style="margin-top:.25rem;"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
          </div>

          <div class="mb-3">
            <label class="form-label">Phone Number (optional)</label>
            <input type="tel" name="phone" value="<?php echo e(old('phone')); ?>" class="form-control" placeholder="+254 700 000 000">
            <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
              <div class="text-danger" style="margin-top:.25rem;"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
          </div>

          <div class="mb-3">
            <label class="form-label">Website URL (optional)</label>
            <input type="url" name="website_url" value="<?php echo e(old('website_url')); ?>" class="form-control" placeholder="https://example.org">
            <?php $__errorArgs = ['website_url'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
              <div class="text-danger" style="margin-top:.25rem;"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
          </div>

          <div class="mb-3">
            <label class="form-label">Logo Image</label>
            <input type="file" name="logo" accept="image/*" class="form-control" required>
            <?php $__errorArgs = ['logo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
              <div class="text-danger" style="margin-top:.25rem;"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
          </div>

          <div class="d-grid">
            <button type="submit" class="btn btn-primary btn-wide">Submit Application</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\DLA\digital-leap-africa\digital-leap-africa\resources\views\partners\apply.blade.php ENDPATH**/ ?>