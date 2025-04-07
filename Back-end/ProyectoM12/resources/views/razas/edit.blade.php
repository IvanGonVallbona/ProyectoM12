@extends('layouts.app')

@section('content')
    <h1>Editar Raza</h1>
    <form action="{{ route('razas.update', $raza) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="nom">Nom:</label>
        <input type="text" name="nom" id="nom" value="{{ $raza->nom }}" required>

        <label for="descripcio">Descripció:</label>
        <textarea name="descripcio" id="descripcio">{{ $raza->descripcio }}</textarea>

        <button type="submit">Actualitzar</button>
    </form>
@endsection