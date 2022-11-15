@extends('layout.app')

@section('title', 'Inicio')

@section('content')

    <form action="#" method="POST">
        @csrf
        @method('POST')

        <h3 class="form-screen-title">Registro de Información Personal</h3>

        <div class="tabs">
            <button type="button" data-tab-target="1">Datos Personales &blacktriangledown;</button>
            <button type="button" data-tab-target="2">Materias impartidas &blacktriangledown;</button>
            <button type="button" data-tab-target="3">Experiencia Laboral &blacktriangledown;</button>
            <button type="button" data-tab-target="4">Subida de Documentos &blacktriangledown;</button>
            <button type="button" data-tab-target="5">Historial académico &blacktriangledown;</button>
        </div>

        {{-- Datos personales --}}
        <div class="mt-2" data-tab-id="1">
            <h3 class="tab--title">Datos personales</h3>
            <div class="input-columns-1">
                <div>
                    <label for="text-input">Nombre</label>
                    <input type="text" placeholder="Coloque su nombre" id="text-input">
                </div>

                <div>
                    <label for="text-input">Apellido paterno</label>
                    <input type="text" placeholder="Coloque su apellido paterno" id="text-input">
                </div>

                <div>
                    <label for="text-input">Apellido materno</label>
                    <input type="text" placeholder="Coloque su apellido materno" id="text-input">
                </div>

                <div>
                    <label for="select-input">Género</label>
                    <ul class="col2">
                        <label><input type="radio" name="#" value="0">Femenino</label>&#160;&#160;&#160;&#160;&#160;
                        <label><input type="radio" name="#" value="1" required>Masculino</label>
                    </ul>
                </div>

                <div>
                    <label for="text-input">Número de empleado UDEMEX</label>
                    <input type="text" placeholder="Número de empleado EDEMEX" id="text-input">
                </div>

                <div>
                    <label for="text-input">Fotografía</label>
                    <input type="file" placeholder="Coloque su fotografía" id="text-input">
                </div>

                <div>
                    <label for="text-input">Teléfono de casa</label>
                    <input type="text" placeholder="Coloque su teléfono de casa" id="text-input">
                </div>

                <div>
                    <label for="text-input">Teléfono celular</label>
                    <input type="text" placeholder="Coloque su teléfono celular" id="text-input">
                </div>

                <div>
                    <label for="text-input">Correo electrónico de UDEMEX</label>
                    <input type="text" placeholder="Coloque su correo electrónico de UDEMEX" id="text-input">
                </div>

                <div>
                    <label for="text-input">Confirmación de correo electrónico UDEMEX</label>
                    <input type="text" placeholder="Coloque su correo electrónico UDEMEX" id="text-input">
                </div>

                <div>
                    <label for="text-input">Correo electrónico personal</label>
                    <input type="text" placeholder="Coloque su correo electrónico personal" id="text-input">
                </div>

                <div>
                    <label for="text-input">Confirmación de correo electrónico personal</label>
                    <input type="text" placeholder="Coloque su correo electrónico personal" id="text-input">
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
        </div>
        {{--Fin Datos personales --}}

        {{--Datos del Historial Académico --}}
        <div class="mt-2" data-tab-id="2">
            <h3 class="tab--title">Materias impartidas</h3>
            <div class="">
                <div>
                    <label for="text-input">Coloque las materias impartidas</label>
                    <ul class="col4">
                        <form action="#" method="post" enctype="multipart/form" id="materias-form">
                        <li class="formlabel">Nombre</li>
                        <li class="formlabel">Institucion</li>
                        <li class="formlabel">Inicio</li>
                        <li class="formlabel">Fin</li>
                        <li class="formlabel">Nivel</li>
                        <li style="color:white">Agregar</li>
                        <li><input name="nombre" type="text" placeholder="Nombre de la materia" id="text-input"></li>
                        <li><input name="institucion" type="text" placeholder="Nombre de la institución" id="text-input"></li>
                        <li><input name="inicio" type="date" placeholder="Inicio de la materia impartida" id="text-input"></li>
                        <li><input name="fin" type="date" placeholder="Fin de la materia impartida" id="text-input"></li>
                        <li><select  style="margin-top:10px" class="" name="tipo" >
                            <option value="#">Preparatoria</option>
                            <option value="#">Licenciatura</option>
                            <option value="#">Maestria</option>
                            <option value="#">Doctorado</option>
                          </select></li>
                          <li><a href="#"  onclick="document.getElementById('materias-form').submit()" id="agregar-materias" type="submit" class="btnplus"><img src="https://cdn-icons-png.flaticon.com/512/189/189689.png" height ="40" width="40" /></a></li>
                        </form>
                    </ul>
                </div>
            </div>
        </div>
        {{--Fin Datos del Historial Académico --}}

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


                </div>
            </div>
        </div>
</form>
        {{--Fin Experiencia Laboral --}}

        {{-- Subida de Documentos --}}

        <div class="mt-2" data-tab-id="4">
            <h3 class="tab--title">Subida de Documentos</h3>
            <div class="">
                <div>
                    <label for="text-input"> Capacitación, anexar constancias con registro de datos:</label>

                    <ul class="col8">
                        <form id="archivos-form" action="{{ route('updateFiles') }}" method="post" enctype="multipart/form-data">
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
                                <option value="#">Diplomado</option>
                                <option value="#">Certificado</option>
                            </select></li>
                            <li><input type="file" name="evidencia" placeholder="Coloque su evidencia" id="text-input"></li>
                            <li><a id="agregar-capacitacion" type="submit" class="btnplus"><img class="icon" src="https://cdn-icons-png.flaticon.com/512/189/189689.png" height ="40" width="40" /></a></li>
                        </form>
                    </ul>
                    <table id="table-capacitaciones">
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
                        <tr>
                          <td>Ingenieria en sistemas</td>
                          <td>Tecnologico de Toluca</td>
                          <td>1 Sep 1999</td>
                          <td>30 Agosto 2005</td>
                          <td>34</td>
                          <td>Diplomado</td>
                          <td align="center"><a href="#" id="agregar-capacitacion" class="btnplus"><img src="https://cdn-icons-png.flaticon.com/512/337/337946.png" class="icon" alt="" height ="40" width="40"></a></td>
                          <td align="center"><a href="#"  onclick="document.getElementById('capacitacion-form').submit()" id="agregar-capacitacion" type="submit" class="btnplus"><img class="icon" src="https://cdn-icons-png.flaticon.com/512/8568/8568248.png" alt="" height ="40" width="40"></a></td>
                        </tr>
                      </table>

                    <script>
                        document.querySelector('#agregar-capacitacion').addEventListener('click', (e)=>{
                            e.preventDefault();
                            document.querySelector('#archivos-form').submit();
                        });
                    </script>

                </div><br>
                <div>
                    <label for="text-input">Adjuntar archivo en pdf de su CV con ortografía actualizado al día de hoy:</label>
                    <small>El nombre del archivo debe de ser su nombre completo empezando
                        por nombre. Ejemplo: CV_NayeliSalazarGomez</small>
                    <input type="file" placeholder="Coloque su fotografia" id="text-input">

                </div>

            </div>
        </div>
        {{--Fin Subida de Documentos --}}

        {{-- Inicio historial academico --}}
        <div class="mt-2" data-tab-id="5">
            <h3 class="tab--title">Historial Académico</h3>
            <div class="">
                <div>
                    <label for="text-input">Coloque su historial académico</label>
                    <ul class="col8">
                        <form action="#" method="post" enctype="multipart/form" id="historialAcademico-form">
                            <li class="formlabel">Nombre</li>
                            <li class="formlabel">Inicio</li>
                            <li class="formlabel">Fin</li>
                            <li class="formlabel">Nivel</li>
                            <li class="formlabel">Cédula PDF</li>
                            <li class="formlabel">Título PDF</li>
                            <li class="formlabel">Certificado PDF</li>
                            <li style="color:white">Agregar</li>
                            <li><input name="nombre" type="text" placeholder="Nombre de capacitacion" id="text-input"></li>
                            <li><input name="inicio" type="date" placeholder="Inicio de capacitacion" id="text-input"></li>
                            <li><input name="fin" type="date" placeholder="Fin de capacitacion" id="text-input"></li>
                            <li>
                                <select style="margin-top:10px" class="" name="tipo" >
                                    <option value="#">Preparatoria</option>
                                    <option value="#">Licenciatura</option>
                                    <option value="#">Maestría</option>
                                    <option value="#">Doctorado</option>
                                </select>
                            </li>
                            <li><input type="file" name="evidencia" placeholder="Coloque su evidencia" id="text-input"></li>
                            <li><input type="file" name="evidencia" placeholder="Coloque su evidencia" id="text-input"></li>
                            <li><input type="file" name="evidencia" placeholder="Coloque su evidencia" id="text-input"></li>
                            <li><a href="#"  onclick="document.getElementById('historialAcademico-form').submit()" id="agregar-hisotiralAcademico" type="submit" class="btnplus"><img src="https://cdn-icons-png.flaticon.com/512/189/189689.png" height ="40" width="40" /></a></li>
                        </form>
                    </ul>
                </div>
            </div>
        </div>

    </form>

@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('js/utilities/menu.js') }}"></script>
    <script></script>
    <script>
        $(document).ready(function() {
            $('.select2-multiple').select2();
        });
    </script>
@endsection
