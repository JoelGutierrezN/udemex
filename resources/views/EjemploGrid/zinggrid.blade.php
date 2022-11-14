@extends('layout.app')

@section('title', 'Ejemplo con Zingrid')
@section('content')

<script src="{{ asset('assets/js/jquery-3.6.1.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.anexgrid.js') }}"></script>

<div class="row">
    <div class="col-12">
        <h1>Zinggrid</h1>
        <a id="export" href="{{ route('reporteEjemplo', ['temp1', 'temp2']) }}">Exportar</a>
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
                {leyenda: 'Mayor nivel de experiencia', ordenable: true, columna: 'nivel_mayor_experiencia', filtro: true},
                {leyenda: 'Modalidad', ordenable: true, columna: 'modalidad', filtro: true},              
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
            filtro: 'null',
            value: 'null'
        }

        setUrl(arreglo);
        let filtroId = $("input[data-columna = 'id_informacion_academica']");
        filtroId.keyup(function(e){
            if(e.key === 'Enter'){
                arreglo = {
                    filtro: 'id_informacion_academica',
                    value: filtroId.val()
                };

                setUrl(arreglo);
            }
        });

    }

    function setUrl(arreglo){
        url_temp = "{{ route('reporteEjemplo', ['temp1', 'temp2']) }}";
        url = url_temp
            .replace('temp1', arreglo.filtro)
            .replace('temp2', arreglo.value);

        $('#export').attr('href', url);
    }
</script>
@endsection