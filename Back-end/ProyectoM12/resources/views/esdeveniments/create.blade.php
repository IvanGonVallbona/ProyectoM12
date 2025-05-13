@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <span>Crear Esdeveniment</span>
                </div>
                <div class="card-body">
                    <form action="{{ route('esdeveniments.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="nom">Nom</label>
                            <input type="text" name="nom" id="nom" class="form-control" placeholder="Nom" required>
                        </div>
                        <div class="form-group">
                            <label for="descripcio">Descripció</label>
                            <textarea name="descripcio" id="descripcio" class="form-control" placeholder="Descripció" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="data">Data</label>
                            <input type="date" name="data" id="data" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="tipus">Tipus</label>
                            <input type="text" name="tipus" id="tipus" class="form-control" placeholder="Tipus" required>
                        </div>
                        <button type="submit" class="btn btn-primary my-3">Guardar</button>
                        <a href="{{ route('esdeveniments.index') }}" class="btn btn-secondary">Cancel·lar</a>

                    </form>                  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
