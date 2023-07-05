<!DOCTYPE html>
<html>

<head>
    <title>Inicio</title>
    <link href="/css/inicio.css" rel="stylesheet" type="text/css">

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" href="../imagenes-05.ico" type="image/x-icon  ">
</head>


<body>
    <section class="our-webcoderskull padding-lg">
        <div class="container">
            <div class="row heading heading-icon">
                <img src="/img/imagenes-07.png">
            </div>
            <div>
                <br><br>
            </div>


            <input type="hidden" name="expiracion" id="expiracion" class="form-control" value="{{$total}}" />
            @if(Auth::check() && Auth::user()->role == 'desarrollador')
                <ul class="row">
                    <li class="col-12 col-md-6 col-lg-3">
                        <a href="{{ url('/home') }}">
                            <div class="cnt-block equal-hight" style="height: 300px;">
                                <figure><img src="/img/harhomB_Mesa de trabajo 1.png" class="img-responsive" alt="">
                                </figure>

                            </div>
                        </a>
                    </li>
                    <li class="col-12 col-md-6 col-lg-3">
                        <a href="{{ url('/Reportes') }}">
                            <div class="cnt-block equal-hight" style="height: 300px;">
                                <figure><img src="/img/harhomB-02.png" class="img-responsive" alt=""></figure>

                            </div>
                        </a>
                    </li>
                    <li class="col-12 col-md-6 col-lg-3">
                        <a href="{{ url('/Calendar') }}">
                            <div class="cnt-block equal-hight" style="height: 300px;">
                                <figure><img src="/img/harhomB-03.png" class="img-responsive" alt=""></figure>

                            </div>
                        </a>
                    </li>
                    <li class="col-12 col-md-6 col-lg-3">
                        <a href="{{ url('/Setting') }}">
                            <div class="cnt-block equal-hight" style="height: 300px;">
                                <figure><img src="/img/harhomB-04.png" class="img-responsive" alt=""></figure>

                            </div>
                        </a>
                    </li>
                </ul>

                <div class="row">
                    <div class="col-md-11" style="margin-top:10px">
                        <br>
                        <h5 align="right" style="color:#999999;">{{ $mensaje }}</h5>
                    </div>
                    <div class="col-md-1" style="margin-top:10px">
                        <div class="form-group">
                            <a id="logout" name="logout" class="logout" href="{{ route('logout') }}"><img
                                    src="/img/imagenes-06.png" height="50" width="50" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>

            @elseif(Auth::check() && Auth::user()->role == 'administrador')

                <ul class="row justify-content-center align-items-center g-2">
                    <li class="col-12 col-md-6 col-lg-3">
                        <a href="{{ url('/home') }}">
                            <div class="cnt-block equal-hight" style="height: 300px;">
                                <figure><img src="/img/harhomB_Mesa de trabajo 1.png" class="img-responsive" alt="">
                                </figure>

                            </div>
                        </a>
                    </li>
                    <li class="col-12 col-md-6 col-lg-3">
                        <a href="{{ url('/Reportes') }}">
                            <div class="cnt-block equal-hight" style="height: 300px;">
                                <figure><img src="/img/harhomB-02.png" class="img-responsive" alt=""></figure>

                            </div>
                        </a>
                    </li>
                    <li class="col-12 col-md-6 col-lg-3">
                        <a href="{{ url('/Calendar') }}">
                            <div class="cnt-block equal-hight" style="height: 300px;">
                                <figure><img src="/img/harhomB-03.png" class="img-responsive" alt=""></figure>

                            </div>
                        </a>
                    </li>
                    <li class="col-12 col-md-6 col-lg-3">
                        <a href="{{ url('/Setting') }}">
                            <div class="cnt-block equal-hight" style="height: 300px;">
                                <figure><img src="/img/harhomB-04.png" class="img-responsive" alt=""></figure>

                            </div>
                        </a>
                    </li>
                </ul>

                <div class="row justify-content-center align-items-center g-2">
                    <div class="col-md-11" style="margin-top:10px">
                        <br>
                        <h5 align="right" style="color:#999999;">{{ $mensaje }}</h5>
                    </div>
                    <div class="col-md-1" style="margin-top:10px">
                        <div class="form-group">
                            <a id="logout" name="logout" class="logout" href="{{ route('logout') }}"><img
                                    src="/img/imagenes-06.png" height="50" width="50" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>

            @elseif(Auth::check() && Auth::user()->role == 'cajero')

                <ul class="row justify-content-center align-items-center g-2">
                    <li class="col-12 col-md-6 col-lg-3">
                        <a href="{{ url('/home') }}">
                            <div class="cnt-block equal-hight" style="height: 300px;">
                                <figure><img src="/img/harhomB_Mesa de trabajo 1.png" class="img-responsive" alt="">
                                </figure>

                            </div>
                        </a>
                    </li>
                    <li class="col-12 col-md-6 col-lg-3">
                        <a href="{{ url('/Calendar') }}">
                            <div class="cnt-block equal-hight" style="height: 300px;">
                                <figure><img src="/img/harhomB-03.png" class="img-responsive" alt=""></figure>
                            </div>
                        </a>
                    </li>

                </ul>

                <div class="row">
                    <div class="col-md-11" style="margin-top:10px">
                        <br>
                        <h5 align="right" style="color:#999999;">{{ $mensaje }}</h5>
                    </div>
                    <div class="col-md-1" style="margin-top:10px">
                        <div class="form-group">
                            <a id="logout" name="logout" class="logout" href="{{ route('logout') }}"><img
                                    src="/img/imagenes-06.png" height="50" width="50" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                    <div class="col-md-3" style="margin-top:10px">
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
