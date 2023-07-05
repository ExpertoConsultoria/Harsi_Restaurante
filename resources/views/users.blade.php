@extends('adminlte::page')
@section('content')



<div class="container">    
    <div class="row">
  <div class="col-xs-6 col-md-4">
      <div style="width:100%;">
        <canvas id = "charMasVenta" width = "400" height = "400"> </canvas>
      </div>
  </div>
  <div class="col-xs-6 col-md-4">
      <div class="col-sm">
            <div style="width:100%;">
                <canvas id = "charMasComida" width = "400" height = "400"> </canvas>
            </div>
       </div>
  </div>
</div>
</div>


@endsection
@section('chartjs')

<script>
var ctx = document.getElementById("charMasVenta").getContext('2d');
var charMasVenta = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ["Entomatadas", "Platillo 2", "Dato3", "Entomatadas", ],
        datasets: [{
            label: 'Desayuno mas vendido',
            data: [{{ $comanda1 }},{{ $comanda2 }},1,10 ],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});
</script>

<script>
var ctx = document.getElementById("charMasComida").getContext('2d');
var charMasComida = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ["Entomatadas", "Platillo 2", "Dato3", "Entomatadas", ],
        datasets: [{
            label: 'Comida mas vendida',
            data: [{{ $comanda1 }},{{ $comanda2 }},1,5 ],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});
</script>

@endsection
