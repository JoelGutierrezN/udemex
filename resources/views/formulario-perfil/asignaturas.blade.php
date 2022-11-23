{{--Datos de materias impartidas --}}
<div class="mt-2" data-tab-id="2">
    <h3 class="tab--title">Asignaturas impartidas</h3>
    <div class="">
        <div>
            <label for="text-input"> Coloque las asignaturas impartidas</label>
            <ul class="col6">
                <form id="materias-form" action="" method="post" enctype="multipart/form-data">
                    @csrf
                    <li class="formlabel" style="font-size:13px;">Nombre completo de la asignatura</li>
                    <li class="formlabel" style="font-size:13px; margin-top:-1%">Nombre completo de la institución donde se impartio</li>
                    <li class="formlabel">Inicio impartición</li>
                    <li class="formlabel">Fin impartición</li>
                    <li class="formlabel">Nivel Escolar</li>
                    <li style="color:white">Agregar</li>
                    <li><input id="materia-nombre" name="nombre" autocomplete="off" type="text" placeholder="Nombre completo de la asignatura"></li>
                    <li><input id="materia-institucion" name="institucion" autocomplete="off" type="text" placeholder="Nombre completo de la institucion donde se ímpartió"></li>
                    <li><input id="materia-inicio" name="inicio" type="date" placeholder="Inicio de la asignatura impartida"></li>
                    <li><input id="materia-fin" name="fin" type="date" placeholder="Fin de la asignatura impartida"></li>
                    <li><select id="materia-nivel" style="margin-top:10px" class="" name="tipo" >
                        <option value="Bachillerato">Bachillerato</option>
                        <option value="Licenciatura">Licenciatura</option>
                        <option value="Maestría">Maestría</option>
                        <option value="Doctorado">Doctorado</option>
                        </select></li>
                    <li><a href="#" id="agregar-materias" type="submit" class="btnplus"><img class="icon" src="{{ asset('img/save.png')}}" height ="40" width="40" /></a></li>
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
                        
            </table>
                    
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
    var inputNivel  = document.querySelector('#materia-nivel');

    function createMateriasTable(){
        fetch('getMaterias/{{ Auth::user()->id }}')
            .then(response => response.json())
            .then(response => {
                let table = document.querySelector('#materias-table');

                table.innerHTML = '';

                response.forEach((element)=>{
                    let tr = document.createElement('tr');
                    let nombre = document.createElement('td');
                    let institucion = document.createElement('td');
                    let Inicio = document.createElement('td');
                    let fin = document.createElement('td');
                    let nivel = document.createElement('td');
                    let operaciones = document.createElement('td');
                    let deleteButton = document.createElement('a');

                    operaciones.setAttribute('style', 'text-align: center;');

                    nombre.innerHTML = `${ element.nombre_asignatura }`;
                    institucion.innerHTML = `${ element.nombre_institucion }`;
                    Inicio.innerHTML = new Date(element.fecha_inicio).toLocaleDateString('es-MX');
                    fin.innerHTML = new Date(element.fecha_fin).toLocaleDateString('es-MX');
                    nivel.innerHTML = `${ element.nivel_escolar }`;
                    deleteButton.innerHTML = `<a><img class="icon" src="https://cdn-icons-png.flaticon.com/512/8568/8568248.png" alt="" height ="40" width="40"></a></div>`;

                    deleteButton.setAttribute('id', `delete-capacitacion-${ element.id_asignatura }`);

                    tr.appendChild(nombre);
                    tr.appendChild(institucion);
                    tr.appendChild(Inicio);
                    tr.appendChild(fin);
                    tr.appendChild(nivel);
                    operaciones.appendChild(deleteButton);
                    tr.appendChild(operaciones);

                    table.appendChild(tr);
                                        
                    // * Eventlisteners
                    deleteButton.addEventListener('click', (e)=>{
                        e.preventDefault();
                        Swal.fire({
                            title: '¿Deseas eliminar el archivo?',
                            confirmButton: 'Si',
                            showCancelButton: true,
                            cancelButtonText: 'Cancelar'
                        }).then((response)=>{
                            if(response.isConfirmed){
                                fetch(`delete-materia/${element.id_asignatura}`)
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
    materiasMenu.addEventListener('click', ()=>{
        createMateriasTable();
    });

    document.querySelector('#agregar-materias')
        .addEventListener('click', (e)=>{
            e.preventDefault();
            Swal.fire('Cargando', 'Espera un momento', 'info');

            let data = new FormData();
            data.append('nombre', document.querySelector('#materia-nombre').value);
            data.append('institucion', document.querySelector('#materia-institucion').value);
            data.append('inicio', document.querySelector('#materia-inicio').value);
            data.append('fin', document.querySelector('#materia-fin').value);
            data.append('nivel', document.querySelector('#materia-nivel').value);
            data.append('_token', '{{ csrf_token() }}');

            fetch('/profesores/storeMaterias', {
                method: 'POST',
                headers: new Headers({
                    'X-CSRF-Token': '{{ csrf_token() }}'
                }),
                body: data
            }).then((response) => response.json())
                .then((response)=>{
                    createMateriasTable();
                    inputNombre.value = '';
                    inputInstitucion.value = '';
                    inputInicio.value = '';
                    inputFin.value = '';
                    inputNivel.value = '';
                    Swal.fire(response[0].state, '', 'success');
                });
        })
</script>