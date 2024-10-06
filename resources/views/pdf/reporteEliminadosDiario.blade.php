@extends('layouts.reporte')

@section('title')
Productos Cancelados | {{ $fecha }}
@endsection

@section('t-headers')
    <th width="col">Nº</th>
    <th width="col">Fecha</th>
    <th width="col">Mesa</th>
    <th width="col">Cajero</th>
    <th width="col">Artículo</th>
    <th width="col">Cantidad</th>
    <th width="col">Precio</th>
    <th width="col">Total</th>
    <th width="col">Motivo</th>
    <th scope="col">Creación</th>
@endsection

@section('t-body')
    <tbody>
        @php
        $no = 1;
        @endphp

        @foreach($temporal as $temporal)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{$temporal['fecha']}}</td>
                <td>{{$temporal['mesa']}}</td>
                <td>{{$temporal['cajero']}}</td>
                <td>{{$temporal['articulo']}}</td>
                <td>{{$temporal['cantidad']}}</td>
                <td>{{$temporal['precio_compra']}}</td>
                <td>{{$temporal['subtotal']}}</td>
                <td>{{$temporal['motivo']}}</td>
                <td>{{$temporal['created_at']}}</td>
            </tr>
        @endforeach
    </tbody>
@endsection

@section('t-foot')
    <tfoot>
        <tr>
        <td style="font-weight: bold;">Total</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td style="font-weight: bold;">{{$cantidad}}</td>
        <td style="font-weight: bold;">{{$precio_compra}}</td>
        <td style="font-weight: bold;">{{$subtotal}}</td>
        <td></td>
        <td></td>
        </tr>
    </tfoot>
@endsection
