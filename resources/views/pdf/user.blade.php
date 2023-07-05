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
<h2>Lista de usuarios del restaurante</h2>
    <button  class="oculto-impresion btn btn-primary" onclick="imprimir()">Imprimir</button>
    <a type="button" class="oculto-impresion btn btn-warning" href="{{ URL::previous() }}">Regresar</a>
<br>
 </header>
  <table class="table table-striped">
    <thead>
        <tr>
            <th>N°</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Rol</th>
            <th>Fecha de ingreso</th>
        </tr>                            
    </thead>
    <tbody>
    @php
        $no = 1;
    @endphp
     @foreach($user as $user)
        @if($user->role != 'desarrollador')
          <tr>
            <td>{{ $no++ }}</td>
            <td><h3>{{ $user->name }}</h3>{{ $user->apellidos }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->role }}</td>
            <td>{{ $user->created_at }}</td>
          </tr>
       @endif
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