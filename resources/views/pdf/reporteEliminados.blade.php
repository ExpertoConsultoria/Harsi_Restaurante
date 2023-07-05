@extends('layouts.app')
@section('content')
@section('imagen')
<a class="navbar-brand" href="{{ url('/inicio') }}">
<img src="../../../img/imagenes-07.png" alt="" width="120" height="40">
</a>
@endsection
@section('auth')
<label><img src="../../../img/usuario.png" alt="" width="25" height="25"> {{ Auth::user()->name }}</label>
@endsection
@section('opciones')
<img src="../../../img/opciones.png" alt="" width="25" height="25">
@endsection
<link href="{{ asset('css/ticket.css') }}" rel="stylesheet">
@csrf
<header class="clearfix">
  <div id="logo">
    <img src="../../../img/imagenes-07.png" width="200" height="80">
  </div>
  <div id="company">
    <h2 class="name">{{$restaurante['nombre']}}</h2>
    <div>{{$restaurante['direccion']}}</div>
    <div>{{$restaurante['telefono']}}</div>
  </div>
  <br>
<h2>Productos eliminados al mes</h2>
    <button  class="oculto-impresion btn btn-primary" onclick="imprimir()">Imprimir</button>
    <a type="button" class="oculto-impresion btn btn-warning" href="{{ URL::previous() }}">Regresar</a>
<br>
 </header>
  <table class="table table-striped">
    <thead>
        <tr>
            <th>N°</th>
            <th>Fecha</th>
            <th>Día</th>
            <th>Número de eliminados</th>
            <th>Total</th>
            <th>Motivo</th>
            <th>Mes</th>
            <th>Año</th>
        </tr>                            
    </thead>
    <tfoot>
       <tr>
       <td style="font-weight: bold;">Total</td>
       <td></td>
       <td></td>
       <td style="font-weight: bold;">{{$eliminado}}</td>
       <td style="font-weight: bold;">{{$total}}</td>                   
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
        <td>{{ $orden->fecha }}</td>
        <td>{{ $orden->dia }}</td>
        <td>{{ $orden->contador }}</td>
        <td>{{ $orden->total }}</td>
        <td>{{ $orden->motivo }}</td>
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
  var lbimagen= document.getElementById('imagen');
  lbimagen.innerHTML = '';
  var lbopciones= document.getElementById('opciones');
  lbopciones.innerHTML = '';
  var lbauth= document.getElementById('auth');
  lbauth.innerHTML = '';
  
    function imprimir() {
      window.print();
    }    
</script>
@endsection
