@extends('layouts.master')

@section('title')
    Home | Laravel DOA Boilerplate
@endsection

@section('content')
    <div class="card">
        <div class="card-body p-5">
            <h1>Hello!</h1>
            <h4>
                Welcome to my DOA Boilerplat project.
            </h4>
            <p>
                If you already know what is Domain Orientented Architecture, then it's easy to explain.
            </p>
            <p>
                To scale up your web application, developers need to thhink of various architecture strategy to implement their application logics in organized way, so that they could be managed and scaled up efficiently. <span class="fw-bold">Domain Oriented Architecture</span> is such a way to structure your application in terms of Domains.
            </p>
            <p>
                Check the boilerplate documentation from 
                <a href="https://github.com/sabbir-rupom/laravel-domain-oa-boilerplate/blob/main/README.md">Github Source</a>
            </p>
        </div>
    </div>
@endsection
