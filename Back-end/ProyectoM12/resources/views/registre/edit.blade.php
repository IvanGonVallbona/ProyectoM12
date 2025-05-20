@extends('layouts.app')

@section('title', 'Editar Registre')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Editar Registre') }}</div>

                <div class="card-body">
                    <a href="{{ route('registre_list') }}" class="btn btn-secondary mb-3">&laquo; Torna</a>
                    
                    <form method="POST" action="{{ route('registre_edit', ['id' => $registre->id]) }}" class="w-75 mx-auto">
                        @csrf

                        <div class="mb-3">
                            <label for="titol" class="form-label">Títol del Registre:</label>
                            <input type="text" name="titol" id="titol" class="form-control @error('titol') is-invalid @enderror" value="{{ old('titol', $registre->titol) }}" required>
                            @error('titol')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="descripcio" class="form-label">Descripció:</label>
                            <textarea name="descripcio" id="descripcio" class="form-control @error('descripcio') is-invalid @enderror" rows="6" required>{{ old('descripcio', $registre->descripcio) }}</textarea>
                            @error('descripcio')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

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