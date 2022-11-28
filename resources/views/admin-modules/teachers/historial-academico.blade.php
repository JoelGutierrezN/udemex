{{-- Inicio historial academico --}}

<style>
    #historialAcademico-form ul{
        display: grid;
        grid-template-columns: 1fr 1fr 1fr 1fr 1fr;
        gap: 5px;
    }
    #historialAcademico-form ul li{
        width: 100%;
    }
    #info-span{
        grid-row: 1/3;
    }
    #historialAcademico-form ul li input, #historialAcademico-form ul li select{
        height: 3.5rem;
    }

</style>

<div class="mt-2" data-tab-id="5">
    <h3 class="tab--title">Historial Académico</h3>

    <div class="">
        <div>
            <label for="text-input">Estudios concluidos</label>
            <form action="{{ route('admin.teachers.storeHistorial') }}" method="post" enctype="multipart/form-data" id="historialAcademico-form">
                @csrf
                <ul class="col5" id="ul-form-historial">
                    <li class="formlabel is-required">Nombre del titulo</li>
                    <li class="formlabel is-required">Nombre de la institución</li>
                    <li class="formlabel is-required">Inicio</li>
                    <li class="formlabel is-required">Fin</li>
                    <li class="formlabel is-required">Nivel Escolar</li>

                    <li><input name="nombre" type="text" autocomplete="off" placeholder="Nombre completo del titulo" id="historial-nombre"></li>
                    <li><input name="institucion" type="text" autocomplete="off" placeholder="Nombre completo de la institucion donde se estudio" id="historial-institucion"></li>
                    <li><input name="inicio" type="date" placeholder="Inicio de capacitación" id="historial-inicio"></li>
                    <li><input name="fin" type="date" placeholder="Fin de capacitación" id="historial-fin"></li>
                    <li>
                        <select style="margin-top:10px" class="" name="nivel" id="historial-nivel">
                            <option value="Licenciatura">Licenciatura</option>
                            <option value="Maestría">Maestría</option>
                            <option value="Doctorado">Doctorado</option>
                            <option value="Especialidad">Especialidad</option>
                        </select>
                    </li>
                </ul>

                <ul class="col5">
                    <li class="formlabel" id="info-span">
                        <span>Tipo de documento</span>
                        <p style="font-size:13px; margin-top:-1.5%">Los archivos subidos no deben exceder los 2MB, solo se permiten archivos PDF</p>
                    </li>
                    <li class="formlabel is-required">Título</li>
                    <li class="formlabel is-required">Certificado</li>
                    <li class="formlabel is-required">Cédula</li>
                    <li>&#160;</li>

                    <li>
                        <input id="historial-titulo" type="file" name="titulo" placeholder="titulo" class="formlabel" accept="application/pdf" required>
                    </li>
                    <li>
                        <input id="historial-certificado" type="file" name="certificado" placeholder="certificado" class="formlabel" accept="application/pdf" required>
                    </li>
                    <li>
                        <input id="historial-cedula" type="file" name="cedula" placeholder="cedula" class="formlabel" accept="application/pdf" required>
                    </li>
                    <li><button id="historial-button" type="submit" class="btnplus"><img class="icon" src="{{ asset('img/save.png')}}" height ="40" width="40" /></button></li>
                </ul>
            </form>
            <div id="historial-ultima-actualizacion">
                <div style="width: 49%; display: inline-block">
                    <p class="is-required" id="campos-obligatorios">Campos obligatorios</p>
                </div>
                <div class="alert-info2" style="width: 49%; display: inline-block; padding: 5px;">
                    <p>Información actualizada a la fecha: <span id="h-actualizacion"></span></p>
                </div>
            </div>

            <br>
            <table id="table-historial-academico" style="font-size: 1.3rem;">
                <thead>
                    <tr>
                        <th>Nombre del titulo</th>
                        <th>Nombre de la institución</th>
                        <th>Inicio</th>
                        <th>Fin</th>
                        <th>Nivel Escolar</th>
                        <th>Archivos</th>
                        <th>Operaciones</th>
                    </tr>
                </thead>

                <tbody id="historial-table"></tbody>
            </table>
        </div>
    </div>
    <br><br><br>
</div>
<script>
    var historialMenu = document.querySelector('#historial-menu');

    var historialForm = document.querySelector('#historialAcademico-form');
    var historialButton = document.querySelector('#historial-button');


    historialButton.addEventListener('click', (e)=>{
        e.preventDefault();
        let data = new FormData(historialForm);

        fetch("/administradores/storeHistorial?id={{ $usuario->user->id }}", {
                method: 'POST',
                headers: new Headers({
                    'X-CSRF-Token': '{{ csrf_token() }}'
                }),
                body: data
            }).then((response) => response.json())
            .then((response)=>{
                createHistorialTable();
                document.querySelector('#historial-nombre').value= '';
                document.querySelector('#historial-institucion').value= '';
                document.querySelector('#historial-inicio').value= '';
                document.querySelector('#historial-fin').value= '';
                document.querySelector('#historial-nivel').value= '';
                document.querySelector('#historial-titulo').value= '';
                document.querySelector('#historial-cedula').value= '';
                document.querySelector('#historial-certificado').value= '';
                Swal.fire('Registro realizado correctamente', '', 'success');
            }).catch((error)=>console.log);

        Swal.fire('Cargando', 'Espera un momento', 'info');
    });

    function createHistorialTable(){
        fetch("{{ env('APP_URL') }}/administradores/getHistorial/{{ $usuario->user->id }}")
            .then((response) => response.json())
            .then((response) => {

                getLastHistorial();

                // Get the modal
                var modal = document.getElementById("myModal");
                // Get the <span> element that closes the modal
                var span = document.getElementsByClassName("close")[0];

                let iframe = document.querySelector('#archivo-view');

                let table = document.querySelector('#historial-table');
                table.innerHTML = '';
                response.forEach((element) => {
                    let tr = document.createElement('tr');
                    let nombre = document.createElement('td');
                    let institucion = document.createElement('td');
                    let inicio = document.createElement('td');
                    let fin = document.createElement('td');
                    let nivel = document.createElement('td');
                    let archivos = document.createElement('td');
                    let opciones = document.createElement('td');
                    let deleteButton = document.createElement('a');

                    let documentosTable = document.createElement('table');
                    let titulo = document.createElement('tr');
                    let certificado = document.createElement('tr');
                    let cedula = document.createElement('tr');

                    opciones.setAttribute('style', 'text-align: center;');
                    titulo.setAttribute('style', 'cursor: pointer;');
                    certificado.setAttribute('style', 'cursor: pointer;');
                    cedula.setAttribute('style', 'cursor: pointer;');

                    nombre.innerHTML = element.nombre_asignatura;
                    institucion.innerHTML = element.nombre_institucion;
                    inicio.innerHTML = new Date(element.fecha_inicio).toLocaleDateString('es-MX');
                    fin.innerHTML = new Date(element.fecha_fin).toLocaleDateString('es-MX');
                    nivel.innerHTML = element.nivel_escolar;
                    titulo.innerHTML = `<span><img src="https://cdn-icons-png.flaticon.com/512/337/337946.png" class="icon" alt="" height ="20" width="20">Ver título</span>`;
                    certificado.innerHTML = `<span><img src="https://cdn-icons-png.flaticon.com/512/337/337946.png" class="icon" alt="" height ="20" width="20">Ver cerfiticado</span>`;
                    cedula.innerHTML = `<span><img src="https://cdn-icons-png.flaticon.com/512/337/337946.png" class="icon" alt="" height ="20" width="20">Ver cédula</span>`;

                    deleteButton.innerHTML = `<img class="icon" src="https://cdn-icons-png.flaticon.com/512/8568/8568248.png" alt="" height ="40" width="40">`;

                    tr.appendChild(nombre);
                    tr.appendChild(institucion);
                    tr.appendChild(inicio);
                    tr.appendChild(fin);
                    tr.appendChild(nivel);
                    archivos.appendChild(titulo);
                    archivos.appendChild(certificado);
                    archivos.appendChild(cedula);
                    tr.appendChild(archivos);
                    opciones.appendChild(deleteButton)
                    tr.appendChild(opciones);
                    table.appendChild(tr);

                    // When the user clicks on <span> (x), close the modal
                    span.onclick = function() {
                        modal.style.display = "none";
                    }

                    // When the user clicks anywhere outside of the modal, close it
                    window.onclick = function(event) {
                        if (event.target == modal) {
                            modal.style.display = "none";
                        }
                    }

                    titulo.addEventListener('click',(e)=>{
                        let archivo = `documentos/Historial/${element.titulo}`;
                        iframe.setAttribute('data', '{{ asset("") }}'+archivo);
                        modal.style.display = "block";
                    });
                    certificado.addEventListener('click',(e)=>{
                        let archivo = `documentos/Historial/${element.certificado}`;
                        iframe.setAttribute('data', '{{ asset("") }}'+archivo);
                        modal.style.display = "block";
                    });
                    cedula.addEventListener('click',(e)=>{
                        let archivo = `documentos/Historial/${element.cedula}`;
                        iframe.setAttribute('data', '{{ asset("") }}'+archivo);
                        modal.style.display = "block";
                    });

                    deleteButton.addEventListener('click', (e)=>{
                        Swal.fire({
                            title: '¿Deseas eliminar el archivo?',
                            confirmButton: 'Si',
                            showCancelButton: true,
                            cancelButtonText: 'Cancelar'
                        }).then((response)=>{
                            if(response.isConfirmed){
                                fetch(`{{ env('APP_URL') }}/administradores/delete-historial/${ element.id_asignatura }`)
                                    .then((response) => response.json())
                                    .then((response) => {
                                        getLastHistorial();
                                        Swal.fire(response[0].alert, '', 'success');
                                        table.removeChild(tr);
                                    }).catch((error)=>{
                                        Swal.fire('Lo sentimos, ocurrio un error', 'Intenta de nuevo mas tarde', 'error');
                                    });
                            }
                        });
                    });
                });
            });
    }

    function getLastHistorial(){
        fetch('{{ route("admin.teachers.lastHistorial", ['id' => $usuario->user->id]) }}')
            .then( (response) => response.json() )
            .then( ({ created_at }) => {
                document.querySelector('#h-actualizacion').innerHTML = new Date(created_at).toLocaleDateString('es-MX');
            });
    }


    historialMenu.addEventListener('click', (e)=>{
        createHistorialTable();
        getLastHistorial();
    });
</script>
