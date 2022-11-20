@extends('admin-modules.layout.app')
@section('title', 'Profesores')
@section('content')

    <ul>
        @foreach($users as $user)
            <li>
                {{ $user->informacionAcademica->experiencia_presencial }}
            </li>
        @endforeach
    </ul>

@endsection
