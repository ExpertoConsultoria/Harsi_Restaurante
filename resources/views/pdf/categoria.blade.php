@extends('layouts.reporte')

@section('title')
Categorías del restaurante
@endsection

@section('t-headers')
    <th>N°</th>
    <th>Nombre</th>
    <th>Fecha de ingreso</th>
@endsection

@section('t-body')
    <tbody>
        @php
            $no = 1;
        @endphp
        @foreach($cta as $cta)
        <tr>
            <td>{{ $no++ }}</td>
            <td><h5>{{ $cta->titulo }}</h5></td>
            <td>{{ $cta->created_at }}</td>
        </tr>
        @endforeach
    </tbody>
@endsection
