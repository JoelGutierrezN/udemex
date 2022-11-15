@extends('layout.app')

@section('title', 'Inicio')

@section('content')

    <form action="#" method="POST">
        @csrf
        @method('POST')

        <h3 class="form-screen-title">Registro de Información Personal</h3>

        <div class="tabs">
            <button type="button" data-tab-target="1">Datos Personales &blacktriangledown;</button>
            <button type="button" data-tab-target="2">Datos del Historial Académico &blacktriangledown;</button>
            <button type="button" data-tab-target="3">Experiencia Laboral &blacktriangledown;</button>
            <button type="button" data-tab-target="4">Subida de Documentos &blacktriangledown;</button>
        </div>

        {{-- Datos personales --}}
        <div class="mt-2" data-tab-id="1">
            <h3 class="tab--title">Datos personales</h3>
            <div class="input-columns-2">
                <div>
                    <label for="text-input">Nombres</label>
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
                    <label for="text-input">Número de empleado EDEMEX</label>
                    <input type="text" placeholder="Número de empleado EDEMEX" id="text-input">
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
                    <label for="text-input">Correo electrónico personal</label>
                    <input type="text" placeholder="Coloque su Correo electrónico personal" id="text-input">
                </div>

                <div>
                    <label for="select-input">Rol</label>
                    <select id="select-input">
                        <option value="">Docente</option>
                        <option value="">Asistente</option>
                    </select>
                </div>

                <div>
                    <label for="text-input">Confirmación de Correo electrónico personal</label>
                    <input type="text" placeholder="Coloque su correo electrónico personal" id="text-input">
                </div>

                <div>
                    <label for="select-input">Sexo</label>
                    <ul class="col2">
                        <label><input type="radio" name="#" value="#">Femenino</label>&#160;&#160;&#160;&#160;&#160;
                        <label><input type="radio" name="#" value="#" required>Masculino</label>
                    </ul>
                </div>

                <div>
                    <label for="text-input">Fotografía</label>
                    <input type="file" placeholder="Coloque su fotografía" id="text-input">
                </div>


            </div>
        </div>
        {{--Fin Datos personales --}}

        {{--Datos del Historial Académico --}}
        <div class="mt-2" data-tab-id="2">
            <h3 class="tab--title">Datos del Historial Académico</h3>
            <div class="input-columns-2">
                <div>
                    <label>Materias que ha impartido en nivel preparatoria</label>
                    <select  style="margin-top:10px" class="select2-multiple" name="herramientas[]" multiple="multiple">
                        <option value="#">Mate prepa1</option>
                        <option value="#">Mate prepa2</option>
                    </select>
                </div>
                <div>
                    <label>Materias que ha impartido en nivel licenciatura</label>
                    <select  style="margin-top:10px" class="select2-multiple" name="herramientas[]" multiple="multiple">
                        <option value="#">Ingles lic 1</option>
                        <option value="#">Ingles lic 2</option>
                    </select>
                </div>
                <div>
                    <label>Materias que ha impartido en nivel maestria</label>
                    <select  style="margin-top:10px" class="select2-multiple" name="herramientas[]" multiple="multiple">
                        <option value="#">español mae 1</option>
                        <option value="#">español mae 2</option>
                    </select>
                </div>
                <div>
                    <label>Materias que ha impartido en nivel doctorado</label>
                    <select  style="margin-top:10px" class="select2-multiple" name="herramientas[]" multiple="multiple">
                        <option value="#">Doc doc 1</option>
                        <option value="#">Doc doc 2</option>
                    </select>
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
        {{--Fin Experiencia Laboral --}}

        {{-- Subida de Documentos --}}

        <div class="mt-2" data-tab-id="4">
            <h3 class="tab--title">Subida de Documentos</h3>
            <div class="input-columns-2">
                <div>
                    <label for="text-input"> Capacitación, anexar constancias con registro de datos:</label>
                    <input type="file" placeholder="Coloque su fotografia" id="text-input">
                </div>
                <div>
                    <label for="text-input">Adjuntar archivo en pdf de su CV con ortografía actualizado al día de hoy:</label>
                    <small>El nombre del archivo debe de ser su nombre completo empezando
                        por nombre. Ejemplo: CV_NayeliSalazarGomez</small>
                    <input type="file" placeholder="Coloque su fotografia" id="text-input">

                </div>
            </div>
        </div>
        {{--Fin Subida de Documentos --}}


    </form>

@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('js/utilities/menu.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.select2-multiple').select2();
        });
    </script>
@endsection