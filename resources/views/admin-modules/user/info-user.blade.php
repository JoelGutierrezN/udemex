@extends('admin-modules.layout.app')
@section('title', 'Docentes')
@section('content')

<h1 id="teachers--title">Informacion de usuario</h1>
<hr style="margin-bottom: 15px">
<div style="width: 80%; margin: auto">
    <form action="#" id="user-form">
        <div>
            <table width="100%">
                <tr style="text-align: left">
                    <th><label for="name">Nombre(s)</label></th>
                    <th><label for="apellido_pat">Apellido paterno</label></th>
                    <th><label for="apellido_mat">Apellido materno</label></th>
                </tr>
                <tr>
                    <td><input type="text" id="user-name" name="name" value="{{ $user->name }}" readonly></td>
                    <td><input type="text"id="user-apellido_pat" name="apellido_pat" value="{{ $user->apellido_pat }}" readonly></td>
                    <td><input type="text"id="user-apellido_mat" name="apellido_mat" value="{{ $user->apellido_mat }}" readonly></td>
                </tr>
                <tr>
                    <th colspan=2><label for="email">Email</label></th>
                    <th><label for="role">Rol</label></th>
                </tr>
                <tr>
                    <td colspan=2><input type="text"id="user-email" name="email" value="{{ $user->email }}" readonly></td>
                    <td><select name="role" id="user-role" readonly>
                        @foreach($tipo_user as $tipo)
                            @if($tipo->id_tipo_usuario == $user->role)
                                <option value="{{ $tipo->id_tipo_usuario }}" selected>{{ $tipo->nombre }}</option>
                            @else
                                <option value="{{ $tipo->id_tipo_usuario }}">{{ $tipo->nombre }}</option>
                            @endif
                        @endforeach
                    </select></td>
                </tr>
            </table>  
        </div>
    </form>

    <div style="width: 30%; margin: auto">
        <table style="width: 100%">
            <tr>
                <td>
                    <button class="btn btn-danger-outline" onclick=actualizarUser() id="guardar-button" style="width: 100%; display: none;">Guardar</button>
                    <button class="btn btn-danger-outline" onclick=editarUser() id="editar-button" style="width: 100%">Editar</button>
                </td>
                <td>
                    <button class="btn btn-danger-outline" onclick=cancelarEditar() id="cancelar-button" style="width: 100%; display: none;">Cancelar</button>
                    <button class="btn btn-danger-outline" onclick=eliminarUser("{{$user->id}}") id="eliminar-button"  style="width: 100%">
                        @if($user->active == 1) 
                            Eliminar
                        @else
                            Restaurar
                        @endif
                    </button>
                </td>
            </tr>
        </table>
    </div>
</div>

@endsection

@section('scripts')

<script>
    function editarUser(){
        document.querySelector('#user-name').removeAttribute('readonly');
        document.querySelector('#user-apellido_pat').removeAttribute('readonly');
        document.querySelector('#user-apellido_mat').removeAttribute('readonly');
        document.querySelector('#user-email').removeAttribute('readonly');
        document.querySelector('#user-role').removeAttribute('readonly');

        document.querySelector('#editar-button').setAttribute('style', 'display: none;');
        document.querySelector('#guardar-button').setAttribute('style', 'display: block; width: 100%');

        document.querySelector('#eliminar-button').setAttribute('style', 'display: none;');
        document.querySelector('#cancelar-button').setAttribute('style', 'display: block; width: 100%');
    }

    function cancelarEditar(){
        document.querySelector('#user-name').setAttribute('readonly', 'readonly');
        document.querySelector('#user-apellido_pat').setAttribute('readonly', 'readonly');
        document.querySelector('#user-apellido_mat').setAttribute('readonly', 'readonly');
        document.querySelector('#user-email').setAttribute('readonly', 'readonly');
        document.querySelector('#user-role').setAttribute('readonly', 'readonly');

        document.querySelector('#guardar-button').setAttribute('style', 'display: none;');
        document.querySelector('#editar-button').setAttribute('style', 'display: block; width: 100%');

        document.querySelector('#cancelar-button').setAttribute('style', 'display: none;');
        document.querySelector('#eliminar-button').setAttribute('style', 'display: block; width: 100%');
    }

    function eliminarUser(id){
        Swal.fire({
            title: '¿Deseas eliminar el usuario?',
            showCancelButton: true,
            cancelButtonText: 'Cancelar'
        }).then((response) => {
            if(response.isConfirmed){
                fetch(`../../usuarios/delete/${id}`)
                    .then((response) => response.text())
                    .then((response) => {
                        console.log(response)
                        if(response == 'eliminado'){
                            Swal.fire('Usuario eliminado', '', 'success');
                            document.querySelector('#eliminar-button').innerHTML = "Restaurar";
                        }else{
                            Swal.fire('Usuario restaurado', '', 'success');
                            document.querySelector('#eliminar-button').innerHTML = "Eliminar";
                        } 
                    }).catch(() => {
                        Swal.fire('Ocurrio un error', 'Intenta de nuevo mas tarde', 'info');
                    })
            }
        });
    }

    function actualizarUser(){
        let form = new FormData(document.querySelector('#user-form'));

        fetch('../../usuarios/update/{{ $user->id }}',{
            method: 'post',
            headers: new Headers({
                'X-CSRF-Token': '{{ csrf_token() }}'
            }),
            body: form
        })
            .then((response) => response.text())
            .then((response) => {
                if(response == 'actualizado'){
                    Swal.fire('Usuario actualiado', '', 'success');
                    cancelarEditar();
                }else{
                    console.log(response)
                }
            }).catch(()=>{
                Swal.fire('Ocurrio un error', 'Intenta de nuevo mas tarde', 'info');
            });
    }
</script>

@endsection