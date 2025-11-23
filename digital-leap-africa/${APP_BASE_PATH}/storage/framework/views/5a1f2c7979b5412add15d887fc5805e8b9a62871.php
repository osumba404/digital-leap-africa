

<?php $__env->startSection('about-content'); ?>
<div class="card bg-primary-light border-0 shadow-sm rounded">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="text-gray-200 m-0">Partners</h5>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPartnerModal">
                <i class="fas fa-plus me-2"></i>Add Partner
            </button>
        </div>
        
        <div class="row">
            <?php $__empty_1 = true; $__currentLoopData = $partners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $partner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="col-md-4 col-lg-3 mb-4">
                    <div class="card h-100 bg-primary-light border-0">
                        <div class="position-relative">
                            <div class="d-flex align-items-center justify-content-center" style="height: 120px; background-color: #fff; padding: 1rem;">
                                <img src="<?php echo e($partner->logo_url); ?>" class="img-fluid" alt="<?php echo e($partner->name); ?>" style="max-height: 80px; width: auto; max-width: 100%;">
                            </div>
                            <div class="position-absolute top-0 end-0 p-2">
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-light rounded-circle" type="button" id="dropdownMenuButton<?php echo e($partner->id); ?>" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton<?php echo e($partner->id); ?>">
                                        <li>
                                            <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editPartnerModal<?php echo e($partner->id); ?>">
                                                <i class="fas fa-edit me-2"></i>Edit
                                            </button>
                                        </li>
                                        <li>
                                            <form action="<?php echo e(route('admin.about.partners.destroy', $partner->id)); ?>" method="POST" class="d-inline">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Are you sure you want to delete this partner?')">
                                                    <i class="fas fa-trash me-2"></i>Delete
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card-body text-center">
                            <h6 class="card-title text-gray-200 mb-0"><?php echo e($partner->name); ?></h6>
                            <?php if($partner->website_url): ?>
                                <a href="<?php echo e($partner->website_url); ?>" target="_blank" class="text-gray-400 small">
                                    <?php echo e(parse_url($partner->website_url, PHP_URL_HOST)); ?>

                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Edit Partner Modal -->
                <div class="modal fade" id="editPartnerModal<?php echo e($partner->id); ?>" tabindex="-1" aria-labelledby="editPartnerModalLabel<?php echo e($partner->id); ?>" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content bg-primary-light text-gray-200">
                            <div class="modal-header border-0">
                                <h5 class="modal-title" id="editPartnerModalLabel<?php echo e($partner->id); ?>">Edit Partner</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="<?php echo e(route('admin.about.partners.update', $partner->id)); ?>" method="POST" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PUT'); ?>
                                <div class="modal-body">
                                    <div class="text-center mb-4">
                                        <div class="d-flex justify-content-center mb-2">
                                            <div style="width: 150px; height: 100px; background-color: #fff; display: flex; align-items: center; justify-content: center; padding: 1rem;">
                                                <img src="<?php echo e($partner->logo_url); ?>" alt="<?php echo e($partner->name); ?>" class="img-fluid" style="max-height: 80px; max-width: 100%;">
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="logo<?php echo e($partner->id); ?>" class="form-label">Change Logo</label>
                                            <input class="form-control bg-primary-light border-0 text-gray-200" type="file" id="logo<?php echo e($partner->id); ?>" name="logo">
                                            <small class="text-muted">Leave empty to keep current logo</small>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="name<?php echo e($partner->id); ?>" class="form-label">Partner Name</label>
                                        <input type="text" class="form-control bg-primary-light border-0 text-gray-200" id="name<?php echo e($partner->id); ?>" 
                                               name="name" value="<?php echo e(old('name', $partner->name)); ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="website_url<?php echo e($partner->id); ?>" class="form-label">Website URL</label>
                                        <input type="url" class="form-control bg-primary-light border-0 text-gray-200" id="website_url<?php echo e($partner->id); ?>" 
                                               name="website_url" value="<?php echo e(old('website_url', $partner->website_url)); ?>">
                                    </div>
                                    <div class="form-check form-switch mb-3">
                                        <input class="form-check-input" type="checkbox" id="is_active<?php echo e($partner->id); ?>" 
                                               name="is_active" value="1" <?php echo e($partner->is_active ? 'checked' : ''); ?>>
                                        <label class="form-check-label" for="is_active<?php echo e($partner->id); ?>">Active</label>
                                    </div>
                                </div>
                                <div class="modal-footer border-0">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-12">
                    <div class="alert alert-info">
                        No partners found. Add your first partner using the button above.
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Add Partner Modal -->
<div class="modal fade" id="addPartnerModal" tabindex="-1" aria-labelledby="addPartnerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-primary-light text-gray-200">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="addPartnerModalLabel">Add New Partner</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?php echo e(route('admin.about.partners.store')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Partner Name</label>
                        <input type="text" class="form-control bg-primary-light border-0 text-gray-200" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="logo" class="form-label">Logo</label>
                        <input class="form-control bg-primary-light border-0 text-gray-200" type="file" id="logo" name="logo" required>
                        <small class="text-muted">Recommended size: 300x200px, transparent background preferred</small>
                    </div>
                    <div class="mb-3">
                        <label for="website_url" class="form-label">Website URL</label>
                        <input type="url" class="form-control bg-primary-light border-0 text-gray-200" id="website_url" name="website_url">
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Partner</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<style>
    .card {
        transition: transform 0.2s;
    }
    .card:hover {
        transform: translateY(-5px);
    }
    .form-control:focus {
        background-color: #2d3748;
        color: #e2e8f0;
    }
    .form-control {
        color: #e2e8f0;
    }
    .form-control::placeholder {
        color: #a0aec0;
    }
    .dropdown-menu {
        background-color: #2d3748;
        border: 1px solid #4a5568;
    }
    .dropdown-item {
        color: #e2e8f0;
    }
    .dropdown-item:hover {
        background-color: #4a5568;
        color: #fff;
    }
    .modal-content {
        border: 1px solid #4a5568;
    }
    .btn-close {
        filter: invert(1) grayscale(100%) brightness(200%);
    }
</style>
<?php $__env->stopPush(); ?>





<?php echo $__env->make('admin.about.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\DLA\digital-leap-africa\digital-leap-africa\resources\views\admin\about\partners.blade.php ENDPATH**/ ?>