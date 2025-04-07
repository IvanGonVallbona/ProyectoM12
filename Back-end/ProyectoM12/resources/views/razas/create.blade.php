@extends('layouts.app')

@section('content')
    <h1>Crear nova Raza</h1>
    <form action="{{ route('razas.store') }}" method="POST">
        @csrf
        <label for="nom">Nom:</label>
        <input type="text" name="nom" id="nom" required>

        <label for="descripcio">Descripció:</label>
        <textarea name="descripcio" id="descripcio"></textarea>

        <button type="submit">Crear</button>
    </form>
@endsection