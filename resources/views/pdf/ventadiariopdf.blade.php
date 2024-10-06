@extends('layouts.reporte')

@section('title')
Venta mensual
@endsection

@section('t-headers')
    <th scope="col">Folio</th>
    <th scope="col">Fecha</th>
    <th scope="col">Mesa</th>
    <th scope="col">Cajero</th>
    <th scope="col">Productos</th>
    <th scope="col">Forma de Pago</th>
    <th scope="col">Importe</th>
    <th scope="col">Descuento</th>
    <th scope="col">Motivo del descuento</th>
    <th scope="col">Subtotal</th>
    <th scope="col">Propina</th>
    <th scope="col">Total</th>
    <th scope="col">Creación</th>
@endsection

@section('t-body')
    <tbody>
        @foreach($orden as $orden)
            <tr>
                <td>{{$orden['id']}}</td>
                <td>{{$orden['fecha']}}</td>
                <td>{{$orden['mesa']}}</td>
                <td>{{$orden['cajero']}}</td>
                <td>{{$orden['articulo']}}</td>
                <td>{{$orden['forma_pago']}}</td>
                <td>{{$orden['conf_total']}}</td>
                <td>{{$orden['descuento_pesos']}}</td>
                <td>{{$orden['motivo_descuento']}}</td>
                <td>{{$orden['total']}}</td>
                <td>{{$orden['propina']}}</td>
                <td>{{$orden['total2']}}</td>
                <td>{{$orden['created_at']}}</td>
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
        <td></td>
        <td style="font-weight: bold;">{{$importe}}</td>
        <td style="font-weight: bold;">{{$descuento}}</td>
        <td></td>
        <td style="font-weight: bold;">{{$total}}</td>
        <td style="font-weight: bold;">{{$propina}}</td>
        <td style="font-weight: bold;">{{$total2}}</td>
        <td></td>
        </tr>
    </tfoot>
@endsection
