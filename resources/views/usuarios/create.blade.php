<form method="POST" action="{{ route('usuarios.store') }}" autocomplete="off" class="px-2">
    @csrf
    <div class="form-group row">
        <label for="name" class="col-md-3 offset-md-1 col-form-label">{{ __('Nombre') }}</label>
        <div class="col-md-7">
            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
            @if ($errors->has('name'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group row">
        <label for="apellidos" class="col-md-3 offset-md-1 col-form-label">{{ __('Apellidos') }}</label>
        <div class="col-md-7">
            <input id="apellidos" type="text" class="form-control{{ $errors->has('apellidos') ? ' is-invalid' : '' }}" name="apellidos" value="{{ old('apellidos') }}" required>
            @if ($errors->has('apellidos'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('apellidos') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group row">
        <label for="email" class="col-md-3 offset-md-1 col-form-label">{{ __('E-Mail') }}</label>
        <div class="col-md-7">
            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
            @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
    </div>

    @if (Auth::check() && Auth::user()->role == 'administrador')
        <div class="form-group row">
            <label for="role" class="col-md-3 offset-md-1 col-form-label">Permisos</label>
            <div class="col-md-7">
                <select name="role" class="form-control">
                    <option value="administrador">Administrador</option>
                    <option value="cajero">Cajero</option>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label for="turno" class="col-md-3 offset-md-1 col-form-label">Turno</label>
            <div class="col-md-7">
                <select id="turno" name="turno" class="form-control" required>
                    @foreach ($horario as $h)
                        <option value="{{ $h->turno }}">{{ $h->turno }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    @endif

    <div class="form-group row">
        <label for="password" class="col-md-3 offset-md-1 col-form-label">{{ __('Contraseña') }}</label>
        <div class="col-md-7">
            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
            @if ($errors->has('password'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group row">
        <div class="text-center col-md-12">
            <button type="submit" class="btn btn-primary">
                {{ __('Registrar') }}
            </button>
        </div>
    </div>
</form>
