@extends('layouts.app')
@section('content')
<link href="{{ asset('css/ticket.css') }}" rel="stylesheet">
<header class="clearfix">
  <div id="logo">
    <img src="../img/imagenes-07.png" width="200" height="80">
  </div>
  <div id="company">
    <h2 class="name">{{$restaurante['nombre']}}</h2>
    <div>{{$restaurante['direccion']}}</div>
    <div>{{$restaurante['telefono']}}</div>
  </div>
  <br>
<h2>Venta anual</h2>
    <button  class="oculto-impresion btn btn-primary" onclick="imprimir()">Imprimir</button>
    <a type="button" class="oculto-impresion btn btn-warning" href="{{ URL::previous() }}">Regresar</a>
<br>
 </header>
  <table class="table table-striped">
    <thead>
        <tr>
            <th>N°</th>
            <th>Número de pedidos</th>
            <th>Corte final</th>
            <th>Descuentos</th>
            <th>Propinas</th>
            <th>Mes</th>
            <th>Año</th>
        </tr>                            
    </thead>
   <tfoot>
       <tr>
       <td style="font-weight: bold;">Total</td>
       <td></td>
       <td style="font-weight: bold;">{{$total}}</td>                   
       <td style="font-weight: bold;">{{$descuento}}</td>
       <td style="font-weight: bold;">{{$propina}}</td>
       <td></td>  
       <td></td>  
       </tr>             
    </tfoot>    
    <tbody>
    @php
        $no = 1;
    @endphp
     @foreach($orden as $orden)
      <tr>
        <td>{{ $no++ }}</td>
        <td>{{ $orden->contador }}</td>
        <td>{{ $orden->total }}</td>
        <td>{{ $orden->descuento }} </td>
        <td>{{ $orden->propina }}</td>
        @if($orden->mes == 1)
        <td>Enero</td>
        @endif
        @if($orden->mes == 2)
        <td>Febrero</td>
        @endif
        @if($orden->mes == 3)
        <td>Marzo</td>
        @endif
        @if($orden->mes == 4)
        <td>Abril</td>
        @endif
        @if($orden->mes == 5)
        <td>Mayo</td>
        @endif
        @if($orden->mes == 6)
        <td>Junio</td>
        @endif
        @if($orden->mes == 7)
        <td>Julio</td>
        @endif
        @if($orden->mes == 8)
        <td>Agosto</td>
        @endif
        @if($orden->mes == 9)
        <td>Septiembre</td>
        @endif
        @if($orden->mes == 10)
        <td>Octubre</td>
        @endif
        @if($orden->mes == 11)
        <td>Noviembre</td>
        @endif
        @if($orden->mes == 12)
        <td>Diciembre</td>
        @endif
        <td>{{ $orden->anno }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
@endsection
@section('ticket')
<script>
    function imprimir() {
      window.print();
    }    
</script>
@endsection

