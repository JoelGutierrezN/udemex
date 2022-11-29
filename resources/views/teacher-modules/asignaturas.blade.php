{{--Datos de materias impartidas --}}

<style>
    #materias-form {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr 1fr 1fr 0.5fr;
        gap: 5px;
    }

    #materias-form li {
        width: 100%
    }

    #materias-form li input, #materias-form li select {
        height: 3.5rem;
    }
</style>

<style>
    .modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background: rgb(0, 0, 0); /* Fallback color */
        background: rgba(0, 0, 0, 0.4); /* Black w/ opacity */
    }

    /* Modal Content/Box */
    .modal-content {
        background: #fefefe;
        margin: auto; /* 15% from the top and centered */
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
        height: 90vh; /* Could be more or less, depending on screen size */
    }

    /* The Close Button */
    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }
</style>

<div class="mt-2" data-tab-id="2">
    <h3 class="tab--title">Asignaturas impartidas</h3>
    <div class="">
        <div>
            <label for="text-input"> Coloque asignaturas impartidas en otras instituciones</label>
            <ul class="col6">
                <form id="materias-form" action="" method="post" enctype="multipart/form-data">
                    @csrf
                    <li class="formlabel is-required" style="font-size:13px;">Nombre completo de la asignatura</li>
                    <li class="formlabel is-required" style="font-size:13px; margin-top:-1.5%">Nombre completo de la
                        institución donde se impartió
                    </li>
                    <li class="formlabel is-required">Inicio impartición</li>
                    <li class="formlabel is-required">Fin impartición</li>
                    <li class="formlabel is-required">Nivel Escolar</li>
                    <li style="color:white">Agregar</li>
                    <li><input id="materia-nombre" name="nombre" autocomplete="off" type="text"
                               placeholder="Nombre completo de la asignatura"></li>
                    <li><input id="materia-institucion" name="institucion" autocomplete="off" type="text"
                               placeholder="Nombre completo de la institución donde se ímpartió"></li>
                    <li><input id="materia-inicio" name="inicio" type="date"
                               placeholder="Inicio de la asignatura impartida"></li>
                    <li><input id="materia-fin" name="fin" type="date" placeholder="Fin de la asignatura impartida">
                    </li>
                    <li><select id="materia-nivel" style="margin-top:10px" class="" name="tipo">
                            <option value="Bachillerato">Bachillerato</option>
                            <option value="Licenciatura">Licenciatura</option>
                            <option value="Maestría">Maestría</option>
                            <option value="Doctorado">Doctorado</option>
                        </select></li>
                    <li><a href="#" id="agregar-materias" type="submit" class="btnplus"><img class="icon"
                                                                                             src="{{ asset('img/save.png')}}"
                                                                                             height="40"
                                                                                             width="40"/></a></li>
                </form>
            </ul>
            
            <table id="table-materias" style="font-size: 1.3rem;">
                <thead>
                <tr>
                    <th>Nombre de la asignatura</th>
                    <th>Institución donde se impartió</th>
                    <th>Inicio impartición</th>
                    <th>Fin impartición</th>
                    <th>Nivel Escolar</th>
                    <th>Operaciones</th>
                </tr>
                </thead>

                <tbody id="materias-table">

                </tbody>

            </table><br>
            <div id="asignatura-ultima-actualizacion">
                <div style="width: 49%; display: inline-block">
                    <p class="is-required" id="campos-obligatorios">Campos obligatorios</p>
                </div>
                <div class="alert-info2" style="width: 49%; display: inline-block; padding: 5px;">
                    <p>Información actualizada a la fecha: <span id="a-actualizacion"></span></p>
                </div>
            </div>

        </div>
        
    </div>
    <br><br><br>
</div>
{{--Fin Datos de materias impartidas --}}

<!-- Tabla de materias -->
<script>
    var materiasMenu = document.querySelector('#materias-menu');

    var inputNombre = document.querySelector('#materia-nombre');
    var inputInstitucion = document.querySelector('#materia-institucion');
    var inputInicio = document.querySelector('#materia-inicio');
    var inputFin = document.querySelector('#materia-fin');
    var inputNivel = document.querySelector('#materia-nivel');

    function createMateriasTable() {
        fetch('{{ env('APP_URL') }}/profesores/getMaterias/{{ Auth::user()->id }}')
            .then(response => response.json())
            .then(response => {
                let table = document.querySelector('#materias-table');

                table.innerHTML = '';

                response.forEach((element) => {
                    let tr = document.createElement('tr');
                    let nombre = document.createElement('td');
                    let institucion = document.createElement('td');
                    let Inicio = document.createElement('td');
                    let fin = document.createElement('td');
                    let nivel = document.createElement('td');
                    let operaciones = document.createElement('td');
                    let deleteButton = document.createElement('a');

                    operaciones.setAttribute('style', 'text-align: center;');

                    nombre.innerHTML = `${element.nombre_asignatura}`;
                    institucion.innerHTML = `${element.nombre_institucion}`;
                    Inicio.innerHTML = new Date(element.fecha_inicio).toLocaleDateString('es-MX');
                    fin.innerHTML = new Date(element.fecha_fin).toLocaleDateString('es-MX');
                    nivel.innerHTML = `${element.nivel_escolar}`;
                    deleteButton.innerHTML = `<a><img class="icon" src="https://cdn-icons-png.flaticon.com/512/8568/8568248.png" alt="" height ="40" width="40"></a></div>`;

                    deleteButton.setAttribute('id', `delete-capacitacion-${element.id_asignatura}`);

                    tr.appendChild(nombre);
                    tr.appendChild(institucion);
                    tr.appendChild(Inicio);
                    tr.appendChild(fin);
                    tr.appendChild(nivel);
                    operaciones.appendChild(deleteButton);
                    tr.appendChild(operaciones);

                    table.appendChild(tr);

                    // * Eventlisteners
                    deleteButton.addEventListener('click', (e) => {
                        e.preventDefault();
                        Swal.fire({
                            title: '¿Deseas eliminar el archivo?',
                            confirmButton: 'Si',
                            showCancelButton: true,
                            cancelButtonText: 'Cancelar'
                        }).then((response) => {
                            if (response.isConfirmed) {
                                fetch(`{{ env('APP_URL') }}/profesores/delete-materia/${element.id_asignatura}`)
                                    .then((response) => response.json())
                                    .then((response) => {
                                        getLastAsignatura()
                                        Swal.fire(response[0].alert, '', 'success');
                                        table.removeChild(tr);
                                    }).catch((error) => {
                                    Swal.fire('Lo sentimos, ocurrio un error', 'Intenta de nuevo mas tarde', 'error');
                                });
                            }
                        });
                    });
                });
            });
    }

    materiasMenu.addEventListener('click', () => {
        createMateriasTable();
        getLastAsignatura()
    });

    document.querySelector('#agregar-materias')
        .addEventListener('click', (e) => {
            e.preventDefault();
            Swal.fire('Cargando', 'Espera un momento', 'info');

            let data = new FormData();
            data.append('nombre', document.querySelector('#materia-nombre').value);
            data.append('institucion', document.querySelector('#materia-institucion').value);
            data.append('inicio', document.querySelector('#materia-inicio').value);
            data.append('fin', document.querySelector('#materia-fin').value);
            data.append('nivel', document.querySelector('#materia-nivel').value);
            data.append('_token', '{{ csrf_token() }}');

            fetch('{{ env('APP_URL') }}/profesores/storeMaterias', {
                method: 'POST',
                headers: new Headers({
                    'X-CSRF-Token': '{{ csrf_token() }}'
                }),
                body: data
            }).then((response) => response.json())
                .then((response) => {
                    getLastAsignatura()
                    createMateriasTable();
                    inputNombre.value = '';
                    inputInstitucion.value = '';
                    inputInicio.value = '';
                    inputFin.value = '';
                    inputNivel.value = '';
                    Swal.fire(response[0].state, '', 'success');
                });
        });

    function getLastAsignatura() {
        fetch('{{ route("teacher.lastAsignatura") }}')
            .then((response) => response.json())
            .then((response) => {
                document.querySelector('#a-actualizacion').innerHTML = new Date(response[0].created_at).toLocaleDateString('es-MX');
            });
    }
</script>
