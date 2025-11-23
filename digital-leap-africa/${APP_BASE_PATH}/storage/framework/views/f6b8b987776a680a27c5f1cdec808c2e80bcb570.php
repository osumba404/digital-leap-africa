

<?php $__env->startSection('content'); ?>
<style>
.project-hero {
    background: linear-gradient(135deg, var(--navy-bg) 0%, var(--deep-blue) 100%);
    border-radius: var(--radius);
    overflow: hidden;
    margin-bottom: 2rem;
}

.project-image {
    width: 100%;
    height: 400px;
    object-fit: cover;
    background: linear-gradient(135deg, var(--primary-blue), var(--deep-blue));
}

.project-details {
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: var(--radius);
    padding: 2rem;
    margin-bottom: 2rem;
}

.tech-grid {
    display: flex;
    flex-wrap: wrap;
    gap: 0.75rem;
    margin: 1.5rem 0;
}

.tech-tag {
    background: rgba(0, 201, 255, 0.2);
    color: var(--cyan-accent);
    padding: 0.5rem 1rem;
    border-radius: 999px;
    font-size: 0.9rem;
    font-weight: 500;
}

.project-links {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
    margin-top: 2rem;
}

.difficulty-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 1rem;
    border-radius: 999px;
    font-weight: 500;
    font-size: 0.9rem;
}

.difficulty-beginner {
    background: rgba(34, 197, 94, 0.2);
    color: #22c55e;
}

.difficulty-intermediate {
    background: rgba(251, 191, 36, 0.2);
    color: #fbbf24;
}

.difficulty-advanced {
    background: rgba(239, 68, 68, 0.2);
    color: #ef4444;
}
</style>

<div class="container">
    
    <div class="project-hero">
        <?php if($project->image_url): ?>
            <img src="<?php echo e($project->image_url); ?>" alt="<?php echo e($project->title); ?>" class="project-image">
        <?php else: ?>
            <div class="project-image" style="display: flex; align-items: center; justify-content: center;">
                <i class="fas fa-project-diagram" style="font-size: 4rem; color: var(--diamond-white); opacity: 0.3;"></i>
            </div>
        <?php endif; ?>
        
        <div style="padding: 2rem;">
            <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem; flex-wrap: wrap;">
                <h1 style="font-size: 2.5rem; font-weight: 700; color: var(--diamond-white); margin: 0;">
                    <?php echo e($project->title); ?>

                </h1>
                
                <?php if($project->difficulty_level): ?>
                    <span class="difficulty-badge difficulty-<?php echo e($project->difficulty_level); ?>">
                        <?php switch($project->difficulty_level):
                            case ('beginner'): ?>
                                <i class="fas fa-seedling"></i>
                                <?php break; ?>
                            <?php case ('intermediate'): ?>
                                <i class="fas fa-chart-line"></i>
                                <?php break; ?>
                            <?php case ('advanced'): ?>
                                <i class="fas fa-rocket"></i>
                                <?php break; ?>
                        <?php endswitch; ?>
                        <?php echo e(ucfirst($project->difficulty_level)); ?>

                    </span>
                <?php endif; ?>
            </div>
            
            <p style="font-size: 1.1rem; color: var(--cool-gray); line-height: 1.6; margin-bottom: 1.5rem;">
                <?php echo e($project->description); ?>

            </p>
            
            <?php if($project->technologies): ?>
                <div class="tech-grid">
                    <?php $__currentLoopData = explode(',', $project->technologies); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tech): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <span class="tech-tag"><?php echo e(trim($tech)); ?></span>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endif; ?>
            
            <div class="project-links">
                <?php if($project->github_url): ?>
                    <a href="<?php echo e($project->github_url); ?>" target="_blank" class="btn-primary" style="padding: 0.75rem 1.5rem;">
                        <i class="fab fa-github me-2"></i>View on GitHub
                    </a>
                <?php endif; ?>
                
                <?php if($project->demo_url): ?>
                    <a href="<?php echo e($project->demo_url); ?>" target="_blank" class="btn-outline" style="padding: 0.75rem 1.5rem;">
                        <i class="fas fa-external-link-alt me-2"></i>Live Demo
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    
    <div class="project-details">
        <h2 style="font-size: 1.5rem; font-weight: 600; color: var(--diamond-white); margin-bottom: 1rem;">
            <i class="fas fa-info-circle me-2"></i>Project Details
        </h2>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem;">
            <?php if($project->created_at): ?>
                <div>
                    <h4 style="color: var(--cyan-accent); font-weight: 500; margin-bottom: 0.5rem;">
                        <i class="fas fa-calendar me-2"></i>Created
                    </h4>
                    <p style="color: var(--cool-gray); margin: 0;"><?php echo e($project->created_at->format('F j, Y')); ?></p>
                </div>
            <?php endif; ?>
            
            <?php if($project->difficulty_level): ?>
                <div>
                    <h4 style="color: var(--cyan-accent); font-weight: 500; margin-bottom: 0.5rem;">
                        <i class="fas fa-signal me-2"></i>Difficulty
                    </h4>
                    <p style="color: var(--cool-gray); margin: 0;"><?php echo e(ucfirst($project->difficulty_level)); ?> Level</p>
                </div>
            <?php endif; ?>
            
            <?php if($project->technologies): ?>
                <div>
                    <h4 style="color: var(--cyan-accent); font-weight: 500; margin-bottom: 0.5rem;">
                        <i class="fas fa-code me-2"></i>Technologies
                    </h4>
                    <p style="color: var(--cool-gray); margin: 0;"><?php echo e(str_replace(',', ', ', $project->technologies)); ?></p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    
    <div style="background: rgba(255, 255, 255, 0.03); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: var(--radius); padding: 2rem; text-align: center;">
        <h3 style="color: var(--diamond-white); margin-bottom: 1rem;">Inspired by this project?</h3>
        <p style="color: var(--cool-gray); margin-bottom: 2rem;">Join our community and start building your own amazing projects!</p>
        <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
            <a href="<?php echo e(route('courses.index')); ?>" class="btn-primary" style="padding: 0.75rem 1.5rem;">
                <i class="fas fa-graduation-cap me-2"></i>Browse Courses
            </a>
            <a href="<?php echo e(route('projects.index')); ?>" class="btn-outline" style="padding: 0.75rem 1.5rem;">
                <i class="fas fa-arrow-left me-2"></i>Back to Projects
            </a>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\DLA\digital-leap-africa\digital-leap-africa\resources\views\pages\projects\show.blade.php ENDPATH**/ ?>