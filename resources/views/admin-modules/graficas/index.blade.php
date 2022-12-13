@extends('admin-modules.layout.app')
@section('title', 'Graficas')

@section('content')

<div class="tabs">
    <button type="button" id="personal-menu" data-tab-target="1">Evaluacion Docente &blacktriangledown;</button>
    <button type="button" id="historial-menu" data-tab-target="2">Porcentajes de Aprobacion &blacktriangledown;</button>
</div>

<div data-tab-id="1">
    @include('admin-modules.graficas.evaluacion-docente')
</div>
<div data-tab-id="2">
    @include('admin-modules.graficas.aprobacion')
</div>

@endsection