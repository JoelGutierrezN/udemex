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
      Highcharts.chart('container-2', {
        chart: {
          type: 'column'
        },
        title: {
          align: 'left',
          text: 'Histoarial academico'
        },
        accessibility: {
            announceNewData: {
              enabled: true
            },
            point: {
              valueSuffix: '%'
            }
          },
          credits: {
            enabled:false
          },
        
          tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
          },

          series: [{
              name: "Browsers",
              colorByPoint: true,
              data: [
                {
                  name: "Chrome",
                  y: 61.04,
                  drilldown: "Chrome"
                },
                {
                  name: "Safari",
                  y: 9.47,
                  drilldown: "Safari"
                },
                {
                  name: "Edge",
                  y: 9.32,
                  drilldown: "Edge"
                },
                {
                  name: "Firefox",
                  y: 8.15,
                  drilldown: "Firefox"
                },
                {
                  name: "Other",
                  y: 11.02,
                  drilldown: null
                }
              ]
            }
          ],
          
      });
    </script>

    <script>// Create the chart
        Highcharts.chart('container-1', {
          chart: {
            type: 'pie'
          },
          title: {
            text: 'Browser market shares. January, 2022'
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
                format: '{point.name}: {point.y:.1f}%'
              }
            }
          },

          credits: {
            enabled:false
          },
        
          tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
          },
        
          series: [
            {
              name: "Browsers",
              colorByPoint: true,
              data: [
                {
                  name: "Chrome",
                  y: 61.04,
                  drilldown: "Chrome"
                },
                {
                  name: "Safari",
                  y: 9.47,
                  drilldown: "Safari"
                },
                {
                  name: "Edge",
                  y: 9.32,
                  drilldown: "Edge"
                },
                {
                  name: "Firefox",
                  y: 8.15,
                  drilldown: "Firefox"
                },
                {
                  name: "Other",
                  y: 11.02,
                  drilldown: null
                }
              ]
            }
          ],
          drilldown: {
            series: [
              {
                name: "Chrome",
                id: "Chrome",
                data: [
                  [
                    "v97.0",
                    36.89
                  ],
                  [
                    "v96.0",
                    18.16
                  ],
                  [
                    "v95.0",
                    0.54
                  ],
                  [
                    "v94.0",
                    0.7
                  ],
                  [
                    "v93.0",
                    0.8
                  ],
                  [
                    "v92.0",
                    0.41
                  ],
                  [
                    "v91.0",
                    0.31
                  ],
                  [
                    "v90.0",
                    0.13
                  ],
                  [
                    "v89.0",
                    0.14
                  ],
                  [
                    "v88.0",
                    0.1
                  ],
                  [
                    "v87.0",
                    0.35
                  ],
                  [
                    "v86.0",
                    0.17
                  ],
                  [
                    "v85.0",
                    0.18
                  ],
                  [
                    "v84.0",
                    0.17
                  ],
                  [
                    "v83.0",
                    0.21
                  ],
                  [
                    "v81.0",
                    0.1
                  ],
                  [
                    "v80.0",
                    0.16
                  ],
                  [
                    "v79.0",
                    0.43
                  ],
                  [
                    "v78.0",
                    0.11
                  ],
                  [
                    "v76.0",
                    0.16
                  ],
                  [
                    "v75.0",
                    0.15
                  ],
                  [
                    "v72.0",
                    0.14
                  ],
                  [
                    "v70.0",
                    0.11
                  ],
                  [
                    "v69.0",
                    0.13
                  ],
                  [
                    "v56.0",
                    0.12
                  ],
                  [
                    "v49.0",
                    0.17
                  ]
                ]
              },
              {
                name: "Safari",
                id: "Safari",
                data: [
                  [
                    "v15.3",
                    0.1
                  ],
                  [
                    "v15.2",
                    2.01
                  ],
                  [
                    "v15.1",
                    2.29
                  ],
                  [
                    "v15.0",
                    0.49
                  ],
                  [
                    "v14.1",
                    2.48
                  ],
                  [
                    "v14.0",
                    0.64
                  ],
                  [
                    "v13.1",
                    1.17
                  ],
                  [
                    "v13.0",
                    0.13
                  ],
                  [
                    "v12.1",
                    0.16
                  ]
                ]
              },
              {
                name: "Edge",
                id: "Edge",
                data: [
                  [
                    "v97",
                    6.62
                  ],
                  [
                    "v96",
                    2.55
                  ],
                  [
                    "v95",
                    0.15
                  ]
                ]
              },
              {
                name: "Firefox",
                id: "Firefox",
                data: [
                  [
                    "v96.0",
                    4.17
                  ],
                  [
                    "v95.0",
                    3.33
                  ],
                  [
                    "v94.0",
                    0.11
                  ],
                  [
                    "v91.0",
                    0.23
                  ],
                  [
                    "v78.0",
                    0.16
                  ],
                  [
                    "v52.0",
                    0.15
                  ]
                ]
              }
            ]
          }
        });</script>
@endsection
