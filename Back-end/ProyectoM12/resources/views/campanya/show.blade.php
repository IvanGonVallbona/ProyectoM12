<!-- 
VISTA DE CAMPANYA INDIVIDUAL 
    Mostra els detalls d'una campanya específica, 
    incloent el registre i els personatges associats. 
-->

@extends('layouts.app')

@section('content')
<div class="container py-4">
    <a href="{{ route('campanya_list') }}" class="btn btn-secondary mb-4">&laquo; Torna</a>
    <div>
        @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
    </div>

    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">{{ $campanya->nom }}</h3>
        </div>
        <div class="card-body">
            <p><strong>Joc:</strong> {{ $campanya->manual->nom ?? '-' }}</p>
            <p><strong>Estat:</strong> {{ $campanya->estat }}</p>
            <p><strong>Descripció:</strong> {{ $campanya->descripcio }}</p>
        </div>
    </div>

    <div class="row">
        @if(Auth::id() !== $campanya->user_id)
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header">El teu Personatge</div>
                <div class="card-body">
                    @if($miPersonatge)
                        <div class="row align-items-center">
                            <div class="col-6">
                                <p><strong>Nom:</strong> {{ $miPersonatge->nom }}</p>
                                <p><strong>Classe:</strong> {{ $miPersonatge->classe->nom ?? '-' }}</p>
                                <p><strong>Raza:</strong> {{ $miPersonatge->raza->nom ?? '-' }}</p>
                                <p><strong>Nivell:</strong> {{ $miPersonatge->nivell }}</p>
                            </div>
                            <div class="col-6 text-end">
                                @if($miPersonatge->imatge)
                                    <img src="{{ asset('uploads/personatges/' . basename($miPersonatge->imatge)) }}" alt="Imatge de {{ $miPersonatge->nom }}" class="img-fluid mb-2">
                                @endif
                            </div>
                        </div>
                    @else
                        <div class="alert alert-info">No tens cap personatge en aquesta campanya.</div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mb-4">
                @if($campanya->registres->count() > 0)
                    <div class="card-header bg-primary text-white">
                        Registre de <b>{{ $campanya->nom }}</b>
                    </div>
                    <div class="card-body p-0">
                        @forelse($campanya->registres as $registre)
                            <div class="border-bottom p-3">
                                <h5 class="mb-2">{{ $registre->titol }}</h5>
                                <p>{{ $registre->descripcio }}</p>
                            </div>
                        @empty
                            <div class="p-3">
                                <p>Sense registres.</p>
                            </div>
                        @endforelse
                    </div>
                @else
                    <div class="card-body">
                        <p>Sense registre.</p>
                    </div>
                @endif
            </div>
        </div>
        @endif
    </div>

    @if(Auth::id() === $campanya->user_id)
        <div class="card mb-4">
            <div class="card-header">Personatges de la Campanya</div>
            <div class="card-body">
                <div class="row">
                    @forelse($personatges as $personatge)
                        <div class="col-md-4 mb-3">
                            <div class="card">
                                <div class="card-body text-center">
                                    @if($personatge->imatge)
                                        <img src="{{ asset('uploads/personatges/' . basename($personatge->imatge)) }}" alt="Imatge de {{ $personatge->nom }}" class="img-fluid mb-2">
                                    @endif
                                    <h5>{{ $personatge->nom }}</h5>
                                    <p><strong>Classe:</strong> {{ $personatge->classe->nom ?? '-' }}</p>
                                    <p><strong>Raza:</strong> {{ $personatge->raza->nom ?? '-' }}</p>
                                    <p><strong>Nivell:</strong> {{ $personatge->nivell }}</p>
                                    <a href="{{ route('personatges.edit', $personatge->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                    <form action="{{ route('personatges.destroy', $personatge->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">Eliminar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="alert alert-info">No hi ha personatges a la campanya.</div>
                    @endforelse
                </div>
            </div>
        </div>
        
        @if(Auth::id() === $campanya->user_id)
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    Registre de <b>{{ $campanya->nom }}<b>
                </div>
                <div class="card-body p-0">
                    @forelse($campanya->registres as $registre)
                        <div class="border-bottom p-3">
                            <h5 class="mb-2">{{ $registre->titol }}</h5>
                            <p>{{ $registre->descripcio }}</p>
                            <a href="{{ route('registre_edit_by_campanya', ['campanya_id' => $campanya->id, 'registre_id' => $registre->id]) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('registre_delete', $registre->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="byCampanya" value="1">
                                <button class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </div>
                    @empty
                        <div class="p-3">
                            <p>Sense registres.</p>
                        </div>
                    @endforelse
                </div>
                <div class="card-footer">
                    <a href="{{ route('registre_new_by_campanya', ['campanya_id' => $campanya->id]) }}" class="btn btn-success btn-sm">Afegir nou registre</a>
                </div>
            </div>
        @endif
    @endif

    

    
</div>
@endsection