@extends('adminlte::page')
@section ('content')

    @if (Auth::check() && Auth::user()->role == 'administrador')
        <div class="row mb-4">
            <div class="col-sm-6 col-xs-12">
                <h2 align="center"> PANEL DE CONFIGURACIÓN</h2>
            </div>
            <div class="col-sm-6 col-xs-12">
                <h2>
                    <?php
                $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
                $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
                echo $dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y');
                ?>
                </h2>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-4 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon" style="border:2px solid #006b8e;border-radius:10px; background-color:#006b8e;">
                        <img src="/img/iconospanel_Mesa de trabajo 1.png" class="img-responsive" alt=""></span>
                    <div class="info-box-content">
                        <span>VENTA DEL DÍA:</span>
                        <span style="font-size: 18px;" id="ventaD"></span>
                        <br>
                        <span>VENTA PARA LLEVAR:</span>
                        <span style="font-size: 18px;" id="ventaDPl"></span>
                        <br>
                        <span>VENTA APPS:</span>
                        <span style="font-size: 18px;" id="ventaAppsD"></span>
                    </div>
                </div>
            </div>

            <div class="col-sm-4 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon" style="border:2px solid #006b8e;border-radius:10px; background-color:#006b8e;">
                        <img src="/img/iconospanel-02.png" class="img-responsive" alt=""></span>
                    <div class="info-box-content">
                        <span>VENTA DEL MES:</span>
                        <span style="font-size: 18px;" id="venta"></span>
                        <br>
                        <span>VENTA PARA LLEVAR:</span>
                        <span style="font-size: 18px;" id="ventaPl"></span>
                        <br>
                        <span>VENTA APPS:</span>
                        <span style="font-size: 18px;" id="ventaApps"></span>
                    </div>
                </div>
            </div>

            <div class="col-sm-4 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon" style="border:2px solid #006b8e;border-radius:10px; background-color:#006b8e;">
                        <img src="/img/iconospanel-03.png" class="img-responsive" alt=""></span>
                    <div class="info-box-content">
                        <span>ÓRDENES DEL DÍA:</span>
                        <span style="font-size: 18px;" id="ordenD"></span>
                        <br>
                        <span>ÓRDENES DEL MES:</span>
                        <span style="font-size: 18px;" id="orden"></span>
                    </div>
                </div>
            </div>

            <div class="col-sm-4 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon" style="border:2px solid #006b8e;border-radius:10px; background-color:#006b8e;">
                        <img src="/img/iconospanel-05.png" class="img-responsive" alt=""></span>
                    <div class="info-box-content">
                        <span>RESERVAS DEL MES:</span>
                        <span style="font-size: 18px;" id="event"></span>
                        <br>
                        <span>RESERVAS DEL DÍA:</span>
                        <span style="font-size: 18px;" id="eventD"></span>
                    </div>
                </div>
            </div>

            <div class="col-sm-4 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon" style="border:2px solid #006b8e;border-radius:10px; background-color:#006b8e;">
                        <img src="/img/iconospanel-04.png" class="img-responsive" alt=""></span>
                    <div class="info-box-content">
                        <span>MESAS:</span>
                        <span style="font-size: 18px;" id="mesa"></span>
                        <br>
                        <span>PRODUCTOS:</span>
                        <span style="font-size: 18px;" id="producto"></span>
                    </div>
                </div>
            </div>

            <div class="col-sm-4 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon" style="border:2px solid #006b8e;border-radius:10px; background-color:#006b8e;">
                        <img src="/img/iconospanel-06.png" class="img-responsive" alt=""></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Personal:</span>
                        <span class="info-box-number" id="user"></span>
                        {{-- <span class="info-box-number" id="user">{{$user}}</span> --}}
                    </div>
                </div>
            </div>

            <div class="col-sm-4 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon"
                        style="border:2px solid #006b8e;border-radius:10px; background-color:#006b8e;"><img
                            src="/img/iconospanel-08.png" class="img-responsive" alt=""></span>
                    <div class="info-box-content">
                        <span>PRODUCTOS CANCELADOS AL MES:</span>
                        <span style="font-size: 18px;" id="cancelado"></span>
                        <br>
                        <span>PRODUCTOS CANCELADOS AL DÍA: </span>
                        <span style="font-size: 18px;" id="canceladoD"><strong></strong></span>
                    </div>
                </div>
            </div>

            <div class="col-sm-4 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon"
                        style="border:2px solid #006b8e;border-radius:10px; background-color:#006b8e;"><img
                            src="/img/iconospanel-09.png" class="img-responsive" alt=""></span>
                    <div class="info-box-content">
                        <span>PRODUCTOS ELIMINADOS AL MES:</span>
                        <span style="font-size: 18px;" id="eliminado"></span>
                        <br>
                        <span>PRODUCTOS ELIMINADOS AL DÍA: </span>
                        <span style="font-size: 18px;" id="eliminadoD"></span>
                    </div>
                </div>
            </div>

            <div class="col-sm-4 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon"
                        style="border:2px solid #006b8e;border-radius:10px; background-color:#006b8e;"><img
                            src="/img/iconospanel-07.png" class="img-responsive" alt=""></span>
                    <div class="info-box-content">
                        <span>MESAS CANCELADAS AL MES:</span>
                        <span style="font-size: 18px;" id="mesasC"></span>
                        <br>
                        <span>MESAS CANCELADAS AL DÍA: </span>
                        <span style="font-size: 18px;" id="mesasCD"></span>
                    </div>
                </div>
            </div>

            <div class="col-sm-4 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon"
                        style="border:2px solid #006b8e;border-radius:10px; background-color:#006b8e;"><img
                            src="/img/iconospanel-10.png" class="img-responsive" alt=""></span>
                    <div class="info-box-content">
                        <span>DESCUENTOS DEL MES:</span>
                        <span style="font-size: 18px;" id="descuento"></span>
                        <br>
                        <span>DESCUENTOS DEL DÍA: </span>
                        <span style="font-size: 18px;" id="descuentoD"></span>
                    </div>
                </div>
            </div>

            <div class="col-sm-4 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon"
                        style="border:2px solid #006b8e;border-radius:10px; background-color:#006b8e;"><img
                            src="/img/iconospanel-11.png" class="img-responsive" alt=""></span>
                    <div class="info-box-content">
                        <span>PROPINAS DEL MES:</span>
                        <span style="font-size: 18px;" id="propina"></span>
                        <br>
                        <span>PROPINAS DEL DÍA: </span>
                        <span style="font-size: 18px;" id="propinaD"></span>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if (Auth::check() && Auth::user()->role == 'cajero')
        <div class="row justify-content-center align-items-center g-2 mt-5">
            <div class="col-5">

                <div class="card text-center">
                  <img class="card-img-top" src="{{ asset('img/imagenes-07.png') }}" alt="Title">
                  <div class="card-body">
                    <h2 class="text-center mb-4">¡Acceso Denegado!</h2>
                    <p class="card-text mb-3">No cuenta con los permisos necesarios para acceder al <b>Resumen Administrativo</b> del sistema.</p>
                    {{-- <p class="text-center">Por fa <a href="/restaurante" style="text-decoration: underline; font-weight: bold">Configuración General</a></p> --}}
                  </div>
                </div>

            </div>
        </div>
    @endif

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
        // On window load
        window.onload = function () {
            localStorage.setItem("DataOnTime", '');
            getDataOnTime();
        }

        // On window unload
        window.onbeforeunload = function () {
            localStorage.removeItem("DataOnTime");
        };

        function getDataOnTime(){

            var resume = localStorage.getItem("DataOnTime");

            $.get('api/resumeSales', function (data) {
                // console.log(data);

                if(resume != ''){
                    data = JSON.stringify(data);

                    if(data != resume){

                        data = JSON.parse(data);

                        var html_select = '';

                        $('#ventaD').empty();
                        $('#ventaDPl').empty();
                        $('#ventaAppsD').empty();
                        $('#venta').empty();
                        $('#ventaPl').empty();
                        $('#ventaApps').empty();
                        $('#ordenD').empty();
                        $('#orden').empty();
                        $('#event').empty();
                        $('#eventD').empty();
                        $('#mesa').empty();
                        $('#producto').empty();
                        $('#user').empty();
                        $('#cancelado').empty();
                        $('#canceladoD').empty();
                        $('#eliminado').empty();
                        $('#eliminadoD').empty();
                        $('#mesasC').empty();
                        $('#mesasCD').empty();
                        $('#descuento').empty();
                        $('#descuentoD').empty();
                        $('#propina').empty();
                        $('#propinaD').empty();

                        html_select = `<strong>${data.ventaD}</strong>`;
                        $('#ventaD').html(html_select);
                        html_select = `<strong>${data.ventaDPl}</strong>`;
                        $('#ventaDPl').html(html_select);
                        html_select = `<strong>${data.ventaAppsD}</strong>`;
                        $('#ventaAppsD').html(html_select);
                        html_select = `<strong>${data.venta}</strong>`;
                        $('#venta').html(html_select);
                        html_select = `<strong> ${data.ventaPl}</strong>`;
                        $('#ventaPl').html(html_select);
                        html_select = `<strong> ${data.ventaApps}</strong>`;
                        $('#ventaApps').html(html_select);
                        html_select = `<strong>${data.ordenD}</strong>`;
                        $('#ordenD').html(html_select);
                        html_select = `<strong>${data.orden}</strong>`;
                        $('#orden').html(html_select);
                        html_select = `<strong>${data.event}</strong>`;
                        $('#event').html(html_select);
                        html_select = `<strong>${data.eventD}</strong>`;
                        $('#eventD').html(html_select);
                        html_select = `<strong>${data.mesa}</strong>`;
                        $('#mesa').html(html_select);
                        html_select = `<strong>${data.producto}</strong>`;
                        $('#producto').html(html_select);
                        html_select = `<strong>${data.user}</strong>`;
                        $('#user').html(html_select);
                        html_select = `<strong>${data.cancelado}</strong>`;
                        $('#cancelado').html(html_select);
                        html_select = `<strong>${data.canceladoD}</strong>`;
                        $('#canceladoD').html(html_select);
                        html_select = `<strong>${data.eliminado}</strong>`;
                        $('#eliminado').html(html_select);
                        html_select = `<strong>${data.eliminadoD}</strong>`;
                        $('#eliminadoD').html(html_select);
                        html_select = `<strong>${data.mesasC}</strong>`;
                        $('#mesasC').html(html_select);
                        html_select = `<strong>${data.mesasCD}</strong>`;
                        $('#mesasCD').html(html_select);
                        html_select = `<strong>${data.descuento}</strong>`;
                        $('#descuento').html(html_select);
                        html_select = `<strong>${data.descuentoD}</strong>`;
                        $('#descuentoD').html(html_select);
                        html_select = `<strong>${data.propina}</strong>`;
                        $('#propina').html(html_select);
                        html_select = `<strong>${data.propinaD}</strong>`;
                        $('#propinaD').html(html_select);

                        data = JSON.stringify(data);
                        localStorage.setItem("DataOnTime",data);
                    }

                } else {

                        var html_select = '';

                        html_select = `<strong>${data.ventaD}</strong>`;
                        $('#ventaD').html(html_select);
                        html_select = `<strong>${data.ventaDPl}</strong>`;
                        $('#ventaDPl').html(html_select);
                        html_select = `<strong>${data.ventaAppsD}</strong>`;
                        $('#ventaAppsD').html(html_select);
                        html_select = `<strong>${data.venta}</strong>`;
                        $('#venta').html(html_select);
                        html_select = `<strong> ${data.ventaPl}</strong>`;
                        $('#ventaPl').html(html_select);
                        html_select = `<strong> ${data.ventaApps}</strong>`;
                        $('#ventaApps').html(html_select);
                        html_select = `<strong>${data.ordenD}</strong>`;
                        $('#ordenD').html(html_select);
                        html_select = `<strong>${data.orden}</strong>`;
                        $('#orden').html(html_select);
                        html_select = `<strong>${data.event}</strong>`;
                        $('#event').html(html_select);
                        html_select = `<strong>${data.eventD}</strong>`;
                        $('#eventD').html(html_select);
                        html_select = `<strong>${data.mesa}</strong>`;
                        $('#mesa').html(html_select);
                        html_select = `<strong>${data.producto}</strong>`;
                        $('#producto').html(html_select);
                        html_select = `<strong>${data.user}</strong>`;
                        $('#user').html(html_select);
                        html_select = `<strong>${data.cancelado}</strong>`;
                        $('#cancelado').html(html_select);
                        html_select = `<strong>${data.canceladoD}</strong>`;
                        $('#canceladoD').html(html_select);
                        html_select = `<strong>${data.eliminado}</strong>`;
                        $('#eliminado').html(html_select);
                        html_select = `<strong>${data.eliminadoD}</strong>`;
                        $('#eliminadoD').html(html_select);
                        html_select = `<strong>${data.mesasC}</strong>`;
                        $('#mesasC').html(html_select);
                        html_select = `<strong>${data.mesasCD}</strong>`;
                        $('#mesasCD').html(html_select);
                        html_select = `<strong>${data.descuento}</strong>`;
                        $('#descuento').html(html_select);
                        html_select = `<strong>${data.descuentoD}</strong>`;
                        $('#descuentoD').html(html_select);
                        html_select = `<strong>${data.propina}</strong>`;
                        $('#propina').html(html_select);
                        html_select = `<strong>${data.propinaD}</strong>`;
                        $('#propinaD').html(html_select);

                        data = JSON.stringify(data);
                        localStorage.setItem("DataOnTime",data);
                }

            });
        }

        $( document ).ready(function() {
            setInterval(getDataOnTime, 5000);//Cada 10 segundo (30 mil milisegundos)
        });
    </script>

@endsection

@section('footer')
    @include('footer')
@endsection

@section('chartjs')
    <script>
        var url = "{{url('Setting/grafica')}}";
        var mes = new Array();
        var contador = new Array();
        $(document).ready(function () {
            $.get(url, function (response) {
                response.forEach(function (data) {
                    mes.push(data.mes);
                    contador.push(data.contador);
                });

                var ctx = document.getElementById("Comida").getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: mes,
                        datasets: [{
                            label: 'Ventas del año',
                            data: contador,
                            backgroundColor: 'rgba(146,232,66,0.57)',
                            borderColor: 'rgba(210,255,82,1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
            });
        });

    </script>
@endsection
