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

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
        integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="{{ URL::asset('/assets/css/module/product/product.min.css') }}" rel="stylesheet" type="text/css" />
@endsection


@section('script')
    @parent

    <!-- Add jQuery validation library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"
        integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Add Sweet Alert library -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Add Toastr library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <!-- Add Custom JS Code -->
    <script src="{{ URL::asset('/assets/js/module/product/form.min.js') }}"></script>
@endsection
