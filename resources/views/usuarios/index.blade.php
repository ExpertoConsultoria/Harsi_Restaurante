@extends('adminlte::page')
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <h1 class="mb-4">Usuarios</h1>

    @if ($message = Session::get('success'))
        <div class="alert alert-success" role="alert">
            {{ $message }}
        </div>
    @endif

    <div class="my-4 d-flex justify-content-between">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
            ✚ Nuevo usuario
        </button>
        <a href="/horario" class="btn btn-secondary">Revisar Horarios</a>
    </div>

    <div class="table-responsive">
        <table id="tableUserList" class="table table-hover table-sm">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellidos</th>
                    <th scope="col">Permisos</th>
                    <th scope="col">Turno</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Creación</th>
                    <th scope="col">Actualización</th>
                    <th scope="col" width="20%">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($user as $index => $ad)
                    <tr>
                        <th scope="row">{{ $index + 1 }}</th>
                        <td>{{ $ad['name'] }}</td>
                        <td>{{ $ad['apellidos'] }}</td>
                        <td class="text-capitalize">{{ $ad['role'] }}</td>
                        <td>{{ $ad['turno'] }}</td>
                        <td>{{ $ad['email'] }}</td>
                        <td>{{ \Carbon\Carbon::parse($ad['created_at'])->format('Y-m-d') }}</td>
                        <td>{{ $ad['updated_at'] }}</td>
                        <td>
                            <form action="{{ route('usuarios.destroy', $ad->id) }}" method="post" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <a href="{{ route('usuarios.edit', $ad->id) }}" class="btn btn-link" title="Editar">
                                    <img src="../img/edit.png" width="30" height="28" alt="Editar">
                                </a>
                                <button type="submit" class="btn btn-link" title="Eliminar"
                                    onclick="return confirm('Seguro quieres eliminar a {{ $ad->name }} {{ $ad->apellidos }} ?')">
                                    <img src="../img/trash.png" width="30" height="28" alt="Eliminar">
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h5 class="modal-title" id="myModalLabel">Agregar usuario</h5>
                </div>
                <div class="modal-body">
                    @include('usuarios.create')
                </div>
            </div>
        </div>
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
