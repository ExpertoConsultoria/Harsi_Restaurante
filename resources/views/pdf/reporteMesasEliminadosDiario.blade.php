@extends('layouts.reporte')

@section('title')
Mesas Canceladas | {{ $fecha }}
@endsection

@section('t-headers')
    <th width="col">Nº</th>
    <th width="col">Fecha</th>
    <th width="col">Mesa</th>
    <th width="col">Cajero</th>
    <th width="col">Total</th>
    <th width="col">Motivo</th>
    <th width="col">Comentario</th>
    <th scope="col">Creación</th>
@endsection

@section('t-body')
    @php
    $no = 1;
    @endphp
    <tbody>
        @foreach($mesas as $temporal)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{$temporal['fecha']}}</td>
                <td>{{$temporal['mesa']}}</td>
                <td>{{$temporal['cajero']}}</td>
                <td>{{$temporal['total']}}</td>
                <td>{{$temporal['motivo']}}</td>
                <td>{{$temporal['comentario']}}</td>
                <td>{{$temporal['created_at']}}</td>
            </tr>
        @endforeach
    </tbody>
@endsection

@section("t-foot")
    <tfoot>
        <tr>
        <td style="font-weight: bold;">Total</td>
        <td></td>
        <td></td>
        <td></td>
        <td style="font-weight: bold;">{{$total}}</td>
        <td></td>
        <td></td>
        </tr>
    </tfoot>
@endsection
