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
                        <p><strong>Nom:</strong> {{ $miPersonatge->nom }}</p>
                        <p><strong>Classe:</strong> {{ $miPersonatge->classe->nom ?? '-' }}</p>
                        <p><strong>Raza:</strong> {{ $miPersonatge->raza->nom ?? '-' }}</p>
                        <p><strong>Nivell:</strong> {{ $miPersonatge->nivell }}</p>
                    @else
                        <div class="alert alert-info">No tens cap personatge en aquesta campanya.</div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mb-4">
                @php
                    $registre = $campanya->registres->first();
                @endphp
                @if($registre)
                    <div class="card-header">
                        {{ $registre->titol ?? 'Registre de la Campanya' }}
                    </div>
                    <div class="card-body">
                        <p>{{ $registre->descripcio }}</p>
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
                                <div class="card-body">
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
        
        <div class="card mb-4">
            @php
                $registre = $campanya->registres->first();
            @endphp
            @if($registre)
            <div class="card-header">
                {{ $registre->titol ?? 'Registre de la Campanya' }}
            </div>
            <div class="card-body">
                @if($registre)
                    <p>{{ $registre->descripcio }}</p>
                @else
                    <p>Sense registre.</p>
                @endif
                <a href="{{ route('registre_edit_by_campanya', ['campanya_id' => $campanya->id]) }}" class="btn btn-warning btn-sm">Editar Sessió</a>
                @if($registre)
                    <form action="{{ route('registre_delete', $registre->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Eliminar Registre</button>
                    </form>
                @endif
            </div>
            @endif
            </div>
        </div>
    @endif

    

    
</div>
@endsection