@props(['align' => 'right', 'width' => '48', 'contentClasses' => 'dropdown-menu-dark'])

@php
    $alignmentClasses = match ($align) {
        'left' => 'dropdown-menu-start',
        'top' => 'dropdown-menu-start',
        default => 'dropdown-menu-end',
    };
@endphp

<div class="dropdown">
    <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        {{ $trigger }}
    </button>
    <div class="dropdown-menu {{ $alignmentClasses }} {{ $contentClasses }}">
        {{ $content }}
    </div>
</div>