@extends('layouts.master.admin')

@section('title')
    Simple Page
@endsection

@section('content')
    @component('components.util.breadcrumb.default')
        @slot('li_1')
            Unit
        @endslot
        @slot('li_active')
            List
        @endslot
        @slot('title')
            Simple Page
        @endslot
    @endcomponent

    <div class="sap-item-box">
        <div class="row">
            <div class="col-lg-5 col-md-12">
                <div class="sap-form">
                    @include('simple_page_view::raw.add', [
                        'title' => 'Unit Create Form',
                        'heads' => $heads,
                    ])
                </div>
            </div>
            <div class="col-lg-6 offset-lg-1 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            Showing All Units (<span class="item-count">{{ $units->count() }}</span>)

                            <div class="search float-end">
                                <input class="form-control" type="text" placeholder="Search unit ..." data-action="list"
                                    data-url="{{ route('unit.search') }}" value="{{ isset($term) ? $term : '' }}" />
                            </div>
                        </div>
                        <div class="sap-data">

                            @include('simple_page_view::raw.list', [
                                'units' => $units,
                            ])
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('css-bottom')
    <style>
        .sap-item-box .search>input {
            padding: 3px 7px;
            margin-top: -0.25rem;
            margin-bottom: 0.5rem;
            font-size: 80%;
        }

    </style>
@endsection

@section('script')
    @parent
    <script src="{{ URL::asset('/assets/libs/jquery-validation/jquery-validation.min.js') }}"></script>
@endsection

@section('script-bottom')
    <script src="{{ URL::asset('/assets/js/pages/sap-form.init.js') }}"></script>
@endsection
