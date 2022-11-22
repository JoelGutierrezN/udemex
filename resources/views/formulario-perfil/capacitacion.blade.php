<script>
    var archivosMenu = document.querySelector('#archivos-menu');
    archivosMenu.addEventListener('click', ()=>{
        fetch('getCapacitaciones/{{ Auth::user()->id }}')
            .then(response => response.json())
            .then((response)=>{
                createTable(response[0], 'dentro');
                createTable(response[0], 'fuera');
            });
        });

    function createTable(data, tabla){
        let table = document.querySelector(`#capacitaciones-table-${tabla}`);
        table.innerHTML = '';
        response.forEach((element)=>{
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