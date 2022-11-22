{{-- Inicio historial academico --}}
<div class="mt-2" data-tab-id="5">
    <h3 class="tab--title">Historial Académico</h3>

    <div class="">
        <div>
            <label for="text-input">Estudios concluidos</label>
            <form action="{{ route('teacher.storeHistorial') }}" method="post" enctype="multipart/form-data" id="historialAcademico-form">
                @csrf
                <ul class="col5">
                    <li class="formlabel">Nombre del titulo</li>
                    <li class="formlabel">Nombre de la institución</li>
                    <li class="formlabel">Inicio</li>
                    <li class="formlabel">Fin</li>
                    <li class="formlabel">Nivel Escolar</li>

                    <li><input name="nombre" type="text" autocomplete="off" placeholder="Nombre completo del titulo" id="text-input"></li>
                    <li><input name="institucion" type="text" autocomplete="off" placeholder="Nombre completo de la institucion donde se estudio" id="text-input"></li>
                    <li><input name="inicio" type="date" placeholder="Inicio de capacitación" id="text-input"></li>
                    <li><input name="fin" type="date" placeholder="Fin de capacitación" id="text-input"></li>
                    <li>
                        <select style="margin-top:10px" class="" name="nivel" >
                            <option value="Licenciatura">Licenciatura</option>
                            <option value="Maestría">Maestría</option>
                            <option value="Doctorado">Doctorado</option>
                            <option value="Especialidad">Especialidad</option>
                        </select>
                    </li>
                </ul>

                <ul class="col5">
                    <li class="formlabel">Tipo de documento</li>
                    <li class="formlabel">Título</li>
                    <li class="formlabel">Certificado</li>
                    <li class="formlabel">Cédula</li>
                    <li>&#160;</li>

                    <li></li>
                    <li>
                        <input id="historial-titulo" type="file" name="titulo" placeholder="titulo" class="formlabel" accept="application/pdf">
                    </li>
                    <li>
                        <input id="historial-certificado" type="file" name="certificado" placeholder="certificado" class="formlabel" accept="application/pdf">
                    </li>
                    <li>
                        <input id="historial-cedula" type="file" name="cedula" placeholder="cedula" class="formlabel" accept="application/pdf">
                    </li>
                    <li><button id="historial-button" type="submit" class="btnplus"><img class="icon" src="{{ asset('img/save.png')}}" height ="40" width="40" /></button></li>
                </ul>
            </form>
            <table id="table-historial-academico" style="font-size: 1.3rem;">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Institución</th>
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
</div>
<script>
    var historialMenu = document.querySelector('#historial-menu');

    var historialForm = document.querySelector('#historialAcademico-form');
    var historialButton = document.querySelector('#historial-button');

    historialButton.addEventListener('click', (e)=>{
        Swal.fire('Cargando', 'Espera un momento', 'info');
    });

    function createHistorialTable(){
        fetch("getHistorial/{{ Auth::user()->id }}")
            .then((response) => response.json())
            .then((response) => {
                                    
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
                        let archivo = `documentos/Historial/${element.titulo}`;
                        iframe.setAttribute('data', '{{ asset("") }}'+archivo);
                        modal.style.display = "block";
                    });
                    cedula.addEventListener('click',(e)=>{
                        let archivo = `documentos/Historial/${element.titulo}`;
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
                                fetch(`delete-historial/${ element.id_asignatura }`)
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
            });
    }

    historialMenu.addEventListener('click', (e)=>{
        createHistorialTable();
    });    
</script>