@extends('layouts.app')

@section('content')
<div class="container py-5">
    @auth
        @if(Auth::user()->tipus_usuari === 'admin')
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <span>Llista de Campanyes</span>
                            <a href="{{ route('campanya_new') }}" class="btn btn-primary btn-sm">Nova Campanya</a>
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
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead class="table-dark">
                                            <tr>
                                                <th>#</th>
                                                <th>Nom</th>
                                                <th>Descripció</th>
                                                <th>Estat</th>
                                                <th>Joc</th>
                                                <th>Creat per</th>
                                                <th>Accions</th>
                                                <th></th>
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
                                                <td>
                                                    <a href="{{ route('campanya.show', $campanya->id) }}" class="btn btn-info btn-sm">
                                                        <i class="fa fa-eye"></i> Veure Campanya
                                                    </a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
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
            {{-- DM o Usuari normal: Cards de campañas pròpies --}}
            <h2 class="mb-4">Les Meves Campanyes</h2>
            @if(Auth::user()->tipus_usuari === 'dm')
                <div class="mb-3 text-end">
                    <a href="{{ route('campanya_new') }}" class="btn btn-primary btn-sm">
                        <i class="fa fa-plus"></i> Nova Campanya
                    </a>
                </div>
            @endif
            <div class="row">
                @forelse($campanyesPropies as $campanya)
                    <div class="col-12 col-sm-6 col-lg-4 mb-4">
                        <div class="card h-100">
                            <div class="card-header bg-primary text-white">
                                {{ $campanya->nom }}
                            </div>
                            <div class="card-body">
                                <p><strong>Joc:</strong> {{ $campanya->manual->nom }}</p>
                                <p><strong>Estat:</strong> {{ $campanya->estat }}</p>
                                <p><strong>Descripció:</strong> {{ Str::limit($campanya->descripcio, 80) }}</p>
                            </div>
                            <div class="card-footer d-flex justify-content-between">
                                <a href="{{ route('campanya.show', $campanya->id) }}" class="btn btn-info btn-sm">Veure Campanya</a>
                                @if(Auth::id() == $campanya->user_id)
                                    <a href="{{ route('campanya_edit', $campanya->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="alert alert-info">No tens cap campanya.</div>
                @endforelse
            </div>
        @endif
    @else
        <div class="alert alert-warning text-center">
            Per veure la llista de campanyes, has d'iniciar sessió.
        </div>
    @endauth
</div>
@endsection