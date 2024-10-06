@extends('layouts.reporte')

@section('title')
Productos del restaurante
@endsection

@section('t-headers')
    <th>N°</th>
    <th>Nombre</th>
    <th>Precio</th>
    <th>Fecha de ingreso</th>
@endsection

@section('t-body')
    <tbody>
        @php
            $no = 1;
        @endphp
        @foreach($productos as $productos)
            <tr>
                <td>{{ $no++ }}</td>
                <td><h5>{{ $productos->titulo }}</h5></td>
                <td>{{ $productos->precio }}</td>
                <td>{{ $productos->created_at }}</td>
            </tr>
        @endforeach
    </tbody>
@endsection
