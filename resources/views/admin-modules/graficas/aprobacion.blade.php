<style>
    table{
        margin: auto;
    }
    td div{
        display: inline-block;
        margin:10px;
    }

    .graficas-1{
        display: grid;
        grid-template-columns: 1fr 1fr;
    }
</style>

<h1 id="teachers--title">Porcentaje de aprobación en la evaluación docente</h1>

<section class="plantilla">
    <table>
        <tr>
            <td style="text-align: right"><label for="plantilla">Seleccione plantilla</label></td>
            <td>
                <select name="plantilla" id="" style="text-align: right">
                    <option value="">sep-2022</option>
                    <option value="">sep-2021</option>
                </select>
            </td>
        </tr>
        <tr>
            <td style="text-align: right">
                <label for="nivel">Seleccione nivel educativo</label>
            </td>
            <td>
                    <div>
                        <input type="radio" name="" id="bachillerato"><label for="">Bachillerato</label>
                    </div>
                    <div>
                        <input type="radio" name="" id="tsu"  checked><label for="">TSU</label>
                    </div>
                    <div>
                        <input type="radio" name="" id="licenciatura"  checked><label for="">Licenciatura</label>
                    </div>
                    <div>
                        <input type="radio" name="" id="postgrado"  checked><label for="">Postgrados</label>
                    </div>
            </td>
        </tr>
    </table>
</section>

<section>
    <table class="table table-green">
        <thead>
            <tr>
                <th>Programa Educativo</th>
                <th>Nivel</th>
                <th>Profesores Evaluados</th>
                <th>Alumnos que contestaron la encuesta</th>
                <th>Promedio de evaluacion docente</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Licenciatura en Informatica Administrativa</td>
                <td>Licenciatura</td>
                <td>23</td>
                <td>50</td>
                <td>9.6</td>
            </tr>
            <tr>
                <td>Licenciatura en Psicologia</td>
                <td>Licenciatura</td>
                <td>30</td>
                <td>40</td>
                <td>7.8</td>
            </tr>
            <tr>
                <td>Licenciatura en Seguridad Publica</td>
                <td>Licenciatura</td>
                <td>45</td>
                <td>60</td>
                <td>6.5</td>
            </tr>
            <tr>
                <td>Licenciatura en Administración de Ventas</td>
                <td>Licenciatura</td>
                <td>24</td>
                <td>30</td>
                <td>8.6</td>
            </tr>
            <tr>
                <td>TSU en Informatica</td>
                <td>TSU</td>
                <td>34</td>
                <td>70</td>
                <td>7.6</td>
            </tr>
            <tr>
                <td>Maestria en Administración Publica y Gobierno</td>
                <td>Postgrado</td>
                <td>23</td>
                <td>20</td>
                <td>8.2</td>
            </tr>
            <tr>
                <td>Maestria en Tecnologia Digital para la Educación</td>
                <td>Postgrado</td>
                <td>15</td>
                <td>10</td>
                <td>9.8</td>
            </tr>
        </tbody>
    </table>
</section>

<section class="graficas-1">
    <div id="grafica-barras-1"></div>
    <div id="grafica-pastel-1"></div>
</section>

<script type="text/javascript" src="{{ asset('js/utilities/menu.js') }}"></script>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/drilldown.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<script>
    Highcharts.chart(
        'grafica-pastel-1', {
            chart: {
                type: 'pie'
            },
            title: {
                text: 'Porcentaje de alumnos que aplicaron la evaluación docuente por Programa educativo',
                align: 'center'
            },
            tooltip: {
                headerFormat: '<span style="font-size:11px">{point.name}</span><br>',
                pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.percentage:.1f}%</b><br/>'
            },
            series: [{
                  name: "Porcentaje de aplicación",
                  colorByPoint: true,
                  data: [
                    {
                        name: 'Licenciatura en Informatica Administrativa',
                        y: 50
                    },
                    {
                        name: 'Licenciatura en Psicologia',
                        y: 40
                    },
                    {
                        name: 'Licenciatura en Seguridad Publica',
                        y: 60
                    },
                    {
                        name: 'Licenciatura en Administracion de Ventas',
                        y: 30
                    }
                  ]
                }
              ],
        }
    );
</script>

<script>
    Highcharts.chart('grafica-barras-1', {
        chart: {
            type: 'column'
        },
        title: {
            text: "Aprobados VS No aprobados por programa educativo",
            align: 'center'
        },
        xAxis: {
            categories: ['TSU', 'Licenciatura', 'Postgrado']
        },
        yAxis: {
            title: null,
        },
        series: [{
                name: 'Aprobados',
                data: [30, 40, 35],
                stack: 'Asia'
            }, {
                name: 'Reporbados',
                data: [4, 1, 4],
                stack: 'Europe'
            }
        ]
    });
</script>