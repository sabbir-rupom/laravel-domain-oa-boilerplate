@props([
    'name' => '',
    'placeholder' => '',
    'class' => '',
    'id' => '',
    'required' => false,
    'value' => '',
    'dataArray' => [],
    'group' => false,
])

<select class="form-select select2 select2-multiple {{ $class }}"
    @if ($id) id="{{ $id }}" @endif name="{{ $name }}[]" multiple
    placeholder="{{ $placeholder ? $placeholder : 'Select One' }}">

    @if ($dataArray)

        @if ($group)
            @foreach ($dataArray as $group => $array)
                <optgroup label="{{ $group }}">

                    @foreach ($array as $key => $item)
                        <option value="{{ $key }}">{{ $item }}</option>
                    @endforeach
                </optgroup>
            @endforeach
        @else
            @foreach ($dataArray as $key => $item)
                <option value="{{ $key }}">{{ $item }}</option>
            @endforeach

        @endif

    @endif
</select>

@if ($required)
    @error($name)
        <div class="invalid-feedback d-block">
            {{ $message }}
        </div>
    @enderror
@endif
