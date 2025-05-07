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
                                <label for="nivell">Nivell</label>
                                <input type="number" name="nivell" id="nivell" class="form-control" placeholder="Nivell" required>
                            </div>

                            <div class="form-group">
                                <label for="joc_id">Joc</label>
                                <select name="joc_id" id="joc_id" class="form-control" required>
                                    <option value="" disabled selected>Selecciona un videojoc</option>
                                    @foreach($jocs as $joc)
                                        <option value="{{ $joc->id }}" {{ old('joc_id') == $joc->id ? 'selected' : '' }}>
                                            {{ $joc->nom }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="raza_id">Raza</label>
                                <select name="raza_id" id="raza_id" class="form-control" required>
                                    <option value="" disabled selected>Selecciona una raza</option>
                                    @foreach($razas as $raza)
                                        <option value="{{ $raza->id }}" data-joc-id="{{ $raza->joc_id }}" {{ old('raza_id') == $raza->id ? 'selected' : '' }}>
                                            {{ $raza->nom }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="classe_id">Classe</label>
                                <select name="classe_id" id="classe_id" class="form-control" required>
                                    <option value="" disabled selected>Selecciona una classe</option>
                                    @foreach($classes as $classe)
                                        <option value="{{ $classe->id }}" data-joc-id="{{ $classe->joc_id }}" {{ old('classe_id') == $classe->id ? 'selected' : '' }}>
                                            {{ $classe->nom }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="imatge">Imatge</label>
                                <input type="file" name="imatge" id="imatge" class="form-control">
                            </div>
                            <input type="hidden" name="campanya_id" value="">

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

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const jocSelect = document.getElementById('joc_id');
        const razaSelect = document.getElementById('raza_id');
        const classeSelect = document.getElementById('classe_id');

        jocSelect.addEventListener('change', function () {
            const jocId = this.value;

            Array.from(razaSelect.options).forEach(option => {
                // Mostra si l'opció no té valor o si el joc_id coincideix
                if (option.value === "" || option.dataset.jocId === jocId) {
                    option.style.display = "block";
                } else {
                    option.style.display = "none";
                }
            });

            // Fa el mateix per a les opcions de classe
            Array.from(classeSelect.options).forEach(option => {
                if (option.value === "" || option.dataset.jocId === jocId) {
                    option.style.display = "block";
                } else {
                    option.style.display = "none";
                }
            });

            // Reinicia la selecció de raça i classe
            razaSelect.value = "";
            classeSelect.value = "";
        });
    });
</script>
@endsection