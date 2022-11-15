@extends('layout.app')

@section('title', 'Ejemplo con AnexGrid')
@section('content')

<!-- Scripts -->
<script src="{{ asset('assets/js/jquery-3.6.1.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.anexgrid.js') }}"></script>

<div class="row">
    <div class="col-12">
        <h1>Anexgrid</h1>
        <a id="export" href="{{ route('reporteEjemplo', ['temp1', 'temp2', 'temp3']) }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-spreadsheet-fill" viewBox="0 0 16 16">
                <path d="M12 0H4a2 2 0 0 0-2 2v4h12V2a2 2 0 0 0-2-2zm2 7h-4v2h4V7zm0 3h-4v2h4v-2zm0 3h-4v3h2a2 2 0 0 0 2-2v-1zm-5 3v-3H6v3h3zm-4 0v-3H2v1a2 2 0 0 0 2 2h1zm-3-4h3v-2H2v2zm0-3h3V7H2v2zm4 0V7h3v2H6zm0 1h3v2H6v-2z"/>
            </svg>
            <span>Exportar</span>
        </a>
    </div>
    <div class="col-12" id="datatable"></div>
</div>

<meta name="csrf-token" content="{{ csrf_token() }}">
<script>
    $(document).ready(function(){
        $('#datatable').anexGrid({
            class: 'table',
            columnas: [
                {leyenda: 'id', ordenable: true, columna: 'id_informacion_academica', filtro: true},
                {leyenda: 'Experiencia presencial', ordenable: true, columna: 'experiencia_presencial', filtro: true},
                {leyenda: 'Experiencia en linea', ordenable: true, columna: 'experiencia_linea', filtro: true},
                {leyenda: 'Mayor nivel de experiencia', ordenable: true, columna: 'nivel_mayor_experiencia', filtro: false},
                {leyenda: 'Modalidad', ordenable: true, columna: 'modalidad', filtro: false},
            ],
            modelo: [
                {propiedad: 'id_informacion_academica'},
                {propiedad: 'experiencia_presencial'},
                {propiedad: 'experiencia_linea'},
                {propiedad: 'nivel_mayor_experiencia'},
                {propiedad: 'modalidad'}
            ],
            url: 'getInformacionAcademicas', // * url de la informacion
            paginable: true,
            filtrable: true,
            limite: [10, 20, 50, 100],
            columna: 'id',
            columna_orden: 'DESC'
        });
    });
</script>

<script>
    $(document).ready(function(){
        setFiltros();
    });

    function setFiltros(){
        let arreglo = {
            id: 'null',
            experiencia_presencial: 'null',
            experiencia_linea: 'null',
        }

        setUrl(arreglo);
        let filtroId = $("input[data-columna = 'id_informacion_academica']");
        let filtroExperienciaPresencial = $("input[data-columna = 'experiencia_presencial']");
        let filtroExperienciaLinea = $("input[data-columna = 'experiencia_linea']");
        filtroId.keyup(function(e){
            if(e.key === 'Enter'){
                arreglo = {
                    id: filtroId.val() == '' ? 'null' : filtroId.val(),
                    experiencia_presencial: filtroExperienciaPresencial.val() == '' ? 'null' : filtroExperienciaPresencial.val(),
                    experiencia_linea: filtroExperienciaLinea.val() == '' ? 'null' : filtroExperienciaLinea.val()
                };

                setUrl(arreglo);
            }
        });

        filtroExperienciaPresencial.keyup(function(e){
            if(e.key === 'Enter'){
                arreglo = {
                    id: filtroId.val() == '' ? 'null' : filtroId.val(),
                    experiencia_presencial: filtroExperienciaPresencial.val() == '' ? 'null' : filtroExperienciaPresencial.val(),
                    experiencia_linea: filtroExperienciaLinea.val() == '' ? 'null' : filtroExperienciaLinea.val()
                };

                setUrl(arreglo);
            }
        });

        filtroExperienciaLinea.keyup(function(e){
            if(e.key === 'Enter'){
                arreglo = {
                    id: filtroId.val() == '' ? 'null' : filtroId.val(),
                    experiencia_presencial: filtroExperienciaPresencial.val() == '' ? 'null' : filtroExperienciaPresencial.val(),
                    experiencia_linea: filtroExperienciaLinea.val() == '' ? 'null' : filtroExperienciaLinea.val()
                };

                setUrl(arreglo);
            }
        });
    }

    function setUrl(arreglo){
        url_temp = "{{ route('reporteEjemplo', ['temp1', 'temp2', 'temp3']) }}";
        url = url_temp
            .replace('temp1', arreglo.id)
            .replace('temp2', arreglo.experiencia_presencial)
            .replace('temp3', arreglo.experiencia_linea);

        $('#export').attr('href', url);
    }
</script>
@endsection
