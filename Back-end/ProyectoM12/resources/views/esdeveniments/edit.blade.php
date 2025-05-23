@extends('layouts.app')

@section('content')
<div class="container py-5">
    @auth
        @if(Auth::user()->tipus_usuari === 'admin')
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <span>Editar Esdeveniment</span>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('esdeveniments.update', $esdeveniment) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="nom">Nom</label>
                                    <input type="text" name="nom" id="nom" class="form-control" value="{{ $esdeveniment->nom }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="descripcio">Descripció</label>
                                    <textarea name="descripcio" id="descripcio" class="form-control" required>{{ $esdeveniment->descripcio }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="data">Data</label>
                                    <input type="date" name="data" id="data" class="form-control" value="{{ $esdeveniment->data }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="tipus">Tipus</label>
                                    <input type="text" name="tipus" id="tipus" class="form-control" value="{{ $esdeveniment->tipus }}" required>
                                </div>
                                <button type="submit" class="btn btn-primary my-3">Actualizar</button>
                                <a href="{{ route('esdeveniments.index') }}" class="btn btn-secondary">Cancel·lar</a>
                            </form>                   
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
