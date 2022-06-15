@props([
    'type' => 'text',
    'disabled' => false,
    'name' => '',
    'placeholder' => '',
    'class' => '',
    'id' => '',
    'required' => false,
    'value' => '',
    'state' => '',
    'helpText' => '',
    'dataAttr' => [],
    'rangeArray' => [],
    'rows' => 4
])

@php
$class = isset($class) ? $class : '';
// if (($name && $errors->has($name)) || $state === 'error') {
//     $class .= ' is-invalid';
// }
@endphp

@if ($type === 'textarea')
    <textarea class="form-control {{ $class }}" name="{{ $name }}" rows="{{ $rows }}"
        @if ($id) id="{{ $id }}" @endif
        @if ($disabled) disabled @endif @if ($required) required @endif
        @if ($dataAttr) @foreach ($dataAttr as $k => $v)
                data-{{ $k }}="{{ $v }}"
            @endforeach @endif
        @if ($placeholder) placeholder="{{ $placeholder }}" @endif>{!! $value !!}</textarea>
@elseif ($type == 'date-range-picker')
    <div class="input-group {{ $class }}" @if ($id) id="{{ $id }}" @endif
        @if ($dataAttr) @foreach ($dataAttr as $k => $v)
                data-{{ $k }}="{{ $v }}"
            @endforeach @endif>
        <input type="text" class="form-control date" name="{{ $rangeArray['name'][0] ?? 'date_start' }}"
            @if ($required) required @endif
            placeholder="{{ $rangeArray['placeholder'][0] ?? 'Date Start' }}" autocomplete="off"
            value="{{ $rangeArray['value'][0] ?? '' }}">
        <span class="input-group-text">{!! $rangeArray['divider'] ?? 'To' !!}</span>
        <input type="text" class="form-control date" name="{{ $rangeArray['name'][1] ?? 'date_end' }}"
            @if ($required) required @endif  autocomplete="off"
            placeholder="{{ $rangeArray['placeholder'][1] ?? 'Date End' }}"
            value="{{ $rangeArray['value'][1] ?? '' }}">
    </div>
@else
    <input type="{{ $type }}" @if ($placeholder) placeholder="{{ $placeholder }}" @endif
        name="{{ $name }}" @if ($id) id="{{ $id }}" @endif
        @if ($disabled) disabled @endif @if ($required) required @endif
        value="{{ $value }}"  autocomplete="off"
        @if ($dataAttr) @foreach ($dataAttr as $k => $v)
                data-{{ $k }}="{{ $v }}"
            @endforeach @endif
        class="form-control {{ $class }}" />
@endif

{{ $slot }}

@if ($helpText)
    <div class="mt-1 @if ($state === 'error') text-danger @else text-muted @endif">
        {{ $helpText }}
    </div>
@endif
