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
                    <label for="text-input" class="is-required"> Nombre(s)</label>
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
                    <label for="text-input" class="is-required"> Apellido paterno</label>
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
                    <label for="text-input" class="is-required"> Apellido materno</label>
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
                    autocomplete="off" id="dato_fecha_nacimiento" name="fecha_nacimiento"
                     value="{{ old('fecha_nacimiento', $usuario->fecha_nacimiento ?? '') }}">
                </div>
                    @if($errors->first('fecha_nacimiento'))
                    <div class="invalid-feedback">
                    <i>{{ $errors->first('fecha_nacimiento') }}</i>
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
                    <label for="text-input" class="is-required"> Correo electrónico Institucional</label>
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
                    <label for="text-file"> Adjuntar archivo en pdf de su CURP</label>
                    @else
                    <label for="text-input" class="is-required"> Adjuntar archivo en pdf de su CURP</label>
                    @endif

                    @if($is_registered)
                    <input type="file" placeholder="Coloque su CURP" id="curp_pdf" name="curp_pdf"
                    accept="application/pdf">
                    @else
                    <input type="file" placeholder="Coloque su fotografía" id="curp_pdf" name="curp_pdf"
                    accept="application/pdf">
                    @endif
                </div>
                         @if($errors->first('curp_pdf'))
                        <div class="invalid-feedback">
                        <i>{{ $errors->first('curp_pdf') }}</i>
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
                            <p>Información actualizada a la fecha: {{ $usuario->updated_at->format('d-m-Y H:i:s') }}</p>
                        </div>
                    </div><br>&nbsp;
            @endif
        </div>
        </form>

@section('scripts')
    <script type="text/javascript" src="{{ asset('js/utilities/menu.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.select2-multiple').select2();
        });
    </script>
@endsection
