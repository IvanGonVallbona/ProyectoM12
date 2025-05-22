@extends('layouts.app')

@section('content')
<div class="container py-5">
    @auth
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>Llista de Personatges</span>
                        <div class="d-flex align-items-center">
                            <span class="me-2 fw-bold">Filtrar per joc:</span>
                            <form method="GET" action="{{ route('personatges.index') }}" class="d-flex align-items-center">
                                <select name="joc_id" class="form-select form-select-sm me-2" onchange="this.form.submit()">
                                    <option value="">Tots els jocs</option>
                                    @foreach($manuals as $manual)
                                        <option value="{{ $manual->id }}" {{ (isset($joc_id) && $joc_id == $manual->id) ? 'selected' : '' }}>
                                            {{ $manual->nom }}
                                        </option>
                                    @endforeach
                                </select>
                                <noscript><button type="submit" class="btn btn-sm btn-secondary">Filtrar</button></noscript>
                            </form>
                        </div>
                        <a href="{{ route('personatges.create') }}" class="btn btn-primary btn-sm">Nou Personatge</a>
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if(auth()->user()->tipus_usuari === 'admin')
                            @if(count($personatges) > 0)
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead class="table-dark">
                                            <tr>
                                                <th scope="col">Nom</th>
                                                <th scope="col">Raça</th>
                                                <th scope="col">Nivell</th>
                                                <th scope="col">Classe</th>
                                                <th scope="col">Joc</th>
                                                <th scope="col">Campanya</th>
                                                <th scope="col">Imatge</th>
                                                <th scope="col">Accions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($personatges as $personatge)
                                            <tr>
                                                <td>{{ $personatge->nom }}</td>
                                                <td>{{ $personatge->raza->nom ?? 'Sense raça' }}</td>
                                                <td>{{ $personatge->nivell }}</td>
                                                <td>{{ $personatge->classe->nom ?? 'Sense classe' }}</td>
                                                <td>{{ $personatge->manual->nom ?? 'Sense joc' }}</td>
                                                <td>{{ $personatge->campanya->nom ?? 'Sense campanya' }}</td>
                                                <td>
                                                    @if($personatge->imatge)
                                                        <img src="{{ $personatge->imatge }}" alt="{{ $personatge->nom }}" class="img-thumbnail" style="max-width: 200px; max-height: 200px;">
                                                    @else
                                                        Sense imatge
                                                    @endif
                                                </td>
                                                <td class="d-flex justify-content-around">
                                                    <a href="{{ route('personatges.edit', $personatge->id) }}" class="btn btn-warning btn-sm m-1">
                                                        <i class="fa fa-edit"></i> Editar
                                                    </a>
                                                    <form action="{{ route('personatges.destroy', $personatge->id) }}" method="POST" 
                                                        onsubmit="return confirm('Estàs segur que vols eliminar aquest personatge?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm m-1">
                                                            <i class="fa fa-trash"></i> Eliminar
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="alert alert-info">
                                    No hi ha personatges registrats. <a href="{{ route('personatges.create') }}">Crear un nou personatge</a>
                                </div>
                            @endif
                        @else
                            <div class="row">
                                @forelse($personatges as $personatge)
                                    @if($personatge->user_id === auth()->id())
                                    <div class="col-12 col-sm-6 col-lg-4 mb-4">
                                        <div class="card h-100">
                                            @if($personatge->imatge)
                                                <img src="{{ asset($personatge->imatge) }}"
                                                    alt="{{ $personatge->nom }}"
                                                    class="img-fluid mx-auto d-block"
                                                    style="max-height: 300px; object-fit: contain;">
                                            @endif
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $personatge->nom }}</h5>
                                                <p class="card-text">
                                                    <strong>Raça:</strong> {{ $personatge->raza->nom ?? 'Sense raça' }}<br>
                                                    <strong>Nivell:</strong> {{ $personatge->nivell }}<br>
                                                    <strong>Classe:</strong> {{ $personatge->classe->nom ?? 'Sense classe' }}<br>
                                                    <strong>Joc:</strong> {{ $personatge->manual->nom ?? 'Sense joc' }}<br>
                                                    <strong>Campanya:</strong> {{ $personatge->campanya->nom ?? 'Sense campanya' }}
                                                </p>
                                            </div>
                                            <div class="card-footer d-flex p-0">
                                                @if($personatge->campanya)
                                                    <span class="text-danger w-100 text-center align-self-center px-2">No es pot gestionar perquè pertany a una campanya.</span>
                                                @else
                                                    <a href="{{ route('personatges.edit', $personatge->id) }}" class="btn btn-warning btn-sm w-50 rounded-0 border-0">
                                                        <i class="fa fa-edit"></i> Editar
                                                    </a>
                                                    <form action="{{ route('personatges.destroy', $personatge->id) }}" method="POST" 
                                                          onsubmit="return confirm('Estàs segur que vols eliminar aquest personatge?');" class="w-50 m-0">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm w-100 rounded-0 border-0">
                                                            <i class="fa fa-trash"></i> Eliminar
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                @empty
                                    <div class="col-12">
                                        <div class="alert alert-info">
                                            No tens personatges per mostrar. <a href="{{ route('personatges.create') }}">Crear un nou personatge</a>
                                        </div>
                                    </div>
                                @endforelse
                            </div>
                        @endif
                    </div>
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