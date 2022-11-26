@extends('layout.app')

@section('title', 'Inicio')

@section('content')

    <style>
      .graficas-container{
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 5px;
      }
    </style>

    <div id="graficas">

        <h3 class="form-screen-title">Ejemplo de Graficas</h3>

        <div class="tabs">
            <button type="button" data-tab-target="1">Grafica de Pastel &blacktriangledown;</button>
            <button type="button" data-tab-target="2">Datos de la Carrera Profesional &blacktriangledown;</button>
        </div>

        <div class="mt-2" data-tab-id="1">
            
              <h3 class="tab--title">Datos Personales</h3>
              <div class="graficas-container">
                <div>
                  <figure class="highcharts-figure">
                    <div id="container-1"></div>
                  </figure>
                </div>
                <div>
                  <figure class="highcharts-figure">
                    <div id="container-2"></div>
                  </figure>
                </div>
              </div>
        </div>

        <div class="mt-2" data-tab-id="2">
            <h2>Pagina en construccion</h2>
        </div>


</div>

@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('js/utilities/menu.js') }}"></script>

    <script>

      fetch('{{ route("admin.getDataHistorial") }}')
        .then((response) => response.json())
        .then((response) => {
          Highcharts.chart('container-2', {
            chart: {
              type: 'column'
            },
            title: {
              align: 'left',
              text: 'Historial academico'
            },
            subtitle: {
              align: 'left',
              text: 'Instituciones donde se ha estudiado'
            },
            accessibility: {
                announceNewData: {
                  enabled: true
                },
              },
              credits: {
                enabled:false
              },
            
              tooltip: {
                headerFormat: '<span style="font-size:11px">Institucion</span><br>',
                pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b><br/>'
              },

              series: [{
                  name: "Instituciones",
                  colorByPoint: true,
                  data: response
                }
              ],
              
          });
        })
    </script>

    <script>// Create the chart

      fetch('{{ route("admin.getDataHistorial") }}')
        .then((response) => response.json())
        .then((response) => {
          Highcharts.chart('container-1', {
          chart: {
            type: 'pie'
          },
          title: {
            text: 'Historial academico'
          },
          subtitle: {
              align: 'left',
              text: 'Instituciones donde se ha estudiado'
            },
          accessibility: {
            announceNewData: {
              enabled: true
            },
            point: {
              valueSuffix: '%'
            }
          },
        
          plotOptions: {
            series: {
              dataLabels: {
                enabled: true,
                format: '{point.name}: {point.y}'
              }
            }
          },

          credits: {
            enabled:false
          },
        
          tooltip: {
            headerFormat: '<span style="font-size:11px">Institucion</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b><br/>'
          },
        
          series: [
            {
              name: "Browsers",
              colorByPoint: true,
              data: response
            }
          ]  
          });
        });
        </script>
@endsection
