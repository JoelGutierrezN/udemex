<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.1.slim.min.js" integrity="sha256-w8CvhFs7iHNVUtnSP0YKEg00p9Ih13rlL9zGqvLdePA="crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/utilities/CosmoScript.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/select2/select2.min.css') }}">


    @yield('imports-head')
    <title>UDEMEX | @yield('title')</title>
</head>
<body>

    @include('layout.header')

     @include('sweetalert::alert')
    <div class="main-container mt-2 mb-2">
        @yield('content')

    </div>

    @include('layout.footer')

    @yield('scripts')
</body>
</html>
