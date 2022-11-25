@extends('layout.app')

@section('title', 'Inicio')

@section('content')

    <form action="#" method="POST">
        @csrf
        @method('POST')

        <h3 class="form-screen-title">Ejemplo de Graficas</h3>

        <div class="tabs">
            <button type="button" data-tab-target="1">Datos Personales &blacktriangledown;</button>
            <button type="button" data-tab-target="2">Datos de la Carrera Profesional &blacktriangledown;</button>
        </div>

        <div class="mt-2" data-tab-id="1">
            <h3 class="tab--title">Datos Personales</h3>
            <div class="input-columns-2">
                <div>
                    <label for="text-input">Nombre del campo</label>
                    <input type="text" placeholder="Este es un placeholder" id="text-input">
                </div>

                <div>
                    <label for="select-input">Nombre del campo</label>
                    <select id="select-input">
                        <option value="">opcion 1</option>
                        <option value="">opcion 2</option>
                        <option value="">opcion 3</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="mt-2" data-tab-id="2">
            <h3 class="tab--title">Datos de la Carrera Profesional</h3>
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
