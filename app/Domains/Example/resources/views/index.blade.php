@extends('layouts.master')

@section('content')
    <div class="card">
        <div class="card-body p-5">
            <h1>Example!</h1>

            <h3>CSS style is working</h3>
            <p>
                Example domain is working
            </p>
        </div>
    </div>
@endsection

@section('script-bottom')
    <link href="{!! url('assets/css/module/example/styles.min.css') !!}" rel="stylesheet">
    <script src="{!! url('assets/js/module/example/script.min.js') !!}"></script>
@endsection
