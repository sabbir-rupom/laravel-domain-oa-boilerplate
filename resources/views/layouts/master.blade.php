<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <title>
        @hasSection('title')
            @yield('title')
        @else
            Laravel DOA Boilerplate
        @endif

    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @hasSection('head-meta')
        @yield('head-meta')
    @else
        <meta content="Laravel application boilerplate with Domain Oriented Architecture" name="description" />
        <meta content="Sabbir Rupom" name="author" />
    @endif

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ URL::asset('assets/images/favicon.ico') }}">
    @include('layouts.include.style-css')
</head>

<body>
    <header>
        @include('layouts.include.navbar')
    </header>
    <div class="main-content">
        <div class="container-fluid">
            @yield('content')
        </div>
    </div>
    <footer>
        @include('layouts.include.script-js')
        @include('layouts.include.footer')
    </footer>
</body>

</html>
