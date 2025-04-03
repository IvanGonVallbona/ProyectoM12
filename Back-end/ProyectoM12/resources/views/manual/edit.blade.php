@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Editar Manual</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('manual_edit', ['id' => $manual->id]) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom</label>
                            <input type="text" name="nom" id="nom" class="form-control @error('nom') is-invalid @enderror" value="{{ old('nom', $manual->nom) }}" required>
                            @error('nom')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="tipus" class="form-label">Tipus</label>
                            <input type="text" name="tipus" id="tipus" class="form-control @error('tipus') is-invalid @enderror" value="{{ old('tipus', $manual->tipus) }}" required>
                            @error('tipus')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="descripcio" class="form-label">Descripció</label>
                            <textarea name="descripcio" id="descripcio" class="form-control @error('descripcio') is-invalid @enderror" rows="4" required>{{ old('descripcio', $manual->descripcio) }}</textarea>
                            @error('descripcio')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="jugabilidad" class="form-label">Jugabilitat</label>
                            <textarea name="jugabilidad" id="jugabilidad" class="form-control @error('jugabilidad') is-invalid @enderror" rows="4" required>{{ old('jugabilidad', $manual->jugabilidad) }}</textarea>
                            @error('jugabilidad')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="imatge" class="form-label">Imatge</label>
                            <input type="file" name="imatge" id="imatge" class="form-control @error('imatge') is-invalid @enderror">
                            @if ($manual->imatge)
                                <p>Imatge actual: <img src="{{ asset('storage/' . $manual->imatge) }}" alt="Imatge del manual" width="100"></p>
                            @endif
                            @error('imatge')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar Canvis</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection