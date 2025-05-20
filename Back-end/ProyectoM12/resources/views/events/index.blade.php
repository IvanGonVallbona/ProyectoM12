@extends('layouts.app')

@section('content')
<div class="container py-5">
    @auth
        {{-- Esdeveniments futurs --}}
        <div class="mb-5">
            <h3 class="mb-4 text-info">Esdeveniments futurs al local</h3>
            <div class="row">
                @forelse($esdeveniments as $esdeveniment)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 border-info">
                            <div class="card-header bg-info text-white">
                                <strong>{{ $esdeveniment->nom }}</strong>
                            </div>
                            <div class="card-body">
                                <p><strong>Descripció:</strong> {{ $esdeveniment->descripcio }}</p>
                                <p><strong>Data:</strong> {{ $esdeveniment->data->format('d/m/Y H:i') }}</p>
                                <p><strong>Tipus:</strong> {{ $esdeveniment->tipus }}</p>
                                <p><strong>Inscrits:</strong> {{ $esdeveniment->participants->count() }}</p>
                            </div>
                            <div class="card-footer d-flex justify-content-between">
                                @if(!$esdeveniment->participants->contains(auth()->user()->id))
                                    <form action="{{ route('esdeveniments.inscriureUsuari', $esdeveniment->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                        <button type="submit" class="btn btn-primary btn-sm">
                                            <i class="fa fa-sign-in-alt"></i> Inscriure's
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('esdeveniments.desinscriureUsuari', $esdeveniment->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                        <button type="submit" class="btn btn-secondary btn-sm">
                                            <i class="fa fa-sign-out-alt"></i> Desinscriure's
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info mb-0">No hi ha esdeveniments futurs.</div>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- Campanyes disponibles --}}
        <div>
            <h3 class="mb-4 text-info">Campanyes disponibles</h3>
            <div class="row">
                @forelse($campanyes as $campanya)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 border-info">
                            <div class="card-header bg-info text-white">
                                <strong>{{ $campanya->nom }}</strong>
                            </div>
                            <div class="card-body">
                                <p><strong>Descripció:</strong> {{ $campanya->descripcio }}</p>
                                <p><strong>Estat:</strong> <span class="badge bg-secondary text-white">{{ $campanya->estat }}</span></p>
                                <p><strong>Joc:</strong> {{ $campanya->manual->nom }}</p>
                                <p><strong>Espais totals:</strong> {{ $campanya->personatges }}</p>
                                <p><strong>Espais lliures:</strong> {{ $campanya->personatges - $campanya->personatgesCampanya->count() }}</p>
                                
                            </div>
                            <div class="card-footer text-end">
                                <a href="{{ route('campanya.addPersonatge', $campanya->id) }}" class="btn btn-info btn-sm">
                                    <i class="fa fa-users"></i> Afegir Personatge
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info mb-0">No hi ha campanyes en preparació amb espais lliures.</div>
                    </div>
                @endforelse
            </div>
        </div>
    @else
        <div class="alert alert-warning text-center">
            Per veure la llista d'esdeveniments i campanyes, has d'iniciar sessió.
        </div>
    @endauth
</div>
@endsection