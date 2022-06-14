@props([
    'type' => '',
    'disabled' => false,
    'name' => '',
    'placeholder' => '',
    'class' => '',
    'id' => '',
    'required' => false,
    'default' => true,
    'value' => '',
    'dataArray' => [],
    'dataAttr' => [],
])

@if ($type === 'datalist')

    <input list="datalistOptions" @if ($id) id="{{ $id }}" @endif
        @if ($placeholder) placeholder="{{ $placeholder }}" @endif name="{{ $name }}"
        @if ($required) required @endif class="form-control {{ $class }}"
        @if ($dataAttr) @foreach ($dataAttr as $k => $v)
                data-{{ $k }}="{{ $v }}"
            @endforeach @endif />
    <datalist id="datalistOptions">

        @foreach ($dataArray as $key => $item)
            <option value="{{ $key }}" @if ($key == $value) selected @endif>{{ $item }}
            </option>
        @endforeach

    </datalist>
@else
    <select class="form-select {{ $class }}" name="{{ $name }}" @if ($id) id="{{ $id }}" @endif
        @if ($required) required @endif @if ($disabled) disabled @endif
        @if ($dataAttr) @foreach ($dataAttr as $k => $v)
                data-{{ $k }}="{{ $v }}"
            @endforeach @endif>
        @if ($default)
            <option value="" @empty($value) selected @endempty>Please Select</option>
        @endif

        @foreach ($dataArray as $key => $item)
            <option value="{{ $key }}" @if ($key == $value) selected @endif>{{ $item }}
            </option>
        @endforeach

    </select>

@endif
