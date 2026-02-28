@props([
    'type' => 'info', // info, success, warning, danger
    'dismissible' => false,
    'icon' => null
])

@php
    $alertClasses = [
        'info' => 'alert-info',
        'success' => 'alert-success',
        'warning' => 'alert-warning',
        'danger' => 'alert-danger',
    ];

    $alertClass = $alertClasses[$type] ?? 'alert-info';

    $iconMap = [
        'info' => 'ti ti-info-circle',
        'success' => 'ti ti-check',
        'warning' => 'ti ti-alert-triangle',
        'danger' => 'ti ti-alert-circle',
    ];

    $iconClass = $icon ?? $iconMap[$type];
@endphp

<div {{ $attributes->merge(['class' => "alert {$alertClass}" . ($dismissible ? ' alert-dismissible' : '')]) }} role="alert">
    <div class="d-flex">
        @if($iconClass)
            <div>
                <i class="{{ $iconClass }}"></i>
            </div>
        @endif
        <div>
            {{ $slot }}
        </div>
    </div>
    @if($dismissible)
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    @endif
</div>
