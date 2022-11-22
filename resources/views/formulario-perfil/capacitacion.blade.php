{{-- Subida de Documentos --}}
        <div class="mt-2" data-tab-id="4">
            <h3 class="tab--title"> 
                    <label for="text-input"> Anexar constancias con registro de datos:</label>
            </h3>
            <div class="">
                <div><br><br>
                    <ul class="col9">
                        <form id="archivos-form" action="{{ route('teacher.updateFiles') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <li class="formlabel">Nombre completo</li>
                            <li class="formlabel" style="font-size:13px; margin-top:-2%">Nombre completo de la institución donde se tomo</li>
                            <li class="formlabel">Solicitud</li>
                            <li class="formlabel">Inicio</li>
                            <li class="formlabel">Fin</li>
                            <li class="formlabel">Número de horas</li>
                            <li class="formlabel">Tipo</li>
                            <li class="formlabel">Evidencia</li>
                            <li style="color:white">Agregar</li>
                            <li><input name="nombre" type="text" placeholder="Nombre de capacitacion" id="text-input"></li>
                            <li><input style="margin-bottom:-10px" name="instituto" type="text" placeholder="Institución donde se tomo la capacitacion" id="text-input"></li>
                            <li><select style="margin-top:10px" class="" name="solicitud" >
                                <option value="conferencia">Dentro de UDEMEX</option>
                                <option value="curso">Fuera de UDEMEX</option>
                            </select></li>
                            <li><input name="inicio" type="date" placeholder="Inicio de capacitacion" id="text-input"></li>
                            <li><input name="fin" type="date" placeholder="Inicio de capacitacion" id="text-input"></li>
                            <li><input class="largo" name="horas" type="number" placeholder="Total de horas" id="text-input"
                             onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;"
                             autocomplete="off"></li>
                            <li><select style="margin-top:10px" class="" name="tipo" >
                                <option value="conferencia">Conferencia</option>
                                <option value="curso">Curso</option>
                                <option value="taller">Taller</option>
                                <option value="diplomado">Diplomado</option>
                                <option value="seminario">Seminario</option>
                                <option value="acreditacion">Acreditación</option>
                                <option value="certificacion">Certificación</option>
                            </select></li>
                            <li><input type="file" accept="application/pdf" name="evidencia" placeholder="Coloque su evidencia" id="text-input"></li>
                            <li><button id="agregar-capacitacion" type="submit" class="btnplus"><img class="icon" src="{{ asset('img/save.png')}}" height ="40" width="40" /></button></li>
                        </form>
                    </ul> <br><br>
                    <h3 class="form-screen-title">CAPACITACIÓN SOLICITADA EN UDEMEX</h3>


                    <table id="table-capacitaciones" style="font-size: 1.3rem;">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Institución</th>
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

                      <h5 class="form-screen-title">CAPACITACIÓN TOMADA AFUERA DE UDEMEX</h5>

                      <table id="table-capacitaciones" style="font-size: 1.3rem;">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Institución</th>
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


            </div>
        </div>
        {{--Fin Subida de Documentos --}}
<script>
    var archivosMenu = document.querySelector('#archivos-menu');

    var enviarCapacitacion = document.querySelector('#agregar-capacitacion');

    enviarCapacitacion.addEventListener('click', (e)=>{
        Swal.fire('Cargando', 'Espera un momento', 'info');
        e.submit();
    });

    archivosMenu.addEventListener('click', ()=>{
        fetch('getCapacitaciones/{{ Auth::user()->id }}')
            .then(response => response.json())
            .then((response)=>{
                createCapacitacionTable(response[0], 'dentro');
                createCapacitacionTable(response[1], 'fuera');
            });
        });

    function createCapacitacionTable(data, tabla){
        let table = document.querySelector(`#capacitaciones-table-${tabla}`);
        table.innerHTML = '';
        //console.log('a');
        data.forEach((element)=>{
                    let tr = document.createElement('tr');

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
                    }

                    // When the user clicks anywhere outside of the modal, close it
                    window.onclick = function(event) {
                        if (event.target == modal) {
                            modal.style.display = "none";
                        }
                    } 

                    // * Eventlisteners
                    pdfPreview.addEventListener('click', (e)=>{
                        e.preventDefault();
                        let archivo = `documentos/Capacitaciones/${element.constancia_pdf}`;
                        iframe.setAttribute('data', '{{ asset("") }}'+archivo);
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
                                fetch(`delete-capacitacion/${ element.id_capacitacion }`)
                                    .then((response) => response.json())
                                    .then((response) => {
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
</script>