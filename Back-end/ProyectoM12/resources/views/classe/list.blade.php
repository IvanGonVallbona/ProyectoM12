@extends('layouts.app')

@section('content')
<div class="container py-5">
    @auth
        @if(Auth::user()->tipus_usuari === 'admin')
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <span>Llista de Classes</span>
                            <a href="{{ route('classe_new') }}" class="btn btn-primary btn-sm">Nova Classe</a>
                        </div>

                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            @if(count($classes) > 0)
                                <table class="table table-bordered table-hover">
                                    <thead class="table-dark">
                                        <tr>
                                            <th scope="col">Nom</th>
                                            <th scope="col">Descripció</th>
                                            <th scope="col">Joc</th>
                                            <th scope="col">Accions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($classes as $classe)
                                        <tr>
                                            <td>{{ $classe->nom }}</td>
                                            <td>{{ $classe->descripcio }}</td>
                                            <td>{{ $classe->manual->nom ?? 'Sense joc' }}</td>
                                            <td class="d-flex justify-content-around">
                                                <a href="{{ route('classe_edit', $classe->id) }}" class="btn btn-warning btn-sm">
                                                    <i class="fa fa-edit"></i> Editar
                                                </a>
                                                <form action="{{ route('classe_delete', $classe->id) }}" method="POST" 
                                                    onsubmit="return confirm('Estàs segur que vols eliminar aquesta classe?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="fa fa-trash"></i> Eliminar
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <div class="alert alert-info">
                                    No hi ha classes registrades. <a href="{{ route('classe_new') }}">Crear una nova classe</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="alert alert-danger">
                No tens permisos per veure aquesta pàgina. Si us plau, inicia sessió amb un compte d'administrador.
            </div>
        @endif
    @else
        <div class="alert alert-danger">
            No tens permisos per veure aquesta pàgina. Si us plau, inicia sessió amb un compte d'administrador.
        </div>
    @endauth
</div>
@endsection