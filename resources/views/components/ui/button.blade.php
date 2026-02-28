@props([
    'variant' => 'primary', // primary, secondary, success, warning, danger, info, light, dark
    'size' => '', // sm, lg
    'icon' => null,
    'outline' => false,
    'type' => 'button'
])

@php
    $baseClass = $outline ? "btn-outline-{$variant}" : "btn-{$variant}";
    $sizeClass = $size ? "btn-{$size}" : '';
    $classes = "btn {$baseClass} {$sizeClass}";
@endphp

<button {{ $attributes->merge(['type' => $type, 'class' => $classes]) }}>
    @if($icon)
        <i class="{{ $icon }}"></i>
    @endif
    {{ $slot }}
</button>
