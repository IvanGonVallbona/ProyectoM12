@extends('layouts.app')

@section('content')
<div class="container py-5">
    @auth
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="row">
            <div class="col-md-12">
                <h2 class="mb-4">Afegir Personatges a la Campanya</h2>

                <!-- Mostrar datos de la campaña -->
                <div class="card mb-4">
                    <div class="card-body">
                        <h4 class="card-title">{{ $campanya->nom }}</h4>
                        <p><strong>Descripció:</strong> {{ $campanya->descripcio }}</p>
                        <p><strong>Estat:</strong> {{ $campanya->estat }}</p>
                        <p><strong>Joc:</strong> {{ $campanya->manual->nom }}</p>
                        <p><strong>Espais disponibles:</strong> {{ $remaining_slots }}</p>
                    </div>
                </div>

                <!-- Mostrar tabla de personajes permitidos -->
                @if($filteredPersonatges->count() > 0)
                    <h4 class="mb-3">Personatges disponibles per afegir</h4>
                    <table class="table table-bordered table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">Nom</th>
                                <th scope="col">Classe</th>
                                <th scope="col">Nivell</th>
                                <th scope="col">Accions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($filteredPersonatges as $personatge)
                                <tr>
                                    <td>{{ $personatge->nom }}</td>
                                    <td>{{ \App\Models\Classe::getName($personatge->classe_id) ?? 'Qualsevol' }}</td>
                                    <td>{{ $personatge->nivell }}</td>
                                    <td>
                                        <form action="{{ route('campanya.addPersonatgeToCampanya', [$campanya->id, $personatge->id]) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm">
                                                <i class="fa fa-plus"></i> Afegir a Campanya
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="alert alert-info">
                        No hi ha personatges disponibles per afegir a aquesta campanya.
                    </div>
                @endif

                <div class="mt-4">
                    <a href="{{ route('campanya_list') }}" class="btn btn-secondary">
                        <i class="fa fa-arrow-left"></i> Torna
                    </a>
                </div>
            </div>
        </div>
    @else
        <div class="alert alert-warning text-center">
            Has d'iniciar sessió per veure aquesta pàgina.
        </div>
    @endauth
</div>
@endsection