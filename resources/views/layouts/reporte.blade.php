<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" type="image/x-icon" href="{{ asset('img/fav1.png') }}">
    <title>Restuarante | @yield('title')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
    <link href="{{ asset('css/ticket.css') }}" rel="stylesheet">

</head>

<body>

    <style type="text/css" media="print">
        @page {
            size: landscape;
        }

    </style>

    <div id="app">
        <nav class="bg-white shadow-sm navbar navbar-expand-md navbar-light">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/inicio') }}">
                    <img src="{{ asset('img/imagenes-07.png') }}" alt="" width="120" height="40">
                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="col-md-5">
                    <h5 style="color: #006b8e;font-weight: 600;">
                        <?php
                            $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
                            $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
                            echo $dias[date('w')].", ".date('d')." de ".$meses[date('n')-1]. " de ".date('Y'). " | ".date("H:i a");
                        ?>
                    </h5>
                </div>
            </div>
        </nav>

        <section class="px-4 mt-4">
            <header class="clearfix">

                <div class="mb-4 row">
                    <div class="col-9">
                        <div id="company">
                            <h2 class="name">{{$restaurante['nombre']}}</h2>
                            <div><b>Dirección:</b> {{$restaurante['direccion']}}</div>
                            <div><b>Telefono:</b> {{$restaurante['telefono']}}</div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div id="logo">
                            <img src="{{ asset('img/imagenes-07.png') }}" width="200" height="90">
                        </div>
                    </div>
                </div>


                <h2 class="text-center font-weight-bold">@yield('title')</h2>
                <div class="text-center">
                    <button class="oculto-impresion btn btn-primary" onclick="imprimir()">Imprimir</button>
                    <a type="button" class="oculto-impresion btn btn-warning" href="{{ URL::previous() }}">Regresar</a>
                </div>
            </header>
            <table class="table mt-3 table-striped">
                <thead>
                    <tr>
                        @yield('t-headers')
                    </tr>
                </thead>
                @yield('t-body')
                @yield('t-foot')
            </table>

        </section>
    </div>

    <script>
        function imprimir() {
            window.print();
        }
    </script>
</body>

</html>
