@extends('layout.app')
@section('title', 'Perfil')

@section('content')

    <div class="profile-container">
        <div class="profile-container--personal-information">
            <div class="personal--information-image">
                <img src="https://randomuser.me/api/portraits/women/4.jpg" alt="image">
            </div>
            <div class="personal--information-info">
                <div>
                    <h6>Licenciada en Derecho</h6>
                    <h2>Adriana Hernandez Hernandez</h2>
                </div>

                <div>
                    <h6>Clave de Empleado</h6>
                    <span>221910321</span>
                </div>

                <div>
                    <h6>Teléfono Celular</h6>
                    <span>722 662 8263</span>
                </div>

                <div>
                    <h6>Teléfono de Casa</h6>
                    <span>728 285 6329</span>
                </div>

                <div>
                    <h6>Correo electrónico <span class="text-green">UDEMEX</span></h6>
                    <span>al221910321@udemex.gob.mx</span>
                </div>

                <div>
                    <h6>Correo electrónico <span class="text-green">Personal</span></h6>
                    <span>al1910321@gmail.com</span>
                </div>

                <div>
                    <h6>Sexo:</h6>
                    <span>Femenino</span>
                </div>
            </div>
        </div>
        <div class="profile-container--profesional-information">
            <h1>ESPACIO RESERVADO PARA FUTURA INFORMACIÓN RELEVANTE</h1>

            <h2>Este perfil esta en proceso de planeación el formato pede ser modificado de acuerdo a las necesidades de la información requerida</h2>
        </div>
    </div>

@endsection
