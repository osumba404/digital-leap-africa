<?php if($paginator->hasPages()): ?>
    <div class="pagination-wrapper">
        <div class="pagination-info">
            Showing <?php echo e($paginator->firstItem()); ?> to <?php echo e($paginator->lastItem()); ?> of <?php echo e($paginator->total()); ?> results
        </div>
        
        <nav class="pagination-nav">
            <ul class="pagination">
                
                <?php if($paginator->onFirstPage()): ?>
                    <li class="page-item disabled">
                        <span class="page-link">
                            <i class="fas fa-chevron-left"></i> Previous
                        </span>
                    </li>
                <?php else: ?>
                    <li class="page-item">
                        <a href="<?php echo e($paginator->previousPageUrl()); ?>" class="page-link" rel="prev">
                            <i class="fas fa-chevron-left"></i> Previous
                        </a>
                    </li>
                <?php endif; ?>

                
                <?php $__currentLoopData = $elements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    
                    <?php if(is_string($element)): ?>
                        <li class="page-item disabled">
                            <span class="page-link"><?php echo e($element); ?></span>
                        </li>
                    <?php endif; ?>

                    
                    <?php if(is_array($element)): ?>
                        <?php $__currentLoopData = $element; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($page == $paginator->currentPage()): ?>
                                <li class="page-item active">
                                    <span class="page-link"><?php echo e($page); ?></span>
                                </li>
                            <?php else: ?>
                                <li class="page-item">
                                    <a href="<?php echo e($url); ?>" class="page-link"><?php echo e($page); ?></a>
                                </li>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                
                <?php if($paginator->hasMorePages()): ?>
                    <li class="page-item">
                        <a href="<?php echo e($paginator->nextPageUrl()); ?>" class="page-link" rel="next">
                            Next <i class="fas fa-chevron-right"></i>
                        </a>
                    </li>
                <?php else: ?>
                    <li class="page-item disabled">
                        <span class="page-link">
                            Next <i class="fas fa-chevron-right"></i>
                        </span>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>

    <style>
        .pagination-wrapper {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1rem;
            margin: 2rem 0;
        }

        .pagination-info {
            color: var(--cool-gray, #AEB8C2);
            font-size: 0.9rem;
        }

        .pagination {
            display: flex;
            list-style: none;
            margin: 0;
            padding: 0;
            gap: 0.25rem;
        }

        .page-item {
            display: flex;
        }

        .page-link {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 0.75rem;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 6px;
            color: #fff;
            text-decoration: none;
            transition: all 0.2s ease;
            font-size: 0.9rem;
        }

        .page-link:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.2);
            color: #fff;
            text-decoration: none;
        }

        .page-item.active .page-link {
            background: var(--primary-blue, #2E78C5);
            border-color: var(--primary-blue, #2E78C5);
            color: #fff;
        }

        .page-item.disabled .page-link {
            background: rgba(255, 255, 255, 0.02);
            border-color: rgba(255, 255, 255, 0.05);
            color: rgba(255, 255, 255, 0.4);
            cursor: not-allowed;
        }

        .page-link i {
            font-size: 0.8rem;
        }

        @media (max-width: 768px) {
            .pagination-wrapper {
                gap: 0.75rem;
            }
            
            .pagination {
                flex-wrap: wrap;
                justify-content: center;
            }
            
            .page-link {
                padding: 0.4rem 0.6rem;
                font-size: 0.85rem;
            }
            
            .pagination-info {
                font-size: 0.85rem;
                text-align: center;
            }
        }
    </style>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\DLA\digital-leap-africa\digital-leap-africa\resources\views/vendor/pagination/custom.blade.php ENDPATH**/ ?>