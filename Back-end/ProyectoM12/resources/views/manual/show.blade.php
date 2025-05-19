@extends('layouts.app')

@section('content')
<div class="container py-5">
    <a href="{{ route('manual_list') }}" class="btn btn-secondary mb-3">&laquo; Volver al listado</a>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                @if($manual->imatge)
                    <img src="{{ asset('uploads/imatges_manuals/' . $manual->imatge) }}" class="card-img-top" alt="Imagen de {{ $manual->nom }}" style="max-height:400px; object-fit:contain;">
                @endif
                <div class="card-body">
                    <h2 class="card-title">{{ $manual->nom }}</h2>
                    <h5 class="card-subtitle mb-2 text-muted">{{ $manual->tipus }}</h5>
                    <p class="card-text mt-3">{{ $manual->descripcio }}</p>
                    <p><strong>Jugabilitat:</strong> {{ $manual->jugabilidad }}</p>
                    <hr>
                    <h4>Clases asociadas</h4>
                    @if($classes->count())
                        <ul>
                            @foreach($classes as $classe)
                                <li>{{ $classe->nom }}: {{ $classe->descripcio }}</li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-muted">No hay clases asociadas a este manual.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection