<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>TICKET DE VENTA</title>
</head>
<header class="clearfix" >
<div class="text-center">
<img style="width:700px; height:250px;" src="{{ $message->embed('img/imagenes-07.png') }}">
</div>
<div> <h1 align="center"> {{$restaurante['nombre']}} </h5></div>
<div> <h1 align="center"> {{$restaurante['rfc']}} </h5></div>         
<div> <h3 align="center"> GRACIAS POR SU COMPRA! </h5></div>
</div>
<?php date_default_timezone_set('America/Mexico_City');?>
<p align="center"><strong>Fecha: </strong><?php echo date("Y-m-d");?> <strong> Hora: </strong><?php echo date("H:i:s");?></p>
</header>
<body >
<footer>
    <h6 align="center"><i class="fa fa-map-marker" aria-hidden="true"></i>{{$restaurante['direccion']}}</h6>
    <h6 align="center"><i class="fa fa-phone" aria-hidden="true">{{$restaurante['telefono']}}</i> </h6>
    <h6 align="center"><i class="fa fa-envelope-o" aria-hidden="true"></i>{{$restaurante['email']}} </h6>
</footer>
</body>

</html>