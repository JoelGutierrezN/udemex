<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    @yield('imports-head')
    <title>UDEMEX | @yield('title')</title>
</head>
<body>

    @include('layout.header')

    <div class="main-container">
        @yield('content')
    </div>

    @include('layout.footer')

    @yield('scripts')
</body>
</html>
