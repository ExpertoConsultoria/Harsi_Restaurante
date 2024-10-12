<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Icons --}}
    <link rel="icon" type="image/x-icon" href="{{ asset('img/fav1.png') }}">

    <title>Restaurante</title>

    {{-- Own Styles --}}
    <style>
        body {
            background: #ECE9E6;
            background: -webkit-linear-gradient(to right, #FFFFFF, #ECE9E6);
            background: linear-gradient(to right, #FFFFFF, #ECE9E6);
        }

    </style>

    {{-- Jquery --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    {{-- Bootstrap --}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>

    {{-- DataTables --}}
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js">
    </script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">

    {{-- Sweet A;ert --}}
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <link rel="stylesheet" type="text/css" href="../css/estilos.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>

<body>
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel"
        style="background-color:white;box-shadow: 0 2px 4px rgba(0,0,0,.04);">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/home') }}">
                <img src="../img/imagenes-07.png" alt="" width="120" height="40">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="mr-auto navbar-nav"></ul>

                <!-- Right Side Of Navbar -->
                <ul class="ml-auto navbar-nav">
                    <!-- Authentication Links -->
                    <li class="nav-item dropdown">

                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                            <a class="dropdown-item"
                                href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                            >
                                {{ __('Cerrar sesión') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <!-- Authentication Links -->
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            Opciones <span class="caret"></span>
                        </a>
                        @if (Auth::check() && Auth::user()->role == 'administrador')
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ url('/inicio') }}">
                                Inicio
                            </a>
                            <a class="dropdown-item" href="{{ url('/home') }}">
                                Comanda
                            </a>
                            <a class="dropdown-item" href="{{ url('/Reportes') }}">
                                Reportes
                            </a>
                            <a class="dropdown-item" href="{{ url('/Calendar') }}">
                                Reservación
                            </a>
                            <a class="dropdown-item" href="{{ url('/Setting') }}">
                                Configuración
                            </a>
                        </div>
                        @endif
                        @if (Auth::check() && Auth::user()->role == 'cajero')
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ url('/inicio') }}">
                                Inicio
                            </a>
                            <a class="dropdown-item" href="{{ url('/home') }}">
                                Comanda
                            </a>
                            <a class="dropdown-item" href="{{ url('/Calendar') }}">
                                Reservación
                            </a>
                        </div>
                        @endif
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        @yield('content')
        @yield('comando')
        @yield('eventos')
        @yield('reservas')
        @yield('field')
        @yield('datatables')
    </div>

    @stack('scripts')
</body>

</html>
