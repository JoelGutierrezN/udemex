@extends('layout.app')

@section('title', 'Inicio')

@section('content')

        <h3 class="form-screen-title">Registro de información personal</h3>

        <div class="tabs">
            <button type="button" id="personal-menu" data-tab-target="1">Datos personales &blacktriangledown;</button>
            <button type="button" id="historial-menu" data-tab-target="5">Historial académico &blacktriangledown;</button>
            <button type="button" id="materias-menu" data-tab-target="2">Asignaturas impartidas &blacktriangledown;</button>
            <a href="{{ route('teacher.experienciaLaboral') }}"><button type="button" id="experiencia-menu">Experiencia laboral &blacktriangledown;</button></a>
            <button type="button" id="archivos-menu" data-tab-target="4">Capacitación &blacktriangledown;</button>
        </div>

        @if($is_registered)
         <form action="{{ route('teacher.usuarios.update', $usuario) }}" method="POST" enctype="multipart/form-data">
             @csrf
             @method('PUT')
           @else

        <form action="{{ route('teacher.usuarios.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')
        @endif
        <div class="mt-2" data-tab-id="1">
            <h3 class="tab--title">Datos personales</h3>
            @if($is_registered)
             <div class="alert alert-info">

                <h6>¡Ya tenemos tus datos!</h6>
                <p>
                    Ya cuentas con tus datos registrados, a partir de ahora solo puedes actualizarlos.
                </p>
           </div>
            @endif


            <div class="input-columns-1">
                <div>
                    <label for="text-input" class="is-required"> Número de empleado UDEMEX</label>
                    <input type="text" placeholder="Número de empleado UDEMEX"
                    autocomplete="off" id="xclave_empleado" name="clave_empleado"
                    value="{{ old('clave_empleado', $usuario->clave_empleado ?? '') }}" pattern="[0-9]+">
                </div>
                     @if($errors->first('clave_empleado'))
                    <div class="invalid-feedback">
                    <i>{{ $errors->first('clave_empleado') }}</i>
                    </div>
                    @endif

                <div>
                    <label for="text-input"> Nombre completo</label>
                    <input type="text" autocomplete="off" readonly
                     value="{{ Auth::user()->name }}  {{ Auth::user()->apellido_pat }}  {{ Auth::user()->apellido_mat }}">
                </div>


                <div>
                    <input type="text" hidden autocomplete="off" id="dato_nombre" name="nombre"
                     value="{{ Auth::user()->name }}">
                </div>

                <div>
                    <input type="text" hidden autocomplete="off" id="dato_apellido_paterno" name="apellido_paterno"
                     value="{{ Auth::user()->apellido_pat }}">
                </div>

                <div>
                    <input type="text" hidden autocomplete="off" id="dato_apellido_materno" name="apellido_materno"
                     value="{{ Auth::user()->apellido_mat }}">
                </div>
                   

                <!-- <div>
                    <label for="text-input" class="is-required"> Apellido paterno</label>
                    <input type="text" placeholder="Coloque su apellido paterno iniciando por letra mayúscula. Ejemplo: 'González'"
                     autocomplete="off" id="dato_apellido_paterno" name="apellido_paterno"
                       value="{{ old('apellido_paterno', $usuario->apellido_paterno ?? '') }}">
                </div>
                    @if($errors->first('apellido_paterno'))
                    <div class="invalid-feedback">
                    <i>{{ $errors->first('apellido_paterno') }}</i>
                    </div>
                    @endif -->

                <!-- <div>
                    <label for="text-input" class="is-required"> Apellido materno</label>
                    <input type="text" placeholder="Coloque su apellido materno iniciando por letra mayúscula. Ejemplo: 'González'"
                    autocomplete="off" id="dato_apellido_materno" name="apellido_materno"
                     value="{{ old('apellido_materno', $usuario->apellido_materno ?? '') }}">
                </div>
                    @if($errors->first('apellido_materno'))
                    <div class="invalid-feedback">
                    <i>{{ $errors->first('apellido_materno') }}</i>
                    </div>
                    @endif -->

                <div>
                    <label for="select-input" class="is-required"> Género</label>
                    <ul class="col2">
                    <label><input type="radio" id="dato_sexo_masculino" name="sexo" value="1" checked @isset ($usuario->sexo) @if($usuario->sexo == 1) checked @endif @endisset>
                        Masculino</label>&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;
                        <label><input type="radio" id="dato_sexo_femenino" name="sexo" value="0" @isset ($usuario->sexo) @if($usuario->sexo == 0)  checked @endif @endisset>
                        Femenino</label>
                    </ul>
                </div>

                <div>
                    <label for="date-input" class="is-required"> Fecha de nacimiento</label>
                    <input type="date" placeholder="Coloque su Fecha de Nacimiento"
                    autocomplete="off" id="fechaNacimiento" name="fecha_nacimiento"
                    min="1930-01-01" max="2010-12-31"
                    value="{{ old('fecha_nacimiento', $usuario->fecha_nacimiento ?? '') }}">
                </div>
                    @if($errors->first('fecha_nacimiento'))
                    <div class="invalid-feedback">
                    <i>{{ $errors->first('fecha_nacimiento') }}</i>
                    </div>
                    @endif

                    <div id="edad">
                        <div>
                            @if($is_registered)
                                <label for="date-input"> Tu edad</label>
                                @php
                                    $fecha_de_nacimiento = $usuario->fecha_nacimiento;
                                    $hoy = date("d-m-Y");
                                    $diff = date_diff(date_create($fecha_de_nacimiento), date_create($hoy));
                                @endphp
                            <input type="text" readonly style="height: 30px;"  id="edad" value="{{$diff->format('%y') }} años ">
                            @endif
                        </div>
                    </div>

                    <div id="edad"></div>

                <div>
                    <label for="text-input" class="is-required"> CURP</label>
                    <input type="text" onkeyup="mayus(this);"
                    placeholder="Coloque su CURP. (HEPA920722HMCRRL07)"
                    autocomplete="off" name="curp" maxlength="18"
                    value="{{ old('curp', $usuario->curp ?? '') }}">
                </div>
                     @if($errors->first('curp'))
                    <div class="invalid-feedback">
                    <i>{{ $errors->first('curp') }}</i>
                    </div>
                    @endif


                <div>
                    <label for="text-input" class="is-required"> Teléfono de casa</label>
                    <input type="text" placeholder="Coloque su teléfono de casa. (10 dígitos)"
                     autocomplete="off" id="dato_telefono_casa" name="telefono_casa"
                     value="{{ old('telefono_casa', $usuario->telefono_casa ?? '') }}"
                     maxlength="10"
                     onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;">
                </div>
                    @if($errors->first('telefono_casa'))
                    <div class="invalid-feedback">
                    <i>{{ $errors->first('telefono_casa') }}</i>
                    </div>
                    @endif

                <div>
                    <label for="text-input" class="is-required"> Teléfono celular</label>
                    <input type="text" placeholder="Coloque su teléfono celular. (10 dígitos)"
                    autocomplete="off" id="dato_celular" name="celular"
                    value="{{ old('celular', $usuario->celular ?? '') }}"
                    maxlength="10"
                    onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;">
                </div>
                     @if($errors->first('celular'))
                    <div class="invalid-feedback">
                    <i>{{ $errors->first('celular') }}</i>
                    </div>
                    @endif

                <div>
                    <label for="text-input"> Correo electrónico Institucional</label>
                    <input type="text"  autocomplete="off" name="email_udemex" readonly
                       value="{{ Auth::user()->email }}">
                </div>

                <div>
                    <label for="text-input" class="is-required"> Correo electrónico personal</label>
                    <input type="text" placeholder="Coloque su correo electrónico personal"
                    autocomplete="off" id="dato_email_personal" name="email_personal"
                     value="{{ old('email_personal', $usuario->email_personal ?? '') }}">
                </div>
                    @if($errors->first('email_personal'))
                    <div class="invalid-feedback">
                    <i>{{ $errors->first('email_personal') }}</i>
                    </div>
                    @endif

                    <div>
                         @if($is_registered)
                        <label for="text-input"> Fotografía</label>
                        @else
                         <label for="text-input" class="is-required"> Fotografía</label>
                        @endif

                        <p class= "text-foto">La fotografía no debe exceder los 2 Mb y solo acepta imágenes
                            con extensiones 'jpeg, png, jfif'</p><br>&nbsp;

                            @if($is_registered)
                            <div id="imagePreview">
                            <img class='fotoperfil' src="{{ asset('imagenes/perfil/' .$usuario->foto)}}" alt="" width="200px">
                        </div>
                            @else
                            <div id="imagePreview"></div>
                            @endif

                        <input type="file" placeholder="Coloque su fotografía" id="foto" name="foto"
                        accept="image/png,image/jpeg,jfif">

                    </div>
                         @if($errors->first('foto'))
                        <div class="invalid-feedback">
                        <i>{{ $errors->first('foto') }}</i>
                        </div>
                        @endif

                <div>
                    <input hidden type="text" value="{{ Auth::user()->id }}" name="id_user">
                </div>
                <div>
                    <input hidden type="text" value="{{ Auth::user()->role }}" name="id_tipo_usuario">
                </div>
            </div>

            <div>
                 @if($is_registered)
                <button  type="submit" class="btn-primario">Actualizar</button>
                <p class= "text-obligatorio">
                     <label class="is-required"> </label>
                    Los campos marcados con un asterisco son obligatorios.
                </p><br>&nbsp;
                @else
                <button  type="submit" class="btn-primario">Guardar</button>
                <p class= "text-obligatorio">
                     <label class="is-required"> </label>
                    Los campos marcados con un asterisco son obligatorios.
                </p><br>&nbsp;
                @endif
            </div>
            <br>&nbsp;
            @if($is_registered)
                    <div class="conte">
                        <div class="left">
                        </div>
                        <div class="alert-info2">
                            <p>Información actualizada a la fecha:
                                {{\Carbon\Carbon::parse($usuario->updated_at)->locale('es')->day}}
                                {{\Carbon\Carbon::parse($usuario->updated_at)->locale('es')->monthName}}
                                {{\Carbon\Carbon::parse($usuario->updated_at)->locale('es')->year}} a las
                                {{ $usuario->updated_at->format('H:i:s') }}
                            </p>
                        </div>
                    </div><br>&nbsp;
            @endif
        </div>
        </form>

    {{-- Asignaturas --}}
    @include('teacher-modules.asignaturas')
    {{--Fin Asignaturas --}}

    {{-- Perfil capacitación --}}
    @include('teacher-modules.capacitacion')
    {{-- Fin capacitación --}}

    {{-- Historial académico --}}
    @include('teacher-modules.historial-academico')
    {{-- Fin Historial académico --}}


    {{-- Modal to PDF --}}
    <div id="myModal" class="modal">
    <!-- Modal content -->
        <div class="modal-content">
            <span class="close">&times;</span>
            <p></p>
            <iframe id="archivo-view" src="" type="application/PDF" width="100%" height="95%" frameborder="0"></iframe>
        </div>
    </div>
    {{-- Modal to PDF --}}
    @endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('js/utilities/menu.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.select2-multiple').select2();
        });
    </script>

    <script type="text/javascript" src="{{ asset('js/utilities/menu.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('.select2-multiple').select2();
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

    {{-- Script para mostrar edad --}}
    <script>
        const fechaNacimiento = document.getElementById("fechaNacimiento");
        const edad = document.getElementById("edad");

        const calcularEdad = (fechaNacimiento) => {
            const fechaActual = new Date();
            const anoActual = parseInt(fechaActual.getFullYear());
            const mesActual = parseInt(fechaActual.getMonth()) + 1;
            const diaActual = parseInt(fechaActual.getDate());

            // 2016-07-11
            const anoNacimiento = parseInt(String(fechaNacimiento).substring(0, 4));
            const mesNacimiento = parseInt(String(fechaNacimiento).substring(5, 7));
            const diaNacimiento = parseInt(String(fechaNacimiento).substring(8, 10));

            let edad = anoActual - anoNacimiento;
            if (mesActual < mesNacimiento) {
                edad--;
            } else if (mesActual === mesNacimiento) {
                if (diaActual < diaNacimiento) {
                    edad--;
                }
            }
            return edad;
        };

        window.addEventListener('load', function () {
            fechaNacimiento.addEventListener('change', function () {
                if (this.value) {
                    //edad.innerText = `La edad es: ${calcularEdad(this.value)} años`;
                    edad.innerHTML = `
                    <label for="edadCalculada">Tu edad</label>
                    <input type="text" id="edadCalculada" value="${calcularEdad(this.value)} años"  disabled="disabled">
                    `
                }
            });
        });
    </script>

    <script>
    function mayus(e) {
        e.value = e.value.toUpperCase();
    }
    </script>

@endsection
