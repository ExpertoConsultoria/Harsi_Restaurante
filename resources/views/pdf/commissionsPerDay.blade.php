@extends('layouts.reporte')

@section('title')
Comisiones por Guia | {{ $fecha }} | {{ $guide }}
@endsection

@section('extra-styles')
    <style type="text/css" media="print">
        td, th {
            text-align: center !important; /* Centra horizontalmente el contenido en cada celda */
            vertical-align: middle !important; /* Centra verticalmente el contenido */
        }
    </style>
@endsection

@section('t-headers')
    <th width="col">Folio</th>
    <th width="col">Fecha</th>
    <th width="col">Importe (Consumo)</th>
    <th width="col">Comisión (%)</th>
    <th width="col">Importe (Guía)</th>
@endsection

@section('t-body')
    <tbody>
        @php
            $total = 0;
        @endphp

        @foreach($ordenes as $orden)
            @php
                // Calculamos la comisión para esta orden
                $total += $orden->comision;
            @endphp

            <tr>
                <td>{{ $orden->id }}</td>
                <td>{{ $orden->fecha }}</td>
                <td>$ {{ number_format($orden->total2 - $orden->propina, 2) }}</td>
                <td>{{ $orden->comision_percentage }} %</td>
                <td>$ {{ number_format($orden->comision, 2) }}</td>
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
            <td style="font-weight: bold;">$ {{ number_format($total, 2) }}</td>
        </tr>
    </tfoot>
@endsection
