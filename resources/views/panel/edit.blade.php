@extends('layouts.app')
@section('content')
@foreach($mesas as $mesas)
<form action="{{ route('panel.update', $mesas->id) }}" method="post">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <div class="form-group">
        <label class="control-label col-md-6" >Número de mesa </label>
        <div class="col-md-8">
            <input type="text" name="titulo" id="titulo" value="{{ $mesas->titulo }}" class="form-control" />
        </div>
    </div>

     <div class="form-group">
        <label class="control-label col-md-6">¿Seguro que quiere abrir la comanda? </label>
        <div class="col-md-8">
           <select id="estado" type="text" class="form-control" name="estado" value="{{ old('estado_id') }}" required>
              <option value="Cerrada">SI</option>
              <option value="Abierta">NO</option>
            </select>
        </div>
    </div>

    <div class="form-group row ">
       <div class=" offset-md-6">
           <button type="submit" class="btn btn-primary">
               {{ __('Guardar') }}
           </button>
       </div>
    </div>
</form>
@endforeach
@endsection