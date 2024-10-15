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
        <nav class="bg-white shadow-sm navbar navbar-expand-md navbar-light">
            <div class="container">
                <label style="margin-bottom: 0rem;">
                    <a class="navbar-brand py-0" href="{{ url('/inicio') }}">
                        <img src="{{ asset('img/imagenes-07.png') }}" alt="" width="200" height="70">
                    </a>
                </label>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="col-md-2"></div>

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
                    <ul class="ml-auto navbar-nav" style="margin-right: 2rem !important">
                        <!-- Authentication Links -->
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
                    </ul>
                    <ul class="navbar-nav">
                        <!-- Authentication Links -->
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false" v-pre>
                                @yield('opciones')
                                <label id="opciones" name="opciones"><img src="../img/opciones.png" alt="" width="25"
                                        height="25"></label>
                            </a>

                            @php
                                $commonMenus = [
                                    ['url' => '/inicio', 'icon' => 'fa-home', 'label' => 'Inicio'],
                                    ['url' => '/home', 'icon' => 'fa-file-alt', 'label' => 'Comandas'],
                                    ['url' => '/Calendar', 'icon' => 'fa-calendar-alt', 'label' => 'Reservación'],
                                    ['url' => '/Ordenes', 'icon' => 'fa-file-alt', 'label' => 'Órdenes y Tickets'],
                                    ['url' => '/Graficas', 'icon' => 'fa-chart-bar', 'label' => 'Estadísticas'],
                                    ['url' => '/Reportes', 'icon' => 'fa-book', 'label' => 'Reportes'],
                                    ['url' => '/Setting', 'icon' => 'fa-cog', 'label' => 'Configuración'],
                                ];

                                $menus = [
                                    'administrador' => $commonMenus,
                                    'jefe_meseros' => $commonMenus,
                                    'cajero' => array_slice($commonMenus, 0, 4), // Solo los primeros 4 menús para cajero
                                    'jefe_cocina' => array_slice($commonMenus, 0, 2), // Solo los primeros 2 menús para jefe de cocina
                                ];

                                $userRole = Auth::check() ? Auth::user()->role : null;
                            @endphp

                            @if ($userRole && isset($menus[$userRole]))
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    @foreach ($menus[$userRole] as $menu)
                                        <a class="dropdown-item" href="{{ url($menu['url']) }}">
                                            <div class="row justify-content-left align-items-left ">
                                                <i class="fas {{ $menu['icon'] }} fa-sm pt-1"></i>
                                                &nbsp;
                                                {{ $menu['label'] }}
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            @endif

                        </li>
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
