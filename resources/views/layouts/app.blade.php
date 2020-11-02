<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> @yield('title',  config('app.name', 'Laravel') ) </title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 bg-white border-bottom shadow-sm">
        <h5 class="my-0 mr-md-auto font-weight-normal"><i class="fa fa-paw" aria-hidden="true"></i> Adoption Finder <i class="fa fa-paw" aria-hidden="true"></i></h5>
        <ul class="navbar-nav bd-navbar-nav flex-row">
            @guest
                <li class="nav-item">
                    <a class="nav-link" style="margin-right: 5px;" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>

                @endif
            @else
                <li class="nav-item dropdown">
                    <a class="nav-item nav-link dropdown-toggle mr-md-2" href="#" id="bd-versions"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="bd-versions">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                        <a class="dropdown-item" href="#">Perfil</a>
                    </div>
                </li>
            @endguest
        </ul>
    </div>

    <div class="container-fluid">
        <div class="row">
            @auth
                <nav class="col-md-2 d-none d-md-block bg-white sidebar">
                    <div class="sidebar-sticky">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link active" href="{{ route('init') }}" target="_blank">
                                    <i class="fa fa-globe" aria-hidden="true"></i>
                                    Ver Pagina
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="{{ route('init') }}" target="_blank">
                                    <i class="fa fa-newspaper-o" aria-hidden="true"></i>
                                    Ver Blog
                                </a>
                            </li>
                        </ul>
                        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-2 mb-1 text-muted">
                            <span>Gestion adopcion</span>
                            <a class="d-flex align-items-center text-muted" href="#" data-toggle="collapse" data-target="#adopcion">
                                <i class="fa fa-angle-down" aria-hidden="true"></i>
                            </a>
                        </h6>
                        <ul class="nav flex-column collapse" id="adopcion">
                            <li class="nav-item">
                                <a class="nav-link active" href="#">
                                    <i class="fa fa-book" aria-hidden="true"></i>
                                    Dashboard
                                </a>
                            </li>
                        </ul>
                        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-3 mb-1 text-muted">
                            <span>Gestion publicaciones informativas</span>
                            <a class="d-flex align-items-center text-muted" href="#" data-toggle="collapse" data-target="#publicacion">
                                <i class="fa fa-angle-down" aria-hidden="true"></i>
                            </a>
                        </h6>
                        <ul class="nav flex-column collapse" id="publicacion">
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <i class="fa fa-book" aria-hidden="true"></i>
                                    Current month
                                </a>
                            </li>
                        </ul>
                        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-3 mb-1 text-muted">
                            <span>Gestion de denuncias</span>
                            <a class="d-flex align-items-center text-muted" href="#" data-toggle="collapse" data-target="#denuncia">
                                <i class="fa fa-angle-down" aria-hidden="true"></i>
                            </a>
                        </h6>
                        <ul class="nav flex-column collapse" id="denuncia">
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <i class="fa fa-book" aria-hidden="true"></i>
                                    Current month
                                </a>
                            </li>
                        </ul>
                        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-3 mb-1 text-muted">
                            <span>Parametros</span>
                            <a class="d-flex align-items-center text-muted" href="#" data-toggle="collapse" data-target="#parametros">
                                <i class="fa fa-angle-down" aria-hidden="true"></i>
                            </a>
                        </h6>
                        <ul class="nav flex-column collapse" id="parametros">
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <i class="fa fa-book" aria-hidden="true"></i>
                                    Current month
                                </a>
                            </li>
                        </ul>
                        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-3 mb-1 text-muted">
                            <span>Reportes</span>
                            <a class="d-flex align-items-center text-muted" href="#" data-toggle="collapse" data-target="#reportes">
                                <i class="fa fa-angle-down" aria-hidden="true"></i>
                            </a>
                        </h6>
                        <ul class="nav flex-column collapse" id="reportes">
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <i class="fa fa-book" aria-hidden="true"></i>
                                    Current month
                                </a>
                            </li>
                        </ul>
                        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-3 mb-1 text-muted">
                            <span>Adm usuario, auditoria</span>
                            <a class="d-flex align-items-center text-muted" href="#" data-toggle="collapse" data-target="#administracion">
                                <i class="fa fa-angle-down" aria-hidden="true"></i>
                            </a>
                        </h6>
                        <ul class="nav flex-column collapse" id="administracion">
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <i class="fa fa-book" aria-hidden="true"></i>
                                    Current month
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
                @endguest

                <main role="main" class="{{ auth()->user() != null ? 'col-9': 'col-12' }} pt-3 px-4">
                    @yield('content')
                </main>
        </div>
    </div>
</div>
</body>
</html>
