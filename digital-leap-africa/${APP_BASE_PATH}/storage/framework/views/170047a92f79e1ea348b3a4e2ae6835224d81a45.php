<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps(['align' => 'right', 'width' => '48', 'contentClasses' => '']) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps(['align' => 'right', 'width' => '48', 'contentClasses' => '']); ?>
<?php foreach (array_filter((['align' => 'right', 'width' => '48', 'contentClasses' => '']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<?php
    // Map alignment to Bootstrap classes
    $menuAlignClass = match($align) {
        'left' => '',
        'top' => '', // not applicable in Bootstrap; fallback to default
        'right' => 'dropdown-menu-end',
        default => 'dropdown-menu-end',
    };

    $dropdownId = 'dd_' . uniqid();
?>

<div class="dropdown">
    <button class="btn btn-link nav-link dropdown-toggle text-decoration-none" type="button" id="<?php echo e($dropdownId); ?>" data-bs-toggle="dropdown" aria-expanded="false">
        <?php echo e($trigger); ?>

    </button>
    <ul class="dropdown-menu <?php echo e($menuAlignClass); ?> <?php echo e($contentClasses); ?>" aria-labelledby="<?php echo e($dropdownId); ?>">
        <?php echo e($content); ?>

    </ul>
</div>
<?php /**PATH C:\xampp\htdocs\DLA\digital-leap-africa\digital-leap-africa\resources\views\components\dropdown.blade.php ENDPATH**/ ?>