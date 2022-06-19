<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>
        Laravel DOA Boilerplate
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="Laravel application boilerplate with Domain Oriented Architecture" name="description" />
    <meta content="Sabbir Rupom" name="author" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ URL::asset('assets/images/favicon.ico') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
    @include('layouts.header')

    <div class="main-content py-5">
        <div class="container">
            @yield('content')
        </div>
    </div>

    @include('layouts.footer')
</body>

</html>
