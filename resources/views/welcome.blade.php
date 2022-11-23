@extends('layout.app')

@section('title', 'Inicio')

@section('content')

        <h3 class="form-screen-title">Registro de Información Personal</h3>

        <div class="tabs">
            <button type="button" id="personal-menu" data-tab-target="1">Datos Personales &blacktriangledown;</button>
            <button type="button" id="historial-menu" data-tab-target="5">Historial académico &blacktriangledown;</button>
            <button type="button" id="materias-menu" data-tab-target="2">Asignaturas impartidas &blacktriangledown;</button>
            <button type="button" id="experiencia-menu" data-tab-target="3">Experiencia Laboral &blacktriangledown;</button>
            <button type="button" id="archivos-menu" data-tab-target="4">Capacitación &blacktriangledown;</button>
        </div>

    {{-- Datos personales --}}
    @include('teacher-modules.index')
    {{--Fin Datos personales --}}

    {{-- Asignaturas --}}
    @include('formulario-perfil.asignaturas')
    {{--Fin Asignaturas --}}

    {{-- Experiencia Laboral --}}
    @include('formulario-perfil.experiencia-laboral')
    {{--Fin Experiencia Laboral --}}

    {{-- Perfil capacitación --}}
    @include('formulario-perfil.capacitacion')
    {{-- Fin capacitación --}}

    {{-- Historial académico --}}
    @include('formulario-perfil.historial-academico')
    {{-- Fin Historial académico --}}

        <style>
            .modal {
                display: none; /* Hidden by default */
                position: fixed; /* Stay in place */
                z-index: 1; /* Sit on top */
                left: 0;
                top: 0;
                width: 100%; /* Full width */
                height: 100%; /* Full height */
                overflow: auto; /* Enable scroll if needed */
                background: rgb(0,0,0); /* Fallback color */
                background: rgba(0,0,0,0.4); /* Black w/ opacity */
            }

                 /* Modal Content/Box */
            .modal-content {
                background: #fefefe;
                margin: auto; /* 15% from the top and centered */
                padding: 20px;
                border: 1px solid #888;
                width: 80%;
                height: 90vh; /* Could be more or less, depending on screen size */
            }

                /* The Close Button */
            .close {
                color: #aaa;
                float: right;
                font-size: 28px;
                font-weight: bold;
            }

            .close:hover,
            .close:focus {
                color: black;
                text-decoration: none;
                cursor: pointer;
            }
        </style>

        <div id="myModal" class="modal">

        <!-- Modal content -->
            <div class="modal-content">
                <span class="close">&times;</span>
                <p></p>
                <object id="archivo-view" src="" type="application/PDF" width="100%" height="95%" frameborder="0"></object>
            </div>

        </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('js/utilities/menu.js') }}"></script>
    <script></script>
    <script>
        $(document).ready(function() {
            $('.select2-multiple').select2();
        });
    </script>

    <script>
     document.addEventListener('DOMContentLoaded',()=>{
        fetch("getTeacherInfo/{{ Auth::user()->id }}")
        .then(response => response.json())
        .then((response)=>{
                console.log(response)
                var dato_clave_empleado =  document.querySelector('#dato_clave_empleado')
                dato_clave_empleado.value=response.clave_empleado;
                dato_clave_empleado.setAttribute("readonly", "true");

                var dato_nombre =  document.querySelector('#dato_nombre')
                dato_nombre.value=response.nombre;
                dato_nombre.setAttribute("readonly", "true");

                var dato_apellido_paterno =  document.querySelector('#dato_apellido_paterno')
                dato_apellido_paterno.value=response.apellido_paterno;
                dato_apellido_paterno.setAttribute("readonly", "true");

                var dato_apellido_materno =  document.querySelector('#dato_apellido_materno')
                dato_apellido_materno.value=response.apellido_materno;
                dato_apellido_materno.setAttribute("readonly", "true");

                var dato_sexo_masculino =  document.querySelector('#dato_sexo_masculino')
                var dato_sexo_femenino =  document.querySelector('#dato_sexo_femenino')
                if (response.sexo == 1){
                    dato_sexo_masculino.setAttribute("checked", "true");
                }else {
                    dato_sexo_femenino.setAttribute("checked", "true");
                }


                var dato_telefono_casa =  document.querySelector('#dato_telefono_casa')
                dato_telefono_casa.value=response.telefono_casa;
                dato_telefono_casa.setAttribute("readonly", "true");

                var dato_celular =  document.querySelector('#dato_celular')
                dato_celular.value=response.celular;
                dato_celular.setAttribute("readonly", "true");

                var dato_email_udemex =  document.querySelector('#dato_email_udemex')
                dato_email_udemex.value=response.email_udemex;
                dato_email_udemex.setAttribute("readonly", "true");

                var dato_email_personal =  document.querySelector('#dato_email_personal')
                dato_email_personal.value=response.email_personal;
                dato_email_personal.setAttribute("readonly", "true");

        })/*.catch((error)=>{})*/

    });
    </script>

    @if(isset($from))

        <script>
            Swal.fire(
                '{{ $alert }}',
                'Lo puedes consultar en la seccion {{ $from }}',
                'success'
            );
        </script>
    @endif

    <script>
        (function(){
            function filePreview(input){
                if(input.files && input.files[0]){
                    var reader = new FileReader();
                    reader.onload = function(e){
                        $('#imagePreview').html("<img class='fotoperfil' src='"+e.target.result+"'/>");
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }
            $('#foto').change(function(){
                filePreview(this);
            });
        })();
    </script>

@endsection
