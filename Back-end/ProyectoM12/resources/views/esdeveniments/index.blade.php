@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Llista d'Esdeveniments</span>
                    <a href="{{ route('esdeveniments.create') }}" class="btn btn-primary btn-sm">Nou Esdeveniment</a>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if(count($esdeveniments) > 0)
                        <table class="table table-bordered table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Nom</th>
                                    <th scope="col">Descripció</th>
                                    <th scope="col">Data</th>
                                    <th scope="col">Tipus</th>
                                    <th scope="col">Accions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($esdeveniments as $esdeveniment)
                                <tr>
                                    <td>{{ $esdeveniment->nom }}</td>
                                    <td>{{ $esdeveniment->descripcio }}</td>
                                    <td>{{ $esdeveniment->data->format('d/m/Y') }}</td>
                                    <td>{{ $esdeveniment->tipus }}</td>
                                    <td class="d-flex justify-content-around">
                                        <a href="{{ route('esdeveniments.edit', $esdeveniment->id) }}" class="btn btn-warning btn-sm m-1">
                                            <i class="fa fa-edit"></i> Editar
                                        </a>
                                        <form action="{{ route('esdeveniments.destroy', $esdeveniment->id) }}" method="POST" 
                                              onsubmit="return confirm('Estàs segur que vols eliminar aquest esdeveniment?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm m-1">
                                                <i class="fa fa-trash"></i> Eliminar
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="alert alert-info">
                            No hi ha esdeveniments registrats. <a href="{{ route('esdeveniments.create') }}">Crear un nou esdeveniment</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
