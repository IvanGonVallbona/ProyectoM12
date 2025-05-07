@extends('layouts.app')

@section('title', 'Nova Classe')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Nova Classe') }}</div>

                <div class="card-body">
                    <a href="{{ route('classe_list') }}" class="btn btn-secondary mb-3">&laquo; Torna</a>
                    
                    <form method="POST" action="{{ route('classe_new') }}" class="w-75 mx-auto">
                        @csrf

                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom de la Classe:</label>
                            <input type="text" name="nom" id="nom" class="form-control @error('nom') is-invalid @enderror" value="{{ old('nom') }}" required>
                            @error('nom')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="descripcio" class="form-label">Descripció:</label>
                            <textarea name="descripcio" id="descripcio" class="form-control @error('descripcio') is-invalid @enderror" rows="4" required>{{ old('descripcio') }}</textarea>
                            @error('descripcio')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="joc_id" class="form-label">Joc:</label>
                            <select name="joc_id" id="joc_id" class="form-control @error('joc_id') is-invalid @enderror" required>
                                <option value="">Selecciona un joc</option>
                                @foreach ($manuals as $manual)
                                    <option value="{{ $manual->id }}">{{ $manual->nom }}</option>
                                @endforeach
                            </select>
                            @error('joc_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection