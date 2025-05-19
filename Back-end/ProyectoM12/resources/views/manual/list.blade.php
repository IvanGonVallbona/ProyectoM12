@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            @php
                $user = Auth::user();
            @endphp

            {{-- Vista para admin --}}
            @if ($user && $user->tipus_usuari === 'admin')
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

                        @if (session('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
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
                                                <img src="{{ $manual->imatge }}" alt="Foto Manual {{ $manual->nom }} " style="width: 100px;">
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
            @endif

            {{-- Vista para user o dm --}}
            @if ($user && ($user->tipus_usuari === 'user' || $user->tipus_usuari === 'dm'))
                <div class="panel panel-primary shadow-sm rounded">
                    <div class="panel-heading bg-primary text-white p-3 text-center">
                        <h3 class="panel-title mb-0">Llistat de manuals</h3>
                    </div>
                    <div class="panel-body p-4">
                        @if(count($manuals) == 0)
                            <div class="text-center text-muted">
                                <h4>No hi ha manuals registrats.</h4>
                            </div>
                        @else
                            <div class="row">
                                @foreach($manuals as $manual)
                                    <div class="col-md-4 mb-4">
                                        <div class="card h-100 shadow-sm">
                                            <div class="card-body d-flex flex-column">
                                                <h5 class="card-title">{{ $manual->nom }}</h5>
                                                <h6 class="card-subtitle mb-2 text-muted">{{ $manual->tipus }}</h6>
                                                <p class="card-text flex-grow-1">
                                                    <span id="desc-short-{{ $manual->id }}">
                                                        {{ Str::limit($manual->descripcio, 80) }}
                                                        @if(strlen($manual->descripcio) > 80)
                                                            ... <button class="btn btn-link p-0 ms-1" onclick="toggleDesc({{ $manual->id }})" type="button">Leer más</button>
                                                        @endif
                                                    </span>
                                                    <span id="desc-full-{{ $manual->id }}" style="display:none;">
                                                        {{ $manual->descripcio }}
                                                        <button class="btn btn-link p-0 ms-1" onclick="toggleDesc({{ $manual->id }})" type="button">Leer menys</button>
                                                    </span>
                                                </p>
                                                <p class="card-text"><strong>Jugabilitat:</strong> {{ $manual->jugabilidad }}</p>
                                                @if ($manual->imatge)
                                                    <img src="{{ $manual->imatge }}" alt="Imatge del manual de {{ $manual->nom }}" height="200px" width="100%" style="object-fit:cover;">
                                                @else
                                                    <span class="text-muted">No disponible</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
                <script>
                    function toggleDesc(id) {
                        const shortDesc = document.getElementById('desc-short-' + id);
                        const fullDesc = document.getElementById('desc-full-' + id);
                        if (shortDesc.style.display === 'none') {
                            shortDesc.style.display = '';
                            fullDesc.style.display = 'none';
                        } else {
                            shortDesc.style.display = 'none';
                            fullDesc.style.display = '';
                        }
                    }
                </script>
            @endif
        </div>
    </div>
</div>
@endsection