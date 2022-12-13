<style>
    .graficas{
        display: grid;
        grid-template-columns: 1fr 1fr;
    }
</style>

<h1 id="teachers--title">Listado de docentes</h1>

<section class="selects">
    <table style="margin: auto">
        <tr>
            <td style="text-align: right">
                <label for="plantilla">Seleccion Plantilla</label>
            </td>
            <td style="text-align: right">

                    <select name="plantilla" id="" style="text-align: right">
                        <option value="">sep-2022</option>
                        <option value="">sep-2021</option>
                    </select>

            </td>
        </tr>
        <tr>
            <td style="text-align: right">
                <label for="programa">Seleccione Programa Educativo</label>
            </td>
            <td style="text-align: right">
                    <select name="programa" id="" style="text-align: right">
                        <option value="">Licenciatura en Informatica Administrativa</option>
                        <option value="">Ingenieria en Desarrollo y Gestion de Software</option>
                    </select>
            </td>
        </tr>
    </table>
</section>

<section class="teachers-list">
    <table class="table table-green">
        <thead>
            <tr>
                <th>Clave Profesor</th>
                <th>Nombre Completo</th>
                <th>Asignatura</th>
                <th>Grupo</th>
                <th>No. Estudiantes</th>
                <th>Calificacion</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>23454</td>
                <td>Pedro Perez López</td>
                <td>LIABC1PRPC3 - Programación</td>
                <td>1</td>
                <td>20</td>
                <td>7.6</td>
            </tr>
            <tr>
                <td>253523</td>
                <td>Juan Villa Zamudio</td>
                <td>LIAIP65DWIOP - Diseño Web</td>
                <td>1</td>
                <td>30</td>
                <td>8.5</td>
            </tr>
            <tr>
                <td>52332</td>
                <td>Laura Mendez Robles</td>
                <td>LIABC10EDPC2 - Estructura de Datos</td>
                <td>2</td>
                <td>30</td>
                <td>9.5</td>
            </tr>
            <tr>
                <td>234523</td>
                <td>Patricia Escalona Huerta</td>
                <td>LIASP31ISPC5 - Ingeniería de Software</td>
                <td>2</td>
                <td>25</td>
                <td>6.3</td>
            </tr>
        </tbody>        
    </table>
</section>

<section class="graficas">
    <div id="grafica-pastel"></div>
    <div id="grafica-barras"></div>
</section>

@section('scripts')

<script type="text/javascript" src="{{ asset('js/utilities/menu.js') }}"></script>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/drilldown.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<script>
    Highcharts.chart('grafica-pastel', {
        chart: {
              type: 'pie'
            },
            title: {
              align: 'center',
              text: 'Porcentaje de aprobación'
            },
            accessibility: {
                announceNewData: {
                  enabled: true
                },
              },
              credits: {
                enabled:false
              },
              plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                    }
                }
            },
            lang: {
                downloadPDF: 'Descargar PDF'
            },
            exporting: {
                buttons: {
                    contextButton: {
                        menuItems: ['downloadPDF']
                    }
                }
            },
              tooltip: {
                headerFormat: '<span style="font-size:11px">{point.name}</span><br>',
                pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.percentage:.1f}%</b><br/>'
              },

              series: [{
                  name: "Porcentaje de aprobacion",
                  colorByPoint: true,
                  data: [
                    {
                        name: 'Aprobados',
                        y: 75
                    },
                    {
                        name: 'Reprobados',
                        y: 25
                    }
                  ]
                }
              ],
    });

    Highcharts.chart('grafica-barras', {
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Promedio de evaluación por docente',
            align: 'center'
        },
        xAxis: {
            categories: ['Pedro Perez López', 'Juan Villa Zamudio', 'Laura Mendez Robles', 'Patricia Escalona Huerta']
        },
        lang: {
                downloadPDF: 'Descargar PDF'
            },
            exporting: {
                buttons: {
                    contextButton: {
                        menuItems: ['downloadPDF']
                    }
                }
            },
        series: [{
            name: 'Promedio de evaluacion',
            colorByPoint: true,
            data: [
                {
                    name: 'Pedro Perez López',
                    y: 7.6
                },
                {
                    name: 'Juan Villa Zamudio',
                    y: 8.5
                },
                {
                    name: 'Laura Mendez Robles',
                    y: 9.5
                },
                {
                    name: 'Patricia Escalona Huerta',
                    y: 6.3
                }
            ]
        }]

    })
</script>

@endsection