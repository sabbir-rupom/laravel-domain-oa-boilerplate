@php
$url_1 = isset($url_1) ? $url_1 : 'javascript: void(0);';
$url_2 = isset($url_2) ? $url_2 : 'javascript: void(0);';
$url_3 = isset($url_3) ? $url_3 : 'javascript: void(0);';
$li_2 = isset($li_2) ? $li_2 : '';
$li_3 = isset($li_3) ? $li_3 : '';
$li_active = isset($li_active) ? $li_active : (isset($title) ? $title : '');
@endphp
<div class="row mb-3">
    <div class="col-12">
        <div class="d-sm-flex justify-content-between">

            @isset($title)
                <h4 class="mb-sm-0 bread-title font-size-18">{{ $title }}</h4>
            @endisset

            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="{!! $url_1 !!}">{{ $li_1 }}</a></li>
                @if (!empty($li_2))
                    <li class="breadcrumb-item"><a href="{!! $url_2 !!}">{{ $li_2 }}</a></li>
                @endif
                @if (!empty($li_3))
                    <li class="breadcrumb-item"><a href="{!! $url_3 !!}">{{ $li_3 }}</a></li>
                @endif
                @if ($li_active)
                    <li class="breadcrumb-item active">{{ $li_active }}</li>
                @endif
            </ol>

        </div>
    </div>
</div>
<!-- end page title -->
