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
                    <label for="text-input">Número de empleado UDEMEX</label>
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
                    <label for="text-input">Nombre(s)</label>
                    <input type="text" placeholder="Coloque su nombre(s) iniciando por letra mayúscula. Ejemplo: 'Luis'"
                    autocomplete="off" id="dato_nombre" name="nombre"  
                     value="{{ old('nombre', $usuario->nombre ?? '') }}">
                </div>
                    @if($errors->first('nombre'))
                    <div class="invalid-feedback">
                    <i>{{ $errors->first('nombre') }}</i>
                    </div>
                    @endif

                <div>
                    <label for="text-input">Apellido paterno</label>
                    <input type="text" placeholder="Coloque apellido paterno iniciando por letra mayúscula. Ejemplo: 'González'"
                     autocomplete="off" id="dato_apellido_paterno" name="apellido_paterno"
                       value="{{ old('apellido_paterno', $usuario->apellido_paterno ?? '') }}">
                </div>
                    @if($errors->first('apellido_paterno'))
                    <div class="invalid-feedback">
                    <i>{{ $errors->first('apellido_paterno') }}</i>
                    </div>
                    @endif

                <div>
                    <label for="text-input">Apellido materno</label>
                    <input type="text" placeholder="Coloque apellido materno iniciando por letra mayúscula. Ejemplo: 'González'"
                    autocomplete="off" id="dato_apellido_materno" name="apellido_materno"
                     value="{{ old('apellido_materno', $usuario->apellido_materno ?? '') }}">
                </div>
                    @if($errors->first('apellido_materno'))
                    <div class="invalid-feedback">
                    <i>{{ $errors->first('apellido_materno') }}</i>
                    </div>
                    @endif

                <div>
                    <label for="select-input">Género</label>
                    <ul class="col2">
                    <label><input type="radio" id="dato_sexo_masculino" name="sexo" value="1" checked @isset ($usuario->sexo) @if($usuario->sexo == 1) checked @endif @endisset>
                        Masculino</label>&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;
                        <label><input type="radio" id="dato_sexo_femenino" name="sexo" value="0" @isset ($usuario->sexo) @if($usuario->sexo == 0)  checked @endif @endisset>
                        Femenino</label>
                    </ul>
                </div>

                <div>
                    <label for="text-input">Teléfono de casa</label>
                    <input type="text" placeholder="Coloque su teléfono de casa. (10 dígitos)"
                    autocomplete="off" id="dato_telefono_casa" name="telefono_casa"
                     value="{{ old('telefono_casa', $usuario->telefono_casa ?? '') }}"
                     maxlength="10"
                     onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;">
                </div>
                    @if($errors->first('telefono_casa'))
                    <div class="invalid-feedback">
                    <i>{{ $errors->first('telefono_casa') }}</i>
                    </div>
                    @endif

                <div>
                    <label for="text-input">Teléfono celular</label>
                    <input type="text" placeholder="Coloque su teléfono celular. (10 dígitos)"
                    autocomplete="off" id="dato_celular" name="celular" 
                    value="{{ old('celular', $usuario->celular ?? '') }}"
                    maxlength="10"
                    onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" pattern="[0-9]{10}">
                </div>
                     @if($errors->first('celular'))
                    <div class="invalid-feedback">
                    <i>{{ $errors->first('celular') }}</i>
                    </div>
                    @endif

                <div>
                    <label for="text-input">Correo electrónico Institucional</label>
                    <input type="text" name="email_udemex" placeholder="Coloque su correo electrónico Institucional"
                    autocomplete="off" id="dato_email_udemex" name="email_udemex"  
                       value="{{ old('email_udemex', $usuario->email_udemex ?? '') }}">
                </div>
                    @if($errors->first('email_udemex'))
                    <div class="invalid-feedback">
                    <i>{{ $errors->first('email_udemex') }}</i>
                    </div>
                    @endif

                <div>
                    <label for="text-input">Correo electrónico personal</label>
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
                        
                        <label for="text-input">Fotografía</label>
                        <p class= "text-foto">La fotografía no debe exceder los 2 Mb y solo acepta imágenes  
                            con extensiones 'jpeg, png, jfif'</p><br>&nbsp;
                            
                            @if($is_registered)
                            <div id="imagePreview">
                            <img class='fotoperfil' src="{{ asset('imagenes/perfil/' . $usuario->foto) }}" alt="" width="200px">
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
            </div>

            <div>
                 @if($is_registered)
                <button  type="submit" class="btn-primario">Actualizar</button>
                @else
                <button  type="submit" class="btn-primario">Guardar Cambios</button>
                @endif
            </div>
            <br>&nbsp;
            @if($is_registered)
                    <div class="conte">
                        <div class="left">
                        </div>
                        <div class="alert-info2">
                            <p>Información actualizada a la fecha: {{ $usuario->updated_at }}</p>
                        </div>
                    </div><br>&nbsp;
                @endif
        </div>
        </form>
    {{--Fin Datos personales --}}

        @include('formulario-perfil.asignaturas')

        {{-- Experiencia Laboral --}}
        <form action="{{ route('teacher.infoacademica.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div class="mt-2" data-tab-id="3">
            <h3 class="tab--title">Datos de Experiencia Laboral</h3>
                <div class="input-columns-1">

                    <div>
                        <label for="text-input">Años de experiencia en modalidad presencial.</label>
                        <input class="acortado" type="number" autocomplete="off" value=0 id="datos_experiencia_presencial" name="experiencia_presencial">
                    </div>
                    @if($errors->first('experiencia_presencial'))
                    <div class="invalid-feedback">
                    <i>{{ $errors->first('experiencia_presencial') }}</i>
                    </div>
                    @endif

                    <div>
                        <label for="text-input">Años de experiencia en modalidad línea</label>
                        <input class="acortado" type="number" autocomplete="off" value=0 id="datos_experiencia_linea" name="experiencia_linea">
                    </div>
                    @if($errors->first('experiencia_linea'))
                    <div class="invalid-feedback">
                    <i>{{ $errors->first('experiencia_linea') }}</i>
                    </div>
                    @endif

                    <div>
                        <label >Seleccione el nivel más alto de experiencia docente</label>
                        <select  style="margin-top:10px" name="nivel_mayor_experiencia">
                            <option value="preparatoria">Preparatoria</option>
                            <option value="licenciatura">Licenciatura</option>
                            <option value="maestria">Maestría</option>
                            <option value="doctorado">Doctorado</option>
                          </select>
                    </div>

                    <div>
                        <label>Áreas de experiencia Laboral</label>
                        <select style="margin-top:10px" class="select2-multiple" name="area_experiencia[]" multiple="multiple">
                            <option value="Industrial">Industrial</option>
                            <option value="Salud">Salud</option>
                          </select>
                    </div>
                    @if($errors->first('area_experiencia'))
                    <div class="invalid-feedback">
                    <i>{{ $errors->first('area_experiencia') }}</i>
                    </div>
                    @endif

                    <div>
                        <label >Seleccione las herramientas tecnológicas que sabe utilizar
                        </label>
                        <select  style="margin-top:10px" class="select2-multiple" name="herramientas[]" multiple="multiple">
                            <option value="Office">Office</option>
                            <option value="Adobe">Adobe</option>
                          </select>
                    </div>
                    @if($errors->first('herramientas'))
                    <div class="invalid-feedback">
                    <i>{{ $errors->first('herramientas') }}</i>
                    </div>
                    @endif

                <div>
                    <label for="select-input-2">Disponibilidad para ser asesor en la UDEMEX</label>
                    <ul class="col2">
                        <li><input type="radio" id="l-otrolugar" name="disponibilidad_asesor" value="100%" checked>
                            <label for=""> %100</label>&#160;&#160;&#160;&#160;&#160;&#160;&#160;<input type="radio" id="l-otrolugar" name="disponibilidad_asesor" value="75%">
                            <label for=""> %75</label>&#160;&#160;&#160;&#160;&#160;&#160;&#160;<input type="radio" id="l-otrolugar" name="disponibilidad_asesor" value="50%">
                            <label for=""> %50</label>&#160;&#160;&#160;&#160;&#160;&#160;&#160;<input type="radio" id="l-otrolugar" name="disponibilidad_asesor" value="25%">
                            <label for=""> %25</label></li>
                        <li>
                    </ul>
                </div>
                @if($errors->first('disponibilidad_asesor'))
                    <div class="invalid-feedback">
                    <i>{{ $errors->first('disponibilidad_asesor') }}</i>
                    </div>
                    @endif

                <div>
                    <label for="select-input-2">¿Trabaja en otro lugar actualmente?</label>
                    <ul class="col2">
                        <li>
                            <input type="radio" id="l-otrolugar" name="labora_actualmente" value="si" checked>
                            <label for=""> Si</label>&#160;&#160;&#160;&#160;
                            <input type="radio" id="l-otrolugar" name="labora_actualmente" value="no">
                            <label for=""> No</label></li>
                        <li>
                    </ul>
                </div>

                <div>
                    <label for="text-input">Lugar donde labora</label>
                    <input type="text" autocomplete="off" placeholder="Coloque el nombre del lugar en donde labora" id="datos_lugar_labora" name="lugar_labora">
                </div>

                <div>
                    <label >Seleccione la modalidad en la que labora</label>
                    <select  style="margin-top:10px" name="modalidad">
                        <option value="presencial">Presencial</option>
                        <option value="linea">Línea</option>
                      </select>
                </div>

                <div style="margin-top:10px">
                    <label for="select-input-2">¿Cuál es el horario laboral en su otro trabajo?</label>
                    <ul class="col2">
                    <li><label for="">Inicio:&#160;&#160;&#160;</label><input type="time" min="6:00:00" max="24:00:00" name="horario_laboral"></li>
                    <li><label for="">Cierre:&#160;&#160;&#160;</label><input type="time" min="6:00:00" max="24:00:00" name="horario_laboral"></li> </ul>
                </div>
                @if($errors->first('horario_laboral'))
                    <div class="invalid-feedback">
                    <i>{{ $errors->first('horario_laboral') }}</i>
                    </div>
                    @endif

                <div>
                    <label for="select-input-2">¿Cuáles son los días laborales en su otro trabajo? </label>
                    <ul class="col8">
                        <li><input type="checkbox" id="l-otrolugar" name="dias_laboral" value="lunes"><label > Lun.</label></li>
                        <li><input type="checkbox" id="dias_laboral" name="dias_laboral" value="martes"><label > Mar.</label></li>
                        <li><input type="checkbox" id="dias_laboral" name="dias_laboral" value="miercoles"><label > Mierc.</label></li>
                        <li><input type="checkbox" id="dias_laboral" name="dias_laboral" value="jueves"><label > Juev.</label></li>
                        <li><input type="checkbox" id="dias_laboral" name="dias_laboral" value="viernes"><label > Vier.</label></li>
                        <li><input type="checkbox" id="dias_laboral" name="dias_laboral" value="sabado"><label > Sáb.</label></li>
                        <li><input type="checkbox" id="dias_laboral" name="dias_laboral" value="domingo"><label > Dom.</label></li>
                        
                        
                        
                    </ul>
                </div>
                @if($errors->first('dias_laboral'))
                    <div class="invalid-feedback">
                    <i>{{ $errors->first('dias_laboral') }}</i>
                    </div>
                    @endif

                <div>
                    <label for="text-input">Adjuntar archivo en pdf de su CV con ortografía actualizado al día de hoy:</label>
                    <input type="file" accept="application/pdf" placeholder="Coloque su fotografia" id="curriculum_pdf" name="curriculum_pdf">
                </div>
                @if($errors->first('curriculum_pdf'))
                    <div class="invalid-feedback">
                    <i>{{ $errors->first('curriculum_pdf') }}</i>
                    </div>
                    @endif

                <div>
                    <button type="submit" class="btn-primario">Guardar</button>
                </div><br><div>&#160;</div>
            </div>
        </div>
        </form>
        {{--Fin Experiencia Laboral --}}

        @include('formulario-perfil.capacitacion')

        @include('formulario-perfil.historial-academico')

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
