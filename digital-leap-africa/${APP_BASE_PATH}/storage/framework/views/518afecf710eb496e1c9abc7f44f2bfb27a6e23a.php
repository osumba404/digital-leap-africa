<div class="form-group">
    <label for="badge_name">Badge Name *</label>
    <input 
        type="text" 
        id="badge_name" 
        name="badge_name" 
        class="form-control" 
        value="<?php echo e(old('badge_name', $badge->badge_name ?? '')); ?>" 
        required
    >
    <?php $__errorArgs = ['badge_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <span class="error-message"><?php echo e($message); ?></span>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>

<div class="form-group">
    <label for="description">Description</label>
    <textarea 
        id="description" 
        name="description" 
        class="form-control" 
        rows="4"
        placeholder="Describe what this badge represents and how users can earn it..."
    ><?php echo e(old('description', $badge->description ?? '')); ?></textarea>
    <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <span class="error-message"><?php echo e($message); ?></span>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>

<div class="form-group">
    <label for="badge_image">Badge Image</label>
    <?php if(isset($badge) && $badge->img_url): ?>
        <div style="margin-bottom: 1rem;">
            <img src="<?php echo e($badge->image_url); ?>" alt="Current badge image" style="width: 80px; height: 80px; object-fit: cover; border-radius: 8px; border: 2px solid rgba(0, 201, 255, 0.3);">
            <p style="font-size: 0.85rem; color: var(--cool-gray); margin-top: 0.5rem;">Current image (upload a new one to replace)</p>
        </div>
    <?php endif; ?>
    <input 
        type="file" 
        id="badge_image" 
        name="badge_image" 
        class="form-control" 
        accept="image/*"
    >
    <small style="color: var(--cool-gray); font-size: 0.85rem; display: block; margin-top: 0.5rem;">
        Accepted formats: JPG, PNG, GIF, SVG (Max: 2MB)
    </small>
    <?php $__errorArgs = ['badge_image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <span class="error-message"><?php echo e($message); ?></span>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>

<div class="form-actions">
    <button type="submit" class="btn-primary">
        <i class="fas fa-save"></i> <?php echo e(isset($badge) ? 'Update Badge' : 'Create Badge'); ?>

    </button>
    <a href="<?php echo e(route('admin.badges.index')); ?>" class="btn-outline">
        <i class="fas fa-times"></i> Cancel
    </a>
</div><?php /**PATH C:\xampp\htdocs\DLA\digital-leap-africa\digital-leap-africa\resources\views\admin\badges\_form.blade.php ENDPATH**/ ?>