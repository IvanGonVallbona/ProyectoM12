@extends('layouts.app')

@section('title', 'Home')

@section('stylesheets')
    @parent
@endsection

@section('content')
     <div class="welcome-header d-flex flex-column align-items-center justify-content-center mt-4">
        <img src="{{ asset('img/logo.png') }}" alt="Logo" class="logo-anim">
        <h1 class="mb-0">Rol Lobby</h1>
    </div>
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="card shadow-sm welcome-card">
                <div class="card-body">
                    <h2>Qui som?</h2>
                    <p class="card-text">
                       Benvinguts a la pàgina web de gestió del club de rol. Des d'aquí podràs consultar diversos manuals dels jocs que podràs gaudir al nostre club, aprenent una mica de la seva història i de la seva jugabilitat. També podràs crear i visualitzar els teus personatges, a més d'afegir-los a campanyes creades pels Dungeon Masters, on podràs examinar els registres de cada sessió de joc per recordar els fets ocorreguts en sessions anteriors.
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm welcome-card">
                <div class="card-body">
                    <h2>On trobar-nos?</h2>
                    <p>Aquesta és la nostra ubicació a Google Maps perquè la teva travessia fins a nosaltres sigui més senzilla:</p>
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2983.3559923410576!2d2.2858206!3d41.604813!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12a4c7c685a4c42f%3A0xb5c5f7b16ff5e21!2sHomoLudicus%20Granollers!5e0!3m2!1ses!2ses!4v1747241025869!5m2!1ses!2ses"
                        width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
    @guest
    <!-- pop up, si no estas logueado salta -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="loginModalLabel">Atenció</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tancar"></button>
          </div>
          <div class="modal-body text-center">
            Per veure més opcions, inicia sessió
          </div>
          <div class="modal-footer">
            <a href="{{ route('login') }}" class="btn btn-primary">Inicia sessió</a>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tancar</button>
          </div>
        </div>
      </div>
    </div>
    
    <script>
      document.addEventListener('DOMContentLoaded', function () {
        var loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
        loginModal.show();
      });
    </script>

    @endguest
   <footer class="bg-dark text-white text-center py-3 mt-5" style="position:fixed; left:0; bottom:0; width:100%; z-index:1030;">
    Contacte: 
    <a href="mailto:genis_manuelferran@iescarlesvallbona.cat" class="text-white text-decoration-none">genis_manuelferran@iescarlesvallbona.cat</a>
    &nbsp;|&nbsp;
    <a href="mailto:ivan_gonzalezparra@iescarlesvallbona.cat" class="text-white text-decoration-none">ivan_gonzalezparra@iescarlesvallbona.cat</a>
</footer>
@endsection