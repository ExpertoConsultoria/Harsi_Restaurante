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
<h2>Mesas canceladas al día</h2>
    <button  class="oculto-impresion btn btn-primary" onclick="imprimir()">Imprimir</button>
    <a type="button" class="oculto-impresion btn btn-warning" href="{{ URL::previous() }}">Regresar</a>
<br>
 </header>
            <div class="table-responsive">
                <table  class="table table-striped">
                   <thead>
                        <tr>
                            <th width="col">Nº</th>
                            <th width="col">Fecha</th>
                            <th width="col">Mesa</th>
                            <th width="col">Cajero</th>                    
                            <th width="col">Total</th>
                            <th width="col">Motivo</th>
                            <th width="col">Comentario</th>
                            <th scope="col">Creación</th>
                        </tr>
                    </thead>
                <tfoot>
                    <tr>
                    <td style="font-weight: bold;">Total</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td style="font-weight: bold;">{{$total}}</td>
                    <td></td>
                    <td></td>   
                    </tr>             
                </tfoot>
                @php
                $no = 1;
                @endphp
                    <tbody>
                        @foreach($mesas as $temporal)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{$temporal['fecha']}}</td>
                            <td>{{$temporal['mesa']}}</td>
                            <td>{{$temporal['cajero']}}</td>
                            <td>{{$temporal['total']}}</td>
                            <td>{{$temporal['motivo']}}</td>
                            <td>{{$temporal['comentario']}}</td>
                            <td>{{$temporal['created_at']}}</td> 
                         </tr>
                        @endforeach
                    </tbody>
                </table>
              
            </div>

@endsection
@section('ticket')
<script>
    function imprimir() {
      window.print();
    }    

  var lbimagen= document.getElementById('imagen');
  lbimagen.innerHTML = '';
  var lbopciones= document.getElementById('opciones');
  lbopciones.innerHTML = '';
  var lbauth= document.getElementById('auth');
  lbauth.innerHTML = '';
</script>
@endsection