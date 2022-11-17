@extends('layout.app')

@section('title', 'Inicio')

@section('content')

        <h3 class="form-screen-title">Registro de Información Personal</h3>

        <div class="tabs">
            <button type="button" id="personal-menu" data-tab-target="1">Datos Personales &blacktriangledown;</button>
            <button type="button" id="materias-menu" data-tab-target="2">Materias impartidas &blacktriangledown;</button>
            <button type="button" id="experiencia-menu" data-tab-target="3">Experiencia Laboral &blacktriangledown;</button>
            <button type="button" id="archivos-menu" data-tab-target="4">Cursos &blacktriangledown;</button>
            <button type="button" id="historial-menu" data-tab-target="5">Historial académico &blacktriangledown;</button>
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
                    <label for="text-input">Correo electrónico de UDEMEX</label>
                    <input type="text" name="email_udemex" placeholder="Coloque su correo electrónico de UDEMEX"
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
                        <medium class="">La fotografía no debe exceder los 2 Megabyte y solo acepta imágenes  
                        con extensiones 'jpeg, png, jfif'</medium>

                        <input type="file" placeholder="Coloque su fotografía" id="foto" name="foto" 
                        accept="image/png,image/jpeg,jfif">
                        
                        <div id="imagePreview"></div>
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
                <button  type="submit" class="btn-primario">Guardar Cambios</button>
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

        {{--Datos de materias impartidas --}}
        <div class="mt-2" data-tab-id="2">
            <h3 class="tab--title">Materias impartidas</h3>
            <div class="">
                <div>
                    <label for="text-input"> Coloque las materias impartidas</label>
                    <ul class="col6">
                        <form id="materias-form" action="" method="post" enctype="multipart/form-data">
                        @csrf
                        <li class="formlabel">Nombre</li>
                        <li class="formlabel">Institución</li>
                        <li class="formlabel">Inicio</li>
                        <li class="formlabel">Fin</li>
                        <li class="formlabel">Nivel Escolar</li>
                        <li style="color:white">Agregar</li>
                        <li><input id="materia-nombre" name="nombre" autocomplete="off" type="text" placeholder="Nombre de la materia"></li>
                        <li><input id="materia-institucion" name="institucion" autocomplete="off" type="text" placeholder="Nombre de la institución"></li>
                        <li><input id="materia-inicio" name="inicio" type="date" placeholder="Inicio de la materia impartida"></li>
                        <li><input id="materia-fin" name="fin" type="date" placeholder="Fin de la materia impartida"></li>
                        <li><select id="materia-nivel" style="margin-top:10px" class="" name="tipo" >
                            <option value="#">Preparatoria</option>
                            <option value="#">Licenciatura</option>
                            <option value="#">Maestría</option>
                            <option value="#">Doctorado</option>
                          </select></li>
                          <li><a href="#" id="agregar-materias" type="submit" class="btnplus"><img class="icon" src="https://cdn-icons-png.flaticon.com/512/189/189689.png" height ="40" width="40" /></a></li>
                        </form>
                    </ul>

                    <table id="table-materias" style="font-size: 1.3rem;">
                        <thead>
                            <tr>
                            <th>Nombre</th>
                            <th>Institución</th>
                            <th>Inicio</th>
                            <th>Fin</th>
                            <th>Nivel Escolar</th>
                            <th>Operaciones</th>
                            </tr>
                        </thead>

                        <tbody id="materias-table">

                        </tbody>
                        
                    </table>
                    
                </div>
            </div>
        </div>
        {{--Fin Datos de materias impartidas --}}

        {{-- Experiencia Laboral --}}
        <form action="{{ route('teacher.infoacademica.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div class="mt-2" data-tab-id="3">
            <h3 class="tab--title">Datos de Experiencia Laboral</h3>
                <div class="input-columns-1">

                    <div>
                        <label for="text-input">Años de experiencia en modo presencial</label>
                        <input type="text" placeholder="Coloque sus años de experiencia en modo en línea" id="datos_experiencia_presencial" name="experiencia_presencial">
                    </div>
                    @if($errors->first('experiencia_presencial'))
                    <div class="invalid-feedback">
                    <i>{{ $errors->first('experiencia_presencial') }}</i>
                    </div>
                    @endif

                    <div>
                        <label for="text-input">Años de experiencia en modo en línea</label>
                        <input type="text" placeholder="Coloque sus años de experiencia en modo presencial" id="datos_experiencia_linea" name="experiencia_linea">
                    </div>
                    @if($errors->first('experiencia_linea'))
                    <div class="invalid-feedback">
                    <i>{{ $errors->first('experiencia_linea') }}</i>
                    </div>
                    @endif

                    <div>
                        <label >Seleccione el nivel más alto de experiencia</label>
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
                        <li><input type="radio" id="l-otrolugar" name="disponibilidad_asesor" value="100%">
                            <label for=""> %100</label>&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;<input type="radio" id="l-otrolugar" name="disponibilidad_asesor" value="75%">
                            <label for=""> %75</label>&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;<input type="radio" id="l-otrolugar" name="disponibilidad_asesor" value="50%">
                            <label for=""> %50</label>&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;<input type="radio" id="l-otrolugar" name="disponibilidad_asesor" value="25%">
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
                    <input type="text" placeholder="Coloque el nombre del lugar en donde labora" id="datos_lugar_labora" name="lugar_labora">
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
                    <li><label for="">Inicio:&#160;&#160;&#160;</label><input type="time" min="6:00:00" max="24:00:00" name="horario_laboral">&#160;&#160;&#160;&#160;&#160;&#160;&#160;<label for="">Cierre:&#160;&#160;&#160;</label><input type="time" min="6:00:00" max="24:00:00" name="horario_laboral"></li> </ul>
                </div>
                @if($errors->first('horario_laboral'))
                    <div class="invalid-feedback">
                    <i>{{ $errors->first('horario_laboral') }}</i>
                    </div>
                    @endif

                <div>
                    <label for="select-input-2">¿Cuáles son los dias laborales en su otro trabajo? </label>
                    <ul class="col2"><input type="checkbox" id="l-otrolugar" name="dias_laboral" value="lunes">
                        <label > Lun.</label>&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;<input type="checkbox" id="dias_laboral" name="dias_laboral" value="martes">
                        <label > Mar.</label>&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;<input type="checkbox" id="dias_laboral" name="dias_laboral" value="miercoles">
                        <label > Mierc.</label>&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;<input type="checkbox" id="dias_laboral" name="dias_laboral" value="jueves">
                        <label > Juev.</label>&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;<input type="checkbox" id="dias_laboral" name="dias_laboral" value="viernes">
                        <label > Vier.</label>&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;<input type="checkbox" id="dias_laboral" name="dias_laboral" value="sabado">
                        <label > Sáb.</label>&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;<input type="checkbox" id="dias_laboral" name="dias_laboral" value="domingo">
                        <label > Dom.</label>
                    </ul>
                </div>
                @if($errors->first('dias_laboral'))
                    <div class="invalid-feedback">
                    <i>{{ $errors->first('dias_laboral') }}</i>
                    </div>
                    @endif

                <div>
                    <label for="text-input">Adjuntar archivo en pdf de su CV con ortografía actualizado al día de hoy:</label>
                    <small>El nombre del archivo debe de ser su nombre completo empezando
                        por nombre. Ejemplo: CV_NayeliSalazarGomez</small>
                    <input type="file" placeholder="Coloque su fotografia" id="curriculum_pdf" name="curriculum_pdf">
                </div>
                @if($errors->first('curriculum_pdf'))
                    <div class="invalid-feedback">
                    <i>{{ $errors->first('curriculum_pdf') }}</i>
                    </div>
                    @endif

                <div>
                    <button type="submit" class="btn-primario">Guardar Cambios</button>
                </div><br><div>&#160;</div>
            </div>
        </div>
        </form>
        {{--Fin Experiencia Laboral --}}

        {{-- Subida de Documentos --}}
        <div class="mt-2" data-tab-id="4">
            <h3 class="tab--title">Capacitaciones</h3>
            <div class="">
                <div>
                    <label for="text-input"> Capacitación, anexar constancias con registro de datos:</label>
                    <ul class="col8">
                        <form id="archivos-form" action="{{ route('teacher.updateFiles') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <li class="formlabel">Nombre</li>
                            <li class="formlabel">Institución</li>
                            <li class="formlabel">Inicio</li>
                            <li class="formlabel">Fin</li>
                            <li class="formlabel">Horas</li>
                            <li class="formlabel">Tipo</li>
                            <li class="formlabel">Evidencia</li>
                            <li style="color:white">Agregar</li>
                            <li><input name="nombre" type="text" placeholder="Nombre de capacitacion" id="text-input"></li>
                            <li><input name="instituto" type="text" placeholder="Institución donde se tomo la capacitacion" id="text-input"></li>
                            <li><input name="inicio" type="date" placeholder="Inicio de capacitacion" id="text-input"></li>
                            <li><input name="fin" type="date" placeholder="Inicio de capacitacion" id="text-input"></li>
                            <li><input name="horas" type="text" placeholder="Total de horas" id="text-input"></li>
                            <li><select style="margin-top:10px" class="" name="tipo" >
                                <option value="diplomado">Diplomado</option>
                                <option value="certificado">Certificado</option>
                            </select></li>
                            <li><input type="file" name="evidencia" placeholder="Coloque su evidencia" id="text-input"></li>
                            <li><a id="agregar-capacitacion" type="submit" class="btnplus"><img class="icon" src="https://cdn-icons-png.flaticon.com/512/189/189689.png" height ="40" width="40" /></a></li>
                        </form>
                    </ul>

                    <table id="table-capacitaciones" style="font-size: 1.3rem;">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Institución</th>
                                <th>Inicio</th>
                                <th>Fin</th>
                                <th>Horas</th>
                                <th>Tipo</th>
                                <th>Archivo</th>
                                <th>Operaciones</th>
                            </tr>
                        </thead>
                        <tbody id="capacitaciones-table-body"></tbody>
                      </table>


                    <script>
                        document.querySelector('#agregar-capacitacion').addEventListener('click', (e)=>{
                            e.preventDefault();
                            document.querySelector('#archivos-form').submit();
                        });

                    </script>

                </div><br>


            </div>
        </div>
        {{--Fin Subida de Documentos --}}

        {{-- Inicio historial academico --}}
        <div class="mt-2" data-tab-id="5">
            <h3 class="tab--title">Historial Académico</h3>

            <div class="">
                <div>
                    <label for="text-input">Coloque su historial académico</label>
                        <form action="{{ route('teacher.storeHistorial') }}" method="post" enctype="multipart/form-data" id="historialAcademico-form">
                            @csrf
                            <ul class="col5">
                            <li class="formlabel">Nombre</li>
                            <li class="formlabel">Institución</li>
                            <li class="formlabel">Inicio</li>
                            <li class="formlabel">Fin</li>
                            <li class="formlabel">Nivel Escolar</li>

                            <li><input name="nombre" type="text" autocomplete="off" placeholder="Nombre de capacitación" id="text-input"></li>
                            <li><input name="institucion" type="text" autocomplete="off" placeholder="Institución de capacitación" id="text-input"></li>
                            <li><input name="inicio" type="date" placeholder="Inicio de capacitación" id="text-input"></li>
                            <li><input name="fin" type="date" placeholder="Fin de capacitación" id="text-input"></li>
                            <li>
                                <select style="margin-top:10px" class="" name="nivel$" >
                                    <option value="Licenciatura">Licenciatura</option>
                                    <option value="Maestría">Maestría</option>
                                    <option value="Doctorado">Doctorado</option>
                                </select>
                            </li>
                           </ul>

                            <ul class="col5">
                                <li class="formlabel">Tipo de documento</li>
                                <li class="formlabel">Título</li>
                                <li class="formlabel">Certificado</li>
                                <li class="formlabel">Cédula</li>
                                <li>&#160;</li>

                                <li></li>
                                <li><input id="historial-titulo" type="file" name="titulo" placeholder="titulo" class="formlabel"></li>
                                <li><input id="historial-certificado" type="file" name="certificado" placeholder="certificado" class="formlabel"></li>
                                <li><input id="historial-cedula" type="file" name="cedula" placeholder="cedula" class="formlabel"></li>
                                <li><button type="submit" class="btnplus"><img class="icon" src="https://cdn-icons-png.flaticon.com/512/189/189689.png" height ="40" width="40" /></button></li>
                            </ul>
                        </form>
                        <table id="table-historial-academico" style="font-size: 1.3rem;">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Institutoción</th>
                                    <th>Inicio</th>
                                    <th>Fin</th>
                                    <th>Nivel Escolar</th>
                                    <th>Archivos</th>
                                    <th>Operaciones</th>
                                </tr>
                            </thead>
                            <tbody id="historial-table">

                            </tbody>
                        </table>

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
                            margin: 15% auto; /* 15% from the top and centered */
                            padding: 20px;
                            border: 1px solid #888;
                            width: 80%; /* Could be more or less, depending on screen size */
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
                            <p>Some text in the Modal..</p>
                            <iframe id="archivo-view" src="" frameborder="0"></iframe>
                        </div>

                    </div>

                    <script>
                        var historialMenu = document.querySelector('#historial-menu');
                        historialMenu.addEventListener('click', (e)=>{
                            fetch("getHistorial/{{ Auth::user()->id }}")
                                .then((response) => response.json())
                                .then((response) => {
                                    
                                    // Get the modal
                                    var modal = document.getElementById("myModal");
                                    // Get the <span> element that closes the modal
                                    var span = document.getElementsByClassName("close")[0];

                                    let iframe = document.querySelector('#archivo-view');

                                    let table = document.querySelector('#historial-table');
                                    table.innerHTML = '';
                                    response.forEach((element) => {
                                        let tr = document.createElement('tr');
                                        let nombre = document.createElement('td');
                                        let institucion = document.createElement('td');
                                        let inicio = document.createElement('td');
                                        let fin = document.createElement('td');
                                        let nivel = document.createElement('td');
                                        let archivos = document.createElement('td');
                                        let opciones = document.createElement('td');
                                        let deleteButton = document.createElement('a');

                                        let documentosTable = document.createElement('table');
                                        let titulo = document.createElement('tr');
                                        let certificado = document.createElement('tr');
                                        let cedula = document.createElement('tr');

                                        opciones.setAttribute('style', 'text-align: center;');
                                        titulo.setAttribute('style', 'cursor: pointer;');
                                        certificado.setAttribute('style', 'cursor: pointer;');
                                        cedula.setAttribute('style', 'cursor: pointer;');

                                        nombre.innerHTML = element.nombre_asignatura;
                                        institucion.innerHTML = element.nombre_institucion;
                                        inicio.innerHTML = element.fecha_inicio;
                                        fin.innerHTML = element.fecha_fin;
                                        nivel.innerHTML = element.nivel_escolar;
                                        titulo.innerHTML = `<span><img src="https://cdn-icons-png.flaticon.com/512/337/337946.png" class="icon" alt="" height ="20" width="20">Ver titulo</span>`;
                                        certificado.innerHTML = `<span><img src="https://cdn-icons-png.flaticon.com/512/337/337946.png" class="icon" alt="" height ="20" width="20">Ver cerfiticado</span>`;
                                        cedula.innerHTML = `<span><img src="https://cdn-icons-png.flaticon.com/512/337/337946.png" class="icon" alt="" height ="20" width="20">Ver cedula</span>`;
                
                                        deleteButton.innerHTML = `<img class="icon" src="https://cdn-icons-png.flaticon.com/512/8568/8568248.png" alt="" height ="40" width="40">`;

                                        tr.appendChild(nombre);
                                        tr.appendChild(institucion);
                                        tr.appendChild(inicio);
                                        tr.appendChild(fin);
                                        tr.appendChild(nivel);
                                        archivos.appendChild(titulo);
                                        archivos.appendChild(certificado);
                                        archivos.appendChild(cedula);
                                        tr.appendChild(archivos);
                                        opciones.appendChild(deleteButton)
                                        tr.appendChild(opciones);
                                        table.appendChild(tr);

                                        // When the user clicks on <span> (x), close the modal
                                        span.onclick = function() {
                                            modal.style.display = "none";
                                        }

                                        // When the user clicks anywhere outside of the modal, close it
                                        window.onclick = function(event) {
                                            if (event.target == modal) {
                                                modal.style.display = "none";
                                            }
                                        } 

                                        titulo.addEventListener('click',(e)=>{
                                            let archivo = `storage/app/Historial/${element.titulo}`;
                                            iframe.setAttribute('src', '{{ asset("") }}'+archivo);
                                            modal.style.display = "block";
                                        });
                                        certificado.addEventListener('click',(e)=>{
                                            console.log('a')
                                            modal.style.display = "block";
                                        });
                                        cedula.addEventListener('click',(e)=>{
                                            console.log('a')
                                            modal.style.display = "block";
                                        });

                                        deleteButton.addEventListener('click', (e)=>{
                                            Swal.fire({
                                                title: '¿Deseas eliminar el archivo?',
                                                confirmButton: 'Si',
                                                showCancelButton: true,
                                                cancelButtonText: 'Cancelar'
                                            }).then((response)=>{
                                                if(response.isConfirmed){
                                                    fetch(`delete-historial/${ element.id_asignatura }`)
                                                        .then((response) => response.json())
                                                        .then((response) => {
                                                            Swal.fire(response[0].alert, '', 'success');
                                                            table.removeChild(tr);
                                                        }).catch((error)=>{
                                                            Swal.fire('Lo sentimos, ocurrio un error', 'Intenta de nuevo mas tarde', 'error');
                                                        });
                                                }
                                            });
                                        });
                                    });
                                });
                        });    
                    </script>
                </div>
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

    <!-- Tabla de materias -->
    <script>
        var materiasMenu = document.querySelector('#materias-menu');

        function createTable(){
            fetch('getMaterias/{{ Auth::user()->id }}')
                .then(response => response.json())
                .then(response => {
                    let table = document.querySelector('#materias-table');

                    table.innerHTML = '';

                    response.forEach((element)=>{
                        let tr = document.createElement('tr');
                        let nombre = document.createElement('td');
                        let institucion = document.createElement('td');
                        let Inicio = document.createElement('td');
                        let fin = document.createElement('td');
                        let nivel = document.createElement('td');
                        let operaciones = document.createElement('td');
                        let deleteButton = document.createElement('a');

                        operaciones.setAttribute('style', 'text-align: center;');

                        nombre.innerHTML = `${ element.nombre_asignatura }`;
                        institucion.innerHTML = `${ element.nombre_institucion }`;
                        Inicio.innerHTML = `${ element.fecha_inicio }`;
                        fin.innerHTML = `${ element.fecha_fin }`;
                        nivel.innerHTML = `${ element.nivel_escolar }`;
                        deleteButton.innerHTML = `<a><img class="icon" src="https://cdn-icons-png.flaticon.com/512/8568/8568248.png" alt="" height ="40" width="40"></a></div>`;

                        deleteButton.setAttribute('id', `delete-capacitacion-${ element.id_asignatura }`);

                        tr.appendChild(nombre);
                        tr.appendChild(institucion);
                        tr.appendChild(Inicio);
                        tr.appendChild(fin);
                        tr.appendChild(nivel);
                        operaciones.appendChild(deleteButton);
                        tr.appendChild(operaciones);

                        table.appendChild(tr);
                                        
                        // * Eventlisteners
                        deleteButton.addEventListener('click', (e)=>{
                            e.preventDefault();
                            Swal.fire({
                                title: '¿Deseas eliminar el archivo?',
                                confirmButton: 'Si',
                                showCancelButton: true,
                                cancelButtonText: 'Cancelar'
                            }).then((response)=>{
                                if(response.isConfirmed){
                                    fetch(`delete-materia/{{ Auth::user()->id }}`)
                                        .then((response) => response.json())
                                        .then((response) => {
                                            Swal.fire(response[0].alert, '', 'success');
                                            table.removeChild(tr);
                                        }).catch((error)=>{
                                            Swal.fire('Lo sentimos, ocurrio un error', 'Intenta de nuevo mas tarde', 'error');
                                        });
                                }
                            });
                        });
                    });
                });
        }
        materiasMenu.addEventListener('click', ()=>{
            createTable();
        });

        document.querySelector('#agregar-materias').addEventListener('click', (e)=>{
                            e.preventDefault();

                            let data = new FormData();
                            data.append('nombre', document.querySelector('#materia-nombre').value);
                            data.append('institucion', document.querySelector('#materia-institucion').value);
                            data.append('inicio', document.querySelector('#materia-inicio').value);
                            data.append('fin', document.querySelector('#materia-fin').value);
                            data.append('nivel', document.querySelector('#materia-nivel').value);
                            data.append('_token', '{{ csrf_token() }}');

                            fetch('/profesores/storeMaterias', {
                                method: 'POST',
                                headers: new Headers({
                                    'X-CSRF-Token': '{{ csrf_token() }}'
                                }),
                                body: data
                            }).then((response) => response.json())
                            .then((response)=>{
                                createTable();
                                Swal.fire(response[0].state, '', 'success');
                            });
                        })

    </script>

    <!-- Tabla de cursos -->
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
    <script>
        var archivosMenu = document.querySelector('#archivos-menu');
        archivosMenu.addEventListener('click', ()=>{
            fetch('getCapacitaciones/{{ Auth::user()->id }}')
                .then(response => response.json())
                .then((response)=>{
                    let table = document.querySelector('#capacitaciones-table-body');
                    table.innerHTML = '';
                    response.forEach((element)=>{
                        let tr = document.createElement('tr');

                        // * Columnas
                        let nombre_curso = document.createElement('td');
                        let nombre_institucion = document.createElement('td');
                        let fecha_inicio = document.createElement('td');
                        let fecha_fin = document.createElement('td');
                        let horas = document.createElement('td');
                        let tipo_curso = document.createElement('td');
                        let constancia_pdf = document.createElement('td');
                        let opciones = document.createElement('td');
                        let deleteButton = document.createElement('a');

                        opciones.setAttribute('style', 'text-align: center;');

                        // * Asignaciones
                        nombre_curso.innerHTML = `${element.nombre_curso}`;
                        nombre_institucion.innerHTML = `${ element.nombre_institucion }`;
                        fecha_inicio.innerHTML = `${ element.fecha_inicio }`;
                        fecha_fin.innerHTML = `${ element.fecha_fin }`;
                        horas.innerHTML = `${ element.horas }`;
                        tipo_curso.innerHTML = `${ element.tipo_curso }`;
                        constancia_pdf.innerHTML = `<a href="#" id="show-capacitacion" class="btnplus"><img src="https://cdn-icons-png.flaticon.com/512/337/337946.png" class="icon" alt="" height ="40" width="40"></a>`;
                        deleteButton.innerHTML = `<a><img class="icon" src="https://cdn-icons-png.flaticon.com/512/8568/8568248.png" alt="" height ="40" width="40"><div>`;
                        

                        // * Attr
                        constancia_pdf.setAttribute('align', 'center');
                        deleteButton.setAttribute('id', `delete-capacitacion-${ element.id_capacitacion }`);

                        // * Appends
                        tr.appendChild(nombre_curso);
                        tr.appendChild(nombre_institucion);
                        tr.appendChild(fecha_inicio);
                        tr.appendChild(fecha_fin);
                        tr.appendChild(horas);
                        tr.appendChild(tipo_curso);
                        tr.appendChild(constancia_pdf);
                        opciones.appendChild(deleteButton);
                        tr.appendChild(opciones);
                        table.appendChild(tr);

                        // * Eventlisteners
                        deleteButton.addEventListener('click', (e)=>{
                            e.preventDefault();
                            Swal.fire({
                                title: '¿Deseas eliminar el archivo?',
                                confirmButton: 'Si',
                                showCancelButton: true,
                                cancelButtonText: 'Cancelar'
                            }).then((result)=>{
                                if(result.isConfirmed){
                                    fetch(`delete-capacitacion/${ element.id_capacitacion }`)
                                        .then((response) => response.json())
                                        .then((response) => {
                                            Swal.fire(response[0].alert, '', 'success');
                                            table.removeChild(tr);
                                        }).catch((error)=>{
                                            Swal.fire('Lo sentimos, ocurrio un error', 'Intenta de nuevo mas tarde', 'error');
                                        });
                                }
                            });
                        });
                        
                    });
                });
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
