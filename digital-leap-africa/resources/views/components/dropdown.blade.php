@props(['align' => 'right', 'width' => '48', 'contentClasses' => ''])

@php
    // Map alignment to Bootstrap classes
    $menuAlignClass = match($align) {
        'left' => '',
        'top' => '', // not applicable in Bootstrap; fallback to default
        'right' => 'dropdown-menu-end',
        default => 'dropdown-menu-end',
    };

    $dropdownId = 'dd_' . uniqid();
@endphp

<div class="dropdown">
    <button class="btn btn-link nav-link dropdown-toggle text-decoration-none" type="button" id="{{ $dropdownId }}" data-bs-toggle="dropdown" aria-expanded="false">
        {{ $trigger }}
    </button>
    <ul class="dropdown-menu {{ $menuAlignClass }} {{ $contentClasses }}" aria-labelledby="{{ $dropdownId }}">
        {{ $content }}
    </ul>
</div>
