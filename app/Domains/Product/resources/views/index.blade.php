@extends('layouts.master')

@section('title')
    Products
@endsection

@section('content')
    @component('components.breadcrumb')
        <x-slot name="li_1">Home</x-slot>
        <x-slot name="url_1">{{ url('/') }}</x-slot>
        <x-slot name="li_2">Product</x-slot>
        <x-slot name="li_active">List</x-slot>
        <x-slot name="title">Product List</x-slot>
    @endcomponent

    <div class="row">
        <div class="col-lg-5 col-md-12">
            <div class="product-form">
                @include('product_view::raw.add')
            </div>
        </div>
        <div class="col-lg-6 offset-lg-1 col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between t-filter-box">
                        <div class="title">
                            Showing All Products (<span class="item-count">{{ $products->count() }}</span>)
                        </div>

                        <div class="search">
                            <input class="form-control" type="text" placeholder="Search product ..." data-action="list"
                                data-url="{{ route('product.search') }}" value="{{ isset($term) ? $term : '' }}" />
                        </div>
                    </div>
                    <div class="mt-3 product-list">
                        @include('product_view::raw.list', [
                            'products' => $products,
                        ])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css-bottom')
    <link href="{{ URL::asset('/assets/css/module/product/product.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('script-top')
    @parent
    <script src="{{ URL::asset('/assets/libs/jquery-validation/jquery-validation.min.js') }}"></script>
@endsection

@section('script-bottom')
    @parent
    <script src="{{ URL::asset('/assets/js/module/product/form.min.js') }}"></script>
@endsection
