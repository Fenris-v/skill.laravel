<!doctype html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>@yield('title')</title>

    <!-- Custom styles for this template -->
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:700,900" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
          integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

    <!-- Custom styles for this template -->
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet">
</head>

<body>

<div class="container d-flex flex-column min-vh-100 position-relative">
    @if(session()->has('message'))
        @alert(['type' => session('message_type')])
            {{ session('message') }}
        @endalert
    @endif

    @include('layout.header')

    @yield('content')

    @include('layout.footer')
</div>

<script src="{{ mix('/js/manifest.js') }}"></script>
<script src="{{ mix('/js/vendor.js') }}"></script>
<script src="{{ mix('/js/app.js') }}"></script>
