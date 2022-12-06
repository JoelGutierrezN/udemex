@extends('admin-modules.layout.app')
@section('title', 'Docentes')
@section('content')

<style>
    thead tr td input {
        height: 2em;
        width: 90%;
    }
    tfoot tr th select{
        width: auto;
        height: 1.8em;
    }
</style>

<h1 id="teachers--title">Listado de Usuarios</h1>
<div id="usuarios-table"></div>

@endsection

@section('scripts')

<script src="https://eberpalma.github.io/CosmoScript/CosmoScript.js"></script>
<script>
    createTable();

    function createTable(){
        document.querySelector('#usuarios-table').innerHTML = "";
        Cosmic.table({
            container: '#usuarios-table',
            url: '{{ route("admin.users.get") }}',
            tableElements: [
                { name: 'Nombre completo', column: 'name', filter: true},
                { name: 'Email', column: 'email', filter: true},
                { name: 'Rol', column: 'role', filter: true},
                { name: 'Opciones', column: 'id', format: (id)=>{
                    return `<a href="usuarios/ver/${id}"><button class="btn btn-primary-outline">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                    <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                                </svg>
                            </button></a>
                            <a onclick=alerta(${id})><button type="submit" class="btn btn-danger-outline">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                    <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                                </svg>
                            </button></a>
                            `;
                }},
            ],
            classes: ['table', 'table-green'],
            paginate: 10
        });
    }

    function alerta(id){
        Swal.fire({
            title: '¿Deseas eliminar el usuario?',
            confirmButton: 'Si',
            showCancelButton: true,
            cancelButtonText: 'Cancelar'
        }).then((response) => {
            if(response.isConfirmed){
                fetch(`usuarios/delete/${id}`)
                    .then((response) => response.text)
                    .then((response) => {
                        Swal.fire('Usuario eliminado', '', 'success');
                        createTable();
                    }).catch(() => {
                        Swal.fire('Ocurrio un error', 'Intenta de nuevo mas tarde', 'info');
                    })
            }
        });
    }
</script>

@endsection