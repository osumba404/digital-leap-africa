

<?php $__env->startSection('content'); ?>
<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="card bg-primary-light border-0 shadow-sm rounded">
                    <div class="card-body">
                        <h5 class="text-gray-200 mb-4">About Settings</h5>
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link text-gray-300 <?php echo e(request()->is('admin/about/sections*') ? 'active text-white fw-bold' : ''); ?>" 
                                   href="<?php echo e(route('admin.about.sections.index')); ?>">
                                    <i class="fas fa-align-left me-2"></i> Sections
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-gray-300 <?php echo e(request()->is('admin/about/team*') ? 'active text-white fw-bold' : ''); ?>" 
                                   href="<?php echo e(route('admin.about.team.index')); ?>">
                                    <i class="fas fa-users me-2"></i> Team Members
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-gray-300 <?php echo e(request()->is('admin/about/partners*') ? 'active text-white fw-bold' : ''); ?>" 
                                   href="<?php echo e(route('admin.about.partners.index')); ?>">
                                    <i class="fas fa-handshake me-2"></i> Partners
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <?php if(session('success')): ?>
                    <div class="alert alert-success">
                        <?php echo e(session('success')); ?>

                    </div>
                <?php endif; ?>
                <?php if($errors->any()): ?>
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>
                <?php echo $__env->yieldContent('about-content'); ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\DLA\digital-leap-africa\digital-leap-africa\resources\views\admin\about\layout.blade.php ENDPATH**/ ?>