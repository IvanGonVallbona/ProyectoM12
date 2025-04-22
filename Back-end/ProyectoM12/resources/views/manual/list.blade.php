@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Llista de Manuals</span>
                    <a href="{{ route('manual_new') }}" class="btn btn-primary btn-sm">Nou Manual</a>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if(count($manuals) > 0)
                        <table class="table table-bordered table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Nom</th>
                                    <th>Tipus</th>
                                    <th>Descripció</th>
                                    <th>Imatge</th>
                                    <th>Accions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($manuals as $manual)
                                <tr>
                                    <td>{{ $manual->id }}</td>
                                    <td>{{ $manual->nom }}</td>
                                    <td>{{ $manual->tipus }}</td>
                                    <td>{{ Str::limit($manual->descripcio, 50) }}</td>
                                    <td>
                                        @if ($manual->imatge)
                                            <img src="{{ $manual->imatge }}" alt="Foto Manual" style="width: 100px;">
                                         @else
                                             No disponible
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('manual_edit', $manual->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                        <form action="{{ route('manual_delete', $manual->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Estàs segur que vols eliminar aquest manual?');">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>No hi ha manuals registrats.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection