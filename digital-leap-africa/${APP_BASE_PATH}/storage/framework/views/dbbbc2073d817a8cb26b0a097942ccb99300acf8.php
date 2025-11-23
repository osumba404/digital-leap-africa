

<?php $__env->startSection('admin-content'); ?>
<div class="card bg-primary-light border-0 shadow-sm rounded">
    <div class="card-header bg-primary-dark text-white">
        <h5 class="m-0">Add Points</h5>
    </div>
    <div class="card-body">
        <form method="POST" action="<?php echo e(route('admin.point-transactions.store')); ?>">
            <?php echo csrf_field(); ?>
            
            <div class="mb-3">
                <label for="user_id" class="form-label text-gray-200">Select User</label>
                <select class="form-control bg-primary-light border-0 text-gray-200" id="user_id" name="user_id" required>
                    <option value="">Choose a user...</option>
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($user->id); ?>" <?php echo e(old('user_id') == $user->id ? 'selected' : ''); ?>>
                            <?php echo e($user->name); ?> (<?php echo e($user->email); ?>)
                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="points" class="form-label text-gray-200">Points</label>
                <input type="number" class="form-control bg-primary-light border-0 text-gray-200" id="points" name="points" value="<?php echo e(old('points')); ?>" required>
                <small class="text-gray-400">Use negative numbers to deduct points</small>
            </div>

            <div class="mb-3">
                <label for="type" class="form-label text-gray-200">Transaction Type</label>
                <select class="form-control bg-primary-light border-0 text-gray-200" id="type" name="type" required>
                    <option value="earned" <?php echo e(old('type') == 'earned' ? 'selected' : ''); ?>>Earned</option>
                    <option value="bonus" <?php echo e(old('type') == 'bonus' ? 'selected' : ''); ?>>Bonus</option>
                    <option value="spent" <?php echo e(old('type') == 'spent' ? 'selected' : ''); ?>>Spent</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label text-gray-200">Description</label>
                <input type="text" class="form-control bg-primary-light border-0 text-gray-200" id="description" name="description" value="<?php echo e(old('description')); ?>" required placeholder="Reason for points adjustment">
            </div>
            
            <div class="form-check form-switch mb-3">
                <input class="form-check-input" type="checkbox" id="active" name="active" value="1" checked>
                <label class="form-check-label text-gray-200" for="active">
                    Active Transaction
                </label>
            </div>
            
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-2"></i>Add Points
                </button>
                <a href="<?php echo e(route('admin.point-transactions.index')); ?>" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>

<style>
.form-control {
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.2);
    color: var(--diamond-white);
    border-radius: 8px;
}
.form-control:focus {
    background: rgba(255, 255, 255, 0.08);
    border-color: var(--cyan-accent);
    box-shadow: 0 0 0 0.2rem rgba(0, 201, 255, 0.25);
    color: var(--diamond-white);
}
.form-label {
    color: var(--diamond-white);
    font-weight: 500;
    margin-bottom: 0.5rem;
}
.card {
    background: rgba(255, 255, 255, 0.02);
    border: 1px solid rgba(255, 255, 255, 0.1);
}
.card-header {
    background: rgba(255, 255, 255, 0.05);
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    color: var(--diamond-white);
}
.btn-primary {
    background: linear-gradient(135deg, var(--primary-blue), var(--cyan-accent));
    border: none;
    color: white;
}
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\DLA\digital-leap-africa\digital-leap-africa\resources\views\admin\point-transactions\create.blade.php ENDPATH**/ ?>