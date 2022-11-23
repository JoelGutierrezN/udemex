{{-- Experiencial Laboral --}}

@if($is_registered_academic)
         <form action="{{ route('teacher.infoacademica.update', $infoAcademica) }}" method="POST" enctype="multipart/form-data">
             @csrf
             @method('PUT')
           @else

           <form action="{{ route('teacher.infoacademica.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
            @endif
                <div class="mt-2" data-tab-id="3">
                    <h3 class="tab--title">Datos de Experiencia Laboral</h3>
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
                            <label for="text-input" class="is-required">Años de experiencia en modalidad presencial.</label>
                            <input type="number" autocomplete="off"
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
                            <input type="number" autocomplete="off"
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
                            <label for="nivel_mayor_experiencia">Seleccione el nivel más alto de experiencia docente</label>
                            <select name="nivel_mayor_experiencia" id="datos_nivel_mayor_experiencia">
                                @if($is_registered_academic)
                                <option value="{{ old('nivel_mayor_experiencia', $infoAcademica->nivel_mayor_experiencia ?? '') }}">{{ old('nivel_mayor_experiencia', $infoAcademica->nivel_mayor_experiencia ?? '') }}</option>
                                {{-- <option value="Preparatoria">Preparatoria</option>
                                <option value="Licenciatura">Licenciatura</option>
                                <option value="Maestría">Maestría</option>
                                <option value="Doctorado">Doctorado</option> --}}
                                @else
                                <option value="Preparatoria">Preparatoria</option>
                                <option value="Licenciatura">Licenciatura</option>
                                <option value="Maestría">Maestría</option>
                                <option value="Doctorado">Doctorado</option>
                                @endif
                            </select>
                        </div>

                        <div>
                            <label class="is-required">Áreas de experiencia Laboral</label>
                            <select style="margin-top:10px" class="multi-select select2-multiple" name="area_experiencia[]" multiple="multiple">
                                @foreach ($areas as $area)
                                <option value="{{$area->id_area_experiencia}}">{{$area->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                        {{-- @if($errors->first('area_experiencia[]'))
                        <div class="invalid-feedback">
                        <i>{{ $errors->first('area_experiencia[]') }}</i>
                        </div>
                        @endif --}}

                        <div>
                            <label class="is-required">Seleccione las herramientas tecnológicas que sabe utilizar</label>
                            <select style="margin-top:10px" class="multi-select select2-multiple " name="id_herramienta[]" multiple="multiple">
                                @foreach ($herramientas as $herramienta)
                                <option value="{{$herramienta->id_herramienta}}">{{$herramienta->nombre}}</option>
                                @endforeach
                              </select>
                        </div>
                        {{-- @if($errors->first('id_herramienta'))
                        <div class="invalid-feedback">
                        <i>{{ $errors->first('id_herramienta') }}</i>
                        </div>
                        @endif --}}

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
                            <label for="select-input-2">¿Trabaja en otro lugar actualmente?</label>
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
                                id="datos_lugar_labora" name="lugar_labora"
                                value="{{ old('lugar_labora', $infoAcademica->lugar_labora ?? '') }}">
                            </div>

                            <div>
                                <label class="is-required">Seleccione la modalidad en la que labora</label>
                                <select name="modalidad">
                                    @if($is_registered_academic)
                                        <option value="{{ old('modalidad', $infoAcademica->modalidad ?? '') }}">{{ old('modalidad', $infoAcademica->modalidad ?? '') }}</option>
                                        <option value="presencial">Presencial</option>
                                        <option value="linea">Línea</option>
                                    @else
                                        <option value="presencial">Presencial</option>
                                        <option value="linea">Línea</option>
                                    @endif
                                </select>
                            </div>

                            <div>
                                <label for="select-input-2" class="is-required">¿Cuál es el horario laboral en su otro trabajo?</label>
                                <ul class="col2">
                                    <li><label for="">Inicio:&#160;&#160;&#160;</label><input type="time" min="6:00:00" max="24:00:00" name="horario_laboral_inicio"></li>
                                    <li><label for="">Cierre:&#160;&#160;&#160;</label><input type="time" min="6:00:00" max="24:00:00" name="horario_laboral_fin"></li>
                                </ul>
                            </div>

                            <div>
                                <label for="select-input-2" class="is-required">¿Cuáles son los días laborales en su otro trabajo? </label>
                                <ul class="col8">
                                    <li><input type="checkbox" id="l-otrolugar" name="lunes" value="si"><label > Lun.</label></li>
                                    <li><input type="checkbox" id="dias_laboral" name="martes" value="si"><label > Mar.</label></li>
                                    <li><input type="checkbox" id="dias_laboral" name="miercoles" value="si"><label > Mierc.</label></li>
                                    <li><input type="checkbox" id="dias_laboral" name="jueves" value="si"><label > Juev.</label></li>
                                    <li><input type="checkbox" id="dias_laboral" name="viernes" value="si"><label > Vier.</label></li>
                                    <li><input type="checkbox" id="dias_laboral" name="sabado" value="si"><label > Sáb.</label></li>
                                    <li><input type="checkbox" id="dias_laboral" name="domingo" value="si"><label > Dom.</label></li>
                                </ul>
                            </div>
                        </div>

                        <div>
                            <label for="text-input" class="is-required">Adjuntar archivo en pdf de su CV con ortografía actualizado al día de hoy:</label>
                            <input type="file" accept="application/pdf" placeholder="Coloque su fotografia" id="curriculum_pdf" name="curriculum_pdf"
                            value="{{ old('curriculum_pdf', $infoAcademica->curriculum_pdf ?? '') }}">
                        </div>
                        @if($errors->first('curriculum_pdf'))
                        <div class="invalid-feedback">
                        <i>{{ $errors->first('curriculum_pdf') }}</i>
                        </div>
                        @endif

                        <div>
                            <input hidden type="text" value="{{ Auth::user()->id }}" name="id_user">
                        </div>
                    </div>

                    <div>
                        @if($is_registered_academic)
                            <button  type="submit" class="btn-primario">Actualizar</button>
                        @else
                            <button  type="submit" class="btn-primario">Guardar Cambios info</button>
                        @endif
                    </div><br>&nbsp;

                    @if($is_registered_academic)
                        <div class="conte">
                            <div class="left"></div>
                            <div class="alert-info2">
                                <p>Información actualizada a la fecha: {{ $infoAcademica->updated_at->format('d-m-Y H:i:s') }}</p>
                            </div>
                        </div><br>&nbsp;
                    @endif
                </div>
            </form>

            <script>
                window.addEventListener('load', function (){
                    const datos_si_labora = document.querySelector('#datos_si_labora');
                    const si_labora = document.querySelector('#datos_labora_actualmente');
                    const no_labora = document.querySelector('#datos_labora_actualmente_no');

                    datos_si_labora.classList.add('d-none');

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
