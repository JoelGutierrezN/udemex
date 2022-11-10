@extends('layout.app')

@section('title', 'Inicio')

@section('content')

    <form action="#" method="POST">
        @csrf
        @method('POST')

        <div class="tabs">
            <button type="button" data-tab-target="1">Datos Personales</button>
            <button type="button" data-tab-target="2">Datos de la Carrera Profesional</button>
        </div>

        {{-- Datos personales --}}
        <div class="mt-2" data-tab-id="1">
            <h3>Datos Personales</h3>
            <div class="input-columns-2">
                <div>
                    <label for="text-input">Nombres</label>
                    <input type="text" placeholder="Coloque su nombre" id="text-input">
                </div>

                <div>
                    <label for="text-input">Apellido Paterno</label>
                    <input type="text" placeholder="Coloque su apellido paterno" id="text-input">
                </div>

                <div>
                    <label for="text-input">Apellido Materno</label>
                    <input type="text" placeholder="Coloque su apellido materno" id="text-input">
                </div>

                <div>
                    <label for="text-input">Número de empleado EDEMEX</label>
                    <input type="text" placeholder="Número de empleado EDEMEX" id="text-input">
                </div>

                <div>
                    <label for="text-input">Telefono de casa</label>
                    <input type="text" placeholder="Coloque su telefono de casa" id="text-input">
                </div>

                <div>
                    <label for="text-input">Telefono Celular</label>
                    <input type="text" placeholder="Coloque su telefono celular" id="text-input">
                </div>

                <div>
                    <label for="text-input">Email de EDEMEX</label>
                    <input type="text" placeholder="Coloque su email de EDEMEX" id="text-input">
                </div>

                <div>
                    <label for="text-input">Email Personal</label>
                    <input type="text" placeholder="Coloque su email personal" id="text-input">
                </div>

                <div>
                    <label for="select-input">Rol</label>
                    <select id="select-input">
                        <option value="">Docente</option>
                        <option value="">Asistente</option>
                    </select>
                </div>

                <div>
                    <label for="text-input">Fotografia</label>
                    <input type="file" placeholder="Coloque su fotografia" id="text-input">
                </div>
            </div>
        </div>
        {{--Fin Datos personales --}}

        <div class="mt-2" data-tab-id="2">
            <h3>Datos de la Carrera Profesional</h3>
            <div class="input-columns-2">
                <div>
                    <label for="text-input-2">Nombre del campo 2</label>
                    <input type="text" placeholder="Este es un placeholder" id="text-input-2">
                </div>
                <div>
                    <label for="select-input-2">Nombre del campo 2</label>
                    <select id="select-input-2">
                        <option value="">opcion 1</option>
                        <option value="">opcion 2</option>
                        <option value="">opcion 3</option>
                    </select>
                </div>
            </div>
        </div>

    </form>

@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('js/utilities/menu.js') }}"></script>
@endsection
