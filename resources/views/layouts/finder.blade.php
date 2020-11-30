@extends('layouts.web')
@section('title', 'Adoption Finder')
@section('content')
    <div class="container-fluid gedf-wrapper">
        <div class="row">
            <div class="col-md-3">
                <div class="card elevation-2">
                    <div class="card-body">
                        <div class="h5">@Adoption Finder</div>
                        <div class="h7 text-muted">Nuestro blog</div>
                        <div class="h7">
                            Visita nuestro blog tambien para conocer datos importantes sobre tu mascota
                            <a href="{{ route('blog.index') }}" target="__blank" class="card-link">Nuestro blog</a>
                        </div>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="h6 text-muted">Mascotas disponibles</div>
                            <div class="h5">{{ App\Models\Mascota::where('adoptado', 0)->count() }}</div>
                        </li>
                        <li class="list-group-item">
                            <div class="h6 text-muted">Mascotas adoptados</div>
                            <div class="h5">{{  App\Models\Mascota::where('adoptado', 1)->count() }}</div>
                        </li>
                        <li class="list-group-item">
                            <div class="h6 text-muted">Total publicaciones</div>
                            <div class="h5">{{ App\Models\PublicacionAdopcion::all()->count() }}</div>
                        </li>
                        <li class="list-group-item">

                            Buscando el bienestar de la mascota 🥰
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6 gedf-main">


                <!--- \\\\\\\Post-->
                @yield('content-body')


            </div>
            <div class="col-md-3">
                @section('info')
                @show
                <div class="card gedf-card">
                    <div class="card-body">
                        <h5 class="card-title">Preguntas Frecuentes</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                            the
                            card's content.</p>
                        <a href="#" class="card-link">Ver pregunta</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

