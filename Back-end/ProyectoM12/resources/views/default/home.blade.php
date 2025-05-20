@extends('layouts.app')

@section('title', 'Home')

@section('stylesheets')
    @parent
@endsection

@section('content')
     <div class="welcome-header d-flex flex-column align-items-center justify-content-center mt-4">
        <img src="{{ asset('img/logo.png') }}" alt="Logo">
        <h1 class="mb-0">Rol Lobby</h1>
    </div>
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="card shadow-sm welcome-card">
                <div class="card-body">
                    <h2>¿Quiénes somos?</h2>
                    <p class="card-text">
                        Bienvenidos a la página web de gestión del club de rol. Desde aquí podrás consultar diversos
                        manuales de los juegos que podrás disfrutar en nuestro club, aprendiendo un poco de su historia y su
                        jugabilidad. También podrás crear y visualizar tus personajes además de añadirlos a campañas creadas por los Dungeon Masters y donde podrás examinar los registros de cada sesión de juego para recordar los hechos acontecidos en sesiones anteriores. 
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm welcome-card">
                <div class="card-body">
                    <h2>¿Dónde estamos?</h2>
                    <p>Esta es nuestra ubicación en Google Maps para que tu travesía hasta nosotros sea más sencilla:</p>
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2983.3559923410576!2d2.2858206!3d41.604813!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12a4c7c685a4c42f%3A0xb5c5f7b16ff5e21!2sHomoLudicus%20Granollers!5e0!3m2!1ses!2ses!4v1747241025869!5m2!1ses!2ses"
                        width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
@endsection