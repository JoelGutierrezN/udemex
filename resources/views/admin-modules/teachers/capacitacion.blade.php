{{-- Subida de Documentos --}}

        <style>
            #capacitacion-inputs-1{
                display: grid;
                grid-template-columns: 1fr 1fr 1fr;
                gap: 3px;
            }
            #capacitacion-inputs-2{
                display: grid;
                grid-template-columns: 1fr 1fr 1fr 1fr 1fr 0.5fr;
                gap: 3px;
            }
            #capacitacion-inputs-1 li, #capacitacion-inputs-2 li {
                width: 100%;
            }
            #capacitacion-inputs-1 li input, #capacitacion-inputs-1 li select, #capacitacion-inputs-2 li input, #capacitacion-inputs-2 li select{
                height: 3.5rem;
            }
        </style>
        <div class="mt-2" data-tab-id="4">
            <h3 class="tab--title">
                    <label for="text-input"> Anexar constancias con registro de datos:</label>
            </h3>
            <div class="">
                <div><br><br>

                        <form id="archivos-form" action="{{ route('admin.teachers.updateFiles') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <ul class="col3" id="capacitacion-inputs-1">
                                <li class="formlabel is-required">Nombre completo</li>
                                <li class="formlabel is-required" >Nombre completo de la institución donde se tomó</li>
                                <li class="formlabel is-required">Categoría de petición</li>
                                <li><input name="nombre" type="text" placeholder="Nombre de capacitación" id="capacitacionSolicitud-nombre"></li>
                                <li><input name="instituto" type="text" placeholder="Institución donde se tomó la capacitación" id="capacitacion-instituto"></li>
                                <li><select style="margin-top:10px" class="" name="solicitud" id="capacitacion-solicitud">
                                    <option value="dentro">Dentro de UDEMEX</option>
                                    <option value="fuera">Fuera de UDEMEX</option>
                                </select></li>
                        </ul>
                        <ul class="col6" id="capacitacion-inputs-2">
                            <li class="formlabel is-required">Inicio</li>
                            <li class="formlabel is-required">Fin</li>
                            <li class="formlabel is-required">Número de horas</li>
                            <li class="formlabel is-required">Tipo</li>
                            <li class="formlabel is-required">Documento de respaldo</li>
                            <li style="color:white">Agregar</li>
                            <li><input name="inicio" type="date" placeholder="Inicio de capacitacion" id="capacitacion-inicio"></li>
                            <li><input name="fin" type="date" placeholder="Inicio de capacitacion" id="capacitacion-fin"></li>
                            <li><input class="largo" name="horas" type="number" placeholder="Total de horas" id="capacitacion-horas"
                             onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;"
                             autocomplete="off"></li>
                            <li><select class="" name="tipo" id="capacitacion-tipo">
                                <option value="conferencia">Conferencia</option>
                                <option value="curso">Curso</option>
                                <option value="taller">Taller</option>
                                <option value="diplomado">Diplomado</option>
                                <option value="seminario">Seminario</option>
                                <option value="acreditacion">Acreditación</option>
                                <option value="certificacion">Certificación</option>
                            </select></li>
                            <li><input type="file" accept="application/pdf" name="evidencia" placeholder="Coloque su evidencia" id="capacitacion-evidencia" required>Subir archivo PDF no mayor a 2 Mb</li>
                            <li><button id="agregar-capacitacion" type="submit" class="btnplus"><img class="icon" src="{{ asset('img/save.png')}}" height ="40" width="40" /></button></li>
                        </ul>
                        </form>
                        
                     <br><br><br>

                    <label style="font-size: 2rem;" for="text-input"> Capacitación solicitada en UDEMEX</label>


                    <table id="table-capacitaciones" style="font-size: 1.3rem;">
                        <thead>
                            <tr>
                                <th>Nombre completo</th>
                                <th>Institución donde se tomó</th>
                                <th>Inicio</th>
                                <th>Fin</th>
                                <th>Horas</th>
                                <th>Tipo</th>
                                <th>Archivo</th>
                                <th>Operaciones</th>
                            </tr>
                        </thead>
                        <tbody id="capacitaciones-table-dentro"></tbody>
                      </table>

                      <br><br><br>


                      <label for="text-input" style="font-size: 2rem;"> Capacitación tomada afuera de UDEMEX</label>

                      <table id="table-capacitaciones" style="font-size: 1.3rem;">
                        <thead>
                            <tr>
                                <th>Nombre completo</th>
                                <th>Institución donde se tomó</th>
                                <th>Inicio</th>
                                <th>Fin</th>
                                <th>Horas</th>
                                <th>Tipo</th>
                                <th>Archivo</th>
                                <th>Operaciones</th>
                            </tr>
                        </thead>
                        <tbody id="capacitaciones-table-fuera"></tbody>
                      </table>

                </div><br>
                <div id="capacitacion-ultima-actualizacion">
                    <div style="width: 49%; display: inline-block">
                        <p  id="campos-obligatorios"></p>
                    </div>
                    <div class="alert-info2" style="width: 49%; display: inline-block; padding: 5px;">
                        <p>Información actualizada a la fecha: <span id="c-actualizacion"></span></p>
                    </div>
                </div>
                <br><br><br>


            </div>
        </div>
        {{--Fin Subida de Documentos --}}
<script>
    var archivosMenu = document.querySelector('#archivos-menu');

    var enviarCapacitacion = document.querySelector('#agregar-capacitacion');

    let archivosForm = document.querySelector('#archivos-form');

    enviarCapacitacion.addEventListener('click', (e)=>{
        e.preventDefault();
        let data = new FormData(archivosForm);
        //data.append('_token', '{{ csrf_token() }}');
        console.log(data);

        fetch("/administradores/updateFiles?id={{ $usuario->id_usuario }}", {
                method: 'POST',
                headers: new Headers({
                    'X-CSRF-Token': '{{ csrf_token() }}'
                }),
                body: data
            }).then((response) => response.json())
            .then((response)=>{
                getCapacitacionData();
                document.querySelector('#capacitacion-nombre').value='';
                document.querySelector('#capacitacion-instituto').value='';
                document.querySelector('#capacitacion-inicio').value='';
                document.querySelector('#capacitacion-fin').value='';
                document.querySelector('#capacitacion-solicitud').value='';
                document.querySelector('#capacitacion-tipo').value='';
                document.querySelector('#capacitacion-evidencia').value='';
                document.querySelector('#capacitacion-horas').value='';
                Swal.fire('Registro realizado correctamente', '', 'success');
            });

        Swal.fire('Cargando', 'Espera un momento', 'info');
    });

    archivosMenu.addEventListener('click', ()=>{
        getCapacitacionData();
        getLastCapacitacion()
    });

    function getCapacitacionData(){
        fetch('/administradores/getCapacitaciones/{{ $usuario->id_usuario }}')
            .then(response => response.json())
            .then((response)=>{
                createCapacitacionTable(response[0], 'dentro');
                createCapacitacionTable(response[1], 'fuera');
            });
        }

    function createCapacitacionTable(data, tabla){
        let table = document.querySelector(`#capacitaciones-table-${tabla}`);
        table.innerHTML = '';
        //console.log('a');
        data.forEach((element)=>{
                    let tr = document.createElement('tr');

                    getLastCapacitacion()

                    // Get the modal
                    var modal = document.getElementById("myModal");
                    // Get the <span> element that closes the modal
                    var span = document.getElementsByClassName("close")[0];

                    let iframe = document.querySelector('#archivo-view');

                    // * Columnas
                    let nombre_curso = document.createElement('td');
                    let nombre_institucion = document.createElement('td');
                    let fecha_inicio = document.createElement('td');
                    let fecha_fin = document.createElement('td');
                    let horas = document.createElement('td');
                    let tipo_curso = document.createElement('td');
                    let constancia_pdf = document.createElement('td');
                    let opciones = document.createElement('td');
                    let deleteButton = document.createElement('a');
                    let pdfPreview = document.createElement('a')

                    opciones.setAttribute('style', 'text-align: center;');

                    // * Asignaciones
                    nombre_curso.innerHTML = `${element.nombre_curso}`;
                    nombre_institucion.innerHTML = `${ element.nombre_institucion }`;
                    fecha_inicio.innerHTML = new Date(element.fecha_inicio).toLocaleDateString('es-MX');
                    fecha_fin.innerHTML = new Date(element.fecha_fin).toLocaleDateString('es-MX');
                    horas.innerHTML = `${ element.horas }`;
                    tipo_curso.innerHTML = `${ element.tipo_curso }`;
                    pdfPreview.innerHTML = `<img src="https://cdn-icons-png.flaticon.com/512/337/337946.png" class="icon" alt="" height ="40" width="40">`;
                    deleteButton.innerHTML = `<a><img class="icon" src="https://cdn-icons-png.flaticon.com/512/8568/8568248.png" alt="" height ="40" width="40"><div>`;


                    // * Attr
                    constancia_pdf.setAttribute('align', 'center');
                    deleteButton.setAttribute('id', `delete-capacitacion-${ element.id_capacitacion }`);

                    // * Appends
                    tr.appendChild(nombre_curso);
                    tr.appendChild(nombre_institucion);
                    tr.appendChild(fecha_inicio);
                    tr.appendChild(fecha_fin);
                    tr.appendChild(horas);
                    tr.appendChild(tipo_curso);
                    constancia_pdf.appendChild(pdfPreview);
                    tr.appendChild(constancia_pdf);
                    opciones.appendChild(deleteButton);
                    tr.appendChild(opciones);
                    table.appendChild(tr);

                    // When the user clicks on <span> (x), close the modal
                    span.onclick = function() {
                        modal.style.display = "none";
                        modal.setAttribute('src', '');
                        iframe.setAttribute('src', '');
                        document.getElementById('archivo-view').contentWindow.location.reload(true);
                    }

                    // When the user clicks anywhere outside of the modal, close it
                    window.onclick = function(event) {
                        if (event.target == modal) {
                            modal.style.display = "none";
                            modal.setAttribute('src', '');
                            iframe.setAttribute('src', '');
                            document.getElementById('archivo-view').contentWindow.location.reload(true);
                            iframe.src = iframe.src;
                        }
                    }

                    // * Eventlisteners
                    pdfPreview.addEventListener('click', (e)=>{
                        e.preventDefault();
                        /*
                         * TODO:
                         * ESTA LINEA ES PARA PRODUCCION TEMPORALMENTE BUSCAR UNA FORMA DE SOLUCION
                            let archivo = `{{ env('app_url') }}documentos/Capacitaciones/${element.constancia_pdf}`;
                         */

                        let archivo = `documentos/Capacitaciones/${element.constancia_pdf}`;

                        iframe.src ='{{ asset("") }}'+archivo;
                        modal.style.display = "block";
                    });

                    deleteButton.addEventListener('click', (e)=>{
                        e.preventDefault();
                        Swal.fire({
                            title: '¿Deseas eliminar el archivo?',
                            confirmButton: 'Si',
                            showCancelButton: true,
                            cancelButtonText: 'Cancelar'
                        }).then((result)=>{
                            if(result.isConfirmed){
                                fetch(`/administradores/delete-capacitacion/${ element.id_capacitacion }?id={{ $usuario->id_usuario }}`)
                                    .then((response) => response.json())
                                    .then((response) => {
                                        getLastCapacitacion()
                                        Swal.fire(response[0].alert, '', 'success');
                                        table.removeChild(tr);
                                    }).catch((error)=>{
                                        Swal.fire('Lo sentimos, ocurrio un error', 'Intenta de nuevo mas tarde', 'error');
                                    });
                            }
                        });
                    });
                });
    }

    function getLastCapacitacion(){
        fetch('{{ route("admin.teachers.lastCapacitacion", ['id' => $usuario->id_usuario]) }}')
            .then( response => response.json() )
            .then( ({ created_at }) => {
                console.log(created_at);
                document.querySelector('#c-actualizacion').innerHTML = new Date(created_at).toLocaleDateString('es-MX');
            });
    }
</script>
