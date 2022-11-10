<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte</title>
    <style>
        *{
            font-family: Arial;
        }
        .page-break {
            page-break-after: always;
        }
        a{
            color: #575757;
            text-decoration: none;
        }
        h1, h2 {
            color: #575757;
        }
        .header{
            margin: auto;
            width: 80%;

        }
        .logo-container{
            display: inline-block;
            width: 35%;
        }
        .logo-container img{
            width: 100%;
        }
        .title-container{
            text-align: center;
            display: inline-block;
            width: 60%;
        }
        .title-container h1{
            font-size: 1.5em;
        }
        .title-container h2{
            font-size: 1.2em;
        }
        .title-container h1, .title-container h2{
            margin: 0;
        }
        .title-container h2{
            margin-top: -20px;
        }
        hr{
            color: #3CA037;
        }
        th{
            text-align: left;
            width: 25%;
            padding: 5px;
            padding-left: 10px;
        }
        .docente-table td{
            border-bottom: 1px solid #3CA037;
        }
        .docente-table #fecha_head{
            text-align: right;
        }
        .docente-table #grupo_col{
            text-align: center;
        }
        .page-body{
            width: 100%;
        }
        .table-container{
            margin: auto;
            width: 80%;
        }
        .docente-table{
            width: 100%;
        }
        #fecha_head, #fecha_col{
            width: 15%;
        }
        #info_table{
            width: 100%;
        }
        #info_table thead tr{
            background-color: #3CA037;
            color: white;
        }
        #alumno_head{
            width: 30%;
        }
        #calificaciones_head{
            width: 70%;
        }
        #info_table tbody tr td{
            border-bottom: 1px solid;
        }
    </style>
</head>
<body>
        <div class="header">
            <div class="logo-container">
                <img src="data:image/jpg;base64, {{ $image }}" alt="Logo UDEMEX">
            </div>
            <div class="title-container">
                <h1><a href="">UNIVERSIDAD DIGITAL</a></h1><br>
                <h2><a href="">DEL ESTADO DE MÉXICO</a></h2>
            </div>
        </div>
        <hr>
        
        <div class="page-body">
            <div class="table-container">
                <h2>Resultados de evaluacion {{ $info[6] }}</h2>
                <table class="docente-table">
                    <tr>
                        <th id="docente_head">Docente: </th>
                        <td id="docente_col">
                            {{ $info[0] }}
                        </td>
                        <th id="fecha_head">Fecha: </th>
                        <td id="fecha_col">{{ $info[1] }}</td>
                    </tr>
                    <tr>
                        <th id="asignatura_head">Asignatura: </th>
                        <td id="asignatura_col">{{ $info[2] }}</td>
                        <th id="grupo_col" colspan=2>{{ $info[3] }}</th>
                    </tr>
                    <tr>
                        <th id="programa_head">Programa educativo: </th>
                        <td id="programa_col" colspan=3>{{ $info[4] }}</td>
                    </tr>
                </table>
                <hr>
                <table id="info_table">
                    <thead>
                        <tr>
                            <th id="alumno_head">Alumno</th>
                            <th id="calificaciones_head">Calificaciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($info[5] as $alumno)
                            <tr>
                                <td>{{ $alumno }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
</body>

</html>