<br>
<form method="POST" action="{{ route('usuarios.store') }}" autocomplete="off">
    @csrf
    <div class="form-group row">
        <label for="name" class="col-md-2 col-md-offset-1 text-center">{{ __('Nombre') }}</label>
            <div class="col-md-8">
                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
            @if ($errors->has('name'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
            </div>
    </div>
    <div class="form-group row">
        <label for="apellidos" class="col-md-2 col-md-offset-1 text-center">{{ __('Apellidos') }}</label>
            <div class="col-md-8">
                <input id="apellidos" type="text" class="form-control{{ $errors->has('apellidos') ? ' is-invalid' : '' }}" name="apellidos" value="{{ old('apellidos') }}" required autofocus>

            @if ($errors->has('apellidos'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('apellidos') }}</strong>
                </span>
            @endif
            </div>
    </div>    
    <div class="form-group row">
        <label for="email" class="col-md-2 col-md-offset-1 text-center">{{ __('E-Mail') }}</label>
            <div class="col-md-8">
                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

            @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
            </div>
    </div>
    @if (Auth::check() && Auth::user()->role == 'desarrollador')
    <div class="form-group row">
        <label for="role" class="col-md-2 col-md-offset-1 text-center">Permisos</label>
         <div class="col-md-8">
            <select name="role" class="form-control" >
                <option value="administrador">Administrador</option>
                <option value="desarrollador">Programador</option>
                <option value="cajero">Cajero</option>
            </select> 
        </div>
    </div>
    @endif
    @if (Auth::check() && Auth::user()->role == 'administrador')
    <div class="form-group row">
        <label for="role" class="col-md-2 col-md-offset-1 text-center">Permisos</label>
         <div class="col-md-8">
            <select name="role" class="form-control" >
                <option value="administrador">Administrador</option>
                <option value="cajero">Cajero</option>
            </select> 
        </div>
    </div>
     <div class="form-group row">
        <label for="turno" class="col-md-2 col-md-offset-1 text-center">Turno</label>
        <div class="col-md-8">
        <select id="turno"   name="turno" class="form-control"   required="turno" >
          
          @foreach ($horario as $h)
          <option  value="{{$h->turno}}">{{$h->turno}}</option>
          @endforeach
        </select>
        </div>
      </div>
    @endif
  
    <div class="form-group row">
        <label for="password" class="col-md-2 col-md-offset-1 text-center">{{ __('Contraseña') }}</label>
        <div class="col-md-8">
            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
            @if ($errors->has('password'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>
    </div>
   
 
    <div class="form-group row">
        <div class="col-md-12 text-center">
            <button type="submit" class="btn btn-primary">
                {{ __('Registrar') }}
            </button>
        </div>
    </div>
</form>