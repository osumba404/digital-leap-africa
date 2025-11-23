

<?php $__env->startSection('content'); ?>
<style>
.job-card {
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: var(--radius);
    padding: 2rem;
    margin-bottom: 1.5rem;
    transition: transform 0.2s, box-shadow 0.2s;
}

.job-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
}

.job-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 1rem;
    gap: 1rem;
}

.job-title {
    font-size: 1.5rem;
    font-weight: 600;
    color: var(--diamond-white);
    margin-bottom: 0.5rem;
}

.job-company {
    color: var(--cyan-accent);
    font-weight: 500;
    margin-bottom: 0.25rem;
}

.job-meta {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
    color: var(--cool-gray);
    font-size: 0.9rem;
    margin-bottom: 1rem;
}

.job-meta-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.job-description {
    color: var(--cool-gray);
    line-height: 1.6;
    margin-bottom: 1.5rem;
}

.job-type {
    background: rgba(122, 95, 255, 0.2);
    color: var(--purple-accent);
    padding: 0.25rem 0.75rem;
    border-radius: 999px;
    font-size: 0.8rem;
    font-weight: 500;
}

.salary-range {
    background: rgba(0, 201, 255, 0.2);
    color: var(--cyan-accent);
    padding: 0.25rem 0.75rem;
    border-radius: 999px;
    font-size: 0.8rem;
    font-weight: 500;
}

@media (max-width: 768px) {
    .job-header {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .job-meta {
        flex-direction: column;
        gap: 0.5rem;
    }
}
</style>

<div class="container">
    <div style="text-align: center; margin-bottom: 3rem;">
        <h1 style="font-size: 2.5rem; font-weight: 700; margin-bottom: 1rem;">Job Board</h1>
        <p style="color: var(--cool-gray); font-size: 1.1rem;">Discover exciting career opportunities in the tech industry</p>
    </div>

    <?php if($jobs->count() > 0): ?>
        <div style="max-width: 900px; margin: 0 auto;">
            <?php $__currentLoopData = $jobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="job-card">
                    <div class="job-header">
                        <div style="flex-grow: 1;">
                            <h3 class="job-title"><?php echo e($job->title); ?></h3>
                            <div class="job-company">
                                <i class="fas fa-building me-2"></i><?php echo e($job->company); ?>

                            </div>
                        </div>
                        
                        <?php if($job->application_url): ?>
                            <a href="<?php echo e($job->application_url); ?>" target="_blank" class="btn-primary" style="padding: 0.75rem 1.5rem; white-space: nowrap;">
                                <i class="fas fa-external-link-alt me-2"></i>Apply Now
                            </a>
                        <?php endif; ?>
                    </div>
                    
                    <div class="job-meta">
                        <?php if($job->location): ?>
                            <div class="job-meta-item">
                                <i class="fas fa-map-marker-alt"></i>
                                <span><?php echo e($job->location); ?></span>
                            </div>
                        <?php endif; ?>
                        
                        <?php if($job->job_type): ?>
                            <span class="job-type"><?php echo e(ucfirst($job->job_type)); ?></span>
                        <?php endif; ?>
                        
                        <?php if($job->salary_range): ?>
                            <span class="salary-range">$<?php echo e($job->salary_range); ?></span>
                        <?php endif; ?>
                        
                        <?php if($job->posted_at): ?>
                            <div class="job-meta-item">
                                <i class="fas fa-clock"></i>
                                <span>Posted <?php echo e(is_string($job->posted_at) ? \Carbon\Carbon::parse($job->posted_at)->diffForHumans() : $job->posted_at->diffForHumans()); ?></span>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <div class="job-description">
                        <?php echo e($job->description); ?>

                    </div>
                    
                    <?php if($job->requirements): ?>
                        <div style="margin-top: 1.5rem;">
                            <h4 style="color: var(--diamond-white); font-weight: 500; margin-bottom: 0.75rem;">
                                <i class="fas fa-list-check me-2"></i>Requirements
                            </h4>
                            <div style="color: var(--cool-gray); line-height: 1.6;">
                                <?php echo nl2br(e($job->requirements)); ?>

                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php else: ?>
        <div style="text-align: center; padding: 4rem 0;">
            <i class="fas fa-briefcase" style="font-size: 4rem; color: var(--cool-gray); opacity: 0.5; margin-bottom: 1rem;"></i>
            <h3 style="color: var(--cool-gray); margin-bottom: 1rem;">No Jobs Available</h3>
            <p style="color: var(--cool-gray); margin-bottom: 2rem;">There are no open positions at this time. Check back soon for new opportunities!</p>
            <a href="<?php echo e(route('courses.index')); ?>" class="btn-primary" style="padding: 0.75rem 1.5rem;">
                <i class="fas fa-graduation-cap me-2"></i>Explore Courses
            </a>
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\DLA\digital-leap-africa\digital-leap-africa\resources\views\pages\jobs\index.blade.php ENDPATH**/ ?>