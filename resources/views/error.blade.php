
@extends('layouts.errors')

@section('http_error')
    401 | Unauthorized
@endsection

@section('content')
    <div class="box">
        <div id="signal">
            ¡Acceso denegado!
        </div>
        <p id="come_back" style="cursor: pointer">Volver</p>
    </div>
@endsection
