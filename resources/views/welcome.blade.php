@extends('layout.app')

@section('title', 'Inicio')

@section('content')

        <h3 class="form-screen-title">Registro de Información Personal</h3>

        <div class="tabs">
            <button type="button" data-tab-target="1">Datos Personales &blacktriangledown;</button>
            <button type="button" data-tab-target="2">Materias impartidas &blacktriangledown;</button>
            <button type="button" data-tab-target="3">Experiencia Laboral &blacktriangledown;</button>
            <button type="button" id="archivos-menu" data-tab-target="4">Cursos &blacktriangledown;</button>
            <button type="button" data-tab-target="5">Historial académico &blacktriangledown;</button>
        </div>

    {{-- Datos personales --}}
       <form action="{{ route('teacher.usuarios.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div class="mt-2" data-tab-id="1">
            <h3 class="tab--title">Datos personales</h3>
            <div class="input-columns-1">

                <div>
                    <label for="text-input">Número de empleado UDEMEX</label>
                    <input type="text" placeholder="Número de empleado EDEMEX" 
                    autocomplete="off" id="dato_clave_empleado" name="clave_empleado"
                    value="{{ old('clave_empleado') }}">
                </div>
                     @if($errors->first('clave_empleado'))
                    <div class="invalid-feedback">
                    <i>{{ $errors->first('clave_empleado') }}</i>
                    </div>
                    @endif

                <div>
                    <label for="text-input">Nombre</label>
                    <input type="text" placeholder="Coloque su nombre iniciando por letra mayúscula. Ejemplo: (Luis)"
                    autocomplete="off" id="dato_nombre" name="nombre"  value="{{ old('nombre') }}">
                </div>
                    @if($errors->first('nombre'))
                    <div class="invalid-feedback">
                    <i>{{ $errors->first('nombre') }}</i>
                    </div>
                    @endif

                <div>
                    <label for="text-input">Apellido paterno</label>
                    <input type="text" placeholder="Coloque apellido paterno iniciando por letra mayúscula. Ejemplo 'González'" 
                     autocomplete="off" id="dato_apellido_paterno" name="apellido_paterno"
                      value="{{ old('apellido_paterno') }}">
                </div>
                    @if($errors->first('apellido_paterno'))
                    <div class="invalid-feedback">
                    <i>{{ $errors->first('apellido_paterno') }}</i>
                    </div>
                    @endif

                <div>
                    <label for="text-input">Apellido materno</label>
                    <input type="text" placeholder="Coloque apellido materno iniciando por letra mayúscula. Ejemplo 'González'" 
                    autocomplete="off" id="dato_apellido_materno" name="apellido_materno"
                     value="{{ old('apellido_materno') }}">
                </div>
                    @if($errors->first('apellido_materno'))
                    <div class="invalid-feedback">
                    <i>{{ $errors->first('apellido_materno') }}</i>
                    </div>
                    @endif

                <div>
                    <label for="select-input">Género</label>
                    <ul class="col2">
                        <label><input type="radio" id="dato_sexo_masculino" name="sexo" value="1">Masculino</label>&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;
                        <label><input type="radio" id="dato_sexo_femenino" name="sexo" value="0">Femenino</label>
                    </ul>
                </div>


                <div>
                    <label for="text-input">Fotografía</label>
                    <input type="file" placeholder="Coloque su fotografía" id="foto" name="foto">
                </div>
                     @if($errors->first('foto'))
                    <div class="invalid-feedback">
                    <i>{{ $errors->first('foto') }}</i>
                    </div>
                    @endif

                <div>
                    <label for="text-input">Teléfono de casa</label>
                    <input type="text" placeholder="Coloque su teléfono de casa" 
                    autocomplete="off" id="dato_telefono_casa" name="telefono_casa"
                     value="{{ old('telefono_casa') }}" maxlength="10"
                     onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;">
                </div>
                    @if($errors->first('telefono_casa'))
                    <div class="invalid-feedback">
                    <i>{{ $errors->first('telefono_casa') }}</i>
                    </div>
                    @endif

                <div>
                    <label for="text-input">Teléfono celular</label>
                    <input type="text" placeholder="Coloque su teléfono celular" 
                    autocomplete="off" id="dato_celular" name="celular"  value="{{ old('celular') }}"
                    maxlength="10"
                    onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;">
                </div>
                     @if($errors->first('celular'))
                    <div class="invalid-feedback">
                    <i>{{ $errors->first('celular') }}</i>
                    </div>
                    @endif

                <div>
                    <label for="text-input">Correo electrónico de UDEMEX</label>
                    <input type="text" name="email_udemex" placeholder="Coloque su correo electrónico de UDEMEX" 
                    autocomplete="off" id="dato_email_udemex" name="email_udemex"  value="{{ old('email_udemex') }}">
                </div>
                    @if($errors->first('email_udemex'))
                    <div class="invalid-feedback">
                    <i>{{ $errors->first('email_udemex') }}</i>
                    </div>
                    @endif

                <div>
                    <label for="text-input">Correo electrónico personal</label>
                    <input type="text" placeholder="Coloque su correo electrónico personal" 
                    autocomplete="off" id="dato_email_personal" name="email_personal"  value="{{ old('email_personal') }}">
                </div>
                    @if($errors->first('email_personal'))
                    <div class="invalid-feedback">
                    <i>{{ $errors->first('email_personal') }}</i>
                    </div>
                    @endif

                <div>
                    <input hidden type="text" value="{{ Auth::user()->id }}" name="id_user">
                </div>

                <!-- <div>
                    <label for="select-input">Rol</label>
                    <select id="select-input">
                        <option value="Tutor">Tutor</option>
                        <option value="Control académico">Control académico</option>
                        <option value="Asesor">Asesor</option>
                    </select>
                </div> -->

                <!-- <div>
                    <label for="select-input">Tipo usuario</label>
                    <select id="select-input">
                        <option value="Docte">Docente</option>
                        <option value="Encargado de Control Docente">Encargado de Control Docente</option>
                        <option value="Revisor">Revisor</option>
                    </select>
                </div> -->
            </div>

            <div>
                <center><button type="submit" class="btn-primario">Guardar Cambios</button></center>
            </div>
            <br>&nbsp;
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
                        <li class="formlabel">Nivel</li>
                        <li style="color:white">Agregar</li>
                        <li><input name="nombre" autocomplete="off" type="text" placeholder="Nombre de la materia" id="text-input"></li>
                        <li><input name="institucion" autocomplete="off" type="text" placeholder="Nombre de la institución" id="text-input"></li>
                        <li><input name="inicio" type="date" placeholder="Inicio de la materia impartida" id="text-input"></li>
                        <li><input name="fin" type="date" placeholder="Fin de la materia impartida" id="text-input"></li>
                        <li><select  style="margin-top:10px" class="" name="tipo" >
                            <option value="#">Preparatoria</option>
                            <option value="#">Licenciatura</option>
                            <option value="#">Maestría</option>
                            <option value="#">Doctorado</option>
                          </select></li>
                          <li><a href="#"  onclick="document.getElementById('materias-form').submit()" id="agregar-materias" type="submit" class="btnplus"><img src="https://cdn-icons-png.flaticon.com/512/189/189689.png" height ="40" width="40" /></a></li>
                        </form>
                    </ul>
                    <table id="table-materias">
                        <tr>
                          <th>Nombre</th>
                          <th>Instituto</th>
                          <th>Inicio</th>
                          <th>Fin</th>
                          <th>Nivel</th>
                          <th>Operaciones</th>
                        </tr>
                        <tr>
                          <td>Ingenieria en sistemas</td>
                          <td>Tecnologico de Toluca</td>
                          <td>1 Sep 1999</td>
                          <td>30 Agosto 2005</td>
                          <td>Doctorado</td>
                          <td align="center"><a href="#"  onclick="document.getElementById('materia-form').submit()" id="agregar-materia" type="submit" class="btnplus"><img class="icon" src="https://cdn-icons-png.flaticon.com/512/8568/8568248.png" alt="" height ="40" width="40"></a></td>
                        </tr>
                      </table>
                      <script>
                        document.querySelector('#agregar-materia').addEventListener('click', (e)=>{
                            e.preventDefault();
                            document.querySelector('#archivos-materia').submit();
                        });
                    </script>
                </div>
            </div>
        </div>
        {{--Fin Datos de materias impartidas --}}

        {{-- Experiencia Laboral --}}
        <div class="mt-2" data-tab-id="3">
            <h3 class="tab--title">Datos de Experiencia Laboral</h3>
            <div class="input-columns-2">
                <div>
                    <label>Areas de Experiencia Laboral</label>
                    <select style="margin-top:10px" class="select2-multiple" name="areas[]" multiple="multiple">
                        <option value="Industrial">Industrial</option>
                        <option value="Salud">Salud</option>
                      </select>
                </div>
                <div>
                    <label >Seleccione las herramientas tecnológicas que sabe utilizar
                    </label>
                    <select  style="margin-top:10px" class="select2-multiple" name="herramientas[]" multiple="multiple">
                        <option value="Office">Office</option>
                        <option value="Adobe">Adobe</option>
                      </select>
                </div>
            </div>
            <div class="contenedor-2col">
                <div>
                    <label for="select-input-2">Disponibilidad para ser asesor en la UDEMEX</label>
                    <ul class="col2">
                        <li><input type="radio" id="l-otrolugar" name="labora-actualmente" value="Bike">
                            <label for=""> %100</label>&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;<input type="radio" id="" name="" value="">
                            <label for=""> %75</label>&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;<input type="radio" id="" name="" value="">
                            <label for=""> %50</label>&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;<input type="radio" id="" name="" value="">
                            <label for=""> %25</label></li>
                        <li>
                        </ul>
                </div>

                <div style="margin-top:10px">
                    <label for="select-input-2">¿Cuál es el horario laboral en su otro trabajo?</label>
                    <ul class="col2">
                        <li><label for="">Inicio:&#160;&#160;&#160;</label><input type="time" min="6:00:00" max="24:00:00">&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;<label for="">Cierre:&#160;&#160;&#160;</label><input type="time" min="6:00:00" max="24:00:00"></li> </ul>
                </div>

            </div>
            <div class="contenedor-2col">
                <div>
                    <label for="select-input-2">¿Trabaja en otro lugar actualmente?</label>
                    <ul class="col2">

                        <li><input type="radio" id="l-otrolugar" name="labora-actualmente" value="Bike">
                            <label for=""> Si</label>&#160;&#160;&#160;&#160;<input type="radio" id="" name="" value="">
                            <label for=""> No</label></li>
                        <li>
                        </ul>
                </div>

                <div>
                    <label for="select-input-2">¿Cuáles son los dias laborales en su otro trabajo? </label>

                        <ul class="col2"><input type="checkbox" id="l-otrolugar" name="labora-actualmente" value="Bike">
                        <label > Lun.</label>&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;<input type="checkbox" id="" name="" value="">
                        <label > Mar.</label>&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;<input type="checkbox" id="" name="" value="">
                        <label > Mierc.</label>&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;<input type="checkbox" id="" name="" value="">
                        <label > Juev.</label>&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;<input type="checkbox" id="" name="" value="">
                        <label > Vier.</label>&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;<input type="checkbox" id="" name="" value="">
                        <label > Sáb.</label>&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;<input type="checkbox" id="" name="" value="">
                        <label > Dom.</label></ul>
                </div>
            </div>
            <div class="contenedor-2col">
                <div>
                    <label for="select-input-2">En este otro lugar donde trabaja, ¿está de...?</label>
                    <ul class="col2">

                        <li><input type="radio" id="" name="" value="">
                            <label for=""> Tiempo Parcial</label>&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;<input type="radio" id="l-otrolugar" name="labora-actualmente" value="Bike">
                            <label for=""> Tiempo Completo</label></li>
                        <li>
                            <li>

                            </li>
                        </ul>
                </div>

                <div>
                    <label for="text-input">Adjuntar archivo en pdf de su CV con ortografía actualizado al día de hoy:</label>
                    <small>El nombre del archivo debe de ser su nombre completo empezando
                        por nombre. Ejemplo: CV_NayeliSalazarGomez</small>
                    <input type="file" placeholder="Coloque su fotografia" id="text-input">

                </div>
            </div>
        </div>
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
                            <li class="formlabel">Institucion</li>
                            <li class="formlabel">Inicio</li>
                            <li class="formlabel">Fin</li>
                            <li class="formlabel">Horas</li>
                            <li class="formlabel">Tipo</li>
                            <li class="formlabel">Evidencia</li>
                            <li style="color:white">Agregar</li>
                            <li><input name="nombre" type="text" placeholder="Nombre de capacitacion" id="text-input"></li>
                            <li><input name="instituto" type="text" placeholder="Institucion donde se tomo la capacitacion" id="text-input"></li>
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
                    
                    <table id="table-capacitaciones">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Instituto</th>
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
                    <form action="#" method="post" enctype="multipart/form" id="historialAcademico-form">
                            <ul class="col5">
                            <li class="formlabel">Nombre</li>
                            <li class="formlabel">Institución</li>
                            <li class="formlabel">Inicio</li>
                            <li class="formlabel">Fin</li>
                            <li class="formlabel">Nivel Escolar</li>

                            <li><input name="nombre" type="text" autocomplete="off" placeholder="Nombre de capacitación" id="text-input"></li>
                            <li><input name="nombre" type="text" autocomplete="off" placeholder="Institución de capacitación" id="text-input"></li>
                            <li><input name="inicio" type="date" placeholder="Inicio de capacitación" id="text-input"></li>
                            <li><input name="fin" type="date" placeholder="Fin de capacitación" id="text-input"></li>
                            <li>
                                <select style="margin-top:10px" class="" name="tipo" >
                                    <option value="#">Preparatoria</option>
                                    <option value="#">Licenciatura</option>
                                    <option value="#">Maestría</option>
                                    <option value="#">Doctorado</option>
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
                            <li><input type="file" name="titulo" placeholder="titulo" class="formlabel"></li>
                            <li><input type="file" name="certificado" placeholder="certificado" class="formlabel"></li>
                            <li><input type="file" name="cedula" placeholder="cedula" class="formlabel"></li>
                            <li><a type="submit" class="btnplus"><img class="icon" src="https://cdn-icons-png.flaticon.com/512/189/189689.png" height ="40" width="40" /></a></li>
                            </ul>

                           <table id="table-historial-academico">
                        <tr>
                          <th>Nombre</th>
                          <th>Institutoción</th>
                          <th>Inicio</th>
                          <th>Fin</th>
                          <th>Nivel Escolar</th>
                          <th>Archivos</th>
                          <th>Operaciones</th>
                        </tr>
                        <tr>
                          <td>Ingeniería en sistemas</td>
                          <td>Tecnologico de Toluca</td>
                          <td>1 Sep 1999</td>
                          <td>30 Agosto 2005</td>
                          <td>Doctorado</td>
                          <td></td>
                          <td align="center"><a href="#" type="submit" class="btnplus"><img class="icon" src="https://cdn-icons-png.flaticon.com/512/8568/8568248.png" alt="" height ="40" width="40"></a></td>
                        </tr>
                      </table>

                        </form>
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

                        // * Asignaciones
                        nombre_curso.innerHTML = `${element.nombre_curso}`;
                        nombre_institucion.innerHTML = `${ element.nombre_institucion }`;
                        fecha_inicio.innerHTML = `${ element.fecha_inicio }`;
                        fecha_fin.innerHTML = `${ element.fecha_fin }`;
                        horas.innerHTML = `${ element.horas }`;
                        tipo_curso.innerHTML = `${ element.tipo_curso }`;
                        constancia_pdf.innerHTML = `<a href="#" id="show-capacitacion" class="btnplus"><img src="https://cdn-icons-png.flaticon.com/512/337/337946.png" class="icon" alt="" height ="40" width="40"></a>`;
                        deleteButton.innerHTML = `<img class="icon" src="https://cdn-icons-png.flaticon.com/512/8568/8568248.png" alt="" height ="40" width="40">`;
                        //opciones.innerHTML = `<a href="delete-capacitacion/${ element.id_capacitacion }" id="delete-archivo-${element.id_capacitacion}" type="submit" class="btnplus"></a>`;
                        
                        // * Attr
                        constancia_pdf.setAttribute('align', 'center');
                        opciones.setAttribute('aling', 'center');
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
                            console.log('delete');
                            fetch(`delete-capacitacion/${ element.id_capacitacion }`)
                                .then((response) => response.json())
                                .then((response) => {
                                    console.log(response);
                                    Swal.fire(response.alert, '', 'success');
                                    table.removeChild(tr);
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
@endsection
