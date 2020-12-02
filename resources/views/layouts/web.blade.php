<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> @yield('title',  config('app.name', 'Laravel') ) </title>
    <!-- Fonts -->
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('storage/paw.ico') }}">
</head>
<body>
{{--@if (Route::has('login'))
    @auth
        <li class="nav-item">
            <a href="{{ url('/home') }}" class="text-sm  underline nav-link">Home</a>
        </li>
    @else
        <li class="nav-item">

            <a href="{{ route('login') }}" class="nav-link">Login </a>
        </li>
        @if (Route::has('register'))
            <li class="nav-item">
                <a href="{{ route('register') }}" class="nav-link">Register</a>
            </li>
        @endif
    @endif
@endif--}}
<div class="container">
    <header class="blog-header py-3">
        <div class="row flex-nowrap justify-content-between align-items-center">
            <div class="col-4 pt-1">

                <h5 class="my-0 mr-md-auto font-weight-normal"><i class="fa fa-paw" aria-hidden="true"></i>
                    <a href="/" class="text-primary">
                        Adoption Finder
                    </a>
                    <i class="fa fa-paw" aria-hidden="true"></i></h5>
            </div>
            <div class="col-4 text-center">
                {{--<a class="blog-header-logo text-primary font-weight-bold" href="{{ route('finder.index') }}">Nuestra publicaciones</a>--}}
            </div>
            <div class="col-4 d-flex justify-content-end align-items-center">
                <a class="text-muted" href="#">

                    {{--<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="mx-3">
                        <circle cx="10.5" cy="10.5" r="7.5"></circle>
                        <line x1="21" y1="21" x2="15.8" y2="15.8"></line>
                    </svg>--}}
                </a>

                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/home') }}" class="btn btn-sm btn-primary">Home <i class="fa fa-home" aria-hidden="true"></i></a>

                    @else
                        <a href="{{ route('login') }}" class="btn btn-sm btn-primary"
                           style="margin-right: 5px;">Login </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-sm btn-primary">Register</a>
                        @endif
                    @endif
                @endif
            </div>
        </div>
    </header>

    <div class="nav-scroller py-1 mb-2">
        <nav class="nav d-flex justify-content-between">
            <a class="p-2 text-primary" href="/">INICIO</a>
            <a class="p-2 text-primary" href="{{ route('blog.index') }}">BLOG</a>
            <a class="p-2 text-primary" href="{{ route('finder.index') }}">BUSCA UNA MASCOTA</a>
            <a class="p-2 text-primary" href=" {{ route('fasqs') }}">PREGUNTAS FRECUENTES</a>
            <a class="p-2 text-primary" href="{{ route('nosotros') }}">ACERCA DE NOSOTROS</a>
        </nav>
    </div>
    <div id="app">
    @yield('content')
    </div>
   @include('layouts.footer')
</div>
</body>
<script src="{{ asset('js/app.js') }}"></script>
    @stack('js')
</html>
