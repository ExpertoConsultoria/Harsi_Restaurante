@extends('layouts.app')

@section('content')

    @if(Auth::check())
    @else
        @include('error')
    @endif
@endsection
