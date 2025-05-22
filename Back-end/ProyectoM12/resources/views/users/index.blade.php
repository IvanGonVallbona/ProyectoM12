@extends('layouts.app')

@section('content')
<div class="container py-5">
    @auth
        @if(Auth::user()->tipus_usuari === 'admin')
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <span>Llista d'Usuaris</span>
                            <form class="d-flex" method="GET" action="{{ route('users.index') }}">
                                <input type="text" name="email" class="form-control form-control-sm me-2" placeholder="Buscar per email" value="{{ request('email') }}">
                                <button type="submit" class="btn btn-sm btn-primary">Buscar</button>
                            </form>
                        </div>
                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            @if(count($users) > 0)
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover mt-4">
                                        <thead class="table-dark">
                                            <tr>
                                                <th>Nom</th>
                                                <th>Email</th>
                                                <th>Tipus d'Usuari</th>
                                                <th>Accions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($users as $user)
                                                <tr>
                                                    <td>{{ $user->name }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>{{ $user->tipus_usuari }}</td>
                                                    <td>
                                                        @if($user->tipus_usuari !== 'admin')
                                                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="alert alert-info">
                                    No hi ha usuaris registrats.
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