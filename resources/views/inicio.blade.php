<!DOCTYPE html>
<html>

    <head>
        <title>Inicio</title>

        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" type="image/x-icon" href="{{ asset('img/fav1.png') }}">

        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>

        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

        <link href="/css/inicio.css" rel="stylesheet" type="text/css">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>


    <body>

        <section class="our-webcoderskull padding-lg">
            <div class="container">

                {{-- Logo --}}
                <div class="mb-4 row heading heading-icon">
                    <img src="/img/imagenes-07.png">
                </div>

                <input type="hidden" name="expiracion" id="expiracion" class="form-control" value="{{$days_left}}" />

                @if(Auth::check())
                    @php
                        $commonMenuItems = [
                            ['url' => '/home', 'img' => '/img/harhomB_Mesa de trabajo 1.png'],
                            ['url' => '/Reportes', 'img' => '/img/harhomB-02.png'],
                            ['url' => '/Calendar', 'img' => '/img/harhomB-03.png'],
                            ['url' => '/Setting', 'img' => '/img/harhomB-04.png'],
                        ];

                        $menuItems = [
                            'administrador' => $commonMenuItems,
                            'jefe_meseros' => array_slice($commonMenuItems, 0, 3), // Solo los primeros 3 para jefe meseros
                            'jefe_cocina' => [$commonMenuItems[0]], // Solo el primer menú para jefe cocina
                            'cajero' => [$commonMenuItems[0], $commonMenuItems[2]], // Primer y tercer menú para cajero
                        ];
                    @endphp

                    <ul class="row justify-content-center align-items-center g-2">
                        @foreach ($menuItems[Auth::user()->role] ?? [] as $item)
                            <li class="col-12 col-md-6 col-lg-3">
                                <a href="{{ url($item['url']) }}">
                                    <div class="cnt-block equal-hight" style="height: 300px;">
                                        <figure>
                                            <img src="{{ $item['img'] }}" class="img-responsive" alt="">
                                        </figure>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>

                    <div class="row justify-content-center align-items-center g-2">
                        <div class="col-md-11">
                            <br>
                            <h5 class="text-end" style="color:#999999;">{{ $message }}</h5>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group text-end">
                                <a id="logout" name="logout" class="logout" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <img src="/img/imagenes-06.png" height="50" width="50" alt="Logout">
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>


                @else
                    @include('error')
                @endif


            </div>
        </section>

    </body>

</html>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script type="text/javascript">
    var expiracion = $('#expiracion').val();
    if ($('#expiracion').val() <= 10 && $('#expiracion').val() != '') {
        Swal.fire(
            'Expiración!',
            'Faltan ' + expiracion + ' días para que el sistema expire!',
            'info'
        )
    }
</script>
