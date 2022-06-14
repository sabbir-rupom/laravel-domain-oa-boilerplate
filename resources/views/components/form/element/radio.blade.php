@props([
    'type' => 'basic',
    'name' => '',
    'label' => '',
    'class' => '',
    'id' => '',
    'value' => 1,
    'checked' => false,
])

<div class="form-check {{ $class }}">
    <input class="form-check-input" type="radio" @if ($id) id="{{ $id }}" @endif
        @if ($checked) checked @endif value="{{ $value }}"
        @if ($name) name="{{ $name }}" @endif>
    <label class="form-check-label" @if ($id) for="{{ $id }}" @endif>
        {{ $label }}
    </label>
</div>
