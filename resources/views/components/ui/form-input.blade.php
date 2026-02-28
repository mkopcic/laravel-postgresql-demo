@props([
    'label' => '',
    'name' => '',
    'type' => 'text',
    'placeholder' => '',
    'required' => false,
    'hint' => '',
    'error' => '',
    'icon' => null
])

<div class="mb-3">
    @if($label)
        <label class="form-label {{ $required ? 'required' : '' }}" for="{{ $name }}">
            {{ $label }}
        </label>
    @endif

    <div class="{{ $icon ? 'input-icon' : '' }}">
        @if($icon)
            <span class="input-icon-addon">
                <i class="{{ $icon }}"></i>
            </span>
        @endif

        <input
            {{ $attributes->merge([
                'type' => $type,
                'class' => 'form-control' . ($error ? ' is-invalid' : ''),
                'id' => $name,
                'name' => $name,
                'placeholder' => $placeholder
            ]) }}
            @if($required) required @endif
        />
    </div>

    @if($hint)
        <small class="form-hint">{{ $hint }}</small>
    @endif

    @if($error)
        <div class="invalid-feedback">{{ $error }}</div>
    @endif
</div>
