<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>M12 Proyecto @yield('title')</title>
        @section('stylesheets')
	    <link rel="stylesheet" href="{{ asset('css/taula.css') }}" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        @show
    </head>
    <body>
        @include('navbar')

        <div class="container">
            @yield('content')
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>