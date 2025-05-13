@extends('layouts.app')

@section('content')
<div class="container py-5">
    @auth
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>Llista de Campanyes</span>
                        @if(Auth::user()->tipus_usuari === 'dm' || Auth::user()->tipus_usuari === 'admin') 
                            <a href="{{ route('campanya_new') }}" class="btn btn-primary btn-sm">Nova Campanya</a>
                        @endif
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif

                        @if(count($campanyes) > 0)
                            <table class="table table-bordered table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nom</th>
                                        <th scope="col">Descripció</th>
                                        <th scope="col">Estat</th>
                                        <th scope="col">Joc</th>
                                        <th scope="col">Creat per</th>
                                        <th scope="col">Accions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($campanyes as $campanya)
                                    <tr>
                                        <th scope="row">{{ $campanya->id }}</th>
                                        <td>{{ $campanya->nom }}</td>
                                        <td>{{ $campanya->descripcio }}</td>
                                        <td>
                                            <span class="badge 
                                                @if($campanya->estat == 'Activa') bg-success 
                                                @elseif($campanya->estat == 'Finalitzada') bg-danger 
                                                @elseif($campanya->estat == 'En preparació') bg-warning 
                                                @else bg-secondary 
                                                @endif">
                                                {{ $campanya->estat }}
                                            </span>
                                        </td>
                                        <td>{{ $campanya->manual->nom }}</td>
                                        <td>{{ $campanya->user->name ?? 'Usuari desconegut' }}</td>
                                        @if(Auth::user()->tipus_usuari === 'dm' || Auth::user()->tipus_usuari === 'admin') 
                                            <td class="d-flex justify-content-around">
                                                <a href="{{ route('campanya_edit', $campanya->id) }}" class="btn btn-warning btn-sm me-2">
                                                    <i class="fa fa-edit"></i> Editar
                                                </a>
                                                
                                                <form action="{{ route('campanya_delete', $campanya->id) }}" method="POST" 
                                                    onsubmit="return confirm('Estàs segur que vols eliminar aquesta campanya?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="fa fa-trash"></i> Eliminar
                                                    </button>
                                                </form>
                                            </td>
                                        @endif
                                        <td class="d-flex justify-content-around">
                                            <a href="{{ route('campanya.addPersonatge', $campanya->id) }}" class="btn btn-info btn-sm">
                                                <i class="fa fa-users"></i> afegir Personatge
                                            </a>
                                        </td>     
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="alert alert-info">
                                No hi ha campanyes registrades. <a href="{{ route('campanya_new') }}">Crear una nova campanya</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="alert alert-warning text-center">
            Per veure la llista de campanyes, has d'iniciar sessió.
        </div>
    @endauth
</div>
@endsection