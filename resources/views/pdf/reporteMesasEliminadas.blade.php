@extends('layouts.reporte')

@section('title')
Mesas Canceladas | {{ $month }}
@endsection

@section('t-headers')
    <th>N°</th>
    <th>Fecha</th>
    <th>Día</th>
    <th>Número de eliminados</th>
    <th>Total</th>
    <th>Motivo</th>
    <th>Mes</th>
    <th>Año</th>
@endsection

@section('t-body')
<   tbody>
        @php
            $no = 1;
        @endphp
        @foreach($orden as $orden)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $orden->fecha }}</td>
                <td>{{ $orden->dia }}</td>
                <td>{{ $orden->contador }}</td>
                <td>{{ $orden->total }}</td>
                <td>{{ $orden->motivo }}</td>
                @if($orden->mes == 1)
                <td>Enero</td>
                @endif
                @if($orden->mes == 2)
                <td>Febrero</td>
                @endif
                @if($orden->mes == 3)
                <td>Marzo</td>
                @endif
                @if($orden->mes == 4)
                <td>Abril</td>
                @endif
                @if($orden->mes == 5)
                <td>Mayo</td>
                @endif
                @if($orden->mes == 6)
                <td>Junio</td>
                @endif
                @if($orden->mes == 7)
                <td>Julio</td>
                @endif
                @if($orden->mes == 8)
                <td>Agosto</td>
                @endif
                @if($orden->mes == 9)
                <td>Septiembre</td>
                @endif
                @if($orden->mes == 10)
                <td>Octubre</td>
                @endif
                @if($orden->mes == 11)
                <td>Noviembre</td>
                @endif
                @if($orden->mes == 12)
                <td>Diciembre</td>
                @endif
                <td>{{ $orden->anno }}</td>
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
        <td style="font-weight: bold;">{{$eliminado}}</td>
        <td style="font-weight: bold;">{{$total}}</td>
        <td></td>
        <td></td>
        </tr>
    </tfoot>
@endsection
