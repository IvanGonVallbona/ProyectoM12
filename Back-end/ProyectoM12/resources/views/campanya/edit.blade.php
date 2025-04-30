@extends('layouts.app')

@section('title', 'Editar Campanya')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Editar Campanya') }}</div>

                <div class="card-body">
                    <a href="{{ route('campanya_list') }}" class="btn btn-secondary mb-3">&laquo; Torna</a>
                    
                    <form method="POST" action="{{ route('campanya_edit', ['id' => $campanya->id]) }}" class="w-75 mx-auto">
                        @csrf

                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom de la Campanya:</label>
                            <input type="text" name="nom" id="nom" class="form-control @error('nom') is-invalid @enderror" value="{{ old('nom', $campanya->nom) }}" required>
                            @error('nom')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="descripcio" class="form-label">Descripció:</label>
                            <textarea name="descripcio" id="descripcio" class="form-control @error('descripcio') is-invalid @enderror" rows="4" required>{{ old('descripcio', $campanya->descripcio) }}</textarea>
                            @error('descripcio')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="estat" class="form-label">Estat de la Campanya:</label>
                            <select name="estat" id="estat" class="form-select @error('estat') is-invalid @enderror" required>
                                <option value="">Selecciona un estat</option>
                                <option value="En preparació" {{ old('estat', $campanya->estat) == 'En preparació' ? 'selected' : '' }}>En preparació</option>
                                <option value="Activa" {{ old('estat', $campanya->estat) == 'Activa' ? 'selected' : '' }}>Activa</option>
                                <option value="Finalitzada" {{ old('estat', $campanya->estat) == 'Finalitzada' ? 'selected' : '' }}>Finalitzada</option>
                                <option value="Cancel·lada" {{ old('estat', $campanya->estat) == 'Cancel·lada' ? 'selected' : '' }}>Cancel·lada</option>
                            </select>
                            @error('estat')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="joc_id" class="form-label">Joc:</label>
                            <select name="joc_id" id="joc_id" class="form-select @error('joc_id') is-invalid @enderror" required>
                                <option value="" disabled>Selecciona un joc</option>
                                @foreach($manuals as $manual)
                                    <option value="{{ $manual->id }}" {{ $campanya->joc_id == $manual->id ? 'selected' : '' }}>
                                        {{ $manual->nom }}
                                    </option>
                                @endforeach
                            </select>
                            @error('joc_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Mantener el mismo usuario que creó la campaña -->
                        <input type="hidden" name="user_id" value="{{ $campanya->user_id }}">

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Guardar Canvis</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection