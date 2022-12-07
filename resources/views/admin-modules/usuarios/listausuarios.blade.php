@extends('admin-modules.layout.app')

@section('title', 'Inicio')

@section('content')
<h1 id="teachers--title">Listado de docentes</h1>

<div>
    <form action="#" method="POST" class="row w-100 p-0 mx-auto align-items-center" id="form-number-items">
        <div class="col-12 col-md-2 text-center my-2">
            @csrf
            @method('GET')
            <select name="paginate" id="select-number-items" class="col-4">
                <option value="10" {{--@if($operativos->count() == '10') selected @endif --}} >10</option>
                <option value="50" {{--@if($operativos->count() == '10') selected @endif --}} >50</option>
                <option value="100" {{--@if($operativos->count() == '10') selected @endif --}} >100</option>
                <option value="250" {{--@if($operativos->count() == '10') selected @endif --}} >250</option>
            </select>
        </div>
        <div class="col-12 col-md-4 text-center my-2 d-flex">
            <input autocomplete="off" type="text" name="q" placeholder="Buscar..." class="form-control me-2">
            <input type="submit" value="Buscar" class="btn btn-primario text-white">
        </div>

        <div class="col-12 col-md-3 my-2">
            <a href="{{route('admin.lista.create')}}" class="btn btn-primario text-white btn-sm d-block mx-auto w-75">Inserción manual</a>
        </div>
        <div class="col-12 col-md-3 my-2">
            <a href="" class="btn btn-primario text-white btn-sm d-block mx-auto w-75">Inserción excel</a>
        </div>
    </form>
</div>

<table class="table table-green">
    <thead>
        <th>Nombre completo</th>
        <th>Correo electronico</th>
        <th>Estatus</th>
        <th>Opciones</th>
    </thead>
    <tbody>
        <tr>
            <td>Samael Gutiérrez</td>
            <td>profesorsamael@correo.com</td>
            <td>Activo</td>
            <td>
                <button>Editar</button>
                <button>Borrar</button>
            </td>
        </tr>
    </tbody>
</table>
@endsection
