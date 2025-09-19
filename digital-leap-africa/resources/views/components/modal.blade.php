@props([
    'name',
    'show' => false,
    'maxWidth' => 'lg' // map: sm, md, lg, xl, 2xl -> modal-sm, -, modal-lg, modal-xl, modal-xl
])

@php
    $sizeClass = [
        'sm' => 'modal-sm',
        'md' => '',
        'lg' => 'modal-lg',
        'xl' => 'modal-xl',
        '2xl' => 'modal-xl',
    ][$maxWidth] ?? '';
    $modalId = Str::slug($name, '-');
@endphp

<div class="modal fade" id="{{ $modalId }}" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog {{ $sizeClass }} modal-dialog-centered">
    <div class="modal-content bg-primary-light text-gray-200 border-0">
      <div class="modal-body">
        {{ $slot }}
      </div>
    </div>
  </div>
</div>

@if($show)
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        var el = document.getElementById(@json($modalId));
        if (!el) return;
        var m = new bootstrap.Modal(el);
        m.show();
      });
    </script>
@endif
