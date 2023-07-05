@extends('adminlte::page')
@section('content')


<div class="jumbotron">
  <div class="container">
     <h1>{{ $user->name }}</h1>
        <table>
    <tbody>
        <tr>
            <td>Nombre</td>
            <td>:&nbsp;</td>
            <td>{{ $user->name }}</td>
        </tr>
        <tr>
            <td>Apellidos</td>
            <td>:&nbsp;</td>
            <td>{{ $user->apellidos }}</td>
        </tr>
        <tr>
            <td>Email</td>
            <td>:&nbsp;</td>
            <td>{{ $user->email }}</td>
        </tr>
          <tr>
            <td>Rol asignado</td>
            <td>:&nbsp;</td>
            <td>{{ $user->role }}</td>
        </tr>
    </tbody>
</table>
  </div>
</div>


@endsection
@section('footer')
    @include('footer')
@endsection
