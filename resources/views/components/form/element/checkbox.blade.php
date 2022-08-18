@props([
    'type' => 'basic',
    'name' => '',
    'label' => '',
    'class' => '',
    'id' => '',
    'value' => 1,
    'checked' => false,
    'disabled' => false,
])

<div class="form-check {{ $class }} @if ($disabled) text-muted @endif" >
    <input class="form-check-input" type="checkbox" @if ($id) id="{{ $id }}" @endif
        @if ($checked) checked @endif value="{{ $value }}" @if ($name) name="{{ $name }}" @endif
        @if ($disabled) disabled @endif>
    <label class="form-check-label" @if ($id) for="{{ $id }}" @endif>
        {{ $label }}
    </label>
</div>