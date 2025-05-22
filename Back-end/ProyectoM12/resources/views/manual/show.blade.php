@extends('layouts.app')

@section('content')
<div class="container py-5">
    <a href="{{ route('manual_list') }}" class="btn btn-secondary mb-3">&laquo; Tornar al llistat</a>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow">
                <div class="card-body">
                    <h2 class="card-title text-center mb-4">{{ $manual->nom }}</h2>
                    <div class="row align-items-center mb-4">
                        <div class="col-md-6">
                            <h5 class="card-subtitle mb-2 text-muted">Tipus: {{ $manual->tipus }}</h5>
                            <p><strong>Jugabilitat:</strong> {{ $manual->jugabilidad }}</p>
                        </div>
                        <div class="col-md-6 text-center">
                            @if($manual->imatge)
                                <img src="{{ asset('uploads/imatges_manuals/' . $manual->imatge) }}" class="img-fluid rounded" alt="Imagen de {{ $manual->nom }}" style="max-height:300px; object-fit:contain;">
                            @endif
                        </div>
                    </div>
                    <div class="mb-4">
                        <h5>Descripció</h5>
                        <p class="card-text">{{ $manual->descripcio }}</p>
                    </div>
                    <hr>
                    <h4>Classes associades</h4>
                    @if($classes->count())
                        <ul>
                            @foreach($classes as $classe)
                                <li>{{ $classe->nom }}: {{ $classe->descripcio }}</li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-muted">No hay clases asociadas a este manual.</p>
                    @endif
                    <h4>Races associades</h4>
                    @if($razas->count())
                        <ul>
                            @foreach($razas as $raza)
                                <li>{{ $raza->nom }}: {{ $raza->descripcio }}</li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-muted">No hay razas asociadas a este manual.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection