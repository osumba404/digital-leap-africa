

<?php $__env->startSection('about-content'); ?>
<div class="card bg-primary-light border-0 shadow-sm rounded">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="text-gray-200 m-0">Team Members</h5>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTeamMemberModal">
                <i class="fas fa-plus me-2"></i>Add Team Member
            </button>
        </div>
        
        <div class="row">
            <?php $__empty_1 = true; $__currentLoopData = $teamMembers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100 bg-primary-light border-0">
                        <div class="position-relative">
                            <img src="<?php echo e($member->image_url); ?>" class="card-img-top" alt="<?php echo e($member->name); ?>" style="height: 200px; object-fit: cover;">
                            <div class="position-absolute top-0 end-0 p-2">
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-light rounded-circle" type="button" id="dropdownMenuButton<?php echo e($member->id); ?>" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton<?php echo e($member->id); ?>">
                                        <li>
                                            <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editTeamMemberModal<?php echo e($member->id); ?>">
                                                <i class="fas fa-edit me-2"></i>Edit
                                            </button>
                                        </li>
                                        <li>
                                            <form action="<?php echo e(route('admin.about.team.destroy', $member->id)); ?>" method="POST" class="d-inline">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Are you sure you want to delete this team member?')">
                                                    <i class="fas fa-trash me-2"></i>Delete
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title text-gray-200"><?php echo e($member->name); ?></h5>
                            <p class="card-text text-gray-400"><?php echo e($member->role); ?></p>
                            <div class="d-flex gap-2 mt-3">
                                <?php if($member->facebook_url): ?>
                                    <a href="<?php echo e($member->facebook_url); ?>" target="_blank" class="text-gray-400 hover:text-blue-400">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                <?php endif; ?>
                                <?php if($member->twitter_url): ?>
                                    <a href="<?php echo e($member->twitter_url); ?>" target="_blank" class="text-gray-400 hover:text-blue-400">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                <?php endif; ?>
                                <?php if($member->instagram_url): ?>
                                    <a href="<?php echo e($member->instagram_url); ?>" target="_blank" class="text-gray-400 hover:text-pink-500">
                                        <i class="fab fa-instagram"></i>
                                    </a>
                                <?php endif; ?>
                                <?php if($member->linkedin_url): ?>
                                    <a href="<?php echo e($member->linkedin_url); ?>" target="_blank" class="text-gray-400 hover:text-blue-600">
                                        <i class="fab fa-linkedin-in"></i>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Edit Team Member Modal -->
                <div class="modal fade" id="editTeamMemberModal<?php echo e($member->id); ?>" tabindex="-1" aria-labelledby="editTeamMemberModalLabel<?php echo e($member->id); ?>" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content bg-primary-light text-gray-200">
                            <div class="modal-header border-0">
                                <h5 class="modal-title" id="editTeamMemberModalLabel<?php echo e($member->id); ?>">Edit Team Member</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="<?php echo e(route('admin.about.team.update', $member->id)); ?>" method="POST" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PUT'); ?>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="name<?php echo e($member->id); ?>" class="form-label">Name</label>
                                                <input type="text" class="form-control bg-primary-light border-0 text-gray-200" id="name<?php echo e($member->id); ?>" 
                                                       name="name" value="<?php echo e(old('name', $member->name)); ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="role<?php echo e($member->id); ?>" class="form-label">Role</label>
                                                <input type="text" class="form-control bg-primary-light border-0 text-gray-200" id="role<?php echo e($member->id); ?>" 
                                                       name="role" value="<?php echo e(old('role', $member->role)); ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="image<?php echo e($member->id); ?>" class="form-label">Profile Image</label>
                                                <input class="form-control bg-primary-light border-0 text-gray-200" type="file" id="image<?php echo e($member->id); ?>" name="image">
                                                <small class="text-muted">Leave empty to keep current image</small>
                                            </div>
                                            <div class="form-check form-switch mb-3">
                                                <input class="form-check-input" type="checkbox" id="is_active<?php echo e($member->id); ?>" 
                                                       name="is_active" value="1" <?php echo e($member->is_active ? 'checked' : ''); ?>>
                                                <label class="form-check-label" for="is_active<?php echo e($member->id); ?>">Active</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="facebook_url<?php echo e($member->id); ?>" class="form-label">Facebook URL</label>
                                                <input type="url" class="form-control bg-primary-light border-0 text-gray-200" id="facebook_url<?php echo e($member->id); ?>" 
                                                       name="facebook_url" value="<?php echo e(old('facebook_url', $member->facebook_url)); ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="twitter_url<?php echo e($member->id); ?>" class="form-label">Twitter URL</label>
                                                <input type="url" class="form-control bg-primary-light border-0 text-gray-200" id="twitter_url<?php echo e($member->id); ?>" 
                                                       name="twitter_url" value="<?php echo e(old('twitter_url', $member->twitter_url)); ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="instagram_url<?php echo e($member->id); ?>" class="form-label">Instagram URL</label>
                                                <input type="url" class="form-control bg-primary-light border-0 text-gray-200" id="instagram_url<?php echo e($member->id); ?>" 
                                                       name="instagram_url" value="<?php echo e(old('instagram_url', $member->instagram_url)); ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="linkedin_url<?php echo e($member->id); ?>" class="form-label">LinkedIn URL</label>
                                                <input type="url" class="form-control bg-primary-light border-0 text-gray-200" id="linkedin_url<?php echo e($member->id); ?>" 
                                                       name="linkedin_url" value="<?php echo e(old('linkedin_url', $member->linkedin_url)); ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="bio<?php echo e($member->id); ?>" class="form-label">Bio</label>
                                        <textarea class="form-control bg-primary-light border-0 text-gray-200" id="bio<?php echo e($member->id); ?>" 
                                                  name="bio" rows="4"><?php echo e(old('bio', $member->bio)); ?></textarea>
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
                        No team members found. Add your first team member using the button above.
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Add Team Member Modal -->
<div class="modal fade" id="addTeamMemberModal" tabindex="-1" aria-labelledby="addTeamMemberModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bg-primary-light text-gray-200">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="addTeamMemberModalLabel">Add New Team Member</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?php echo e(route('admin.about.team.store')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control bg-primary-light border-0 text-gray-200" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="role" class="form-label">Role</label>
                                <input type="text" class="form-control bg-primary-light border-0 text-gray-200" id="role" name="role" required>
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Profile Image</label>
                                <input class="form-control bg-primary-light border-0 text-gray-200" type="file" id="image" name="image" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="facebook_url" class="form-label">Facebook URL</label>
                                <input type="url" class="form-control bg-primary-light border-0 text-gray-200" id="facebook_url" name="facebook_url">
                            </div>
                            <div class="mb-3">
                                <label for="twitter_url" class="form-label">Twitter URL</label>
                                <input type="url" class="form-control bg-primary-light border-0 text-gray-200" id="twitter_url" name="twitter_url">
                            </div>
                            <div class="mb-3">
                                <label for="instagram_url" class="form-label">Instagram URL</label>
                                <input type="url" class="form-control bg-primary-light border-0 text-gray-200" id="instagram_url" name="instagram_url">
                            </div>
                            <div class="mb-3">
                                <label for="linkedin_url" class="form-label">LinkedIn URL</label>
                                <input type="url" class="form-control bg-primary-light border-0 text-gray-200" id="linkedin_url" name="linkedin_url">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="bio" class="form-label">Bio</label>
                        <textarea class="form-control bg-primary-light border-0 text-gray-200" id="bio" name="bio" rows="4"></textarea>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Team Member</button>
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

<?php echo $__env->make('admin.about.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\DLA\digital-leap-africa\digital-leap-africa\resources\views\admin\about\team.blade.php ENDPATH**/ ?>