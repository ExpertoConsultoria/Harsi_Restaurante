@extends('layouts.app')
@section('content')
@section('imagen')
<a class="navbar-brand" href="{{ url('/inicio') }}">
<img src="../../img/imagenes-07.png" alt="" width="120" height="40">
</a>
@endsection
@section('auth')
<label><img src="../../img/usuario.png" alt="" width="25" height="25"> {{ Auth::user()->name }}</label>
@endsection
@section('opciones')
<img src="../../img/opciones.png" alt="" width="25" height="25">
@endsection
<link href="{{ asset('css/ticket.css') }}" rel="stylesheet">
<header class="clearfix">
  <div id="logo">
    <img src="../../img/imagenes-07.png" width="200" height="80">
  </div>
  <div id="company">
    <h2 class="name">{{$restaurante['nombre']}}</h2>
    <div>{{$restaurante['direccion']}}</div>
    <div>{{$restaurante['telefono']}}</div>
  </div>
  <br>
<h2>Venta diario</h2>
    <button  class="oculto-impresion btn btn-primary" onclick="imprimir()">Imprimir</button>
    <a type="button" class="oculto-impresion btn btn-warning" href="{{ URL::previous() }}">Regresar</a>
    <a id="pdf" href="/ventaDiarioPdf/{{$estado}}/{{$fecha}}"><button  class="oculto-impresion btn btn-primary" >Descargar Pdf</button></a>
<br>
 </header>
            <div class="table-responsive">
                <table  class="table table-striped">
                   <thead>
                        <tr>
                            <th width="col">Folio</th>
                            <th width="col">Fecha</th>
                            <th width="col">Mesa</th>
                            <th width="col">Cajero</th>
                            <th width="col">Productos</th>
                            <th width="col">Forma de Pago</th>
                            <th width="col">Importe</th>
                            <th width="col">Descuento</th>
                            <th width="col">Motivo del descuento</th>
                            <th width="col">Subtotal</th>
                            <th width="col">Propina</th>
                            <th width="col">Cupón</th>
                            <th width="col">Total</th>
                            <th scope="col">Creación</th>
                        </tr>
                    </thead>
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
                </table>

            </div>

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
