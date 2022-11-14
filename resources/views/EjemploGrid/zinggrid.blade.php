@extends('layout.app')

@section('title', 'Ejemplo con AnexGrid')
@section('content')

<!-- Scripts -->
<script src="{{ asset('assets/js/jquery-3.6.1.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.anexgrid.js') }}"></script>

<div class="row">
    <div class="col-12">
        <h1>Anexgrid</h1>
        <a id="export" href="{{ route('reporteEjemplo', ['temp1', 'temp2', 'temp3']) }}">Exportar</a>
    </div>
    <div class="col-12" id="datatable"></div>
</div>

<meta name="csrf-token" content="{{ csrf_token() }}">
<script>
    $(document).ready(function(){
        $('#datatable').anexGrid({
            class: 'table table-striped',
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