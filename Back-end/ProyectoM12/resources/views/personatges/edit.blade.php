@extends('layouts.app')

@section('content')
<div class="container py-5">
    @auth
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <span>Editar Personatge</span>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('personatges.update', $personatge) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                            <div class="form-group">
                                <label for="nom">Nom</label>
                                <input type="text" name="nom" id="nom" class="form-control" value="{{ $personatge->nom }}" required>
                            </div>
                            <div class="form-group">
                                <label for="raza_id">Raza</label>
                                <select name="raza_id" id="raza_id" class="form-control" required>
                                    <option value="" disabled>Selecciona una raza</option>
                                    @foreach($razas as $raza)
                                        <option value="{{ $raza->id }}" {{ $personatge->raza_id == $raza->id ? 'selected' : '' }}>
                                            {{ $raza->nom }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="nivell">Nivell</label>
                                <input type="number" name="nivell" id="nivell" class="form-control" value="{{ $personatge->nivell }}" required>
                            </div>

                            <div class="form-group">
                                <label for="classe_id">Classe</label>
                                <select name="classe_id" id="classe_id" class="form-control" required>
                                    <option value="" disabled>Selecciona una classe</option>
                                    @foreach($classes as $classe)
                                        <option value="{{ $classe->id }}" {{ $personatge->classe_id == $classe->id ? 'selected' : '' }}>
                                            {{ $classe->nom }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                             

                            <div class="form-group">
                                <label for="imatge">Imatge</label>
                                <input type="file" name="imatge" id="imatge" class="form-control" {{ old('eliminar_foto') ? 'disabled' : '' }}>
                            </div>
                            
                            @if ($personatge->imatge)
                                <div class="form-group">
                                    <label for="imatgeActual">Imatge actual:</label>
                                    <img name="imatgeActual" src="{{ asset($personatge->imatge) }}" alt="{{ $personatge->nom }}" class="img-thumbnail" style="max-width: 200px; max-height: 200px;">
                                </div>
                            @endif

                                
                            <button type="submit" class="btn btn-primary my-3">Actualizar</button>
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