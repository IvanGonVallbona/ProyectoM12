@extends('layouts.app')

@section('content')
<div class="container py-5">
    @auth
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>Llista de Personatges</span>
                        <a href="{{ route('personatges.create') }}" class="btn btn-primary btn-sm">Nou Personatge</a>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if(count($personatges) > 0)
                            <table class="table table-bordered table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col">Nom</th>
                                        <th scope="col">Raça</th>
                                        <th scope="col">Nivell</th>
                                        <th scope="col">Classe</th>
                                        <th scope="col">Joc</th>
                                        <th scope="col">Imatge</th>
                                        <th scope="col">Accions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($personatges as $personatge)
                                    <tr>
                                        <td>{{ $personatge->nom }}</td>
                                        <td>{{ $personatge->raza->nom ?? 'Sense raza' }}</td>
                                        <td>{{ $personatge->nivell }}</td>
                                        
                                        <td>{{ $personatge->classe->nom ?? 'Sense classe' }}</td>
                                        <td>{{ $personatge->manual->nom ?? 'Sense videojoc' }}</td>
                                        <td>
                                            @if($personatge->imatge)
                                                <img src="{{ $personatge->imatge }}" alt="{{ $personatge->nom }}" class="img-thumbnail" style="max-width: 200px; max-height: 200px;">
                                            @else
                                                Sense imatge
                                            @endif
                                        </td>
                                        <td class="d-flex justify-content-around">
                                            @if($personatge->campanya)
                                                {{-- Si el personaje está en una campaña, solo el DM puede modificarlo --}}
                                                @if($personatge->campanya->user_id === auth()->id() || auth()->user()->tipus_usuari === 'admin')
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
                                                @else
                                                    <span class="text-muted">Sense permisos</span>
                                                @endif
                                            @else
                                                {{-- Si el personaje no está en una campaña, solo el propietario puede modificarlo --}}
                                                @if($personatge->user_id === auth()->id() || auth()->user()->tipus_usuari === 'admin')
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
                                                @else
                                                    <span class="text-muted">Sense permisos</span>
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="alert alert-info">
                                No hi ha personatges registrats. <a href="{{ route('personatges.create') }}">Crear un nou personatge</a>
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