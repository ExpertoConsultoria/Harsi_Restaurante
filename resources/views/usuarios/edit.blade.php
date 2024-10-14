@extends('adminlte::page')

@section('content')
@section('auth')
    <label><img src="../../img/usuario.png" alt="" width="25" height="25"> {{ Auth::user()->name }}</label>
@endsection
@section('opciones')
    <img src="../../img/opciones.png" alt="" width="25" height="25">
@endsection

<style>
    .header {
        color: #006b8e;
        font-size: 27px;
        padding: 10px;
    }

    .bigicon {
        font-size: 35px;
        color: #36A0FF;
    }

    .form-label {
        font-weight: bold;
    }
</style>

<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="well well-sm">
                <fieldset>
                    <legend class="text-center header">Modificar usuario</legend>

                    <form action="{{ route('usuarios.update', $user->id) }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        <div class="form-group">
                            <label for="name" class="form-label">{{ __('Nombre') }}</label>
                            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $user->name }}" required>
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="apellidos" class="form-label">{{ __('Apellidos') }}</label>
                            <input id="apellidos" type="text" class="form-control{{ $errors->has('apellidos') ? ' is-invalid' : '' }}" name="apellidos" value="{{ $user->apellidos }}" required>
                            @if ($errors->has('apellidos'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('apellidos') }}</strong>
                                </span>
                            @endif
                        </div>

                        @if (Auth::check() && Auth::user()->role == 'administrador')
                            <div class="form-group">
                                <label for="role" class="form-label">{{ __('Rol') }}</label>
                                <select id="role" class="form-control" name="role" required>
                                    <option value="" disabled selected>{{ __('Selecciona un rol') }}</option>
                                    <option value="administrador">Administrador</option>
                                    <option value="cajero">Cajero</option>
                                    <option value="jefe_meseros">Jefe de Meseros</option>
                                    <option value="jefe_cocina">Jefe de Cocina</option>
                                </select>
                                @if ($errors->has('role'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('role') }}</strong>
                                    </span>
                                @endif
                            </div>
                        @endif

                        <div class="form-group">
                            <label for="turno" class="form-label">Turno</label>
                            <select id="turno" name="turno" class="form-control" required>
                                <option value="{{ $user->turno }}">{{ $user->turno }}</option>
                                @foreach ($horario as $h)
                                    <option value="{{ $h->turno }}">{{ $h->turno }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="email" class="form-label">{{ __('E-Mail') }}</label>
                            <input id="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $user->email }}" required>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="text-center form-group">
                            <button type="submit" class="btn btn-primary" onclick="return confirm('Seguro de guardar los cambios {{ $user->name }} {{ $user->apellidos }} ?')">
                                {{ __('Guardar') }}
                            </button>
                            &nbsp;
                            &nbsp;
                            &nbsp;
                            <a href="{{ url()->previous() }}" class="btn btn-default">Cancelar</a>
                        </div>
                    </form>
                </fieldset>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
<script>
    $(document).ready(function() {
        $('#opciones').empty();
        $('#auth').empty();
    });
</script>
@endsection

@section('footer')
@include('footer')
@endsection
