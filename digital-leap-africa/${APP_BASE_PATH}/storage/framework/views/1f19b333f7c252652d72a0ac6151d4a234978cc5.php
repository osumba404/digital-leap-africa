<footer class="bg-primary-light border-top border-dark-subtle mt-auto">
    <div class="container py-4">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
            <p class="mb-0 small text-gray-400">
                <?php echo e($siteSettings['footer_text'] ?? ''); ?>

            </p>
            <div class="d-flex gap-4">
                <a href="<?php echo e($siteSettings['privacy_policy_url'] ?? '#'); ?>" class="link-light text-decoration-none">Privacy Policy</a>
                <a href="<?php echo e($siteSettings['terms_of_service_url'] ?? '#'); ?>" class="link-light text-decoration-none">Terms of Service</a>
            </div>
        </div>
    </div>
</footer><?php /**PATH C:\xampp\htdocs\DLA\digital-leap-africa\digital-leap-africa\resources\views\components\footer.blade.php ENDPATH**/ ?>