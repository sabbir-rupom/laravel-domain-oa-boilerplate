@props([
    'type' => 'basic',
    'value' => 1,
    'total' => 5,
    'classRating' => 'text-primary',
    'class' => '',
    'id' => '',
    'name' => '',
    'dataAttr' => [],
])

@if ($type === 'plugin')

    <div class="rating-star {{ $class }}">
        <input type="hidden" class="rating {{ $classRating }}" name="{{ $name }}"
            value="{!! intval($value) !!}"
            @if ($dataAttr) @foreach ($dataAttr as $k => $v)
                            data-{{ $k }}="{{ $v }}"
                        @endforeach @endif
            @if ($id) id="{{ $id }}" @endif />
    </div>
@else
    <div class="nxt-ratings {{ $class }} @if ($type === 'input') input-fill @endif"
        @if ($id) id="{{ $id }}" @endif>
        <input type="hidden" name="{{ $name }}" value="{{ $value }}">

        @for ($i = 0; $i < $total; $i++)
            @php
                if ($value > 0) {
                    echo '<i class="fa fa-star '.$classRating.'"></i>';
                    $value--;
                } else {
                    echo '<i class="fa fa-star"></i>';
                }
            @endphp
        @endfor
    </div>

@endif
