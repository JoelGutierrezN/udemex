<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <title>UDEMEX | Login</title>
</head>
<body>
    <main>
        <img src="{{ asset('assets/img/logos/udemex-white.png') }}" alt="udemex" id="login-image">
        <form action="{{ route('authenticate.temporal') }}" method="POST">
            @csrf
            @method('POST')

            <h1>Acceso al Sistema</h1>

            <div class="divisor-line"></div>

            <h2>UDEMEX</h2>

            <div class="form-group">
                <label for="email-input">Correo</label>
                <input type="email" name="email" id="email-input" placeholder="correo@ejemplo.com">
            </div>

            <div class="form-group">
                <label for="password-input">Contraseña</label>
                <input type="password" name="password" id="password-input" placeholder="******************">
            </div>

            <div class="form-group-button">
                <button type="submit">Ingresar</button>
            </div>

            <div class="form-group-images">
{{--                <img src="{{ asset('assets/img/logos/edomex-2022.png') }}" alt="edomex" width="70px">--}}
                <img src="{{ asset('assets/img/logos/udemex.png') }}" alt="udemex" width="80px">
            </div>

        </form>
    </main>
</body>
</html>



