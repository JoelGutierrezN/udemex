@extends('layout.app')

@section('title', 'Inicio')

@section('content')

<h3 class="form-screen-title">Registro de información personal</h3>

        <div class="tabs">
            <a href="{{route('teacher.index')}}"> <button type="button" id="personal-menu">Datos personales &blacktriangledown;</button></a>
            <button type="button" id="historial-menu" data-tab-target="5">Historial académico &blacktriangledown;</button>
            <button type="button" id="materias-menu" data-tab-target="2">Asignaturas impartidas &blacktriangledown;</button>
            <button type="button" id="experiencia-menu" data-tab-target="1">Experiencia laboral &blacktriangledown;</button></a>
            <button type="button" id="archivos-menu" data-tab-target="4">Capacitación &blacktriangledown;</button>
            {{-- {{ route('experienciaLaboral') }} --}}
        </div>


        @if($is_registered_academic)
            <form action="{{ route('teacher.infoacademica.update', $infoAcademica) }}" method="POST" enctype="multipart/form-data" id="form_experiencia">
                @csrf
                @method('PUT')
        @else
           <form action="{{ route('teacher.infoacademica.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
        @endif
            <div class="mt-2" data-tab-id="1">
                <h3 class="tab--title">Datos de experiencia laboral</h3>
                @if($is_registered_academic)
                    <div class="alert alert-info">
                        <h6>¡Ya tenemos tus datos!</h6>
                        <p>
                            Ya cuentas con tus datos registrados, a partir de ahora solo puedes actualizarlos.
                        </p>
                    </div>
                @endif
                <div class="input-columns-1">


                    <div>
                        <label for="text-input"  class="is-required ">Años de experiencia en modalidad presencial</label>
                        <input class="acortadox2" type="number" autocomplete="off"
                        id="numero" name="experiencia_presencial"
                        onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" min="1" max="99"
                        value="{{ old('experiencia_presencial', $infoAcademica->experiencia_presencial ?? '') }}">
                    </div>
                    @if($errors->first('experiencia_presencial'))
                    <div class="invalid-feedback">
                    <i>{{ $errors->first('experiencia_presencial') }}</i>
                    </div>
                    @endif


                    <div>
                        <label for="text-input" class="is-required">Años de experiencia en modalidad línea</label>
                        <input class="acortadox2" type="number" autocomplete="off"
                        id="numero2" name="experiencia_linea"
                        onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" min="1" max="99"
                        value="{{ old('experiencia_linea', $infoAcademica->experiencia_linea ?? '') }}">
                    </div>
                    @if($errors->first('experiencia_linea'))
                    <div class="invalid-feedback">
                    <i>{{ $errors->first('experiencia_linea') }}</i>
                    </div>
                    @endif


                    <div>
                        <label for="nivel_mayor_experiencia" class="is-required">Seleccione el nivel más alto de experiencia docente</label>
                        <select name="nivel_mayor_experiencia" id="datos_nivel_mayor_experiencia">
                            @php
                                $nivelesExperiencia = ['Preparatoria','Licenciatura', 'Maestría', 'Doctorado'];
                            @endphp
                            @if($is_registered_academic)
                                @foreach ($nivelesExperiencia as $nivel)
                                    @if ($infoAcademica->nivel_mayor_experiencia==$nivel)
                                        <option value="{{$nivel}}" selected>{{$nivel}}</option>
                                    @else
                                        <option value="{{$nivel}}">{{$nivel}}</option>
                                    @endif
                                @endforeach
                            @else
                                @foreach ($nivelesExperiencia as $nivel)
                                    <option value="{{$nivel}}">{{$nivel}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>


                  @if($is_registered_academic)
                        @php
                            $areas_registered = [];
                            $areas_infoAcademica = App\Models\infoAcademicarea::where("id_user", Auth::id())->get();
                            foreach($areas_infoAcademica as $area):
                                array_push($areas_registered , App\Models\AreaExperiencia::where("id_area_experiencia", $area->id_area)->first());
                            endforeach;
                        @endphp
                        <div>
                         <label>Áreas de experiencia Laboral</label>
                            <select  name="area_experiencia[]" class="js-example-basic-multiple" multiple="multiple">
                                 @foreach ($areas_registered as $arearegi)
                                    <option value="{{$arearegi->id_area_experiencia}}" selected>{{$arearegi->nombre}}</option>
                                 @endforeach

                                @foreach ($areas_no_seleccionadas as $areasnoselect)
                                    <option value="{{$areasnoselect->id_area_experiencia}}">{{$areasnoselect->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                    @else
                    <div>
                        <label class="is-required">Áreas de experiencia Laboral</label>
                        <select  name="area_experiencia[]" class="js-example-basic-multiple" multiple="multiple">
                        @foreach ($areas as $area)
                        <option value="{{$area->id_area_experiencia}}">{{$area->nombre}}</option>
                         @endforeach
                        </select>
                    </div>
                        @if($errors->first('area_experiencia'))
                            <div class="invalid-feedback">
                                <i>{{ $errors->first('area_experiencia') }}</i>
                            </div>
                        @endif
                    @endif


                    @if($is_registered_academic)
                        @php
                            $herramientas_registered = [];
                            $herramientas_infoAcademica = App\Models\InfoAcademicHerramienta::where("id_user", Auth::id())->get();
                            foreach($herramientas_infoAcademica as $herramienta):
                                array_push($herramientas_registered , App\Models\HerramientaTecnologica::where("id_herramienta", $herramienta->id_herramienta)->first());
                            endforeach;
                        @endphp

                        <div>
                         <label>Seleccione las herramientas tecnológicas que sabe utilizar</label>
                            <select  name="id_herramienta[]" class="js-example-basic-multiple" multiple="multiple">
                                @foreach ($herramientas_registered as $herramientabd)
                                    <option value="{{$herramientabd->id_herramienta}}" selected>{{$herramientabd->nombre}}</option>
                                @endforeach
                                   @foreach ($herramientas_no_seleccionadas as $herramientasnoselect)
                                        <option value="{{$herramientasnoselect->id_herramienta}}">{{$herramientasnoselect->nombre}}</option>
                                @endforeach

                            </select>
                        </div>
                    @else
                        <div>
                            <label class="is-required">Seleccione las herramientas tecnológicas que sabe utilizar</label>
                            <select  name="id_herramienta[]" class="js-example-basic-multiple" multiple="multiple">
                            @foreach ($herramientas as $herramienta)
                            <option value="{{$herramienta->id_herramienta}}">{{$herramienta->nombre}}</option>
                            @endforeach
                            </select>
                        </div>
                             @if($errors->first('id_herramienta'))
                            <div class="invalid-feedback">
                            <i>{{ $errors->first('id_herramienta') }}</i>
                            </div>
                             @endif
                    @endif


                    <div>
                        <label for="select-input-2" class="is-required">Disponibilidad para ser asesor en la UDEMEX</label>
                        <ul class="col2">
                            <li><input type="radio" id="datos_disponibilidad_asesor" name="disponibilidad_asesor" value="100%" checked @isset ($infoAcademica->disponibilidad_asesor) @if($infoAcademica->disponibilidad_asesor == "100%") checked @endif @endisset>
                                <label for=""> %100</label>&#160;&#160;&#160;&#160;&#160;&#160;&#160;<input type="radio" id="datos_disónibilidad_asesor" name="disponibilidad_asesor" value="75%" @isset ($infoAcademica->disponibilidad_asesor) @if($infoAcademica->disponibilidad_asesor == "75%") checked @endif @endisset>
                                <label for=""> %75</label>&#160;&#160;&#160;&#160;&#160;&#160;&#160;<input type="radio" id="datos_disónibilidad_asesor" name="disponibilidad_asesor" value="50%" @isset ($infoAcademica->disponibilidad_asesor) @if($infoAcademica->disponibilidad_asesor == "50%") checked @endif @endisset>
                                <label for=""> %50</label>&#160;&#160;&#160;&#160;&#160;&#160;&#160;<input type="radio" id="datos_disónibilidad_asesor" name="disponibilidad_asesor" value="25%" @isset ($infoAcademica->disponibilidad_asesor) @if($infoAcademica->disponibilidad_asesor == "25%") checked @endif @endisset>
                                <label for=""> %25</label></li>
                            <li>
                        </ul>
                    </div>


                    <div>
                        <label for="select-input-2" class="is-required">¿Trabaja en otro lugar actualmente?</label>
                        <ul class="col2">
                            <li>
                                <input type="radio" id="datos_labora_actualmente_no" name="labora_actualmente" value="No" checked @isset ($infoAcademica->labora_actualmente) @if($infoAcademica->labora_actualmente == "No") checked @endif @endisset>
                                <label for=""> No</label>&#160;&#160;&#160;&#160;&#160;&#160;&#160;
                                <input type="radio" id="datos_labora_actualmente" name="labora_actualmente" value="Si" @isset ($infoAcademica->labora_actualmente) @if($infoAcademica->labora_actualmente == "Si") checked @endif @endisset>
                                <label for=""> Sí</label>
                            <li>
                        </ul>
                    </div>


                    <div id="datos_si_labora">
                        <div>
                            <label for="datos_lugar_labora" class="is-required">Nombre completo del lugar donde labora</label>
                            <input type="text" autocomplete="off" placeholder="Coloque el nombre del lugar en donde labora"
                            id="datos_lugar_labora" name="lugar_labora" style="height: 30px;"
                            value="{{ old('lugar_labora', $infoAcademica->lugar_labora ?? '') }}">
                        </div>

                        <div>
                            <label class="is-required">Seleccione la modalidad en la que labora</label>
                            <select name="modalidad" id="datos_modalidad" style="height: 30px;">
                                @php
                                    $nivelesModalidad = ['Presencial','Línea'];
                                @endphp
                                @if($is_registered_academic)
                                    @foreach ($nivelesModalidad as $modalidad)
                                        @if ($infoAcademica->modalidad==$modalidad)
                                            <option value="{{$modalidad}}" selected>{{$modalidad}}</option>
                                        @else
                                            <option value="{{$modalidad}}">{{$modalidad}}</option>
                                        @endif
                                    @endforeach
                                @else
                                @foreach ($nivelesModalidad as $modalidad)
                                    <option value="{{$modalidad}}">{{$modalidad}}</option>
                                @endforeach
                            @endif
                            </select>
                        </div>
                        <div>
                            <label for="select-input-2" class="is-required">¿Cuál es el horario laboral en su otro trabajo?</label>
                            <ul class="col2">
                                <li><label for="">Inicio:&#160;&#160;&#160;</label><input type="time" min="6:00:00" max="24:00:00"
                                    name="horario_laboral_inicio" id="datos_horario_laboral_inicio" value="{{ old('horario_laboral_inicio', $infoAcademica->horario_laboral_inicio ?? '') }}"></li>
                                <li><label for="">Cierre:&#160;&#160;&#160;</label><input type="time" min="6:00:00" max="24:00:00"
                                    name="horario_laboral_fin" id="datos_horario_laboral_fin" value="{{ old('horario_laboral_fin', $infoAcademica->horario_laboral_fin ?? '') }}"></li>
                            </ul>
                        </div>
                        <div>
                            <label for="select-input-2" class="is-required">¿Cuáles son los días laborales en su otro trabajo? </label>
                            <ul class="col8">
                                <li><input type="checkbox" id="dias_laboral_lunes" name="lunes" value="si" @isset ($infoAcademica->lunes) @if($infoAcademica->lunes == "si") checked @endif @endisset><label > Lun.</label></li>
                                <li><input type="checkbox" id="dias_laboral_martes" name="martes" value="si" @isset ($infoAcademica->martes) @if($infoAcademica->martes == "si") checked @endif @endisset><label > Mar.</label></li>
                                <li><input type="checkbox" id="dias_laboral_miercoles" name="miercoles" value="si" @isset ($infoAcademica->miercoles) @if($infoAcademica->miercoles == "si") checked @endif @endisset><label > Mierc.</label></li>
                                <li><input type="checkbox" id="dias_laboral_jueves" name="jueves" value="si" @isset ($infoAcademica->jueves) @if($infoAcademica->jueves == "si") checked @endif @endisset><label > Juev.</label></li>
                                <li><input type="checkbox" id="dias_laboral_viernes" name="viernes" value="si" @isset ($infoAcademica->viernes) @if($infoAcademica->viernes == "si") checked @endif @endisset><label > Vier.</label></li>
                                <li><input type="checkbox" id="dias_laboral_sabado" name="sabado" value="si" @isset ($infoAcademica->sabado) @if($infoAcademica->sabado == "si") checked @endif @endisset><label > Sáb.</label></li>
                                <li><input type="checkbox" id="dias_laboral_domingo" name="domingo" value="si" @isset ($infoAcademica->domingo) @if($infoAcademica->domingo == "si") checked @endif @endisset><label > Dom.</label></li>
                            </ul>
                        </div>
                    </div>
                    @if($is_registered_academic)
                        <div>
                            <label for="">Adjuntar archivo en pdf de su CV con ortografía actualizado al día de hoy</label>
                             <p class= "text-foto">
                             Si desea actualizar el archivo, coloque nuevamente su archivo CV en caso contrario no coloque nada.
                            </p>
                            <div class="conte">
                                <div class="pdfright">
                                    <a class="sin" href="{{ route('teacher.infoacademic.downloadinfo', $infoAcademica->uuid) }}"
                                    target=”_blank”>
                                    <img class="icon" src="{{ asset('img/pdfdownload.png')}}" height ="45" width="45" />
                                   Descargar </a>
                                </div>
                             </div>
                            <input type="file" accept="application/pdf" placeholder="Coloque su fotografia" id="datos_curriculum_pdf" name="curriculum_pdf">
                        </div>
                    @else
                        <div>
                            <label for="text-input" class="is-required">Adjuntar archivo en pdf de su CV con ortografía actualizado al día de hoy</label>
                            <input type="file" accept="application/pdf" placeholder="Coloque su fotografia" id="datos_curriculum_pdf" name="curriculum_pdf"
                            value="{{ old('curriculum_pdf', $infoAcademica->curriculum_pdf ?? '') }}">
                        </div>
                        @if($errors->first('curriculum_pdf'))
                            <div class="invalid-feedback">
                                <i>{{ $errors->first('curriculum_pdf') }}</i>
                            </div>
                        @endif
                    @endif
                    <div>
                        <input hidden type="text" id="id_user_experiencia" value="{{ Auth::user()->id }}" name="id_user">
                    </div>
                </div>
                <div>
                    @if($is_registered_academic)
                        <button  type="submit" class="btn-primario" id="send_form_experiencia">Actualizar</button>
                        <p class= "text-obligatorio">
                        <label class="is-required"> </label>
                        Los campos marcados con un asterisco son obligatorios.
                        </p><br>&nbsp;
                    @else
                        <button  type="submit" class="btn-primario" id="send_form_experiencia">Guardar</button>
                        <p class= "text-obligatorio">
                        <label class="is-required"> </label>
                        Los campos marcados con un asterisco son obligatorios.
                        </p><br>&nbsp;
                    @endif
                </div>
                @if($is_registered_academic)
                    <div class="conte">
                        <div class="left"></div>
                        <div class="alert-info2">
                            <p>Información actualizada a la fecha:
                                {{\Carbon\Carbon::parse($infoAcademica->updated_at)->locale('es')->day}}
                                {{\Carbon\Carbon::parse($infoAcademica->updated_at)->locale('es')->monthName}}
                                {{\Carbon\Carbon::parse($infoAcademica->updated_at)->locale('es')->year}} a las
                                {{ $infoAcademica->updated_at->format('H:i:s') }}
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

    {{-- Modals to PDF --}}
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

    {{-- script para mostrar u ocultar campos adicionales --}}
    <script>
        window.addEventListener('load', function (){
            const datos_si_labora = document.querySelector('#datos_si_labora');
            const si_labora = document.querySelector('#datos_labora_actualmente');
            const no_labora = document.querySelector('#datos_labora_actualmente_no');
            if(!si_labora.checked){
                datos_si_labora.classList.add('d-none');
            }
            si_labora.addEventListener('change', function (){
                if(si_labora.checked){
                    datos_si_labora.classList.remove('d-none');
                }else{
                    if(!datos_si_labora.classList.contains('d-none')){
                        datos_si_labora.classList.add('d-none');
                    }
                }
            });
            no_labora.addEventListener('change', function (){
                if(no_labora.checked){
                    datos_si_labora.classList.add('d-none');
                }else{
                    if(!datos_si_labora.classList.contains('d-none')){
                        datos_si_labora.classList.remove('d-none');
                    }
                }
            });
        });
    </script>

    {{-- Script para limitar los campos de años de experiencia --}}
    <script>
        var input =  document.getElementById('numero');
        input.addEventListener('input',function(){
        if (this.value.length > 2)
            this.value = this.value.slice(0,2);
        });

        var input =  document.getElementById('numero2');
        input.addEventListener('input',function(){
        if (this.value.length > 2)
            this.value = this.value.slice(0,2);
        });
    </script>

    <script src="{{ asset('js/select2/select2.min.js')}}"></script>

    {{-- Script para las clases de select2 --}}
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>

    <script type="text/javascript">
        $(".js-example-basic-multiple").select2();
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

    {{-- Script para previsualizar la foto --}}
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

