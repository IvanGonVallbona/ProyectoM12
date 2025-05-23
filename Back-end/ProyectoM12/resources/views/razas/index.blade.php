@extends('layouts.app')

@section('content')
<div class="container py-5">
    @auth
        @if(Auth::user()->tipus_usuari === 'admin')
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <span>Llista de Razas</span>
                            <div class="d-flex align-items-center">
                                <span class="me-2 fw-bold">Filtrar per joc:</span>
                                <form method="GET" action="{{ route('razas.index') }}" class="d-flex align-items-center">
                                    <select name="joc_id" class="form-select form-select-sm me-2" onchange="this.form.submit()">
                                        <option value="">Tots els jocs</option>
                                        @foreach($manuals as $manual)
                                            <option value="{{ $manual->id }}" {{ (isset($joc_id) && $joc_id == $manual->id) ? 'selected' : '' }}>
                                                {{ $manual->nom }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <noscript><button type="submit" class="btn btn-sm btn-secondary">Filtrar</button></noscript>
                                </form>
                            </div>
                            <a href="{{ route('razas.create') }}" class="btn btn-primary btn-sm">Nova raza</a>
                        </div>

                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            @if(count($razas) > 0)
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover mt-4">
                                        <thead class="table-dark">
                                            <tr>
                                                <th>Nom</th>
                                                <th>Descripció</th>
                                                <th>Joc</th>
                                                <th>Accions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($razas as $raza)
                                            <tr>
                                                <td>{{ $raza->nom }}</td>
                                                <td>{{ $raza->descripcio }}</td>
                                                <td>{{ $raza->manual->nom ?? 'Sense joc' }}</td>
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
                                </div>
                            @else
                                <div class="alert alert-info">
                                    No hi ha razas registrades. <a href="{{ route('razas.create') }}">Crear una nova raza</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="alert alert-danger">
                No tens permisos per accedir a aquesta pàgina.
            </div>
        @endif
    @else
        <div class="alert alert-danger">
            Necessites iniciar sessió per accedir a aquesta pàgina.
        </div>
    @endif
</div>
@endsection
