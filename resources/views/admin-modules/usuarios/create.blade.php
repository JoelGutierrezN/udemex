@extends('admin-modules.layout.app')

@section('title', 'Inicio')

@section('content')

<h3 class="form-screen-title">Inserción manual de usuarios</h3>

<form action="" method="POST" enctype="multipart/form-data">
    <div class="input-columns-1">
        <div>
            <label for="text-input" class="is-required">Nombre completo</label>
            <input type="text" placeholder="coloque el nombre completo del usuario" autocomplete="off" name="nombre">
        </div>
        <div>
            <label for="text-input" class="is-required">Correo electronico</label>
            <input type="text" placeholder="coloque el correo electronico del usuario" autocomplete="off" name="email">
        </div>
    </div>
    <button type="submit" class="btn-primario">Enviar</button>
</form>

@endsection
