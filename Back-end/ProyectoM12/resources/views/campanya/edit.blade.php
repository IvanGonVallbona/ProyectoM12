@extends('layouts.app')

@section('title', 'Editar Campanya')

@section('content')
<div class="container py-5">
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
                                <option value="preparacio" {{ old('estat', $campanya->estat) == 'En preparació' ? 'selected' : '' }}>En preparació</option>
                                <option value="activa" {{ old('estat', $campanya->estat) == 'Activa' ? 'selected' : '' }}>Activa</option>
                                <option value="finalitzada" {{ old('estat', $campanya->estat) == 'Finalitzada' ? 'selected' : '' }}>Finalitzada</option>
                                <option value="cancelada" {{ old('estat', $campanya->estat) == 'Cancel·lada' ? 'selected' : '' }}>Cancel·lada</option>
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
                                    <option value="{{ $manual->id }}" {{ old('joc_id', $campanya->joc_id) == $manual->id ? 'selected' : '' }}>
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

                        <div class="mb-3">
                            <label for="personatges" class="form-label">Número de Jugadors:</label>
                            <select name="personatges" id="personatges" class="form-select @error('personatges') is-invalid @enderror" required>
                                <option value="" disabled>Selecciona el número de personatges</option>
                                @for($i = 3; $i <= 6; $i++)
                                    <option value="{{ $i }}" {{ old('personatges', $campanya->personatges) == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                            @error('personatges')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div id="classes-container">
                            <!-- Aquí se generarán dinámicamente los selects de clases -->
                        </div>

                        <!-- Campo oculto para el user_id -->
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

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const numJugadorsSelect = document.getElementById('personatges');
        const jocSelect = document.getElementById('joc_id');
        const classesContainer = document.getElementById('classes-container');
        const classes = <?php echo json_encode($classes); ?>;
        

        numJugadorsSelect.addEventListener('change', function () {
            const jocId = jocSelect.value;

            // Si no s'ha escollit joc, mostrar error i sortir
            if (!jocId) {
                classesContainer.innerHTML = '<div class="alert alert-danger">Has de seleccionar un joc abans de triar els personatges.</div>';
                return;
            }

            const numJugadors = parseInt(this.value);
            classesContainer.innerHTML = '';

            for (let i = 1; i <= numJugadors; i++) {
                const div = document.createElement('div');
                div.classList.add('mb-3');

                // Crear un label per al select
                const label = document.createElement('label');
                label.setAttribute('for', `classe_${i}`);
                label.classList.add('form-label');
                label.textContent = `Classe del Personatge ${i}:`;

                // Crear el select
                const select = document.createElement('select');
                select.name = `classe_${i}`;
                select.id = `classe_${i}`;
                select.classList.add('form-select');

                // Opció Qualsevol. Per defecte
                const optQualsevol = document.createElement('option');
                optQualsevol.value = "";
                optQualsevol.selected = true;
                optQualsevol.textContent = 'Qualsevol';
                select.appendChild(optQualsevol);

                // Afegir només les classes del joc seleccionat
                classes.forEach(function(classe) {
                    // Comprovar si la classe pertany al joc seleccionat
                    if (jocId == classe.joc_id) {
                        // Crear l'opció per a la classe
                        const opt = document.createElement('option');
                        opt.value = classe.id;
                        opt.textContent = classe.nom;
                        select.appendChild(opt);
                    }
                });
                // Afegir el select i el label al div
                div.appendChild(label);
                div.appendChild(select);    
                // Afegir el div al contenidor de classes
                classesContainer.appendChild(div);
            }
        });
    });
</script>
@endsection