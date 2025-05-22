@extends('layouts.app')

@section('content')
<div class="container py-5">
    @auth
        @if(Auth::user()->tipus_usuari === 'admin')
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            Editar Usuari
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('users.edit', $user->id) }}">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Nom</label>
                                    <input type="text" class="form-control" value="{{ $user->name }}" disabled>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" value="{{ $user->email }}" disabled>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Tipus d'Usuari</label>
                                    <select name="tipus_usuari" class="form-select" required>
                                        <option value="dm" {{ $user->tipus_usuari == 'dm' ? 'selected' : '' }}>Dungeon Master</option>
                                        <option value="user" {{ $user->tipus_usuari == 'user' ? 'selected' : '' }}>User normal</option>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary">Desar</button>
                                <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancel·lar</a>
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