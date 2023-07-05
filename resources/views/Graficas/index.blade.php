@extends('adminlte::page')
@section('content')
<div class="row">
    <div class="col-md-12">
        <h1 align="left">Informes</h1>
        <br>
        <div class="box box-success">
            <div class="box-body">
                <div class="chart">
                    <canvas id="Comida" height="500" width="1000"></canvas>
                </div>
            </div>
        </div>
    </div>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // On window load
    window.onload= function(){
        localStorage.setItem("GraficaData", '');
        getProducts();
    }

    // On window unload
    window.onbeforeunload = function(){
        localStorage.removeItem("GraficaData");
    };

    var Articulo = new Array();
    var TotalVentas = new Array();

    function getProducts() {
        var grafica = localStorage.getItem("GraficaData");

        $.get('api/Graficas/chart', function (response) {

                if(grafica != ''){
                    response = JSON.stringify(response);

                    if(response != grafica){

                        Articulo = [];
                        TotalVentas = [];

                        response = JSON.parse(response);
                            response.forEach(function (data) {
                                Articulo.push(data.articulo);
                                TotalVentas.push(data.TotalVentas);
                            });

                            var ctx = document.getElementById("Comida").getContext('2d');
                            var myChart = new Chart(ctx, {
                                type: 'line',
                                data: {
                                    labels: Articulo,
                                    datasets: [{
                                        label: 'Productos más vendidos',
                                        data: TotalVentas,
                                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                                        borderColor: 'rgba(54, 162, 235, 1)',
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
                        response = JSON.stringify(response);
                        localStorage.setItem("GraficaData",response);
                    }

                } else {
                    response.forEach(function (data) {
                        Articulo.push(data.articulo);
                        TotalVentas.push(data.TotalVentas);
                    });

                    var ctx = document.getElementById("Comida").getContext('2d');
                    var myChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: Articulo,
                            datasets: [{
                                label: 'Productos más vendidos',
                                data: TotalVentas,
                                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                                borderColor: 'rgba(54, 162, 235, 1)',
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
                    response = JSON.stringify(response);
                    localStorage.setItem("GraficaData",response);
                }
        });
    }
    $(document).ready(function () {
        setInterval(getProducts, 30000); //Cada 30 segundo (30 mil milisegundos)
    });

</script>
@section('footer')
@include('footer')
@endsection
@endsection
