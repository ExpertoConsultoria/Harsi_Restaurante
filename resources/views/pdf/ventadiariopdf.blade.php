<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Venta diario</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>

<header class="clearfix">
  <div id="logo">
    <img src="{{public_path('/img/imagenes-07.png')}}" width="200" height="80">
  </div>
  <div id="company">
    <h2 class="name">{{$restaurante['nombre']}}</h2>
    <div>{{$restaurante['direccion']}}</div>
    <div>{{$restaurante['telefono']}}</div>
  </div>
<h2>Venta diario</h2>
</header>
<body>
<table  class="table table-bordered">
<thead>
                            <tr>
                            <th scope="col">Folio</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Mesa</th>
                            <th scope="col">Cajero</th>
                            <th scope="col">Productos</th>
                            <th scope="col">Forma de Pago</th>
                            <th scope="col">Importe</th>
                            <th scope="col">Descuento</th>
                            <th scope="col">Motivo del descuento</th>
                            <th scope="col">Subtotal</th>
                            <th scope="col">Propina</th>
                            <th width="col">Cupón</th>
                            <th scope="col">Total</th>
                            <th scope="col">Creación</th>
                            </tr>
    </thead>

                <tbody>

                       @foreach($orden as $orden)
                       <tr>
                           <td>{{$orden['id']}}</td>
                           <td>{{$orden['fecha']}}</td>
                           <td>{{$orden['mesa']}}</td>
                           <td>{{$orden['cajero']}}</td>
                           <td>{{$orden['articulo']}}</td>
                           <td>{{$orden['forma_pago']}}</td>
                           <td>{{$orden['conf_total']}}</td>
                           <td>{{$orden['descuento_pesos']}}</td>
                           <td>{{$orden['motivo_descuento']}}</td>
                           <td>{{$orden['total']}}</td>
                           <td>{{$orden['propina']}}</td>
                           {{-- <td>{{$orden['cupon']}}</td> --}}
                           <td>{{$orden['total2']}}</td>
                           <td>{{$orden['created_at']}}</td>
                        </tr>
                       @endforeach
                   </tbody>
                   <tfoot>
                    <tr>
                    <td style="font-weight: bold;">Total</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td style="font-weight: bold;">{{$importe}}</td>
                    <td style="font-weight: bold;">{{$descuento}}</td>
                    <td></td>
                    <td style="font-weight: bold;">{{$total}}</td>
                    <td style="font-weight: bold;">{{$propina}}</td>
                    {{-- <td style="font-weight: bold;">{{$cupon}}</td> --}}
                    <td style="font-weight: bold;">{{$total2}}</td>
                    <td></td>
                    </tr>
                </tfoot>
</table>
</body>
</html>
