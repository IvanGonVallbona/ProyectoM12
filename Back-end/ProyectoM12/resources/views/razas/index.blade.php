@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Llista de Razas</span>
                    <a href="{{ route('classe_new') }}" class="btn btn-primary btn-sm">Nova raza</a>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if(count($razas) > 0)
                        <table class="table table-bordered table-hover mt-4">
                            <thead class="table-dark">
                                <tr>
                                    <th>Nom</th>
                                    <th>Descripció</th>
                                    <th>Accions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($razas as $raza)
                                <tr>
                                    <td>{{ $raza->nom }}</td>
                                    <td>{{ $raza->descripcio }}</td>
                                    <td>
                                        <a href="{{ route('razas.edit', $raza->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                        <form action="{{ route('razas.destroy', $raza->id) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Segur que vols eliminar aquesta raza?')">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="alert alert-info">
                            No hi ha razas registrades. <a href="{{ route('razas.create') }}">Crear una nova raza</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
