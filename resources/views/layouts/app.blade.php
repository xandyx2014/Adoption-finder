<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> @yield('title',  config('app.name', 'Laravel') ) </title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('storage/paw.ico') }}">
    @stack('css')
</head>
<body>
<div id="app">
    @include('layouts.header')
    <div class="container-fluid">
        <div class="row">
            @auth
                @include('layouts.nav')
            @endguest

            <main role="main" class="{{ auth()->user() != null ? 'col-10': 'col-12' }} pt-3 px-4">
                @yield('content')
            </main>
        </div>
    </div>
</div>
<script src="{{ asset('js/app.js') }}"></script>
</body>
<!-- Scripts -->
@stack('js')
</html>
