@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Llista de Registres</span>
                    @if (Auth::user() && Auth::user()->tipus_usuari === 'dm')
                        <a href="{{ route('registre_new') }}" class="btn btn-primary btn-sm">Nou Registre</a>
                    @endif    
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
                    @if(count($registres) > 0)
                        <table class="table table-bordered table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Títol</th>
                                    <th scope="col">Descripció</th>
                                    <th scope="col">Data de creació</th>
                                    @if (Auth::user() && Auth::user()->tipus_usuari === 'dm')
                                        <th scope="col">Accions</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($registres as $registre)
                                <tr>
                                    <th scope="row">{{ $registre->id }}</th>
                                    <td>{{ $registre->titol }}</td>
                                    <td>{{ Str::limit($registre->descripcio, 100) }}</td>
                                    <td>{{ $registre->created_at->format('d/m/Y H:i') }}</td>
                                    @if (Auth::user() && Auth::user()->tipus_usuari === 'dm')
                                    <td class="d-flex justify-content-around">
                                        <a href="{{ route('registre_edit', $registre->id) }}" class="btn btn-warning btn-sm me-2">
                                            <i class="fa fa-edit"></i> Editar
                                        </a>
                                        
                                        <form action="{{ route('registre_delete', $registre->id) }}" method="POST" 
                                              onsubmit="return confirm('Estàs segur que vols eliminar aquest registre?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fa fa-trash"></i> Eliminar
                                            </button>
                                        </form>
                                    </td>
                                    @endif
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="alert alert-info">
                            No hi ha registres. <a href="{{ route('registre_new') }}">Crear un nou registre</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection