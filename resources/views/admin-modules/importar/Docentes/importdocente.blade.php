@extends('admin-modules.layout.app')
@section('title', 'Docentes')
@section('content')

<form action="#" method="post" enctype="multipart/form-data">
    @csrf
     <div class="mt-0" data-tab-id="1">
            <h3 class="tab--title"></h3>
             <div class="alert alert-info">
                <h6>Inserción Excel Docentes</h6>
             </div>

             <div class="input-columns-excel">
                 <div>
                    <label for="text-input" class="is-required"> Ingresa Archivo</label>
                    <input type="file" name="import_file" id="" class="form-control" accept=".xlsx, .xls">
                </div>
                     @if($errors->first('archivo'))
                    <div class="invalid-feedback">
                    <i>{{ $errors->first('archivo') }}</i>
                    </div>
                    @endif
            </div>
     </div>

                <div class="conte">
                        <div class="leftexcel">
                            <button type="file" name="import_file"  class="btn btn-primario text-white btn-lg d-block w-35" >
                            <h2>Guardar</h2>
                            </button>
                        </div>
                        <div class="rightexcel">
                            <a href="#" class="btn btn-primario text-white btn-lg d-block w-35">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="18" fill="currentColor" class="bi bi-filetype-exe" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5ZM2.575 15.202H.785v-1.073H2.47v-.606H.785v-1.025h1.79v-.648H0v3.999h2.575v-.647ZM6.31 11.85h-.893l-.823 1.439h-.036l-.832-1.439h-.931l1.227 1.983-1.239 2.016h.861l.853-1.415h.035l.85 1.415h.908l-1.254-1.992L6.31 11.85Zm1.025 3.352h1.79v.647H6.548V11.85h2.576v.648h-1.79v1.025h1.684v.606H7.334v1.073Z"></path>
                             </svg>Descargar Archivo</a>
                        </div>
                </div><br>&nbsp;
                
                <div class="alert alert-info">
                <h5>Instrucciones:</h5>
                <p class="parrafo mt-1">1.- Descarga el archivo, en el botón de "Descargar Archivo".</p>
                <p class="parrafo mt-1">2.- Todos los campos deben de ser llenados.</p>
                <h5  class="mt-2">Notas:</h5>
                <p class="parrafo mt-1">1.- Las celdas a ingresar no deben contener formulas.</p>
                <p class="parrafo mt-1">2.- La información a ingresar en el archivo, debe ser texto o información sin formato alguno.</p>
                <p class="parrafo mt-1">3.- El campo género debe contener un solo caracter "F" o "M". "F" para Femenino o "M" para Masculino.</p>
                <p class="parrafo mt-1">4.- En caso de crear su propio archivo de importación, usted debe tener el formato ".xlsx" y debe de tener las mismas características del archivo.
                situado en el botón "Descargar Archivo".</p>
             </div>
     
</form>

@endsection
