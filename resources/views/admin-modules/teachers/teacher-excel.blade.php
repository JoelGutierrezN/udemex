<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Excel</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellido paterno</th>
                <th>Apellido materno</th>
                <th>Sexo</th>
                <th>Fecha de nacimiento</th>
                <th>Curp</th>
                <th>Clave de empleado</th>
                <th>Telefono de casa</th>
                <th>Celular</th>
                <th>Correo electronico udemex</th>
                <th>Correo electronico personal</th>
                <th>Rol</th>
                <th>Activo</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{$user->nombre}}</td>
                    <td>{{$user->apellido_paterno}}</td>
                    <td>{{$user->apellido_materno}}</td>
                    <td>{{$user->sexo}}</td>
                    <td>{{$user->fecha_nacimiento}}</td>
                    <td>{{$user->curp}}</td>
                    <td>{{$user->clave_empleado}}</td>
                    <td>{{$user->telefono_casa}}</td>
                    <td>{{$user->celular}}</td>
                    <td>{{$user->email_udemex}}</td>
                    <td>{{$user->email_personal}}</td>
                    <td>{{$user->rol}}</td>
                    <td>{{$user->activo}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
