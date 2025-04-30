@extends('layouts.app')

@section('content')
<div class="container py-5">
    @auth
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <span>Crear Personatge</span>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('personatges.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                            <div class="form-group">
                                <label for="nom">Nom</label>
                                <input type="text" name="nom" id="nom" class="form-control" placeholder="Nom" required>
                            </div>
                            <div class="form-group">
                                <label for="raza_id">Raza</label>
                                <select name="raza_id" id="raza_id" class="form-control" required>
                                    <option value="" disabled>Selecciona una raza</option>
                                    @foreach($razas as $raza)
                                        <option value="{{ $raza->id }}">
                                            {{ $raza->nom }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="nivell">Nivell</label>
                                <input type="number" name="nivell" id="nivell" class="form-control" placeholder="Nivell" required>
                            </div>
                            <div class="form-group">
                                <label for="classe_id">Classe</label>
                                <select name="classe_id" id="classe_id" class="form-control" required>
                                    <option value="" disabled>Selecciona una classe</option>
                                    @foreach($classes as $classe)
                                        <option value="{{ $classe->id }}">{{ $classe->nom }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="imatge">Imatge</label>
                                <input type="file" name="imatge" id="imatge" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="joc_id">Joc</label>
                                <select name="joc_id" id="joc_id" class="form-control" required>
                                    <option value="" disabled selected>Selecciona un joc</option>
                                    @foreach($manuals as $manual)
                                        <option value="{{ $manual->id }}">{{ $manual->nom }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <button type="submit" class="btn btn-primary my-3">Guardar</button>
                            <a href="{{ route('personatges.index') }}" class="btn btn-secondary">Cancel·lar</a>
                        </form>
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