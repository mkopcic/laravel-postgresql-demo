@props([
    'id' => 'modal-' . uniqid(),
    'title' => '',
    'size' => '', // sm, lg, xl
    'static' => false
])

@php
    $sizeClass = $size ? "modal-{$size}" : '';
@endphp

<div class="modal modal-blur fade" id="{{ $id }}" tabindex="-1" role="dialog" aria-hidden="true"
     @if($static) data-bs-backdrop="static" data-bs-keyboard="false" @endif>
    <div class="modal-dialog {{ $sizeClass }} modal-dialog-centered" role="document">
        <div class="modal-content">
            @if($title)
                <div class="modal-header">
                    <h5 class="modal-title">{{ $title }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            @endif

            <div class="modal-body">
                {{ $slot }}
            </div>

            @isset($footer)
                <div class="modal-footer">
                    {{ $footer }}
                </div>
            @endisset
        </div>
    </div>
</div>
