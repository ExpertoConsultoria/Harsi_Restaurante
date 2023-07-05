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

</style>

<div class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="well well-sm">

                <fieldset>
                    <legend class="text-center header">Modificar usuario</legend>


                    @foreach($user as $ad)
                    <form action="{{ route('usuarios.update', $ad->id) }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        <div class="form-group row">
                            <label for="name" class="col-md-1 col-md-offset-1 text-center">{{ __('Nombre') }}</label>
                            <div class="col-md-8">
                                <input id="name" type="text"
                                    class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name"
                                    value="{{ $ad->name }}" required>

                                @if ($errors->has('name'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>



                        <div class="form-group row">
                            <label for="apellidos"
                                class="col-md-1 col-md-offset-1 text-center">{{ __('Apellidos') }}</label>
                            <div class="col-md-8">
                                <input id="apellidos" type="text"
                                    class="form-control{{ $errors->has('apellidos') ? ' is-invalid' : '' }}"
                                    name="apellidos" value="{{ $ad->apellidos }}" required>

                                @if ($errors->has('apellidos'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('apellidos') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        @if (Auth::check() && Auth::user()->role == 'desarrollador')
                            <div class="form-group row">
                                <label for="role" class="col-md-1 col-md-offset-1 text-center">{{ __('Rol') }}</label>
                                <div class="col-md-8">
                                    <select id="role" type="text" class="form-control col-md-6 col-form-label text-md-right"
                                        name="role" value="{{ $ad->role }}" required>

                                        @foreach($user as $user)
                                        <option value="{{ $user->role }}" disabled>{{ Str::ucfirst($user->role) }}</option>
                                        <option value="administrador">Administrador</option>
                                        <option value="cajero">Cajero</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('role'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('role') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        @endif

                        @if (Auth::check() && Auth::user()->role == 'administrador')
                            <div class="form-group row">
                                <label for="role" class="col-md-1 col-md-offset-1 text-center">{{ __('Rol') }}</label>
                                <div class="col-md-8">
                                    <select id="role" type="text" class="form-control col-md-6 col-form-label text-md-right"
                                        name="role" value="{{ $ad->role }}" required>

                                        @foreach($user as $user)
                                        <option value="{{ $user->role }}" disabled>{{ Str::ucfirst($user->role) }}</option>
                                        <option value="administrador">Administrador</option>
                                        <option value="cajero">Cajero</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('role'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('role') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        @endif


                        <div class="form-group row">
                            <label for="turno" class="col-md-1 col-md-offset-1 text-center">Turno</label>
                            <div class="col-md-8">
                                <select id="turno" name="turno" class="form-control" required="turno">
                                    <option selected="" value="{{ $user->turno }}">{{ $user->turno }}</option>
                                    @foreach ($horario as $h)
                                    <option value="{{$h->turno}}">{{$h->turno}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-1 col-md-offset-1 text-center">{{ __('E-Mail') }}</label>

                            <div class="col-md-8">
                                <input id="email" type="text"
                                    class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                                    value="{{ $ad->email }}" required>

                                @if ($errors->has('email'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group row ">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary"
                                    onclick="return confirm('Seguro de guardar los cambios {{ $ad->name }} {{ $ad->apellidos }} ?')">
                                    {{ __('Guardar') }}
                                </button>
                            </div>
                        </div>


                        <div class="form-group row ">
                            <div class="col-md-12 text-center">
                                <button class="btn btn-primary"
                                    action="{{ url()->previous() }}">Cancelar</button>

                            </div>
                        </div>




                    </form>
                    @endforeach
                </fieldset>

            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    var lbopciones = document.getElementById('opciones');
    lbopciones.innerHTML = '';
    var lbauth = document.getElementById('auth');
    lbauth.innerHTML = '';

</script>
@endsection
@section('footer')
@include('footer')
@endsection
