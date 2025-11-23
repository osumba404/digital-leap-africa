<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'name',
    'show' => false,
    'maxWidth' => 'lg' // map: sm, md, lg, xl, 2xl -> modal-sm, -, modal-lg, modal-xl, modal-xl
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'name',
    'show' => false,
    'maxWidth' => 'lg' // map: sm, md, lg, xl, 2xl -> modal-sm, -, modal-lg, modal-xl, modal-xl
]); ?>
<?php foreach (array_filter(([
    'name',
    'show' => false,
    'maxWidth' => 'lg' // map: sm, md, lg, xl, 2xl -> modal-sm, -, modal-lg, modal-xl, modal-xl
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<?php
    $sizeClass = [
        'sm' => 'modal-sm',
        'md' => '',
        'lg' => 'modal-lg',
        'xl' => 'modal-xl',
        '2xl' => 'modal-xl',
    ][$maxWidth] ?? '';
    $modalId = Str::slug($name, '-');
?>

<div class="modal fade" id="<?php echo e($modalId); ?>" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog <?php echo e($sizeClass); ?> modal-dialog-centered">
    <div class="modal-content bg-primary-light text-gray-200 border-0">
      <div class="modal-body">
        <?php echo e($slot); ?>

      </div>
    </div>
  </div>
</div>

<?php if($show): ?>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        var el = document.getElementById(<?php echo json_encode($modalId, 15, 512) ?>);
        if (!el) return;
        var m = new bootstrap.Modal(el);
        m.show();
      });
    </script>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\DLA\digital-leap-africa\digital-leap-africa\resources\views\components\modal.blade.php ENDPATH**/ ?>