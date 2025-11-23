<?php if($paginator->hasPages()): ?>
    <div class="simple-pagination-wrapper">
        <nav class="simple-pagination-nav">
            <ul class="simple-pagination">
                
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
        .simple-pagination-wrapper {
            display: flex;
            justify-content: center;
            margin: 2rem 0;
        }

        .simple-pagination {
            display: flex;
            list-style: none;
            margin: 0;
            padding: 0;
            gap: 0.5rem;
        }

        .simple-pagination .page-item {
            display: flex;
        }

        .simple-pagination .page-link {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 6px;
            color: #fff;
            text-decoration: none;
            transition: all 0.2s ease;
            font-size: 0.9rem;
        }

        .simple-pagination .page-link:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.2);
            color: #fff;
            text-decoration: none;
        }

        .simple-pagination .page-item.disabled .page-link {
            background: rgba(255, 255, 255, 0.02);
            border-color: rgba(255, 255, 255, 0.05);
            color: rgba(255, 255, 255, 0.4);
            cursor: not-allowed;
        }

        .simple-pagination .page-link i {
            font-size: 0.8rem;
        }

        @media (max-width: 768px) {
            .simple-pagination .page-link {
                padding: 0.4rem 0.8rem;
                font-size: 0.85rem;
            }
        }
    </style>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\DLA\digital-leap-africa\digital-leap-africa\resources\views\vendor\pagination\simple-custom.blade.php ENDPATH**/ ?>