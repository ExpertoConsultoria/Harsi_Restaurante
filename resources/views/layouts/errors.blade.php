{{-- <!DOCTYPE html> --}}
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- CSRF Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Favicon --}}
    <link rel="icon" href="{{ asset('images/favicon.png') }}">
    <title>@yield('http_error')</title>


    {{-- Styles --}}
    <link rel="stylesheet" href="{{ asset('css/http_errors.css') }}">

    {{-- AJAX --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

    @yield('imports')
</head>
<body class="">


    @yield('styles')
    @yield('content')

    <script>
        $("#come_back").click(function () {
            window.location.href = "{{URL::to('home')}}"
        });
    </script>

</body>
</html>
