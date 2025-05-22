@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Llista d'Esdeveniments</span>
                    @if (Auth::user() && Auth::user()->tipus_usuari === 'admin' || Auth::user()->tipus_usuari === 'dm')
                    <a href="{{ route('esdeveniments.create') }}" class="btn btn-primary btn-sm">Nou Esdeveniment</a>
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

                    @if(count($esdeveniments) > 0)

                      <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">Nom</th>
                                    <th scope="col">Descripció</th>
                                    <th scope="col">Data</th>
                                    <th scope="col">Tipus</th>
                                    <th scope="col">Participants</th>
                                    <th scope="col">Email Participants</th>

                                    @if (Auth::user() && Auth::user()->tipus_usuari === 'admin' || Auth::user()->tipus_usuari === 'dm')
                                    <th scope="col">Accions</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($esdeveniments as $esdeveniment)
                                <tr>
                                    <td>{{ $esdeveniment->nom }}</td>
                                    <td>{{ $esdeveniment->descripcio }}</td>
                                    <td>{{ $esdeveniment->data->format('d/m/Y') }}</td>
                                    <td>{{ $esdeveniment->tipus }}</td>
                                    <td>{{ $esdeveniment->participants->count() }} inscrits</td>
                                   <td>
                                        @if($esdeveniment->participants->count())
                                            @foreach($esdeveniment->participants as $participant)
                                            <div>{{ $participant->email }}</div>
                                            @endforeach
                                        @else
                                        <span class="text-muted">Sense participants</span>
                                        @endif
                                    </td>


                                        @if (Auth::user() && Auth::user()->tipus_usuari === 'admin' || Auth::user()->tipus_usuari === 'dm')
                                        
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
                                            @auth
                                                @if(!$esdeveniment->participants->contains(auth()->user()->id))
                                                    <form action="{{ route('esdeveniments.inscriureUsuari', $esdeveniment->id) }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                                        <button type="submit" class="btn btn-primary mt-2">Inscriure's</button>
                                                    </form>
                                                @else
                                                    <form action="{{ route('esdeveniments.desinscriureUsuari', $esdeveniment->id) }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                                        <button type="submit" class="btn btn-secondary mt-2">Desinscriure's</button>
                                                    </form>
                                                @endif
                                            @endauth
                                        </td>
                                        @endif
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
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