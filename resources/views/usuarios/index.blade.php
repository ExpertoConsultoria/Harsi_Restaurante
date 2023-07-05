@extends('adminlte::page')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<h1 align="left">Usuarios</h1>
@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif
<div class="row">
<div class="col-md-3" >
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
    ✚ Nuevo usuario
</button>
</div>
<div class="col-md-2" >
 <a href="/horario"><button type="button"  href="/horario" name="horario" id="horario" class="btn btn-primary">Horarios</button></a>   
</div>
</div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close glyphicon glyphicon-remove" data-dismiss="modal" aria-label="Close">
                </button>
                <h4 class="modal-title" id="myModalLabel">Agregar usuario</h4>
            </div>
            <div class="modal-body">
                @include('usuarios.create')
            </div>
        </div>
    </div>
</div>

 <div id="formModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Horario cajeros</h4>
                        </div>
                        <div class="modal-body">
                            <span id="form_result"></span>
                            <form method="post" id="sample_form" class="form-horizontal" enctype="multipart/form-data" autocomplete="off">
                                @csrf
                                <div class="form-group">
                                    <label class="control-label col-md-2" >Nombre  </label>
                                    <div class="col-md-8">
                                        <input type="text" name="titulo" id="titulo" class="form-control" required />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2" >Estado </label>
                                    <div class="col-md-8">
                                       <select id="estado" type="text" class="form-control" name="estado" value="{{ old('estado_id') }}" required>
                                            <option value="Abierta">Abierta</option>
                                            <option value="Cerrada">Cerrada</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2" >Color </label>
                                    <div class="col-md-8">
                                       <input type="color" name="color" id="color">
                                    </div>
                                </div>
                                <br>
                                <div class="form-group" align="center">
                                    <input type="hidden" name="action" id="action" />
                                    <input type="hidden" name="hidden_id" id="hidden_id" />
                                    <input type="submit" name="action_button" id="action_button" class="btn btn-warning" value="Add" />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
<br>
<br>

<div class="table-responsive">
    <table id="tableUserList" class="table table-hover">
        <thead  class="thead-dark ">
        <tr class="success">
            <th scope="col">No.</th>
            <th scope="col">Nombre</th>
            <th scope="col">Apellidos</th>
            <th scope="col">Permisos</th>
            <th scope="col">Turno</th>
            <th scope="col">Correo</th>
            <th scope="col">Fecha de creación</th>
            <th scope="col">Actualización</th>
            <th scope="col">Acciones</th>
        </tr>
        </thead>

        <tbody>
        @php
            $no = 1;
        @endphp
        @foreach($user as $ad)
            <tr>
                <th scope="row" style="cursor: context-menu;">{{ $no++ }}</th>
                <td style="cursor: pointer;">{{$ad['name']}}</td>
                <td style="cursor: context-menu;">{{$ad['apellidos']}}</td>
                <td style="cursor: context-menu;">{{$ad['role']}}</td>
                <td style="cursor: context-menu;">{{$ad['turno']}}</td>
                <td style="cursor: context-menu;">{{$ad['email']}}</td>
                <td>{{$ad['created_at']}}</td>
                <td>{{$ad['updated_at']}}</td>
                <td>
                    <form action="{{ route('usuarios.destroy', $ad->id) }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <a type="submit" href="{{ route('usuarios.show',$ad->id) }}">
                            <img  src="../img/ver.png " width="30" height="28">
                        </a>
                        <a type="submit" id="correctoinsertdoc" href="{{ route('usuarios.edit',$ad->id) }}">
                            <img  src="../img/edit.png " width="30" height="28">
                        </a>
                        <button type="submit" onclick="return confirm('Seguro quieres eliminar a {{ $ad->name }} {{ $ad->apellidos }} ?')">
                            <img  src="../img/trash.png " width="30" height="28">
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

@endsection
@section('footer')
    @include('footer')
@endsection
@section('tabla')
<script src="{{asset('js/script.js')}}" defer></script>
<script>
    window.onload = function () {
        $("#tableUserList").paginationTdA({
            elemPerPage: 10
        });
    }
</script>
@endsection

