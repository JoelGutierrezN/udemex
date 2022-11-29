@extends('admin-modules.layout.app')
@section('title', 'Docentes')
@section('content')

    <h1 id="teachers--title">Listado de docentes</h1>

    <table class="table table-green">
        <thead>
            <th>Fotografía</th>
            <th>Clave de Empleado</th>
            <th>Nombre Completo</th>
            <th>Estado</th>
            <th>Proceso de Registro</th>
            <th>Opciones</th>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>
                        @isset($user->usuario->foto)
                        <img class='profile-image' src="{{ asset('imagenes/perfil/' . $user->usuario->foto) }}" alt="foto">
                        @endisset
                    </td>
                    <td>{{ $user->usuario->clave_empleado }}</td>
                    <td>{{ $user->usuario->get_fullname }}</td>
                    <td>{{ $user->usuario->get_active_status }}</td>
                    <td>Estado</td>
                    <td>
                        <form action="{{ route('admin.teachers.edit', $user->usuario ) }}" method="POST">
                            @csrf
                            @method('GET')
                            <button class="btn btn-primary-outline">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                    <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                                </svg>
                            </button>
                        </form>

                        <form action="{{ route('admin.teachers.destroy', $user->usuario) }}" method="POST" class="formulario-eliminar">
                            @csrf
                            @method('DELETE')
                        <button type="submit" class="btn btn-danger-outline">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                            </svg>
                        </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection


@section('scripts')
  <script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  </script>

  <script>
    $('.formulario-eliminar').submit(function(e){
        e.preventDefault();
        Swal.fire({
        title: 'Eliminar docente',
        text: "¿Está seguro que desea eliminar al docente seleccionado?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#549950',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar'
        }).then((result) => {
        if (result.isConfirmed) {
            // Swal.fire(
            // 'Eliminado!',
            // 'El docente ha sido eliminado correctamente.',
            // 'success'
            // )
            this.submit();
        }
        });
    });

 </script>
@endsection
