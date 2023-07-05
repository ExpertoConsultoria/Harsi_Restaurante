<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" type="image/x-icon" href="{{ asset('img/fav1.png') }}">
    <title>Restaurante</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    {{-- Font Awesome --}}
    <link rel=”stylesheet” href="{{ asset('fontawesome/css/all.css') }}">
    <link href="{{ asset('fontawesome/css/fontawesome.css') }}" rel="stylesheet">
    <link href="{{ asset('fontawesome/css/brands.css') }}" rel="stylesheet">
    <link href="{{ asset('fontawesome/css/solid.css') }}" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">


    {{-- ChartScript --}}

    {{-- ChartStyle --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                @yield('imagen')
                <label id="imagen" name="imagen"><a class="navbar-brand" href="{{ url('/inicio') }}">
                        <img src="../img/imagenes-07.png" alt="" width="200" height="70">
                    </a></label>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="col-md-2">
                </div>
                <div class="col-md-5">
                    <h5 style="color: #006b8e;font-weight: 600;">
                        <?php
          $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
          $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
          echo $dias[date('w')].", ".date('d')." de ".$meses[date('n')-1]. " de ".date('Y'). " | ".date("H:i a");
          ?>
                    </h5>
                </div>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->


                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto" style="margin-right: 2rem !important">
                        <!-- Authentication Links -->
                        @guest

                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link" href="#" role="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false" v-pre>
                                @yield('auth')
                                <label id="auth" name="auth"><img src="../img/usuario.png" alt="" width="25"
                                        height="25"> {{ Auth::user()->name }}</label>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    Cerrar sesión
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                    <ul class="navbar-nav">
                        <!-- Authentication Links -->
                        @guest
                        <li class="nav-item">
                            {{--  <a class="nav-link" href="{{ route('login') }}">{{ __('') }}</a> --}}
                        </li>
                        @if (Route::has('register'))
                        <li class="nav-item">
                            {{--  <a class="nav-link" href="{{ route('register') }}">{{ __('') }}</a> --}}
                        </li>
                        @endif
                        @else


                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false" v-pre>
                                @yield('opciones')
                                <label id="opciones" name="opciones"><img src="../img/opciones.png" alt="" width="25"
                                        height="25"></label>
                            </a>

                            @if ((Auth::check() && Auth::user()->role == 'administrador') || Auth::check() && Auth::user()->role == 'desarrollador')
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ url('/inicio') }}">
                                    <div class="row justify-content-center  align-items-center ">
                                        <div class="col-1"><i class="fas fa-home fa-sm"></i></div>
                                        <div class="col-9">Inicio</div>
                                    </div>
                                </a>
                                <a class="dropdown-item" href="{{ url('/home') }}">
                                    <div class="row justify-content-center  align-items-center ">
                                        <div class="col-1"><i class="fas fa-file-alt"></i></div>
                                        <div class="col-9">Comanda</div>
                                    </div>
                                </a>
                                <a class="dropdown-item" href="{{ url('/Reportes') }}">
                                    <div class="row justify-content-center  align-items-center ">
                                        <div class="col-1"><i class="fas fa-book"></i></div>
                                        <div class="col-9">Reportes</div>
                                    </div>
                                </a>
                                <a class="dropdown-item" href="{{ url('/Graficas') }}">
                                    <div class="row justify-content-center  align-items-center ">
                                        <div class="col-1"><i class="fas fa-chart-bar"></i></div>
                                        <div class="col-9">Estadísticas</div>
                                    </div>
                                </a>
                                <a class="dropdown-item" href="{{ url('/Calendar') }}">
                                    <div class="row justify-content-center  align-items-center ">
                                        <div class="col-1"><i class="fas fa-calendar-alt"></i></div>
                                        <div class="col-9">Reservación</div>
                                    </div>
                                </a>
                                <a class="dropdown-item" href="{{ url('/Ordenes') }}">
                                    <div class="row justify-content-center  align-items-center ">
                                        <div class="col-1"><i class="fas fa-file-alt"></i></div>
                                        <div class="col-9">Ver Ordenes</div>
                                    </div>
                                </a>
                                <a class="dropdown-item" href="{{ url('/Setting') }}">
                                    <div class="row justify-content-center  align-items-center ">
                                        <div class="col-1"><i class="fas fa-cog"></i></div>
                                        <div class="col-9">Configuración</div>
                                    </div>
                                </a>
                            </div>
                            @endif
                            @if (Auth::check() && Auth::user()->role == 'cajero')
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ url('/inicio') }}">
                                    <div class="row justify-content-center  align-items-center ">
                                        <div class="col-1"><i class="fas fa-home"></i></div>
                                        <div class="col-9">Inicio</div>
                                    </div>
                                </a>
                                <a class="dropdown-item" href="{{ url('/home') }}">
                                    <div class="row justify-content-center  align-items-center ">
                                        <div class="col-1"><i class="fas fa-file-alt"></i></div>
                                        <div class="col-9">Comanda</div>
                                    </div>
                                </a>
                                <a class="dropdown-item" href="{{ url('/Calendar') }}">
                                    <div class="row justify-content-center  align-items-center ">
                                        <div class="col-1"><i class="fas fa-calendar-alt"></i></div>
                                        <div class="col-9">Reservación</div>
                                    </div>
                                </a>
                                <a class="dropdown-item" href="{{ url('/Ordenes') }}">
                                    <div class="row justify-content-center  align-items-center ">
                                        <div class="col-1"><i class="fas fa-file-alt"></i></div>
                                        <div class="col-9">Ver Ordenes</div>
                                    </div>
                                </a>
                            </div>
                            @endif
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
            @yield('comando')
            @yield('funciones')
            @yield('ticket')
            @yield('modal')
        </main>
    </div>

</body>

</html>
