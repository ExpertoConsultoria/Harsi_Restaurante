@extends('layouts.reporte')

@section('title')
Usuarios del Sistema
@endsection

@section('t-headers')
    <th>N°</th>
    <th>Nombre</th>
    <th>Email</th>
    <th>Rol</th>
    <th>Fecha de ingreso</th>
@endsection

@section('t-body')
    <tbody>
        @php
            $no = 1;
        @endphp
        @foreach($user as $user)
            <tr>
                <td>{{ $no++ }}</td>
                <td><h5>{{ $user->name }}
                    {{ $user->apellidos }}</h5></td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role }}</td>
                <td>{{ $user->created_at }}</td>
            </tr>
        @endforeach
    </tbody>
@endsection

